<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
    $this->load->model('content/M_menu');
    $this->load->model('content/M_headline');
		$this->load->model('content/M_post');
		$this->load->model('content/M_user');
		$this->load->model('content/M_category');
		$this->load->model('content/M_link');
	}

	public function index()
	{
		$option = $this->M_options->get_by_id($this->config->item('opt_ID'));
		$page     = $this->uri->segment(2);
		$perpage  = $option->opt_read;
    if(!($page))
    {
      $offset = 0;
    }
    else
    {
      $offset = $page;
    }
    $config['base_url'] = base_url('post/');
    $config['total_rows'] = $this->M_post->count_page();
    $config['per_page'] = $perpage;
    $config['num_links'] = 3;
    $config['uri_segment'] = 2;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link'] = '<i class="fas fa-angle-right"></i>';
    $config['next_tag_open'] = '<li class="page-item"><a>';
    $config['next_tag_close'] = '</a></li>';
    $config['prev_link'] = '<i class="fas fa-angle-left"></i>';
    $config['prev_tag_open'] = '<li class="prev page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="next page-item">';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    $data['option']				= $this->M_options->get_by_id($this->config->item('opt_ID'));
		$data['headline']			= $this->M_headline->get_latest();
		$data['author']				= '';
		$data['category']			= '';
		$data['pos']	        = $this->M_post->get_per_page($perpage,$offset);
    $data['tautan']       = $this->M_link->get_all();
		$data['content']			= 'public/_content/post';
		$this->load->view('public/overview',$data);
	}

  public function read($slug)
  {
		$post									= $this->M_post->get_by_slug($slug);
		$count = array('post_view_count' => $post->post_view_count + 1);
		$this->M_post->update($count,$slug);
		$data['option']				= $this->M_options->get_by_id($this->config->item('opt_ID'));
		$data['headline']			= $this->M_headline->get_latest();
		$data['author']				= '';
		$data['category']			= '';
		$data['pos']	        = $this->M_post->get_latest();
    $data['tautan']       = $this->M_link->get_all();
		$data['data']					= $post;
		$data['content']			= 'public/_content/post_detail';
		$this->load->view('public/overview',$data);
  }

	public function author($author)
	{
		$option = $this->M_options->get_by_id($this->config->item('opt_ID'));
		$page     = $this->uri->segment(4);
    $perpage  = $option->opt_read;
    if(!($page))
    {
      $offset = 0;
    }
    else
    {
      $offset = $page;
    }
    $config['base_url'] = base_url('post/author/'.$author);
    $config['total_rows'] = $this->M_post->count_page_author($author);
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
		$data['option']				= $this->M_options->get_by_id($this->config->item('opt_ID'));
		$data['headline']			= $this->M_headline->get_latest();
		$data['author']				= $this->M_user->get_by_userlogin($author);
		$data['category']			= '';
		$data['pos']     			= $this->M_post->get_per_page_author($perpage,$offset,$author);
    $data['tautan']       = $this->M_link->get_all();
		$data['content']			= 'public/_content/post';
		$this->load->view('public/overview',$data);
	}

	public function category($category)
	{
		$option 	= $this->M_options->get_by_id($this->config->item('opt_ID'));
		$cat 			= $this->M_category->get_by_slug($category);
		$page     = $this->uri->segment(4);
    $perpage  = $option->opt_read;
    if(!($page))
    {
      $offset = 0;
    }
    else
    {
      $offset = $page;
    }
    $config['base_url'] = base_url('post/category/'.$category);
    $config['total_rows'] = $this->M_post->count_page_category($cat->cat_ID);
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
		$data['category']			= $this->M_category->get_by_slug($category);
		$data['author']				= '';
		$data['pos']     			= $this->M_post->get_per_page_category($perpage,$offset,$cat->cat_ID);
    $data['tautan']       = $this->M_link->get_all();
		$data['content']			= 'public/_content/post';
		$this->load->view('public/overview',$data);
	}

}
