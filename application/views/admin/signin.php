<?php
/*
| -------------------------------------------------------------------
| Signin Dashboard Paser CMS
| -------------------------------------------------------------------
|
| penulis     : yudhistira ramadhany
| surel       : yudhistira.ramadhany.yr@gmail.com
| jabatan     : kepala seksi aplikasi dan pengembangan informatika
| organisasi  : dinas komunikasi, informatika, statistik dan persandian
| instansi    : pemerintah kabupaten paser
|
| file ini digunakan sebagai dasar dari seluruh tampilan.
*/
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html class="fixed">
	<head>
    <title>Admin | <?php echo $option->opt_name;?></title>
		<!-- Meta -->
    <?php $this->load->view('admin/_includes/meta');?>
    <!-- CSS -->
    <?php $this->load->view('admin/_includes/css');?>
	</head>
	<body>
		<!-- start: page -->
    <?php $this->load->view($content);?>
		<!-- end: page -->
    <!-- start: javascript -->
    <?php $this->load->view('admin/_includes/js');?>
    <!-- end: javascript -->
	</body>
</html>
