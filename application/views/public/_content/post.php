<?php $this->load->view('public/_content/headline');?>
<div class="container mt-5">
  <div class="row">
    <div class="col-lg-8">
      <?php
      if($author)
      {
        echo '<div class="row">';
          echo '<div class="col-md-12 heading heading-border heading-bottom-border">';
            echo '<h4>Penulis: <strong>'.$author->display_name.'</strong></h4>';
          echo '</div>';
        echo '</div>';
      }
      if($category)
      {
        echo '<div class="row">';
          echo '<div class="col-md-12 heading heading-border heading-bottom-border">';
            echo '<h4>Kategori: <strong>'.$category->cat_name.'</strong></h4>';
          echo '</div>';
        echo '</div>';
      }
      ?>
        <?php
        if(count($pos))
        {
          foreach($pos as $row)
          {
        ?>
        <div class="container">
          <div class="row">
            <div class="blog-posts">
              <div class="blog-posts">
                <article class="post post-medium">
                  <div class="row mb-3">
                    <div class="col-lg-5">
                      <div class="post-image">
                        <a href="<?php echo site_url('post/'.$row->post_slug);?>">
                          <img src="<?php echo $row->post_feature_image;?>" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="<?php echo $row->post_title;?>" />
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-7">
                      <div class="post-content">
                        <h2 class="font-weight-semibold text-5 line-height-4 mb-2">
                          <a href="<?php echo site_url('post/'.$row->post_slug);?>">
                            <?php
                            $post_title = character_limiter($row->post_title, 85);
                            echo $post_title;
                            ?>
                          </a>
                        </h2>
                        <p class="mb-0">
                          <?php
                          $post_content = character_limiter($row->post_content, 350);
                          echo $post_content;
                          ?>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="post-meta">
                        <span><i class="far fa-calendar-alt"></i> <?php echo date_indo(date('Y-m-d',strtotime($row->post_date)));?></span>
                        <span><i class="far fa-eye"></i> <?php echo $row->post_view_count;?></span>
                        <span><i class="far fa-user"></i> Oleh <a href="<?php echo site_url('post/author/'.$row->user_login);?>"><?php echo $row->display_name;?></a> </span>
                        <span>
                          <i class="far fa-folder"></i>
                          <?php
                          $category = explode(',',$row->post_category);
                          $cat = array();
                          foreach($category as $key => $value)
                          {
                            $rows = $this->M_category->get_by_id($value);
                            $cat[$value] = anchor('post/category/'.$rows->cat_slug,$rows->cat_name);
                          }
                          echo implode(', ',$cat++);
                          ?>
                        </span>
                        <span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0">
                          <a href="<?php echo site_url('post/'.$row->post_slug);?>" class="btn btn-xs btn-light text-1 text-uppercase">Selengkapnya</a>
                        </span>
                      </div>
                    </div>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <?php echo $this->pagination->create_links();?>
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
        <h5 class="mb-0"><strong>Kategori</strong> Berita</h5>
        <ul class="nav nav-list flex-column">
          <?php
          foreach($this->M_category->get_root() as $row_cat)
          {
            echo '<li class="nav-item">';
            echo anchor('post/category/'.$row_cat->cat_slug,$row_cat->cat_name,array('class'=>'nav-link'));
            $parent = $this->M_category->get_by_id($row_cat->cat_ID);
            if($row_cat->cat_ID == $parent->cat_ID)
            {
              echo '<ul>';
              foreach($this->M_category->get_by_parent($row_cat->cat_ID) as $row_cat_p)
              {
                echo '<li class="nav-item">'.anchor('post/category/'.$row_cat_p->cat_slug,$row_cat_p->cat_name,array('class'=>'nav-link')).'</li>';
              }
              echo '</ul>';
            }
            echo '</li>';
          }
          ?>
        </ul>
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
