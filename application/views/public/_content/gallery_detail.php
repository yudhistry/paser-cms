<?php $this->load->view('public/_content/headline');?>
<section class="page-header page-header-modern page-header-background page-header-background-sm overlay overlay-color-dark overlay-show overlay-op-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12 align-self-center p-static order-2 text-center" style="text-shadow: 2px 2px 2px #000000">
        <div class="col-md-12 align-self-center order-1">
          <ul class="breadcrumb d-block text-center">
            <li><a href="<?php echo base_url();?>">Beranda</a></li>
            <li class="active">Galeri</li>
          </ul>
        </div>
        <h1><?php echo $data->gal_title;?></h1>
        <span class="sub-title text-3">
          <i class="fas fa-calendar-alt"></i> <?php echo date_indo(date('Y-m-d',strtotime($data->gal_date)));?>
          <i class="fas fa-user ml-1"></i> Oleh <?php echo $data->display_name;?>
        </span>
      </div>
    </div>
  </div>
</section>
<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-lg-12">
      <p><?php echo $data->gal_description;?></p>
    </div>
    <div class="col-lg-12">
      <div class="row portfolio-list lightbox" data-plugin-options="{'delegate': 'a.lightbox-portfolio', 'type': 'image', 'gallery': {'enabled': true}}">
      <?php
      if($data->gal_file != 0)
      {
        $image = explode(',',$data->gal_file);
        foreach($image as $key => $value)
        {
          $library = $this->M_library->get_by_id($value);
        ?>
          <div class="col-12 col-sm-6 col-lg-3 appear-animation" data-appear-animation="expandIn" data-appear-animation-delay="200">
            <div class="portfolio-item img-thumbnail d-block">
              <span class="thumb-info thumb-info-lighten thumb-info-centered-icons border-radius-0">
                <span class="thumb-info-wrapper border-radius-0">
                  <img src="<?php echo $library->lib_path;?>" class="img-fluid border-radius-0" alt="<?php echo $library->lib_name;?>" style="height:200px">
                  <span class="thumb-info-action">
                    <a href="<?php echo $library->lib_path;?>" class="lightbox-portfolio" title="<?php echo $library->lib_name;?>">
                      <span class="thumb-info-action-icon thumb-info-action-icon-light"><i class="fas fa-search text-dark"></i></span>
                    </a>
                  </span>
                </span>
              </span>
            </div>
          </div>
        <?php
        }
      }
      else {
      ?>
        <div class="container mb-5">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="text-center text-muted mt-5"><i class="fas fa-times-circle text-danger"></i><br>Data tidak ditemukan</h1>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
      </div>
    </div>
  </div>
</div>
<!-- start: link -->
<?php $this->load->view('public/_content/link');?>
<!-- end: link -->
