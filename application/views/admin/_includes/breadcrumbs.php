<header class="page-header">
  <h2><?php echo $page;?></h2>
  <div class="right-wrapper text-right">
    <ol class="breadcrumbs">
      <?php
      echo '<li>'.anchor(base_url('pasery'),'<i class="fas fa-home"></i>').'</li>';
      $pages = $page != 'Beranda' ? '<li><span>'.$page.'</span></li>' : null;
      echo $pages;
      $subpages = $subpage != $page ? '<li><span>'.$subpage.'</span></li>' : null;
      echo $subpages;
      ?>
    </ol>
    <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
  </div>
</header>
