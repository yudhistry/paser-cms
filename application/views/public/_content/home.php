<?php
$this->load->view('public/_content/slide_revo');
$this->load->view('public/_content/headline');
?>
<div class="container mt-5">
  <div class="row">
    <div class="col-lg-8">
      <?php
      if(count($pos_terbaru))
      {
      ?>
      <div class="container mb-5">
        <div class="row">
          <div class="col-md-12 heading heading-border heading-bottom-border">
            <h3>Berita <strong>Terbaru</strong></h3>
          </div>
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
      <div class="container">
        <script type="text/javascript" src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js"></script>
        <div id="gpr-kominfo-widget-container"></div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('public/_content/link');?>
