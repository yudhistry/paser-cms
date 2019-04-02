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
| file ini digunakan sebagai dasar dari seluruh tampilan.
*/
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html class="fixed sidebar-light sidebar-left-sm">
	<head>
    <title>Admin | <?php echo $option->opt_name;?></title>
		<!-- Meta -->
    <?php $this->load->view('admin/_includes/meta');?>
    <!-- CSS -->
    <?php $this->load->view('admin/_includes/css');?>
	</head>
	<body>
		<section class="body">
			<!-- start: header -->
      <?php $this->load->view('admin/_includes/header');?>
			<!-- end: header -->
			<div class="inner-wrapper">
				<!-- start: sidebar -->
        <?php $this->load->view('admin/_includes/sidebar_left');?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
          <!-- start: breadcrumbs -->
          <?php $this->load->view('admin/_includes/breadcrumbs');?>
          <!-- end: breadcrumbs -->
					<?php echo $this->session->flashdata('message');?>
					<!-- start: page -->
          <?php $this->load->view($content);?>
					<!-- end: page -->
				</section>
			</div>
      <!-- start: javascript -->
      <?php $this->load->view('admin/_includes/sidebar_right');?>
      <!-- end: javascript -->
		</section>
    <!-- start: javascript -->
    <?php $this->load->view('admin/_includes/js');?>
    <!-- end: javascript -->
	</body>
</html>
