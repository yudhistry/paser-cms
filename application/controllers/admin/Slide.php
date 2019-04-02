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
| file ini digunakan untuk halaman pengaturan slide.
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Slide extends CI_Controller {

  var $page     = 'Pengaturan';
  var $subpage  = 'Slide';

	public function __construct()
	{
  	parent::__construct();
    $this->load->model('admin/M_slides');
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
    $data['ajax_list']  = site_url('admin/slide/ajax_list');
		$data['content']    = 'admin/_content/slide';
		$this->load->view('admin/overview',$data);
	}

  public function ajax_list()
  {
    $list = $this->M_slides->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach($list as $rows)
    {
        $no++;
        $row = array();
        $badge  = $rows->slide_status == 'aktif' ? 'badge badge-success' : 'badge badge-danger';
        $status = $rows->slide_status == 'aktif' ? 'Aktif' : 'Tidak Aktif';
        $row[] = form_checkbox(array('name'=>'check_id[]','value'=>$rows->slide_ID,'class'=>'data-check'));
        $row[] = img(array('src'=>$rows->slide_url,'height'=>'100'));
        $row[] = anchor('admin/slide/author/'.$rows->slide_author,$rows->display_name);
        $row[] = anchor('admin/slide/update_status/'.$rows->slide_ID,$status,array('class'=>$badge.' text-2 w-100'));
        $row[] = '
          <i class="fas fa-calendar"></i> '.date('d-m-Y',strtotime($rows->slide_date)).'<br>
          <i class="fas fa-clock"></i> '.date('h:i:s',strtotime($rows->slide_date));
        $data[] = $row;
    }
    $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->M_slides->count_all(),
                    "recordsFiltered" => $this->M_slides->count_filtered(),
                    "data" => $data,
                    );
    //output ke format json_decode
    echo json_encode($output);
  }

  public function author()
  {
    if($this->uri->segment(4))
    {
      $this->session->set_userdata('slide_author',$this->uri->segment(4));
      redirect('pasery/setting/slide');
    }
    else
    {
      $this->session->unset_userdata('slide_author');
      redirect('pasery/setting/slide');
    }
  }

  public function add()
  {
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $data['ajax_list']  = site_url('admin/library_option/ajax_list');
		$data['content']    = 'admin/_content/slide_add';
		$this->load->view('admin/overview',$data);
  }

  public function insert()
  {
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      //$this->form_validation->set_rules('lib_file','Berkas','required',array('required'=>'%s harus diisi.'));
      $this->form_validation->set_rules('slide_title','Nama','trim|required|xss_clean',array('required'=>'%s harus diisi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $message =
          '<div class="alert p-0">
              <blockquote class="danger bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>Folder Baru</strong> gagal disimpan.'.validation_errors().'
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        $this->index();
      }
      else
      {
        $data = array(
          'slide_author'      => $this->session->userdata['logged']['ID'],
          'slide_title'       => $this->input->post('slide_title'),
          'slide_description' => $this->input->post('slide_description'),
          'slide_url'         => $this->input->post('slide_url'),
          'slide_status'      => 'aktif',
          'slide_date'        => date('Y-m-d h:i:s')
        );
        $this->M_slides->insert($data);
        $message =
          '<div class="alert p-0">
              <blockquote class="success bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>'.$this->page.'</strong> berhasil ditambahkan.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/setting/slide');
      }
    }
    elseif(isset($_POST['btn_save_lib']))
    {
      $row = $this->M_libraries->get_by_id($this->input->post('btn_save_lib'));
      $data = array(
        'slide_author'      => $this->session->userdata['logged']['ID'],
        'slide_title'       => $row->lib_name,
        'slide_description' => $row->lib_content,
        'slide_url'         => $row->lib_path,
        'slide_status'      => 'aktif',
        'slide_date'        => date('Y-m-d h:i:s')
      );
      $this->M_slides->insert($data);
      $message =
        '<div class="alert p-0">
            <blockquote class="success bg-white m-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>'.$this->subpage.'</strong> berhasil ditambahkan.
            </blockquote>
        </div>';
      $this->session->set_flashdata('message',$message);
      redirect('pasery/setting/slide');
    }
    else
    {
      redirect('pasery/setting/slide');
    }
  }

  public function update_status()
  {
    $id     = $this->uri->segment(4);
    $status = $this->M_slides->get_by_id($id);
    $change = $status->slide_status == 'aktif' ? 'tidak_aktif' : 'aktif';
    $data = array(
      'slide_status' => $change
    );
    $this->M_slides->update($data,$id);
    $message =
      '<div class="alert p-0">
          <blockquote class="success bg-white m-0">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>Status '.$this->subpage.' '.$status->slide_title.'</strong> berhasil diubah.
          </blockquote>
      </div>';
    $this->session->set_flashdata('message',$message);
    redirect('pasery/setting/slide');
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
    		$data['content']    = 'admin/_content/slide_remove';
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
        redirect('pasery/setting/slide');
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
      redirect('pasery/setting/slide');
    }
  }

  public function delete()
  {
    if(isset($_POST['btn_delete']))
    {
      $checked = $this->input->post('ID');
      foreach($checked as $id)
      {
        $this->M_slides->delete($id);
      }
      $message =
        '<div class="alert p-0">
            <blockquote class="success bg-white m-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>'.$this->subpage.'</strong> telah dihapus.
            </blockquote>
        </div>';
      $this->session->set_flashdata('message',$message);
      redirect('pasery/setting/slide');
    }
    else
    {
      redirect('pasery/setting/slide');
    }
  }
}
