<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

  var $page       = 'Pos';
  var $subpage    = 'Kategori';

  public function __construct() {
    parent::__construct();
    $this->load->model('admin/M_categories');
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
    $data['ajax_list']  = site_url('admin/category/ajax_list');
		$data['content']    = 'admin/_content/category';
		$this->load->view('admin/overview',$data);
  }

  public function ajax_list()
  {
    $list = $this->M_categories->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach($list as $rows)
    {
        $no++;
        $row = array();
        if($rows->cat_role == 0)
        {
          $cat_parent = '';
        }
        else
        {
          $parent     = $this->M_categories->get_by_id($rows->cat_parent);
          $cat_parent = ' - '.$parent->cat_name;
        }
        $enc_id = $this->encryption->encrypt($rows->cat_ID);
        $enc_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id);
        $row[] = form_checkbox(array('name'=>'check_id[]','value'=>$enc_id,'class'=>'data-check'));
        $row[] = anchor('pasery/post/category/edit/'.$enc_id,$rows->cat_name,array('class'=>'font-weight-semibold')).$cat_parent;
        $row[] = $rows->cat_description;
        $row[] = $rows->cat_slug;

        $data[] = $row;
    }
    $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->M_categories->count_all(),
                    "recordsFiltered" => $this->M_categories->count_filtered(),
                    "data" => $data,
                    );
    //output ke format json_decode
    echo json_encode($output);
  }

  public function add()
  {
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $this->load->view('admin/header',$data);
    $this->load->view('admin/kategori_tambah',$data);
    $this->load->view('admin/footer',$data);
  }

  public function insert()
  {
    $this->load->library('slug');
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      $this->form_validation->set_rules('cat_name','Nama','trim|required|is_unique[psr_categories.cat_name]',array('required'=>'%s harus diisi.','is_unique'=>'Sebuah istilah dengan nama yang diberikan sudah ada.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $this->add();
      }
      else
      {
        $slug       = $this->slug->create_slug_category($this->input->post('cat_name'),'psr_categories');
        if($this->input->post('cat_parent') <> '0')
        {
          $role     = $this->M_categories->get_by_id($this->input->post('cat_parent'));
          $cat_role = $role->cat_role + 1;
        }
        else {
          $cat_role = '0';
        }
        $data = array(
          'cat_name'        => $this->input->post('cat_name'),
          'cat_description' => $this->input->post('cat_description'),
          'cat_parent'      => $this->input->post('cat_parent'),
          'cat_slug'        => $slug,
          'cat_role'        => $cat_role
        );
        $this->M_categories->insert($data);
        $message =
          '<div class="alert p-0">
              <blockquote class="success bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>'.$this->subpage.'</strong> berhasil ditambahkan.
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/post/category');
      }
    }
    else
    {
      redirect('pasery/post/category');
    }
  }

  public function edit($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    $data['option']     = $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']       = $this->page;
    $data['subpage']    = $this->subpage;
    $data['data']       = $this->M_categories->get_by_id($dec_id);
		$data['content']    = 'admin/_content/category_edit';
		$this->load->view('admin/overview',$data);
  }

  public function update($id)
  {
    $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
    $dec_id = $this->encryption->decrypt($dec_id);
    if(isset($_POST['btn_save']))
    {
      //set validasi data input
      //$this->form_validation->set_rules('cat_ID','ID','required',array('required'=>'%s tidak ditemukan.'));
      $this->form_validation->set_rules('cat_name','Judul','trim|required|xss_clean',array('required'=>'%s harus diisi.'));
      //Proses validasi data input
      if($this->form_validation->run() == FALSE)
      {
        $this->edit();
      }
      else
      {
        if($this->input->post('cat_parent') <> '0')
        {
          $role     = $this->M_categories->get_by_id($this->input->post('cat_parent'));
          $cat_role = $role->cat_role + 1;
        }
        else {
          $cat_role = '0';
        }
        $data = array(
          'cat_name'        => $this->input->post('cat_name'),
          'cat_description' => $this->input->post('cat_description'),
          'cat_parent'      => $this->input->post('cat_parent'),
          'cat_role'        => $cat_role
        );
        $this->M_categories->update($data,$dec_id);
        $message =
          '<div class="alert p-0">
              <blockquote class="info bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>'.$this->subpage.' '.$this->input->post('cat_name').'</strong> berhasil diperbarui.<br>
                  '.anchor('pasery/post/category','<i class="fas fa-arrow-left"></i> Kembali ke Semua '.$this->subpage).'
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect('pasery/post/category/edit/'.$id);
      }
    }
    else
    {
      redirect('pasery/post/category/edit/'.$id);
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
    		$data['content']    = 'admin/_content/category_remove';
    		$this->load->view('admin/overview',$data);
      }
      else
      {
        redirect('pasery/post/category');
      }
    }
    else
    {
      redirect('pasery/post/category');
    }
  }

  public function delete()
  {
    if(isset($_POST['btn_delete']))
    {
      $checked = $this->input->post('ID');
      foreach($checked as $id)
      {
        $this->M_categories->delete($id);
      }
      $message =
        '<div class="aler p-0">
            <blockquote class="success bg-white m-0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>'.count($checked).' '.$this->subpage.'</strong> terpilih telah dihapus.
            </blockquote>
        </div>';
      $this->session->set_flashdata('message',$message);
      redirect('pasery/post/category');
    }
    else
    {
      redirect('pasery/post/category');
    }
  }

}
