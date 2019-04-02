<!-- start: headline -->
<?php $this->load->view('public/_content/headline');?>
<!-- end: headline -->
<section class="page-header page-header-modern page-header-background page-header-background-sm overlay overlay-color-primary overlay-show overlay-op-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12 align-self-center p-static order-2 text-center" style="text-shadow: 2px 2px 2px #000000">
        <div class="col-md-12 align-self-center order-1">
          <ul class="breadcrumb d-block text-center">
            <li><a href="<?php echo base_url();?>">Beranda</a></li>
          </ul>
        </div>
        <h1>Pencarian</h1>
      </div>
    </div>
  </div>
</section>
<div class="container mb-5">
  <div class="row">
    <div class="col-lg-12 heading heading-border heading-bottom-border mb-0">
      <h4 class="">Hasil pencarian: <strong class="font-weight-extra-bold"><?php echo $this->input->post('search');?></strong></h4>
      <!--<p class="lead mb-0">6 results found.</p>-->
    </div>
    <div class="col-lg-12">
      <ul class="simple-post-list">
        <?php
        if(count($search))
        {
          foreach($search as $row)
          {
            $type = $row->post_type == 'pos' ? 'Berita' : 'Halaman';
            $url  = $row->post_type == 'pos' ? 'post' : 'page';
            echo '<li>';
            echo '<div class="post-info">';
            echo '<a href="'.site_url($url.'/'.$row->post_slug).'" class="font-weight-bold">'.$row->post_title.'</a>';
            echo '<div class="post-meta">';
            echo '<span class="text-dark text-uppercase font-weight-semibold">'.$type.'</span> | '.date_indo(date('Y-m-d',strtotime($row->post_date)));
            echo '</div>';
            echo '</div>';
            echo '</li>';

          }
        }
        else {
          echo '<div class="col-lg-12">';
          echo '<h1 class="text-center text-muted mt-5"><i class="fas fa-times-circle"></i><br>Data Tidak Ditemukan</h1>';
          echo '</div>';
        }
        ?>
      </ul>
    </div>
  </div>
</div>
<!-- start: link -->
<?php $this->load->view('public/_content/link');?>
<!-- end: link -->
