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
| file ini digunakan untuk halaman pengaturan tautan.
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller {

  var $page     = 'Pengaturan';
  var $subpage  = 'Tautan';

	public function __construct()
	{
  	parent::__construct();
    $this->load->model('admin/M_links');
    $this->load->model('admin/M_libraries');
    $this->load->model('admin/M_library_option');
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
    $data['ajax_list']  = site_url('admin/link/ajax_list');
		$data['content']    = 'admin/_content/link';
		$this->load->view('admin/overview',$data);
	}

  public function ajax_list()
  {
    $list = $this->M_links->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach($list as $rows)
    {
        $no++;
        $row = array();
        $enc_id = $this->encryption->encrypt($rows->link_ID);
        $enc_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id);
        $row[] = form_checkbox(array('name'=>'check_id[]','value'=>$rows->link_ID,'class'=>'data-check'));
        $row[] = img(array('src'=>$rows->link_img_path,'height'=>'60'));
        $row[] = anchor('pasery/setting/link/edit/'.$enc_id,'<strong>'.$rows->link_title.'</strong>').'<br><i clas="fas fa-link"></i> '.anchor($rows->link_url,$rows->link_url,array('target'=>'_blank'));
        $row[] = '<i class="fas fa-calendar-alt"></i> '.date('d-m-Y',strtotime($rows->link_date)).'<br><i class="fas fa-clock"></i> '.date('h:i:s',strtotime($rows->link_date));

        $data[] = $row;
    }
    $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->M_links->count_all(),
                    "recordsFiltered" => $this->M_links->count_filtered(),
                    "data" => $data,
                    );
    //output ke format json_decode
    echo json_encode($output);
  }

  public function add()
  {
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
		$data['content']    = 'admin/_content/link_add';
		$this->load->view('admin/overview',$data);
  }

  public function insert()
  {
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('link_title','Nama','trim|required',array('required'=>'%s harus diisi.'));
      $this->form_validation->set_rules('link_url','Link','trim|required',array('required'=>'%s harus diisi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $this->add();
      }
      else
      {
        $data = array(
          'link_title'      => $this->input->post('link_title'),
          'link_url'        => $this->input->post('link_url'),
          'link_date'       => date('Y-m-d h:i:s'),
          'link_img_path'   => $this->input->post('link_img_path')
        );
        $this->M_links->insert($data);
        $message =
          '<div class="alert p-0">
              <blockquote class="success bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>'.$this->page.'</strong> berhasil ditambahkan.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/setting/link');
      }
    }
    elseif(isset($_POST['btn_link_img_path']))
    {
      $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
      $data['page']       = $this->page;
      $data['subpage']    = $this->subpage;
      $data['ajax_list']  = site_url('admin/library_option/ajax_list');
      $data['content']    = 'admin/_content/link_library';
      $this->load->view('admin/overview',$data);
    }
    else
    {
      redirect('pasery/setting/link');
    }
  }

  public function edit($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $data['data']       = $this->M_links->get_by_id($dec_id);
		$data['content']    = 'admin/_content/link_edit';
		$this->load->view('admin/overview',$data);
  }

  public function update($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('link_title','Nama','trim|required',array('required'=>'%s harus diisi.'));
      $this->form_validation->set_rules('link_url','Link','trim|required',array('required'=>'%s harus diisi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $this->add();
      }
      else
      {
        $data = array(
          'link_title'      => $this->input->post('link_title'),
          'link_url'        => $this->input->post('link_url'),
          'link_date'       => date('d-m-Y h:i:s'),
          'link_img_path'   => $this->input->post('link_img_path')
        );
        $this->M_links->update($data,$dec_id);
        $message =
          '<div class="alert p-0">
              <blockquote class="success bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>'.$this->page.'</strong> berhasil ditambahkan.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/setting/link');
      }
    }
    elseif(isset($_POST['btn_link_img_path']))
    {
      $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
      $data['page']       = $this->page;
      $data['subpage']    = $this->subpage;
      $data['ajax_list']  = site_url('admin/library_option/ajax_list');
      $data['content']    = 'admin/_content/link_library_edit';
      $this->load->view('admin/overview',$data);
    }
    else
    {
      redirect('pasery/setting/link');
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
    		$data['content']    = 'admin/_content/link_remove';
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
        redirect('pasery/setting/link');
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
      redirect('pasery/setting/link');
    }
  }

  public function delete()
  {
    if(isset($_POST['btn_delete']))
    {
      $checked = $this->input->post('ID');
      foreach($checked as $id)
      {
        $this->M_links->delete($id);
      }
      $message =
        '<div class="alert p-0">
            <blockquote class="success bg-white m-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>'.$this->subpage.'</strong> telah dihapus.
            </blockquote>
        </div>';
      $this->session->set_flashdata('message',$message);
      redirect('pasery/setting/link');
    }
    else
    {
      redirect('pasery/setting/link');
    }
  }
}
