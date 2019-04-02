<?php $this->load->view('public/_content/headline');?>
<section class="page-header page-header-modern page-header-background page-header-background-md overlay overlay-color-dark overlay-show overlay-op-5" style="background-image: url(<?php echo $data->post_feature_image;?>);">
  <div class="container">
    <div class="row">
      <div class="col-md-12 align-self-center p-static order-2 text-center" style="text-shadow: 2px 2px 2px #000000">
        <h1><?php echo $data->post_title;?></h1>
        <span class="sub-title text-3">
          <i class="fas fa-calendar-alt"></i> <?php echo date_indo(date('Y-m-d',strtotime($data->post_date)));?>
          <i class="fas fa-eye ml-1"></i> <?php echo $data->post_view_count;?>
          <i class="fas fa-user ml-1"></i> Oleh <?php echo $data->display_name;?>
          <?php
          if($data->post_category)
          {
            echo '<i class="far fa-folder ml-2"></i>';
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
      <?php echo $data->post_content;?>
    </div>
  </div>
</div>
<!-- start: link -->
<?php $this->load->view('public/_content/link');?>
<!-- end: link -->
