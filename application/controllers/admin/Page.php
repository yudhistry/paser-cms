<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

  var $page     = 'Laman';
  var $subpage  = 'Semua Laman';

	public function __construct()
	{
  	parent::__construct();
    $this->load->model('admin/M_pages');
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
    $data['ajax_list']  = site_url('admin/page/ajax_list');
		$data['content']    = 'admin/_content/page';
		$this->load->view('admin/overview',$data);
	}

  public function ajax_list()
  {
    $list = $this->M_pages->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach($list as $rows)
    {
        $no++;
        $row = array();
        $enc_id = $this->encryption->encrypt($rows->post_ID);
        $enc_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id);
        $row[] = form_checkbox(array('name'=>'check_id[]','value'=>$enc_id,'class'=>'data-check'));
        $row[] = anchor('pasery/page/edit/'.$enc_id,'<strong>'.$rows->post_title.'</strong>').'<br>'.anchor(base_url('page/'.$rows->post_slug),base_url('page/'.$rows->post_slug),array('class'=>'text-2','target'=>'_blank'));
        $row[] = anchor('admin/page/author/'.$rows->ID,$rows->display_name);
        $row[] = $rows->post_view_count;
        $row[] = '<i class="fas fa-bookmark"></i> '.ucwords(str_replace('_',' ',$rows->post_status)).'<br><i class="fas fa-calendar"></i> '.date('d-m-Y h:i:s',strtotime($rows->post_date));
        $data[] = $row;
    }
    $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->M_pages->count_all(),
                    "recordsFiltered" => $this->M_pages->count_filtered(),
                    "data" => $data,
                    );
    //output ke format json_decode
    echo json_encode($output);
  }

  public function status()
  {
    if($this->uri->segment(4))
    {
      $this->session->set_userdata('post_status',$this->uri->segment(4));
      redirect('pasery/page');
    }
    else
    {
      $this->session->unset_userdata('post_status');
      $this->session->unset_userdata('post_author');
      redirect('pasery/page');
    }
  }

  public function author()
  {
    if($this->uri->segment(4))
    {
      $this->session->set_userdata('post_author',$this->uri->segment(4));
      redirect('pasery/page');
    }
    else
    {
      $this->session->unset_userdata('post_author');
      redirect('pasery/page');
    }
  }

  public function add()
  {
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = 'Tambah Laman';
		$data['content']    = 'admin/_content/page_add';
		$this->load->view('admin/overview',$data);
  }

  public function insert()
  {
    $this->load->library('slug');
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('post_title','Judul','trim|required|xss_clean',array('required'=>'%s harus diisi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $this->add();
      }
      else
      {
        $slug       = $this->slug->create_slug_post($this->input->post('post_title'),'psr_posts');
        $date       = explode('/',$this->input->post('post_datepick'));
        $post_date  = $date[2].'-'.$date[1].'-'.$date[0].' '.$this->input->post('post_timepick');
        $data = array(
          'post_author'           => $this->session->userdata['logged']['ID'],
          'post_type'             => 'laman',
          'post_slug'             => $slug,
          'post_title'            => $this->input->post('post_title'),
          'post_content'          => $this->input->post('post_content'),
          'post_parent'           => 0,
          'post_order'            => 0,
          'post_status'           => $this->input->post('post_status'),
          'post_date'             => $post_date,
          'post_feature_image'    => $this->input->post('post_feature_image'),
          'comment_status'        => 'tertutup'
        );
        $this->M_pages->insert($data);
        $message =
          '<div class="alert p-0">
              <blockquote class="success bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>'.$this->page.' '.$this->input->post('post_title').'</strong> berhasil ditambahkan.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/page');
      }
    }
    elseif(isset($_POST['btn_post_feature_image']))
    {
      $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
      $data['page']       = $this->page;
      $data['subpage']    = $this->subpage;
      $data['ajax_list']  = site_url('admin/library_option/ajax_list');
  		$data['content']    = 'admin/_content/page_library';
  		$this->load->view('admin/overview',$data);
    }
    elseif(isset($_POST['remove_post_feature_image']))
    {
      $this->add();
    }
    else
    {
      redirect('pasery/page/add','refresh');
    }
  }

  public function edit($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $data['data']       = $this->M_pages->get_by_id($dec_id);
		$data['content']    = 'admin/_content/page_edit';
		$this->load->view('admin/overview',$data);
  }

  public function update($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('post_title','Judul','trim|required|xss_clean',array('required'=>'%s harus diisi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $this->add();
      }
      else
      {
        //$slug       = $this->slug->create_slug_post($this->input->post('post_title'),'psr_posts');
        $date       = explode('/',$this->input->post('post_datepick'));
        $post_date  = $date[2].'-'.$date[1].'-'.$date[0].' '.$this->input->post('post_timepick');
        $data = array(
          'post_author'           => $this->session->userdata['logged']['ID'],
          'post_type'             => 'laman',
          //'post_slug'             => $slug,
          'post_title'            => $this->input->post('post_title'),
          'post_content'          => $this->input->post('post_content'),
          'post_parent'           => 0,
          'post_order'            => 0,
          'post_status'           => $this->input->post('post_status'),
          'post_date'             => $post_date,
          'post_feature_image'    => $this->input->post('post_feature_image'),
          'comment_status'        => 'tertutup'
        );
        $this->M_pages->update($data,$dec_id);
        $message =
          '<div class="alert p-0">
              <blockquote class="success bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>'.$this->page.' '.$this->input->post('post_title').'</strong> berhasil diperbarui.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/page');
      }
    }
    elseif(isset($_POST['btn_post_feature_image']))
    {
      $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
      $data['page']       = $this->page;
      $data['subpage']    = $this->subpage;
      $data['ajax_list']  = site_url('admin/library_option/ajax_list');
  		$data['content']    = 'admin/_content/page_library_edit';
  		$this->load->view('admin/overview',$data);
    }
    elseif(isset($_POST['remove_post_feature_image']))
    {
      $data = array(
        'post_feature_image' => ''
      );
      $this->M_pages->update($data,$dec_id);
      $this->edit($id);
    }
    else
    {
      redirect('pasery/page/edit/'.$id,'refresh');
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
    		$data['content']    = 'admin/_content/page_remove';
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
        redirect('pasery/page');
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
      redirect('pasery/page');
    }
  }

  public function delete()
  {
    if(isset($_POST['btn_delete']))
    {
      $checked = $this->input->post('ID');
      foreach($checked as $id)
      {
        $this->M_pages->delete($id);
      }
      $message =
        '<div class="alert p-0">
            <blockquote class="success bg-white m-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>'.count($checked).' '.$this->page.'</strong> telah dihapus.
            </blockquote>
        </div>';
      $this->session->set_flashdata('message',$message);
      redirect('pasery/page');
    }
    else
    {
      redirect('pasery/page');
    }
  }
}
