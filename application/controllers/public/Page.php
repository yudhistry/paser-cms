<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
    $this->load->model('content/M_menu');
		$this->load->model('content/M_page');
		$this->load->model('content/M_category');
		$this->load->model('content/M_headline');
		$this->load->model('content/M_link');
	}

	public function index()
	{
    $data['option']				= $this->M_options->get_by_id($this->config->item('opt_ID'));
		$data['headline']			= $this->M_headline->get_latest();
		$data['pos_terbaru']	= $this->M_post->get_latest();
		$data['tautan']				= $this->M_link->get_all();
		$data['content']			= 'public/_content/page';
		$this->load->view('public/overview',$data);
	}

  public function read($slug)
  {
		$page									= $this->M_page->get_by_slug($slug);
		$count = array('post_view_count' => $page->post_view_count + 1);
		$this->M_page->update($count,$slug);
		$data['option']				= $this->M_options->get_by_id($this->config->item('opt_ID'));
		$data['headline']			= $this->M_headline->get_latest();
		$data['data']	        = $page;
		$data['tautan']				= $this->M_link->get_all();
		$data['content']			= 'public/_content/page';
		$this->load->view('public/overview',$data);
  }
}
