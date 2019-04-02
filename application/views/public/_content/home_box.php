<div class="slider-container rev_slider_wrapper" style="height: 330px;">
  <div id="revolutionSlider" class="slider rev_slider" data-version="5.4.8" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 1140, 'gridheight': 430, 'disableProgressBar': 'on', 'responsiveLevels': [4096,1200,992,500], 'parallax': { 'type': 'scroll', 'origo': 'enterpoint', 'speed': 1000, 'levels': [2,3,4,5,6,7,8,9,12,50], 'disable_onmobile': 'on' }, 'navigation' : {'arrows': { 'enable': true }, 'bullets': {'enable': true, 'style': 'bullets-style-1', 'h_align': 'center', 'v_align': 'bottom', 'space': 7, 'v_offset': 70, 'h_offset': 0}}}">
    <ul>
      <?php foreach($slide as $row){ ?>
      <li data-transition="fade" style="text-shadow: 2px 2px 2px #000000">
        <img src="<?php echo $row->slide_url;?>"
          alt=""
          data-bgposition="center center"
          data-bgfit="cover"
          data-bgrepeat="no-repeat"
          class="rev-slidebg">
        <div class="tp-caption text-color-light font-weight-normal"
          data-x="center"
          data-y="center" data-voffset="['-50','-50','-50','-75']"
          data-start="700"
          data-fontsize="['22','22','22','40']"
          data-lineheight="['25','25','25','45']"
          data-transform_in="y:[-50%];opacity:0;s:500;">SELAMAT DATANG DI WEBSITE RESMI</div>

        <div class="tp-caption font-weight-extra-bold text-color-light negative-ls-2"
          data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
          data-x="center"
          data-y="center"
          data-fontsize="['30','30','30','50']"
          data-lineheight="['55','55','55','95']">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</div>

        <div class="tp-caption font-weight-semibold"
          data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
          data-x="center"
          data-y="center" data-voffset="['40','40','40','80']"
          data-fontsize="['25','25','25','50']"
          data-lineheight="['20','20','20','95']"
          style="color: #FFFFFF">PEMERINTAH KABUPATEN PASER</div>
      </li>
    <?php } ?>
    </ul>
  </div>
</div>
<!-- start: headline -->
<?php $this->load->view('public/_content/headline');?>
<!-- end: headline -->
<div class="container mt-5">
  <div class="row">
    <div class="col-lg-8">
      <?php
      if(count($pos_terbaru))
      {
      ?>
      <div class="container mb-5">
        <div class="col-md-12 heading heading-border heading-bottom-border">
          <h3>Berita <strong>Terbaru</strong></h3>
        </div>
        <div class="row">
          <?php
          foreach($pos_terbaru as $row)
          {
            echo '<div class="col-lg-6">';
            echo '<article class="post post-large pb-5">';
            echo '<div class="post-image mb-2">';
            echo '<a href="'.site_url('post/'.$row->post_slug).'"  title="'.$row->post_title.'">';
            echo '<img style="height:150px; width:100%" src="'.$row->post_feature_image.'" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="'.$row->post_title.'">';
            echo '</a>';
            echo '</div>';
            echo '<div class="post-date"><span class="day">'.date('d',strtotime($row->post_date)).'</span><span class="month">'.date('M',strtotime($row->post_date)).'</span></div>';
            echo '<div class="post-content"><h4><a href="'.site_url('post/'.$row->post_slug).'" class="text-decoration-none" title="'.$row->post_title.'">'.character_limiter($row->post_title, 85).'</a></h4></div>';
            echo '</article>';
            echo '</div>';
          }
          ?>
        </div>
      </div>
      <?php
      }
      ?>
    </div>
    <div class="col-lg-4 mb-5">
      <!--
      <div class="container mb-3">
        <h5 class="mb-0"><strong>Kategori</strong> Berita</h5>
        <ul class="nav nav-list flex-column">
          <?php
          foreach($this->M_category->get_root() as $row_cat)
          {
            echo '<li class="nav-item">';
            echo anchor('content/post/category/'.$row_cat->cat_slug,$row_cat->cat_name,array('class'=>'nav-link'));
            $parent = $this->M_category->get_by_id($row_cat->cat_ID);
            if($row_cat->cat_ID == $parent->cat_ID)
            {
              echo '<ul>';
              foreach($this->M_category->get_by_parent($row_cat->cat_ID) as $row_cat_p)
              {
                echo '<li class="nav-item">'.anchor('content/post/category/'.$row_cat_p->cat_slug,$row_cat_p->cat_name,array('class'=>'nav-link')).'</li>';
              }
              echo '</ul>';
            }
            echo '</li>';
          }
          ?>
        </ul>
      </div>
      -->
      <div class="container">
        <script type="text/javascript" src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js"></script>
        <div id="gpr-kominfo-widget-container"></div>
      </div>
    </div>
  </div>
</div>
<!-- start: link -->
<?php $this->load->view('public/_content/link');?>
<!-- end: link -->
