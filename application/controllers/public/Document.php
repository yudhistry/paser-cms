<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
    $this->load->model('content/M_menu');
    $this->load->model('content/M_headline');
    $this->load->model('content/M_document');
    $this->load->model('content/M_library');
		$this->load->model('content/M_post');
		$this->load->model('content/M_user');
		$this->load->model('content/M_category');
		$this->load->model('content/M_link');
	}

	public function index()
	{
		$this->session->unset_userdata('doc_parent_public');
		$option   = $this->M_options->get_by_id($this->config->item('opt_ID'));
		$page     = $this->uri->segment(2);
    $perpage  = 25;
    if(!($page))
    {
      $offset = 0;
    }
    else
    {
      $offset = $page;
    }
    $config['base_url'] = base_url('document');
    $config['total_rows'] = $this->M_document->count_page();
    $config['per_page'] = $perpage;
    $config['num_links'] = 3;
    $config['uri_segment'] = 2;
    $config['full_tag_open'] = '<ul class="pagination float-right">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link'] = '<i class="fas fa-angle-right"></i>';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = '<i class="fas fa-angle-left"></i>';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    $data['option']				= $option;
		$data['headline']			= $this->M_headline->get_latest();
		$data['dokumen']      = $this->M_document->get_per_page($perpage,$offset);
    $data['pos_terbaru']	= $this->M_post->get_latest();
    $data['tautan']       = $this->M_link->get_all();
		$data['content']			= 'public/_content/document';
		$this->load->view('public/overview',$data);
	}

	public function parent($slug)
	{
		$parent 	= $this->M_document->get_by_slug($slug);
		$this->session->set_userdata('doc_parent_public',$parent->doc_ID);
		$option   = $this->M_options->get_by_id($this->config->item('opt_ID'));
		$page     = $this->uri->segment(4);
    $perpage  = 25;
    if(!($page))
    {
      $offset = 0;
    }
    else
    {
      $offset = $page;
    }
    $config['base_url'] = base_url('document/parent/'.$slug);
    $config['total_rows'] = $this->M_document->count_page();
    $config['per_page'] = $perpage;
    $config['num_links'] = 3;
    $config['uri_segment'] = 4;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link'] = '<i class="fas fa-angle-right"></i>';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = '<i class="fas fa-angle-left"></i>';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    $data['option']				= $option;
		$data['headline']			= $this->M_headline->get_latest();
		$data['folder']				= $parent;
		$data['dokumen']      = $this->M_document->get_per_page($perpage,$offset);
    $data['pos_terbaru']	= $this->M_post->get_latest();
    $data['tautan']       = $this->M_link->get_all();
		$data['content']			= 'public/_content/document_parent';
		$this->load->view('public/overview',$data);
	}

  public function download($slug)
  {
    $this->load->helper('download');
    $row = $this->M_document->get_by_slug($slug);
    $data = array('doc_download_count' => $row->doc_download_count + 1);
    $this->M_document->update($data,$slug);
    force_download('./assets/library/document/'.$row->doc_file,NULL);
    redirect('document');
  }

	public function search()
	{
		if($this->input->post('search') <> null)
		{
			$this->session->set_userdata('search_public',$this->input->post('search'));
			$this->session->unset_userdata('doc_parent_public');
			$option   = $this->M_options->get_by_id($this->config->item('opt_ID'));
			$page     = $this->uri->segment(3);
	    $perpage  = 25;
	    if(!($page))
	    {
	      $offset = 0;
	    }
	    else
	    {
	      $offset = $page;
	    }
	    $config['base_url'] = base_url('document/search');
	    $config['total_rows'] = $this->M_document->count_page_search();
	    $config['per_page'] = $perpage;
	    $config['num_links'] = 3;
	    $config['uri_segment'] = 3;
	    $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    $config['next_link'] = '<i class="fas fa-angle-right"></i>';
	    $config['next_tag_open'] = '<li class="page-item">';
	    $config['next_tag_close'] = '</li>';
	    $config['prev_link'] = '<i class="fas fa-angle-left"></i>';
	    $config['prev_tag_open'] = '<li class="page-item">';
	    $config['prev_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open'] = '<li class="page-item">';
	    $config['num_tag_close'] = '</li>';
	    $this->pagination->initialize($config);
	    $data['option']				= $option;
			$data['headline']			= $this->M_headline->get_latest();
			$data['dokumen']      = $this->M_document->get_per_page_search($perpage,$offset);
	    $data['pos_terbaru']	= $this->M_post->get_latest();
	    $data['tautan']       = $this->M_link->get_all();
			$data['content']			= 'public/_content/document_search';
			$this->load->view('public/overview',$data);
		}
		else {
			if($this->session->userdata('doc_parent_public'))
			{
				$slug = $this->M_document->get_by_id($this->session->userdata('doc_parent_public'));
				redirect('document/parent/'.$slug->doc_slug);
			}
			else {
				redirect('document');
			}
		}
	}

}
