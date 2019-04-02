<?php
/*
| -------------------------------------------------------------------
| Admin Dashboard Paser CMS
| -------------------------------------------------------------------
|
| penulis     : yudhistira ramadhany
| surel       : yudhistira.ramadhany.yr@gmail.com
| jabatan     : kepala seksi aplikasi dan pengembangan informatika
| organisasi  : dinas komunikasi, informatika, statistik dan persandian
| instansi    : pemerintah kabupaten paser
|
| file ini digunakan untuk halaman beranda setelah berhasil masuk.
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  var $page     = 'Beranda';
  var $subpage  = 'Beranda';

	public function __construct()
	{
  	parent::__construct();
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
		$data['option']		= $this->M_options->get_by_id($this->config->item('opt_ID'));
    $data['page']     = $this->page;
    $data['subpage']  = $this->subpage;
		$data['content']	= 'admin/_content/dashboard';
		$this->load->view('admin/overview',$data);
	}

}
