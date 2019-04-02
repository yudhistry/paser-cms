<div class="pt-3 bg-primary" id="home-intro">
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <blockquote class="blockquote-reverse blockquote-dark text-uppercase text-dark font-weight-bold">
          Berita <span class="text-white">Utama</span>
        </blockquote>
      </div>
      <div class="col-md-10">
        <marquee class="pt-2" onmouseover="stop()" onmouseout="start()">
          <?php
          if(count($headline))
          {
            foreach($headline as $row)
            {
              echo '<a href="'.site_url('post/'.$row->post_slug).'" class="text-white pr-5">'.$row->post_title.'</a>';
            }
          }
          ?>
        </marquee>
      </div>
    </div>
  </div>
</div>
