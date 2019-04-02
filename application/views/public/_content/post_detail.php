<!-- start: headline -->
<?php $this->load->view('public/_content/headline');?>
<!-- end: headline -->
<section class="page-header page-header-modern page-header-background page-header-background-sm overlay overlay-color-dark overlay-show overlay-op-5" style="background-image: url(<?php echo $data->post_feature_image;?>);">
  <div class="container">
    <div class="row">
      <div class="col-md-12 align-self-center p-static order-2 text-center" style="text-shadow: 2px 2px 2px #000000">
        <div class="col-md-12 align-self-center order-1">
          <ul class="breadcrumb d-block text-center">
            <li><a href="<?php echo base_url();?>">Beranda</a></li>
            <li class="active">Berita</li>
          </ul>
        </div>
        <h1><?php echo $data->post_title;?></h1>
        <span class="sub-title text-3">
          <i class="fas fa-calendar-alt"></i> <?php echo date_indo(date('Y-m-d',strtotime($data->post_date)));?>
          <i class="fas fa-eye ml-1"></i> <?php echo $data->post_view_count;?>
          <i class="fas fa-user ml-1"></i> Oleh <?php echo anchor('post/anchor/'.$data->user_login,$data->display_name,array('class'=>'text-white'));?>
          <?php
          if($data->post_category)
          {
            echo '<i class="far fa-folder ml-2"></i> ';
            $category = explode(',',$data->post_category);
            $cat = array();
            foreach($category as $key => $value)
            {
              $rows = $this->M_category->get_by_id($value);
              $cat[$value] = anchor('post/category/'.$rows->cat_slug,$rows->cat_name,array('class'=>'text-white'));
            }
            echo implode(', ',$cat++);
          }
          ?>
        </span>
      </div>
    </div>
  </div>
</section>
<div class="container mb-5">
  <div class="row">
    <div class="col-lg-12">
      <div class="post-image ml-0 mb-3 text-center">
        <a href="<?php echo site_url('post/'.$data->post_slug);?>">
          <img src="<?php echo $data->post_feature_image;?>" class="img-fluid img-thumbnail" alt="<?php echo $data->post_title;?>" style="width:90%; box-shadow:2px 2px 3px #CCCCCC" />
        </a>
			</div>
      <?php echo $data->post_content;?>
    </div>
  </div>
</div>
<!-- start: link -->
<?php $this->load->view('public/_content/link');?>
<!-- end: link -->
