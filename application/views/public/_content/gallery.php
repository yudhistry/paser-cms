<?php $this->load->view('public/_content/headline');?>
<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-lg-8">
      <?php
      if(count($galeri))
      {
        foreach($galeri as $row)
        {
          $image = explode(',',$row->gal_file);
          $library = $this->M_library->get_by_id($image[0]);
        ?>
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <a href="<?php echo site_url('gallery/'.$row->gal_slug);?>">
                <span class="thumb-info thumb-info-borders thumb-info-borders-rounded rounded box-shadow-1">
                  <span class="thumb-info-wrapper">
                    <img src="<?php echo $library->lib_path;?>" class="img-fluid" alt="<?php echo $row->gal_title;?>">
                    <span class="thumb-info-title">
                      <span class="thumb-info-inner"><?php echo character_limiter($row->gal_title, 85);?></span>
                      <span class="thumb-info-type"><i class="fas fa-user"></i> Oleh <?php echo $row->display_name;?></span>
                    </span>
                    <span class="thumb-info-action">
                      <span class="thumb-info-action-icon"><i class="fas fa-plus"></i></span>
                    </span>
                  </span>
                </span>
              </a>
            </div>

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
    <div class="col-lg-4 mb-5">
      <div class="container mb-3">
        <div class="tabs tabs-dark mb-4 pb-2">
          <ul class="nav nav-tabs">
            <li class="nav-item active">
              <a class="nav-link show active text-1 font-weight-bold text-uppercase" href="#newPosts" data-toggle="tab">Berita Terbaru</a>
            </li>
            <!--<li class="nav-item"><a class="nav-link text-1 font-weight-bold text-uppercase" href="#recentPosts" data-toggle="tab">Recent</a></li>-->
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="newPosts">
              <ul class="simple-post-list">
                <?php
                foreach($pos_terbaru as $row)
                {
                  echo '<li>';
                  //echo '<div class="post-image">';
                  //echo '<div class="img-thumbnail img-thumbnail-no-borders d-block">';
                  //echo '<a href="blog-post.html">';
                  //echo '<img src="'.$row->post_feature_image.'" width="50" height="50" alt="">';
                  //echo '</a>';
                  //echo '</div>';
                  //echo '</div>';
                  echo '<div class="post-info">';
                  echo '<a href="'.site_url('post/'.$row->post_slug).'" data-toggle="tooltip" data-placement="left" title="" data-original-title="'.$row->post_title.'">'.character_limiter($row->post_title, 55).'</a>';
                  echo '<div class="post-meta">'.date('M d, Y',strtotime($row->post_date)).'</div>';
                  echo '</div>';
                  echo '</li>';
                }
                ?>
              </ul>
            </div>
            <!--
            <div class="tab-pane" id="recentPosts">
              <ul class="simple-post-list">
                <li>
                  <div class="post-image">
                    <div class="img-thumbnail img-thumbnail-no-borders d-block">
                      <a href="blog-post.html">
                        <img src="img/blog/square/blog-24.jpg" width="50" height="50" alt="">
                      </a>
                    </div>
                  </div>
                  <div class="post-info">
                    <a href="blog-post.html">Vitae Nibh Un Odiosters</a>
                    <div class="post-meta">
                       Nov 10, 2018
                    </div>
                  </div>
                </li>
                <li>
                  <div class="post-image">
                    <div class="img-thumbnail img-thumbnail-no-borders d-block">
                      <a href="blog-post.html">
                        <img src="img/blog/square/blog-42.jpg" width="50" height="50" alt="">
                      </a>
                    </div>
                  </div>
                  <div class="post-info">
                    <a href="blog-post.html">Odiosters Nullam Vitae</a>
                    <div class="post-meta">
                       Nov 10, 2018
                    </div>
                  </div>
                </li>
                <li>
                  <div class="post-image">
                    <div class="img-thumbnail img-thumbnail-no-borders d-block">
                      <a href="blog-post.html">
                        <img src="img/blog/square/blog-11.jpg" width="50" height="50" alt="">
                      </a>
                    </div>
                  </div>
                  <div class="post-info">
                    <a href="blog-post.html">Nullam Vitae Nibh Un Odiosters</a>
                    <div class="post-meta">
                       Nov 10, 2018
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            -->
          </div>
        </div>


      </div>
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
