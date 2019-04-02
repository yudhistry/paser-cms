<?php $this->load->view('public/_content/headline');?>
<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-lg-8">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-8">
            <a href="<?php site_url('document');?>" class="btn btn-transparent"><i class="fas fa-home"></i></a>
          </div>
          <div class="col-sm-4">
            <?php
            echo form_open('public/document/search');
              echo '<div class="input-group">';
  							echo '<input class="form-control form-control-sm text-1" placeholder="Pencarian..." name="search" id="s" type="text">';
  							echo '<span class="input-group-append">';
                echo '<button type="submit" name="btn_search" class="btn btn-dark text-1"><i class="fas fa-search"></i></button>';
  							echo '</span>';
							echo '</div>';
            echo form_close();
            ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered table-hover">
              <thead>
                <tr class="text-center">
                  <th width="50px"><i class="fas fa-folder"></i></th>
                  <th>Nama</th>
                  <th width="135px"><i class="fas fa-calendar-alt"></i></th>
                  <th width="70px"><i class="fas fa-download"></i></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach($dokumen as $row)
                {
                  $doc_date = explode(' ',$row->doc_date);
                  $date = $row->doc_type == 'folder' ? date_indo($doc_date[0]) : date_indo($row->doc_endorsement);
                  $icon = $row->doc_type == 'folder' ? '<i class="fas fa-folder text-warning pr-2"></i>' : '<i class="fas fa-file-alt pr-2"></i>';
                  $anchor = $row->doc_type == 'file' ? anchor('document/download/'.$row->doc_slug,$row->doc_title) : anchor('document/parent/'.$row->doc_slug,$row->doc_title);
                  echo '<tr>';
                    echo '<td class="text-center">'.$icon.'</td>';
                    echo '<td>'.$anchor.'</td>';
                    echo '<td class="text-2">'.$date.'</td>';
                    echo '<td class="text-center">'.$row->doc_download_count.'</td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <?php echo $this->pagination->create_links();?>
          </div>
        </div>
      </div>
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
