<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    var $page       = 'Pengguna';
    var $subpage    = 'Profil Anda';

    public function __construct() {
      parent::__construct();
      $this->load->model('admin/M_users');
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
    	$ID 	= $this->session->userdata['logged']['ID'];
    	$row 	= $this->M_users->get_by_id($ID);
      $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
      $data['page']       = $this->page;
      $data['subpage']    = $this->subpage;
      $data['data']       = $row;
  		$data['content']    = 'admin/_content/profile';
  		$this->load->view('admin/overview',$data);
    }

    public function update()
    {
      if(isset($_POST['btn_save']))
      {
        //set validasi data input
        $this->form_validation->set_rules('ID','ID','required',array('required'=>'%s harus diisi.'));
        $this->form_validation->set_rules('user_login','Nama Pengguna','required|xss_clean',array('required'=>'%s harus diisi.'));
        $this->form_validation->set_rules('user_fullname','Nama Lengkap','required',array('required'=>'%s harus diisi.'));
        $this->form_validation->set_rules('user_email','Email','required|valid_email|xss_clean',array('required'=>'%s harus diisi.','valid_email'=>'Penulisan %s tidak valid.'));
        $this->form_validation->set_rules('user_url','URL','valid_url|xss_clean',array('valid_url'=>'Penulisan %s tidak valid.'));
        if($this->input->post('user_password') or $this->input->post('user_password_confirm'))
        {
          $this->form_validation->set_rules('user_password','Sandi Baru','trim|required|min_length[8]|xss_clean',array('required'=>'%s harus diisi.','min_length'=>'%s minimal 8 karakter'));
          $this->form_validation->set_rules('user_password_confirm','Konfirmasi Sandi Baru','trim|required|matches[user_password]',array('required'=>'%s harus diisi.','matches'=>'%s tidak sesuai dengan Sandi Baru.'));
        }
        //Proses validasi data input
        if($this->form_validation->run() == FALSE)
        {
          $message =
              '<div class="alert p-0">
                  <blockquote class="danger bg-white m-0">
                      <button data-dismiss="alert" class="close" type="button">×</button>
                      <strong>'.$this->subpage.'</strong> gagal diperbarui. Cek kembali isian Anda!
                  </blockquote>
              </div>';
          $this->session->set_flashdata('message',$message);
          $this->index();
        }
        else
        {
          // set data input
          $id     = $this->input->post('ID');
          //$hash   = password_hash($this->input->post('user_password'),PASSWORD_DEFAULT);
          if($this->input->post('user_password'))
          {
            $data   = array(
                'user_login'    => $this->input->post('user_login'),
                'user_fullname' => $this->input->post('user_fullname'),
                'display_name'  => $this->input->post('display_name'),
                'user_email'    => $this->input->post('user_email'),
                'user_url'      => $this->input->post('user_url'),
                'user_phone'    => $this->input->post('user_phone'),
                'user_address'  => $this->input->post('user_address'),
                'user_bio'      => $this->input->post('user_bio'),
                'user_password' => password_hash($this->input->post('user_password'),PASSWORD_DEFAULT)
            );
          }
          else
          {
            $data   = array(
                'user_login'    => $this->input->post('user_login'),
                'user_fullname' => $this->input->post('user_fullname'),
                'display_name'  => $this->input->post('display_name'),
                'user_email'    => $this->input->post('user_email'),
                'user_url'      => $this->input->post('user_url'),
                'user_phone'    => $this->input->post('user_phone'),
                'user_address'  => $this->input->post('user_address'),
                'user_bio'      => $this->input->post('user_bio')
            );
          }
          // update data ke model
          $this->M_users->update($data,$id);
          $message =
              '<div class="alert p-0">
                  <blockquote class="info bg-white m-0">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <strong>'.$this->subpage.'</strong> berhasil diperbarui.
                  </blockquote>
              </div>';
          $this->session->set_flashdata('message',$message);
          redirect('pasery/profile');
        }
      }
      else
      {
        redirect($this->index());
      }
    }

    public function avatar()
    {
      if(isset($_POST['btn_save']))
      {
        if($this->input->post('ID'))
        {
          $config['upload_path'] = './assets/library/user/';
          $config['allowed_types'] = 'jpg|jpeg|png';
          $config['file_name'] = $this->input->post('ID');
          $config['overwrite'] = TRUE;
          $config['max_size'] = '2024';
          $this->upload->initialize($config);
          if ($this->upload->do_upload('user_avatar'))
          {
            $file   = $this->upload->data();
            $avatar = $file['file_name'];
            $data   = array(
                'user_avatar'   => $avatar
            );
            $this->M_users->update($data,$this->input->post('ID'));
            $message =
                '<div class="alert p-0">
                    <blockquote class="info bg-white m-0">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Foto '.$this->subpage.'</strong> berhasil diperbarui.
                    </blockquote>
                </div>';
            $this->session->set_flashdata('message',$message);
            redirect('admin/profile');
          }
          else
          {
            $message =
                '<div class="alert p-0">
                    <blockquote class="danger bg-white m-0">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Foto '.$this->subpage.'</strong> gagal diperbarui.'.$this->upload->display_errors().'
                    </blockquote>
                </div>';
            $this->session->set_flashdata('message',$message);
            redirect('admin/profile');
          }
        }
        else
        {
                $message =
                    '<div class="alert mt-5 mb-0 p-0">
                        <blockquote class="warning bg-white m-0">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>ID Foto '.$this->subpage.'</strong> tidak ditemukan.
                        </blockquote>
                    </div>';
                $this->session->set_flashdata('message',$message);
                redirect('admin/profile');
        }
      }
      else
      {
        redirect($this->index());
      }
    }
}
