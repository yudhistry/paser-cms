<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('content/M_home');
		$this->load->model('content/M_menu');
		$this->load->model('content/M_slide');
		$this->load->model('content/M_headline');
		$this->load->model('content/M_category');
		$this->load->model('content/M_post');
		//$this->load->model('content/M_galleries');
		//$this->load->model('content/M_libraries');
	}

	public function index()
	{
		$data['option']				= $this->M_options->get_by_id($this->config->item('opt_ID'));
		$data['slide']				= $this->M_slide->get_all();
		$data['headline']			= $this->M_headline->get_latest();
		$data['pos_terbaru']	= $this->M_post->get_latest();
		$data['tautan']				= $this->M_home->links_get_all();
		$data['content']			= 'public/_content/home';
		$this->load->view('public/overview',$data);
	}

	public function search()
	{
		$search = $this->input->post('search');
		$data['option']				= $this->M_options->get_by_id($this->config->item('opt_ID'));
		$data['headline']			= $this->M_headline->get_latest();
		$data['search']				= $this->M_home->search_post($this->input->post('search'));
		$data['tautan']				= $this->M_home->links_get_all();
		$data['content']			= 'public/_content/search';
		$this->load->view('public/overview',$data);
	}

	public function error()
	{
		$data['option']				= $this->M_options->get_by_id($this->config->item('opt_ID'));
		$data['headline']			= $this->M_headline->get_latest();
		$data['tautan']				= $this->M_home->links_get_all();
		$data['content']			= 'public/error_404';
		$this->load->view('public/overview',$data);
	}


}
