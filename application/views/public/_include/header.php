<div class="header-body">
  <div class="header-container container">
    <div class="header-row">
      <div class="header-column">
        <div class="header-row">
          <div class="header-logo">
            <?php
            if($option->opt_logo)
            {
              $logo = img(array('alt'=>$option->opt_name,'width'=>'auto','height'=>'48','data-sticky-width'=>'auto','data-sticky-height'=>'40','src'=>base_url('assets/library/option/logo/'.$option->opt_logo)));
              echo anchor(base_url(),$logo);
            }
            else {
              echo '<a href="'.base_url().'">';
              echo '<img alt="DiskominfostaperPaser" width="100" height="48" data-sticky-width="82" data-sticky-height="40" src="'.base_url('assets/content/img/logo.png').'">';
              echo '</a>';
            }
            ?>
          </div>
        </div>
      </div>
      <div class="header-column justify-content-end">
        <div class="header-row">
          <div class="header-nav header-nav-line header-nav-top-line header-nav-top-line-with-border order-2 order-lg-1">
            <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
              <?php $this->load->view('public/_include/menu');?>
            </div>
            <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
              <i class="fas fa-bars"></i>
            </button>
          </div>
          <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
            <div class="header-nav-feature header-nav-features-search d-inline-flex">
              <a href="#" class="header-nav-features-toggle" data-focus="headerSearch"><i class="fas fa-search header-nav-top-icon"></i></a>
              <div class="header-nav-features-dropdown" id="headerTopSearchDropdown">
                <?php echo form_open('welcome/search');?>
                  <div class="simple-search input-group">
                    <?php echo form_input('search','',array('class'=>'form-control','id'=>'headerSearch','placeholder'=>'Pencarian...'));?>
                    <span class="input-group-append">
                      <button class="btn" type="submit">
                        <i class="fa fa-search header-nav-top-icon"></i>
                      </button>
                    </span>
                  </div>
                <?php echo form_close();?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
