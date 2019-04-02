<?php
/*
| -------------------------------------------------------------------
| Admin Login Paser CMS
| -------------------------------------------------------------------
|
| penulis     : yudhistira ramadhany
| surel       : yudhistira.ramadhany.yr@gmail.com
| jabatan     : kepala seksi aplikasi dan pengembangan informatika
| organisasi  : dinas komunikasi, informatika, statistik dan persandian
| instansi    : pemerintah kabupaten paser
|
| file ini digunakan untuk otentifikasi/verifikasi data pengguna.
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
  	parent::__construct();
		$this->load->model('admin/M_auth');
	}

	public function index()
	{
		// ambil cookie
		$cookie = get_cookie($this->config->item('application'));
		//cek session
		if($this->session->userdata('logged'))
		{
			redirect('pasery/dashboard');
		}
		elseif($cookie <> '')
		{
			// cek cookie
			$row = $this->M_auth->get_by_cookie($cookie)->row();
			if($row)
			{
				$this->_register_session($row);
			}
			else
			{
				$data = array(
					'user_login'		=> set_value('login'),
					'user_password'	=> set_value('password'),
					'user_cookie'		=> set_value('rememberme')
				);
				// ambil basis data dari tabel psr_options
				$data['option']		= $this->M_options->get_by_id($this->config->item('opt_ID'));
				// set content file login
				$data['content']	= 'admin/_content/login';
				$this->load->view('admin/signin',$data);
			}
		}
		else
		{
			$data = array(
				'user_login'		=> set_value('login'),
				'user_password'	=> set_value('password'),
				'user_cookie'		=> set_value('rememberme')
			);
			// ambil basis data dari tabel psr_options
			$data['option']		= $this->M_options->get_by_id($this->config->item('opt_ID'));
			// set content file login
			$data['content']	= 'admin/_content/login';
			$this->load->view('admin/signin',$data);
		}
	}

	public function login()
	{
		if(isset($_POST['btn_login']))
		{
			// set variable input
			$login 		= $this->input->post('login');
			$password = $this->input->post('password');
			$remember	= $this->input->post('rememberme');
      // set validasi data inout
			$this->form_validation->set_rules('login','Pengguna','trim|required|xss_clean',array('required'=>'%s harus diisi.'));
      $this->form_validation->set_rules('password','Password','required|xss_clean',array('required'=>'%s harus diisi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
				$this->index();
      }
      else
      {
				$check_login = $this->M_auth->login($login);
				$row = $check_login->row();
				if($row)
				{
					$hash = $row->user_password;
					if(password_verify($password,$hash))
					{
						if($row->user_status == 1)
						{
							$message =
								'<div class="alert alert-block alert-warning">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<strong>Peringatan!</strong> Akun '.$login.' belum diaktifasi. Harap hubungi Administrator.
								</div>';
							$this->session->set_flashdata('message',$message);
							$this->index();
						}
						else
						{
							if($remember)
							{
								$key = random_string('alnum',100);
								// set masa kadaluarsa cookie 30 hari ke depan
								set_cookie($this->config->item('application'),$key,3600*24*30);
								// simpan cookie ke database
								$data = array(
									'user_cookie'	=> $key
								);
								$this->M_auth->update($data,$row->ID);
							}
							$this->_register_session($row);
						}
					}
					else
					{
						$message =
							'<div class="alert alert-block alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>Kesalahan!</strong> Kata sandi salah. <a href="#">Lupa Kata Sandi?</a>.
							</div>';
						$this->session->set_flashdata('message',$message);
						$this->index();
					}
				}
				else
				{
					$message =
						'<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<strong>Kesalahan!</strong> Pengguna atau kata sandi salah.
						</div>';
					$this->session->set_flashdata('message',$message);
					redirect('pasery');
				}
      }
		}
		else
		{
			redirect('pasery','refresh');
		}
	}

	public function _register_session($row)
	{
		$user = $this->M_auth->get_by_id($row->ID);
		$user_sess = array(
			'ID'							=> $user->ID,
			'user_login'			=> $user->user_login,
			'user_cookie'			=> $user->user_cookie,
			'user_fullname'		=> $user->user_fullname,
			'user_email'			=> $user->user_email,
			'user_url'				=> $user->user_url,
			'user_registered'	=> $user->user_registered,
			'user_role'				=> $user->user_role,
			'user_status'			=> $user->user_status,
			'user_avatar'			=> $user->user_avatar,
			'usrole_name'			=> $user->usrole_name,
			'display_name'		=> $user->display_name,
			'last_login'			=> $user->last_login,
	    'last_ip_address'	=> $user->last_ip_address
		);
		$this->session->set_userdata('logged',$user_sess);
		$message =
			'<div class="alert alert-block alert-info mt-3 mb-0">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>Selamat datang,</strong> '.$user->display_name.'.
			</div>';
		$this->session->set_flashdata('message',$message);
		redirect('pasery/dashboard');
	}

	public function logout()
	{
		delete_cookie($this->config->item('application'));
		$this->session->sess_destroy();
		redirect('pasery');
	}

	public function not_found()
	{
		$this->load->view('admin/_includes/error_404');
	}

}
