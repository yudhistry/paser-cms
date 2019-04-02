<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  var $page     = 'Pengguna';
  var $subpage  = 'Semua Pengguna';

	public function __construct()
	{
  	parent::__construct();
    $this->load->model('admin/M_users');
    $this->load->model('admin/M_userrole');
    // cek sesi user
    if($this->session->userdata('logged'))
    {
      return;
    }
    else {
      redirect('pasery');
    }
	}

	public function index()
	{
		$data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $data['ajax_list']  = site_url('admin/user/ajax_list');
		$data['content']    = 'admin/_content/user';
		$this->load->view('admin/overview',$data);
	}

  public function ajax_list()
  {
    $list = $this->M_users->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach($list as $rows)
    {
        $no++;
        $row = array();
        $enc_id = $this->encryption->encrypt($rows->ID);
        $enc_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id);
        $checkbox   = $rows->user_super <> '0' ? form_checkbox(array('name'=>'check_id[]','value'=>$enc_id,'class'=>'data-check')) : '';
        $edit       = $rows->user_super <> '0' ? anchor('pasery/user/edit/'.$enc_id,'<strong>'.$rows->user_login.'</strong>',array('title'=>'Sunting')) : '<strong>'.$rows->user_login.'</strong>';
        $row[] = $checkbox;
        $row[] = $edit;
        $row[] = $rows->user_fullname;
        $row[] = mailto($rows->user_email,$rows->user_email,array('title'=>'Kirim Email'));
        $row[] = $rows->usrole_name;
        $row[] = date('d-m-Y h:i:s',strtotime($rows->user_registered));
        $data[] = $row;
    }
    $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->M_users->count_all(),
                    "recordsFiltered" => $this->M_users->count_filtered(),
                    "data" => $data,
                    );
    //output ke format json_decode
    echo json_encode($output);
  }

  public function role()
  {
    if($this->uri->segment(4))
    {
      $this->session->set_userdata('user_role',$this->uri->segment(4));
      redirect('pasery/user');
    }
    else
    {
      $this->session->unset_userdata('user_role');
      redirect('pasery/user');
    }
  }

  public function add()
  {
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = 'Tambah Pengguna';
    $data['ajax_list']  = site_url('admin/library_option/ajax_list');
		$data['content']    = 'admin/_content/user_add';
		$this->load->view('admin/overview',$data);
  }

  public function insert()
  {
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('user_login','Nama Pengguna','trim|required|is_unique[psr_users.user_login]|xss_clean',array('required'=>'%s harus diisi.','is_unique'=>'%s sudah digunakan.'));
      $this->form_validation->set_rules('user_fullname','Nama Lengkap','required',array('required'=>'%s harus diisi.'));
      $this->form_validation->set_rules('user_email','Email','required|valid_email|is_unique[psr_users.user_email]|xss_clean',array('required'=>'%s harus diisi.','valid_email'=>'Penulisan %s tidak valid.','is_unique'=>'%s sudah digunakan.'));
      $this->form_validation->set_rules('user_url','URL','trim|valid_url|xss_clean',array('valid_url'=>'Penulisan %s tidak valid.'));
      $this->form_validation->set_rules('user_password','Sandi','trim|required|min_length[8]|xss_clean',array('required'=>'%s harus diisi.','min_length'=>'%s minimal 8 karakter'));
      $this->form_validation->set_rules('user_password_confirm','Konfirmasi Sandi','trim|required|matches[user_password]',array('required'=>'%s harus diisi.','matches'=>'%s tidak sesuai dengan Sandi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $this->add();
      }
      else
      {
        $data = array(
            //'user_login'        => $this->input->post('user_login'),
            'user_fullname'     => $this->input->post('user_fullname'),
            'display_name'      => $this->input->post('user_login'),
            'user_email'        => $this->input->post('user_email'),
            'user_url'          => $this->input->post('user_url'),
            'user_phone'        => $this->input->post('user_phone'),
            'user_role'         => $this->input->post('user_role'),
            //'user_registered'   => date('Y-m-d h:i:s'),
            'user_password'     => password_hash($this->input->post('user_password'),PASSWORD_DEFAULT)
        );
        $this->M_users->update($data,$dec_id);
        $message =
            '<div class="alert p-0">
                <blockquote class="success bg-white m-0" data-dismiss="alert">
                    <strong>'.$this->page.' berhasil ditambahkan.</strong>
                </blockquote>
            </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/user');
      }
    }
    else
    {
      redirect('pasery/user/add','refresh');
    }
  }

  public function edit($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $data['data']       = $this->M_users->get_by_id($dec_id);
		$data['content']    = 'admin/_content/user_edit';
		$this->load->view('admin/overview',$data);
  }

  public function update($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('user_login','Nama Pengguna','trim|required|xss_clean',array('required'=>'%s harus diisi.'));
      $this->form_validation->set_rules('user_fullname','Nama Lengkap','required',array('required'=>'%s harus diisi.'));
      $this->form_validation->set_rules('user_email','Email','required|valid_email|xss_clean',array('required'=>'%s harus diisi.','valid_email'=>'Penulisan %s tidak valid.'));
      $this->form_validation->set_rules('user_url','URL','trim|valid_url|xss_clean',array('valid_url'=>'Penulisan %s tidak valid.'));
      if($this->input->post('user_password'))
      {
        $this->form_validation->set_rules('user_password','Sandi','trim|required|min_length[8]|xss_clean',array('required'=>'%s harus diisi.','min_length'=>'%s minimal 8 karakter'));
        $this->form_validation->set_rules('user_password_confirm','Konfirmasi Sandi','trim|required|matches[user_password]',array('required'=>'%s harus diisi.','matches'=>'%s tidak sesuai dengan Sandi.'));
      }
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $this->edit($id);
      }
      else
      {
        if($this->input->post('user_password'))
        {
          $data = array(
              //'user_login'        => $this->input->post('user_login'),
              'user_fullname'     => $this->input->post('user_fullname'),
              'display_name'      => $this->input->post('user_login'),
              'user_email'        => $this->input->post('user_email'),
              'user_url'          => $this->input->post('user_url'),
              'user_phone'        => $this->input->post('user_phone'),
              'user_role'         => $this->input->post('user_role'),
              //'user_registered'   => date('Y-m-d h:i:s'),
              'user_password'     => password_hash($this->input->post('user_password'),PASSWORD_DEFAULT)
          );
          $this->M_users->update($data,$dec_id);
          $message =
              '<div class="alert p-0">
                  <blockquote class="success bg-white m-0" data-dismiss="alert">
                      <strong>'.$this->page.' berhasil ditambahkan.</strong>
                  </blockquote>
              </div>';
          $this->session->set_flashdata('message',$message);
          redirect('pasery/user');
        }
        else {
          $data = array(
              //'user_login'        => $this->input->post('user_login'),
              'user_fullname'     => $this->input->post('user_fullname'),
              'display_name'      => $this->input->post('user_login'),
              'user_email'        => $this->input->post('user_email'),
              'user_url'          => $this->input->post('user_url'),
              'user_phone'        => $this->input->post('user_phone'),
              'user_role'         => $this->input->post('user_role'),
              //'user_registered'   => date('Y-m-d h:i:s'),
              //'user_password'     => password_hash($this->input->post('user_password'),PASSWORD_DEFAULT)
          );
          $this->M_users->update($data,$dec_id);
          $message =
              '<div class="alert p-0">
                  <blockquote class="info bg-white m-0" data-dismiss="alert">
                      <strong>'.$this->page.' berhasil diperbarui.</strong>
                  </blockquote>
              </div>';
          $this->session->set_flashdata('message',$message);
          redirect('pasery/user');
        }
      }
    }
    else {
      redirect('pasery/user/edit/'.$id);
    }
  }

  public function remove()
  {
    if(isset($_POST['btn_remove']))
    {
      $checkbox = $this->input->post('check_id');
      if(isset($checkbox))
      {
        $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
        $data['page']       = $this->page;
        $data['subpage']    = $this->subpage;
        $data['checked']    = $checkbox;
    		$data['content']    = 'admin/_content/user_remove';
    		$this->load->view('admin/overview',$data);
      }
      else
      {
        $message =
          '<div class="alert p-0">
              <blockquote class="warning bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>Tidak ada '.$this->subpage.'</strong> terpilih.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/user');
      }
    }
    else
    {
      $message =
        '<div class="alert p-0">
            <blockquote class="warning bg-white m-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Tidak ada '.$this->subpage.'</strong> terpilih tes tes.
            </blockquote>
        </div>';
      $this->session->set_flashdata('message',$message);
      redirect('pasery/user');
    }
  }

  public function delete()
  {
    if(isset($_POST['btn_delete']))
    {
      $checked = $this->input->post('ID');
      foreach($checked as $id)
      {
        $this->M_users->delete($id);
      }
      $message =
        '<div class="alert p-0">
            <blockquote class="success bg-white m-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>'.$this->subpage.'</strong> telah dihapus.
            </blockquote>
        </div>';
      $this->session->set_flashdata('message',$message);
      redirect('pasery/user');
    }
    else
    {
      redirect('pasery/user');
    }
  }
}
