<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
    $this->load->model('content/M_menu');
    $this->load->model('content/M_headline');
    $this->load->model('content/M_gallery');
    $this->load->model('content/M_library');
		$this->load->model('content/M_post');
		$this->load->model('content/M_user');
		$this->load->model('content/M_category');
		$this->load->model('content/M_link');
	}

	public function index()
	{
		$option = $this->M_options->get_by_id($this->config->item('opt_ID'));
		$page     = $this->uri->segment(3);
    $perpage  = $option->opt_read;
    if(!($page))
    {
      $offset = 0;
    }
    else
    {
      $offset = $page;
    }
    $config['base_url'] = base_url('gallery/index/');
    $config['total_rows'] = $this->M_post->count_page();
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
    $data['option']				= $this->M_options->get_by_id($this->config->item('opt_ID'));
		$data['headline']			= $this->M_headline->get_latest();
		$data['galeri']	      = $this->M_gallery->get_per_page($perpage,$offset);
    $data['pos_terbaru']	= $this->M_post->get_latest();
    $data['tautan']       = $this->M_link->get_all();
		$data['content']			= 'public/_content/gallery';
		$this->load->view('public/overview',$data);
	}

  public function view($slug)
  {
		$gallery							= $this->M_gallery->get_by_slug($slug);
		$count 								= array('gal_view_count' => $gallery->gal_view_count + 1);
		$this->M_gallery->update($count,$slug);
		$data['option']				= $this->M_options->get_by_id($this->config->item('opt_ID'));
		$data['headline']			= $this->M_headline->get_latest();
		$data['author']				= '';
		$data['category']			= '';
		$data['data']					= $gallery;
		$data['pos_terbaru']	= $this->M_post->get_latest();
    $data['tautan']       = $this->M_link->get_all();
		$data['content']			= 'public/_content/gallery_detail';
		$this->load->view('public/overview',$data);
  }

}
