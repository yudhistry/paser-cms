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

class Menu extends CI_Controller {

  var $page     = 'Pengaturan';
  var $subpage  = 'Menu';

	public function __construct()
	{
  	parent::__construct();
    $this->load->model('admin/M_menus');
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
    $data['menu']     = $this->M_menus->get_all();
		$data['content']	= 'admin/_content/menu';
		$this->load->view('admin/overview',$data);
	}

  public function insert()
  {
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('menu_title','Nama','trim|required',array('required'=>'%s harus diisi.'));
      $this->form_validation->set_rules('menu_url','Link','trim',array('required'=>'%s harus diisi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $this->index();
      }
      else
      {
        if($this->input->post('menu_parent') <> '0')
        {
          $role       = $this->M_menus->get_by_id($this->input->post('menu_parent'));
          $menu_role  = $role->menu_role + 1;
        }
        else {
          $menu_role = '0';
        }
        $data = array(
          'menu_title'  => $this->input->post('menu_title'),
          'menu_url'    => $this->input->post('menu_url'),
          'menu_parent' => $this->input->post('menu_parent'),
          'menu_order'  => $this->input->post('menu_order'),
          'menu_role'   => $menu_role
        );
        $this->M_menus->insert($data);
        $message =
          '<div class="alert p-0">
              <blockquote class="success bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>'.$this->page.' '.$this->subpage.'</strong> berhasil ditambahkan.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/setting/menu','refresh');
      }
    }
    else
    {
      redirect('pasery/setting/menu','refresh');
    }
  }

  public function edit($id)
	{
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    $data['option']		= $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']     = $this->page;
    $data['subpage']  = $this->subpage;
    $data['menu']     = $this->M_menus->get_all();
    $data['data']     = $this->M_menus->get_by_id($dec_id);
		$data['content']	= 'admin/_content/menu_edit';
		$this->load->view('admin/overview',$data);
	}

  public function update($id)
  {
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('menu_title','Nama','trim|required',array('required'=>'%s harus diisi.'));
      $this->form_validation->set_rules('menu_url','Link','trim',array('required'=>'%s harus diisi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $this->index();
      }
      else
      {
        if($this->input->post('menu_parent') <> '0')
        {
          $role       = $this->M_menus->get_by_id($this->input->post('menu_parent'));
          $menu_role  = $role->menu_role + 1;
        }
        else {
          $menu_role = '0';
        }
        $data = array(
          'menu_title'  => $this->input->post('menu_title'),
          'menu_url'    => $this->input->post('menu_url'),
          'menu_parent' => $this->input->post('menu_parent'),
          'menu_order'  => $this->input->post('menu_order'),
          'menu_role'   => $menu_role
        );
        $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
        $dec_id = $this->encryption->decrypt($dec_id);
        $this->M_menus->update($data,$dec_id);
        $message =
          '<div class="alert p-0">
              <blockquote class="info bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>'.$this->page.' '.$this->subpage.'</strong> berhasil diperbarui.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/setting/menu','refresh');
      }
    }
    else
    {
      redirect('pasery/setting/menu/'.$id);
    }
  }

  public function delete($id)
  {
    if(isset($_POST['btn_remove']))
    {
      if($id)
      {
        $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
        $dec_id = $this->encryption->decrypt($dec_id);
        $row    = $this->M_menus->get_by_id($dec_id);
        $role   = $row->menu_role;
        $parent = $row->menu_parent;
        $data = array(
          'menu_role'   => $role,
          'menu_parent' => $parent
        );
        $this->M_menus->update_by_parent($data,$dec_id);
        $this->M_menus->delete($dec_id);
        $message =
          '<div class="alert p-0">
              <blockquote class="success bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>'.$this->subpage.' '.$this->input->post('menu_title').'</strong> telah dihapus.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/setting/menu');
      }
      else {
        $message =
          '<div class="alert p-0">
              <blockquote class="danger bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>'.$this->subpage.'</strong> gagal dihapus.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('admin/settings/menu/edit/'.$id);
      }
    }
    else
    {
      redirect('pasery/setting/menu');
    }
  }

}
