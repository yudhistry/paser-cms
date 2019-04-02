<div class="container">
  <div class="footer-ribbon">
    <span>Sekilas Info</span>
  </div>
  <div class="row py-5 my-4">
    <div class="col-md-6 mb-4 mb-lg-0">
      <h5 class="text-3 mb-3">Tentang</h5>
      <div>
        <p><?php echo $option->opt_description;?></p>
      </div>
    </div>
    <div class="col-md-4 mb-4 mb-md-0">
      <div class="contact-details">
        <h5 class="text-3 mb-3">Kontak</h5>
        <ul class="list list-icons list-icons-lg">
          <li class="mb-1"><i class="far fa-dot-circle text-color-primary"></i><p class="m-0"><?php echo $option->opt_address;?></p></li>
          <li class="mb-1"><i class="fab fa-whatsapp text-color-primary"></i><p class="m-0"><a href="<?php echo 'tel:'.$option->opt_telp;?>"><?php echo $option->opt_telp;?></a></p></li>
          <li class="mb-1"><i class="far fa-envelope text-color-primary"></i><p class="m-0"><a href="<?php echo 'mailto:'.$option->opt_email;?>"><?php echo $option->opt_email;?></a></p></li>
        </ul>
      </div>
    </div>
    <div class="col-md-2">
      <h5 class="text-3 mb-3">Ikuti</h5>
      <ul class="social-icons">
        <li class="social-icons-facebook"><a href="<?php echo $option->opt_facebook;?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
        <li class="social-icons-twitter"><a href="<?php echo $option->opt_twitter;?>" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
        <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
      </ul>
    </div>
  </div>
</div>
