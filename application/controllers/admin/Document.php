<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

  var $page       = 'Dokumen';
  var $subpage    = 'Semua Dokumen';

  public function __construct() {
    parent::__construct();
    $this->load->model('admin/M_documents');
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
    $this->session->unset_userdata('doc_parent');
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $data['ajax_list']  = site_url('admin/document/ajax_list');
		$data['content']    = 'admin/_content/document';
		$this->load->view('admin/overview',$data);
  }

  public function parent()
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $this->uri->segment(3));
    $dec_id = $this->encryption->decrypt($dec_id);
    $this->session->set_userdata('doc_parent',$dec_id);
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $data['data']       = $this->M_documents->get_by_id($dec_id);
    $data['ajax_list']  = site_url('admin/document/ajax_list');
		$data['content']    = 'admin/_content/document_parent';
		$this->load->view('admin/overview',$data);
  }

  public function ajax_list()
  {
    $list = $this->M_documents->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach($list as $rows)
    {
        $no++;
        $row = array();
        $enc_id = $this->encryption->encrypt($rows->doc_ID);
        $enc_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id);
        if($rows->doc_type == 'folder')
        {
          $type = '<div class="widget-summary">
  											<div class="widget-summary-col widget-summary-col-icon">
  												<div class="summary-icon bg-dark">
  													<i class="fas fa-folder text-warning"></i>
  												</div>
  											</div>
  											<div class="widget-summary-col">
  												<div class="summary">
  													<h4 class="title text-primary"><strong>'.$rows->doc_title.'</strong></h4>
  													<div class="info">
  														<span class="text-muted">'.$rows->doc_description.'</span>
  													</div>
  												</div>
  												<div class="summary-footer">
  													<a class="text-muted"><i class="fas fa-user"></i> '.$rows->display_name.'</a>
  												</div>
  											</div>
  										</div>';
          $anchor = anchor('pasery/document/'.$enc_id,$type,'style="text-decoration:none"');
          $count  = $rows->doc_view_count;
        }
        else {
          $icon = explode('.',$rows->doc_file);
          if($icon[1] == 'pdf' or $icon[1] == 'PDF')
          {
            $iconx = '<i class="fas fa-file-pdf text-danger"></i>';
          }
          elseif($icon[1] == 'xls' or $icon[1] == 'XLS' or $icon[1] == 'xlsx' or $icon[1] == 'XLSX')
          {
            $iconx = '<i class="fas fa-file-excel text-success"></i>';
          }
          elseif($icon[1] == 'doc' or $icon[1] == 'DOC' or $icon[1] == 'docx' or $icon[1] == 'DOCX')
          {
            $iconx = '<i class="fas fa-file-word text-info"></i>';
          }
          elseif($icon[1] == 'ppt' or $icon[1] == 'PPT' or $icon[1] == 'pptx' or $icon[1] == 'PPTX')
          {
            $iconx = '<i class="fas fa-file-powerpoint text-danger"></i>';
          }
          else {
            $iconx = '<i class="fas fa-file-archive text-warning"></i>';
          }
          $type = '<div class="widget-summary">
  											<div class="widget-summary-col widget-summary-col-icon">
  												<div class="summary-icon">
  													'.$iconx.'
  												</div>
  											</div>
  											<div class="widget-summary-col">
  												<div class="summary">
  													<h4 class="title text-primary"><strong>'.$rows->doc_title.'</strong></h4>
  													<div class="info">
  														<span class="text-muted">'.$rows->doc_description.'</span>
  													</div>
  												</div>
  												<div class="summary-footer">
                            <a class="text-muted text-1 float-left">'.$rows->doc_url.'</a>
                            <a class="text-muted">'.anchor($rows->doc_url,'<i class="fas fa-search"></i> / <i class="fas fa-download"></i>',array('target'=>'blank')).'</a>
  													<a class="text-muted"><i class="fas fa-user ml-2"></i> '.$rows->display_name.'</a>
  												</div>
  											</div>
  										</div>';
          $anchor = anchor('pasery/document/edit/'.$enc_id,$type,'style="text-decoration:none"');
          $count  = $rows->doc_download_count;
        }
        $row[] = form_checkbox(array('name'=>'check_id[]','value'=>$enc_id,'class'=>'data-check'));
        $row[] = $anchor;
        $row[] = $count;
        $row[] = '
          <i class="fas fa-calendar"></i> '.date('d-m-Y',strtotime($rows->doc_date)).'<br>
          <i class="fas fa-clock"></i> '.date('h:i:s',strtotime($rows->doc_date));
        $data[] = $row;
    }
    $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->M_documents->count_all(),
                    "recordsFiltered" => $this->M_documents->count_filtered(),
                    "data" => $data,
                    );
    //output ke format json_decode
    echo json_encode($output);
  }

  public function author()
  {
    $enc_id = $this->encryption->encrypt($this->session->userdata('doc_parent'));
    $enc_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id);
    if($this->uri->segment(4))
    {
      $this->session->set_userdata('doc_author',$this->uri->segment(4));
      if($enc_id)
      {
        redirect('pasery/document/'.$enc_id);
      }
      else {
        redirect('pasery/document/');
      }
    }
    else
    {
      $this->session->unset_userdata('doc_author');
      if($enc_id)
      {
        redirect('pasery/document/'.$enc_id);
      }
      else {
        redirect('pasery/document/');
      }
    }
  }

  public function add($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $data['data']       = $this->M_documents->get_by_id($dec_id);
    //$data['ajax_list']  = site_url('admin/document/ajax_list');
		$data['content']    = 'admin/_content/document_add';
		$this->load->view('admin/overview',$data);
  }

  public function insert()
  {
    $this->load->library('slug');
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('doc_title','Nama Folder','trim|required|xss_clean',array('required'=>'%s harus diisi.'));
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
        $slug = $this->slug->create_slug_document($this->input->post('doc_title'),'psr_documents');
        if($this->session->userdata('doc_parent'))
        {
          $parent     = $this->M_documents->get_by_id($this->session->userdata('doc_parent'));
          $doc_parent = $this->session->userdata('doc_parent');
          $doc_role   = $parent->doc_role + 1;
        }
        else {
          $doc_parent = 0;
          $doc_role   = 0;
        }
        $data = array(
          'doc_author'      => $this->session->userdata['logged']['ID'],
          'doc_slug'        => $slug,
          'doc_title'       => $this->input->post('doc_title'),
          'doc_description' => $this->input->post('doc_description'),
          'doc_type'        => 'folder',
          'doc_parent'      => $doc_parent,
          'doc_role'        => $doc_role,
          'doc_date'        => date('Y-m-d h:i:s')
        );
        $this->M_documents->insert($data);
        $message =
          '<div class="alert p-0">
              <blockquote class="success bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>Folder '.$this->page.'</strong> berhasil ditambahkan.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/document');
      }
    }
    if(isset($_POST['btn_save_doc']))
    {
      //set validasi data input
      $this->form_validation->set_rules('doc_title','Nama','trim|required|xss_clean',array('required'=>'%s harus diisi.'));
      $this->form_validation->set_rules('doc_endorsement','Tanggal Terbit','required',array('required'=>'%s harus diisi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $message =
          '<div class="alert p-0">
              <blockquote class="danger bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>'.$this->page.'</strong> gagal ditambahkan. Cek kembali isian Anda.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        $this->add($this->uri->segment(4));
      }
      else
      {
        if($this->session->userdata('doc_parent'))
        {
          $parent     = $this->M_documents->get_by_id($this->session->userdata('doc_parent'));
          $doc_parent = $this->session->userdata('doc_parent');
          $doc_role   = $parent->doc_role + 1;
        }
        else {
          $doc_parent = 0;
          $doc_role   = 0;
        }
        $slug = $this->slug->create_slug_document($this->input->post('doc_title'),'psr_documents');
        $date = explode('/',$this->input->post('doc_endorsement'));
        $date_endorsement = $date[2].'-'.$date[1].'-'.$date[0];
        $config['upload_path'] = './assets/library/document/';
        $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|ppt|pptx|zip|rar';
        $config['file_name'] = $slug;
        $config['overwrite'] = FALSE;
        $config['max_size'] = '10024';
        $this->upload->initialize($config);
        if($this->upload->do_upload('doc_file'))
        {
          $file = $this->upload->data();
          $doc_file = $file['file_name'];
          $data = array(
            'doc_author'      => $this->session->userdata['logged']['ID'],
            'doc_slug'        => $slug,
            'doc_title'       => $this->input->post('doc_title'),
            'doc_description' => $this->input->post('doc_description'),
            'doc_file'        => $this->input->post('doc_file'),
            'doc_url'         => base_url('assets/library/document/'.$doc_file),
            'doc_file'        => $doc_file,
            'doc_endorsement' => $date_endorsement,
            'doc_type'        => 'file',
            'doc_parent'      => $doc_parent,
            'doc_role'        => $doc_role,
            'doc_date'        => date('Y-m-d h:i:s')
          );
          $this->M_documents->insert($data);
          $message =
            '<div class="alert p-0">
                <blockquote class="success bg-white m-0">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>'.$this->subpage.'</strong> berhasil ditambahkan. '.$this->upload->display_errors().'
                </blockquote>
            </div>';
          $this->session->set_flashdata('message',$message);
          redirect('pasery/document/'.$this->uri->segment(4));
        }
        else {
          $message =
            '<div class="alert p-0">
                <blockquote class="warning bg-white m-0">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>'.$this->page.'</strong> gagal ditambahkan. '.$this->upload->display_errors().'
                </blockquote>
            </div>';
          $this->session->set_flashdata('message',$message);
          $this->add($this->uri->segment(4));
        }
      }
    }
    else
    {
      redirect('pasery/document');
    }
  }

  public function edit($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    $document           = $this->M_documents->get_by_id($dec_id);
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $data['folder']     = $this->M_documents->get_by_id($document->doc_parent);
    $data['data']       = $document;
    $data['content']    = 'admin/_content/document_edit';
		$this->load->view('admin/overview',$data);
  }

  public function update($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('doc_title','Nama Folder','trim|required|xss_clean',array('required'=>'%s harus diisi.'));
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
          'doc_author'      => $this->session->userdata['logged']['ID'],
          'doc_title'       => $this->input->post('doc_title'),
          'doc_description' => $this->input->post('doc_description'),
          'doc_modified'    => date('Y-m-d h:i:s')
        );
        $this->M_documents->update($data,$dec_id);
        $message =
          '<div class="alert p-0">
              <blockquote class="info bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>Folder '.$this->page.'</strong> berhasil diperbarui.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/document/'.$id);
      }
    }
    elseif(isset($_POST['btn_save_doc']))
    {
      //set validasi data input
      //$this->form_validation->set_rules('doc_ID','ID','required',array('required'=>'%s tidak ditemukan.'));
      $this->form_validation->set_rules('doc_title','Nama Folder','trim|required|xss_clean',array('required'=>'%s harus diisi.'));
      $this->form_validation->set_rules('doc_endorsement','Tanggal Terbit','required',array('required'=>'%s harus diisi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $this->edit();
      }
      else
      {
        //$slug = $this->slug->create_slug_document($this->input->post('doc_title'),'psr_documents');
        if($this->input->post('doc_parent'))
        {
          $parent     = $this->M_documents->get_by_id($this->input->post('doc_parent'));
          $doc_parent = $this->input->post('doc_parent');
          $doc_role   = $parent->doc_role + 1;
        }
        else {
          $doc_parent = 0;
          $doc_role   = 0;
        }
        $date = explode('/',$this->input->post('doc_endorsement'));
        $date_endorsement = $date[2].'-'.$date[1].'-'.$date[0];
        $config['upload_path'] = './assets/library/document/';
        $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|ppt|pptx|zip|rar';
        $config['file_name'] = $this->input->post('doc_slug');
        $config['overwrite'] = TRUE;
        $config['max_size'] = '10024';
        $this->upload->initialize($config);
        if ($this->upload->do_upload('doc_file'))
        {
          $file = $this->upload->data();
          $doc_file = $file['file_name'];
          $data = array(
            'doc_author'      => $this->session->userdata['logged']['ID'],
            //'doc_slug'        => $slug,
            'doc_title'       => $this->input->post('doc_title'),
            'doc_description' => $this->input->post('doc_description'),
            'doc_file'        => $this->input->post('doc_slug'),
            'doc_url'         => base_url('assets/library/document/'.$doc_file),
            'doc_file'        => $doc_file,
            'doc_endorsement' => $date_endorsement,
            'doc_type'        => 'file',
            'doc_parent'      => $doc_parent,
            'doc_role'        => $doc_role,
            'doc_modified'    => date('Y-m-d h:i:s')
          );
          $this->M_documents->update($data,$dec_id);
          $message =
            '<div class="alert p-0">
                <blockquote class="success bg-white m-0">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>'.$this->page.'</strong> berhasil ditambahkan. '.$this->upload->display_errors().'
                </blockquote>
            </div>';
          $this->session->set_flashdata('message',$message);
          redirect('pasery/document/edit/'.$id);
        }
        else {
          $data = array(
            'doc_author'      => $this->session->userdata['logged']['ID'],
            //'doc_slug'        => $slug,
            'doc_title'       => $this->input->post('doc_title'),
            'doc_description' => $this->input->post('doc_description'),
            //'doc_file'        => $this->input->post('doc_file'),
            //'doc_url'         => base_url('assets/library/document/'.$doc_file),
            //'doc_file'        => $doc_file,
            'doc_endorsement' => $date_endorsement,
            'doc_type'        => 'file',
            'doc_parent'      => $doc_parent,
            'doc_role'        => $doc_role,
            'doc_modified'    => date('Y-m-d h:i:s')
          );
          $this->M_documents->update($data,$dec_id);
          $message =
            '<div class="alert p-0">
                <blockquote class="info bg-white m-0">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>'.$this->page.'</strong> berhasil disimpan.<br>
                    '.anchor('pasery/document/'.$this->input->post('btn_back'),'<i class="fas fa-arrow-left"></i> Kembali ke Semua '.$this->page).'
                </blockquote>
            </div>';
          $this->session->set_flashdata('message',$message);
          redirect('pasery/document/edit/'.$id);
        }
      }
    }
    else
    {
      redirect('pasery/document/edit/'.$id);
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
    		$data['content']    = 'admin/_content/document_remove';
    		$this->load->view('admin/overview',$data);
      }
      else
      {
        redirect('pasery/document');
      }
    }
    elseif(isset($_POST['btn_doc_file']))
    {
      $row        = $this->M_documents->get_by_id($dec_id);
      $files      = explode(',',$row->doc_file);
      $doc_file   = array($this->input->post('btn_doc_file'));
      $doc_files  = array_diff($files,$doc_file);
      $data       = array(
        'doc_file' => implode(',',$doc_files)
      );
      $this->M_documents->update($data,$dec_id);
      $message =
        '<div class="alert p-0">
            <blockquote class="info bg-white m-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Gambar </strong> telah dihapus.
            </blockquote>
        </div>';
      $this->session->set_flashdata('message',$message);
      redirect('pasery/document/edit/'.$id);
    }
    else
    {
      redirect('pasery/document');
    }
  }

  public function delete()
  {
    if(isset($_POST['btn_delete']))
    {
      $checked = $this->input->post('ID');
      foreach($checked as $id)
      {
        $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
        $dec_id = $this->encryption->decrypt($dec_id);
        $this->M_documents->delete($dec_id);
      }
      $message =
        '<div class="alert p-0">
            <blockquote class="success bg-white m-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>'.$this->subpage.'</strong> terpilih telah dihapus.
            </blockquote>
        </div>';
      $this->session->set_flashdata('message',$message);
      redirect('pasery/document');
    }
    else
    {
      redirect('pasery/document');
    }
  }

}
