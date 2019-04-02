<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library_option extends CI_Controller {

  var $page       = 'Pustaka';
  var $subpage    = 'Semua Pustaka';

  public function __construct() {
    parent::__construct();
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
    $data['ajax_list']  = site_url('admin/library/ajax_list');
		$data['content']    = 'admin/_content/library';
		$this->load->view('admin/overview',$data);
  }

  public function ajax_list()
  {
    $list = $this->M_library_option->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach($list as $rows)
    {
        $no++;
        $row = array();
        if($rows->lib_type == 'gambar')
        {
          $thumbnail = '<img src="'.$rows->lib_path.'" class="thumbnail thumb-preview thumb-image img-fluid m-0" width="100px" height="100px">';
        }
        elseif($rows->lib_type == 'dokumen')
        {
          $thumbnail = '<img src="'.base_url('assets/library/default-document.png').'" class="thumbnail thumb-preview thumb-image img-fluid m-0" width="100px" height="100px">';
        }
        else {
          $thumbnail = '<img src="'.base_url('assets/library/default-unknown.png').'" class="thumbnail thumb-preview thumb-image img-fluid m-0" width="100px" height="100px">';
        }
        $row[] = '
          <div class="row m-0">
            <div class="col-ms-4">
              '.form_button(array('type'=>'submit','class'=>'btn btn-transparent p-0','name'=>'btn_save_lib','value'=>$rows->lib_ID,'content'=>$thumbnail)).'
            </div>
            <div class="col-md-8">
              '.form_button(array('type'=>'submit','class'=>'btn btn-transparent text-primary p-0','name'=>'btn_save_lib','value'=>$rows->lib_ID,'content'=>'<strong>'.$rows->lib_name.'</strong>')).'<br>
              <i class="fas fa-file"></i> '.$rows->lib_file.'<br>
              <i class="fas fa-link"></i> '.$rows->lib_path.'
            </div>
          </div>
        ';
        $row[] = '
          <i class="fas fa-bookmark"></i> '.ucwords($rows->lib_type).'<br>
          <i class="fas fa-calendar"></i> '.date('d-m-Y',strtotime($rows->lib_date)).'<br>
          <i class="fas fa-clock"></i> '.date('h:i:s',strtotime($rows->lib_date));
        $data[] = $row;
    }
    $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->M_library_option->count_all(),
                    "recordsFiltered" => $this->M_library_option->count_filtered(),
                    "data" => $data,
                    );
    //output ke format json_decode
    echo json_encode($output);
  }

  public function insert()
  {
    if(isset($_POST['btn_save']))
    {
      $this->form_validation->set_rules('lib_name','Judul','trim|required|xss_clean|is_unique[psr_libraries.lib_name]',array('required'=>'%s harus diisi.'));
      if($this->form_validation->run() == FALSE)
      {
        $message =
          '<div class="alert p-0">
              <blockquote class="danger bg-white m-0">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>Pustaka</strong> gagal ditambahkan.'.validation_errors().'
              </blockquote>
          </div>';
        $this->session->set_flashdata('message',$message);
        redirect($this->input->post('redirect'));
      }
      else
      {
        $lib_name = preg_replace('/[^A-Za-z0-9\ ]/','',$this->input->post('lib_name'));
        $config['upload_path'] = './assets/library/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|pdf|txt|doc|docx|xls|xlsx|zip|rar';
        $config['file_name'] = strtolower(str_replace(' ','',$lib_name));
        $config['overwrite'] = TRUE;
        $config['max_size'] = '5024';
        $this->upload->initialize($config);
        if ($this->upload->do_upload('lib_file'))
        {
          $file = $this->upload->data();
          $lib_file = $file['file_name'];
          if($file['file_ext'] == '.jpg' or $file['file_ext'] == '.jpeg' or $file['file_ext'] == '.png'  or $file['file_ext'] == '.gif'  or $file['file_ext'] == '.bmp')
          {
            $type = 'gambar';
          }
          elseif($file['file_ext'] == '.pdf' or $file['file_ext'] == '.txt' or $file['file_ext'] == '.doc' or $file['file_ext'] == '.docx' or $file['file_ext'] == '.xls' or $file['file_ext'] == '.xlsx')
          {
            $type = 'dokumen';
          }
          else {
            $type = 'tidak diketahui';
          }
          $data = array(
            'lib_author'  => $this->session->userdata['logged']['ID'],
            'lib_type'    => $type,
            'lib_file'    => $lib_file,
            'lib_path'    => base_url('assets/library/'.$lib_file),
            'lib_name'    => $this->input->post('lib_name'),
            'lib_content' => $this->input->post('lib_content'),
            'lib_date'    => date('Y-m-d h:i:s'),
          );
          $this->M_libraries->insert($data);
          $message =
            '<div class="alert p-0">
                <blockquote class="success bg-white m-0">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>'.$this->page.'</strong> berhasil ditambahkan.
                </blockquote>
            </div>';
          $this->session->set_flashdata('message',$message);
          redirect($this->input->post('redirect'));
        }
        else
        {
          $message =
            '<div class="alert p-0">
                <blockquote class="danger bg-white m-0">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>'.$this->page.'</strong> gagal ditambahkan. '.$this->upload->display_errors().'
                </blockquote>
            </div>';
          $this->session->set_flashdata('message',$message);
          redirect($this->input->post('redirect'));
        }
      }
    }
    else
    {
      redirect($this->input->post('redirect'));
    }
  }

}
