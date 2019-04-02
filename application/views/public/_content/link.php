<?php
if(count($tautan))
{
?>
<div class="container mb-5">
  <div class="col-md-12 heading heading-border heading-middle-border heading-middle-border-center">
    <h3>Tautan <strong>Terkait</strong></h3>
  </div>
  <div class="row">
    <div class="owl-carousel owl-theme carousel-center-active-item" data-plugin-options="{'responsive': {'0': {'items': 1}, '476': {'items': 1}, '768': {'items': 7}, '992': {'items': 7}, '1200': {'items': 7}}, 'autoplay': true, 'autoplayTimeout': 3000, 'dots': false}">
      <?php
      foreach($tautan as $row)
      {
        echo '<div>';
        $link_img = img(array('src'=>$row->link_img_path,'height'=>'100','width'=>'auto'));
        echo anchor($row->link_url,$link_img,array('title'=>$row->link_title));
        echo '</div>';
      }
      ?>
    </div>
  </div>
</div>
<?php
}
?>
