<?php
/*
| -------------------------------------------------------------------
| Admin Dashboard Paser CMS
| -------------------------------------------------------------------
|
| penulis     : yudhistira ramadhany
| surel       : yudhistira.ramadhany.yr@gmail.com
| jabatan     : kepala seksi aplikasi dan pengembangan informatika
| organisasi  : dinas komunikasi, informatika, statistik dan persandian
| instansi    : pemerintah kabupaten paser
|
| file ini digunakan untuk halaman pengaturan umum website.
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

  var $page     = 'Pengaturan';
  var $subpage  = 'Umum';

	public function __construct()
	{
  	parent::__construct();
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
		$data['option']		= $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']     = $this->page;
    $data['subpage']  = $this->subpage;
    $data['data']     = $data['option'];
		$data['content']	= 'admin/_content/setting';
		$this->load->view('admin/overview',$data);
	}

  public function update()
  {
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('ID','ID','required',array('required'=>'%s harus diisi.'));
      $this->form_validation->set_rules('opt_name','Judul Situs','required',array('required'=>'%s harus diisi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $message =
            '<div class="alert p-0">
                <blockquote class="danger bg-white m-0">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>'.$this->page.' '.$this->subpage.'</strong> gagal diperbarui. Cek kembali isian Anda!
                </blockquote>
            </div>';
        $this->session->set_flashdata('message',$message);
        $this->index();
      }
      else
      {
        // set data input
        $id     = $this->input->post('ID');
        $data   = array(
          'opt_name'    		=> $this->input->post('opt_name'),
          'opt_slogan'    	=> $this->input->post('opt_slogan'),
          'opt_description' => $this->input->post('opt_description'),
          'opt_address'    	=> $this->input->post('opt_address'),
          'opt_telp'    		=> $this->input->post('opt_telp'),
          'opt_email'    		=> $this->input->post('opt_email'),
          'opt_read'        => $this->input->post('opt_read'),
          'opt_facebook'    => $this->input->post('opt_facebook'),
          'opt_twitter'     => $this->input->post('opt_twitter')
        );
        // update data ke model
        $this->M_options->update($data,$id);
        $message =
            '<div class="alert p-0">
                <blockquote class="info bg-white m-0">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>'.$this->page.' '.$this->subpage.'</strong> berhasil diperbarui.
                </blockquote>
            </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/setting');
      }
    }
    else
    {
        redirect('pasery/setting');
    }
  }

  public function logo()
  {
      if(isset($_POST['btn_save']))
      {
          if($this->input->post('ID'))
          {
              $config['upload_path'] 		= './assets/library/option/logo/';
              $config['allowed_types'] 	= 'jpg|png';
              $config['file_name'] 		= $this->input->post('ID');
              $config['overwrite'] 		= TRUE;
              $config['max_size'] 		= '5000';
              $this->upload->initialize($config);
              if ($this->upload->do_upload('opt_logo'))
              {
                  $file   = $this->upload->data();
                  $logo 	= $file['file_name'];
                  $data   = array(
                      'opt_logo'   => $logo
                  );
                  $this->M_options->update($data,$this->input->post('ID'));
                  $message =
                      '<div class="alert p-0">
                          <blockquote class="info bg-white m-0">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Logo berhasil diperbarui.</strong>
                          </blockquote>
                      </div>';
                  $this->session->set_flashdata('message',$message);
                  redirect('admin/setting');
              }
              else
              {
                  $message =
                      '<div class="alert p-0">
                          <blockquote class="danger bg-white m-0">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Logo gagal diperbarui.</strong>'.$this->upload->display_errors().'
                          </blockquote>
                      </div>';
                  $this->session->set_flashdata('message',$message);
                  redirect('pasery/setting');
              }
          }
          else
          {
                  $message =
                      '<div class="alert mt-5 mb-0 p-0">
                          <blockquote class="warning bg-white m-0">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>ID Logo tidak ditemukan.</strong>
                          </blockquote>
                      </div>';
                  $this->session->set_flashdata('message',$message);
                  redirect('pasery/setting');
          }
      }
      else
      {
          redirect('pasery/setting');
      }
  }

  public function favicon()
  {
      if(isset($_POST['btn_save']))
      {
          if($this->input->post('ID'))
          {
              $config['upload_path'] 		= './assets/library/option/favicon/';
              $config['allowed_types'] 	= 'jpg|jpeg|png';
              $config['file_name'] 		= $this->input->post('ID');
              $config['overwrite'] 		= TRUE;
              $config['max_size'] 		= '2000';
              $this->upload->initialize($config);
              if ($this->upload->do_upload('opt_favicon'))
              {
                  $file   	= $this->upload->data();
                  $favicon 	= $file['file_name'];
                  $data   	= array(
                      'opt_favicon'   => $favicon
                  );
                  $this->M_options->update($data,$this->input->post('ID'));
                  $message =
                      '<div class="alert p-0">
                          <blockquote class="info bg-white m-0">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Favicon</strong> berhasil diperbarui.
                          </blockquote>
                      </div>';
                  $this->session->set_flashdata('message',$message);
                  redirect('pasery/setting');
              }
              else
              {
                  $message =
                      '<div class="alert p-0">
                          <blockquote class="danger bg-white m-0">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Favicon</strong> gagal diperbarui.'.$this->upload->display_errors().'
                          </blockquote>
                      </div>';
                  $this->session->set_flashdata('message',$message);
                  redirect('pasery/setting');
              }
          }
          else
          {
                  $message =
                      '<div class="alert p-0">
                          <blockquote class="warning bg-white m-0">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>ID</strong> tidak ditemukan.'.$this->upload->display_errors().'
                          </blockquote>
                      </div>';
                  $this->session->set_flashdata('message',$message);
                  redirect('pasery/setting');
          }
      }
      else
      {
        redirect('pasery/setting');
      }
  }

}
