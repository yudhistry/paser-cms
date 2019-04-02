<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

  var $page       = 'Galeri';
  var $subpage    = 'Semua Galeri';

  public function __construct() {
    parent::__construct();
    $this->load->model('admin/M_galleries');
    $this->load->model('admin/M_libraries');
    $this->load->model('admin/M_library_option');
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
    $data['ajax_list']  = site_url('admin/gallery/ajax_list');
		$data['content']    = 'admin/_content/gallery';
		$this->load->view('admin/overview',$data);
  }

  public function ajax_list()
  {
    $list = $this->M_galleries->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach($list as $rows)
    {
        $no++;
        $row = array();
        $enc_id = $this->encryption->encrypt($rows->gal_ID);
        $enc_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id);
        $count = $rows->gal_file ? count(explode(',',$rows->gal_file)) : '0';
        $name = '<div class="widget-summary">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-dark">
													<i class="fas fa-folder text-warning"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title"><strong>'.$rows->gal_title.'</strong></h4>
													<div class="info">
														<span class="amount text-muted">'.$count.'</span>
														<span class="text-primary">( <i class="fas fa-user"></i> '.$rows->display_name.' )</span>
													</div>
												</div>
												<div class="summary-footer">
													<a class="text-muted">'.$rows->gal_description.'</a>
												</div>
											</div>
										</div>';
        $row[] = form_checkbox(array('name'=>'check_id[]','value'=>$rows->gal_ID,'class'=>'data-check'));
        $row[] = anchor('pasery/gallery/edit/'.$enc_id,$name,'style="text-decoration:none"');
        $row[] = $rows->gal_view_count;
        $row[] = '
          <i class="fas fa-calendar"></i> '.date('d-m-Y',strtotime($rows->gal_date)).'<br>
          <i class="fas fa-clock"></i> '.date('h:i:s',strtotime($rows->gal_date));
        $data[] = $row;
    }
    $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->M_galleries->count_all(),
                    "recordsFiltered" => $this->M_galleries->count_filtered(),
                    "data" => $data,
                    );
    //output ke format json_decode
    echo json_encode($output);
  }

  public function insert()
  {
    $this->load->library('slug');
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('gal_title','Nama Folder','trim|required|xss_clean',array('required'=>'%s harus diisi.'));
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
        $slug = $this->slug->create_slug_gallery($this->input->post('gal_title'),'psr_galleries');
        $data = array(
          'gal_author'      => $this->session->userdata['logged']['ID'],
          'gal_slug'        => $slug,
          'gal_title'       => $this->input->post('gal_title'),
          'gal_description' => $this->input->post('gal_description'),
          'gal_date'        => date('Y-m-d h:i:s')
        );
        $this->M_galleries->insert($data);
        $message =
          '<div class="alert p-0">
              <blockquote class="success bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>Folder '.$this->page.'</strong> berhasil ditambahkan.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/gallery');
      }
    }
    else
    {
      redirect('pasery/gallery');
    }
  }

  public function edit($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $data['data']       = $this->M_galleries->get_by_id($dec_id);
		$data['content']    = 'admin/_content/gallery_edit';
		$this->load->view('admin/overview',$data);
  }

  public function update($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('gal_title','Nama Folder','trim|required|xss_clean',array('required'=>'%s harus diisi.'));
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
          'gal_author'      => $this->session->userdata['logged']['ID'],
          'gal_title'       => $this->input->post('gal_title'),
          'gal_description' => $this->input->post('gal_description'),
          'gal_modified'    => date('Y-m-d h:i:s')
        );
        $this->M_galleries->update($data,$dec_id);
        $message =
          '<div class="alert p-0">
              <blockquote class="info bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>Folder '.$this->page.'</strong> berhasil diperbarui.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/gallery/edit/'.$id);
      }
    }
    elseif(isset($_POST['btn_save_lib']))
    {
      $checked  = $this->input->post('btn_save_lib');
      if($checked)
      {
        $row = $this->M_galleries->get_by_id($dec_id);
        if($row->gal_file)
        {
          //$array_new  = implode(',',$checked);
          //$collect    = $row->gal_file.','.$array_new;
          //$coll_array = explode(',',$collect);
          //$collectit  = array_unique($coll_array);
          //$image      = implode(',',$collectit);
          $collect      = $row->gal_file.','.$checked;
          $coll_array   = explode(',',$collect);
          $collect_it   = array_unique($coll_array);
          $image        = implode(',',$collect_it);
        }
        else {
          //$image      = implode(',',$collectit);
          $image      = $checked;
        }
        $data     = array(
          'gal_file'  => $image
        );
        $this->M_galleries->update($data,$dec_id);
        $message =
          '<div class="alert p-0">
              <blockquote class="success bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>Gambar </strong> berhasil diperbarui.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/gallery/edit/'.$id);
      }
      else {
        $message =
          '<div class="alert p-0">
              <blockquote class="warning bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>Gambar </strong> gagal diperbarui.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/gallery/edit/'.$id);
      }
    }
    else
    {
      redirect('pasery/gallery/edit/'.$id);
    }
  }

  public function remove()
  {
    $id = $this->uri->segment(4);
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    if(isset($_POST['btn_remove']))
    {
      $checkbox = $this->input->post('check_id');
      if(isset($checkbox))
      {
        $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
        $data['page']       = $this->page;
        $data['subpage']    = $this->subpage;
        $data['checked']    = $checkbox;
    		$data['content']    = 'admin/_content/gallery_remove';
    		$this->load->view('admin/overview',$data);
      }
      else
      {
        redirect('pasery/gallery');
      }
    }
    elseif(isset($_POST['btn_gal_file']))
    {
      $row        = $this->M_galleries->get_by_id($dec_id);
      $files      = explode(',',$row->gal_file);
      $gal_file   = array($this->input->post('btn_gal_file'));
      $gal_files  = array_diff($files,$gal_file);
      $data       = array(
        'gal_file' => implode(',',$gal_files)
      );
      $this->M_galleries->update($data,$dec_id);
      $message =
        '<div class="alert p-0">
            <blockquote class="info bg-white m-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Gambar </strong> telah dihapus.
            </blockquote>
        </div>';
      $this->session->set_flashdata('message',$message);
      redirect('pasery/gallery/edit/'.$id);
    }
    else
    {
      redirect('pasery/gallery');
    }
  }

  public function delete()
  {
    if(isset($_POST['btn_delete']))
    {
      $checked = $this->input->post('ID');
      foreach($checked as $id)
      {
        $this->M_galleries->delete($id);
      }
      $message =
        '<div class="alert p-0">
            <blockquote class="success bg-white m-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>'.$this->subpage.'</strong> terpilih telah dihapus.
            </blockquote>
        </div>';
      $this->session->set_flashdata('message',$message);
      redirect('pasery/gallery');
    }
    else
    {
      redirect('pasery/gallery');
    }
  }

  public function library($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $data['data']       = $this->M_galleries->get_by_id($dec_id);
    $data['ajax_list']  = site_url('admin/library_option/ajax_list');
		$data['content']    = 'admin/_content/gallery_library';
		$this->load->view('admin/overview',$data);
  }


}
