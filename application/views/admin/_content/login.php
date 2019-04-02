<section class="body-sign">
  <div class="center-sign">
    <a href="<?php echo base_url();?>" class="logo float-left pt-3">
      <img src="<?php echo base_url('assets/library/option/logo.png');?>" height="54" alt="Porto Admin" />
    </a>
    <div class="panel card-sign">
      <div class="card-title-sign mt-3 text-right">
        <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Otentifikasi</h2>
      </div>
      <div class="card-body pb-5">
        <?php echo form_open('admin/auth/login');?>
          <div class="form-group mb-3">
            <?php echo form_label('Pengguna','login');?>
            <div class="input-group">
              <?php echo form_input('login',set_value('login'),array('class'=>'form-control form-control-lg'));?>
              <span class="input-group-append">
                <span class="input-group-text">
                  <i class="fas fa-user"></i>
                </span>
              </span>
            </div>
            <?php echo form_error('login','<span class="text-danger">','</span>');?>
          </div>
          <div class="form-group mb-3">
            <div class="clearfix">
              <?php echo form_label('Sandi','password');?>
              <a href="pages-recover-password.html" class="float-right">Lupa Sandi?</a>
            </div>
            <div class="input-group">
              <?php echo form_password('password',set_value('password'),array('class'=>'form-control form-control-lg'));?>
              <span class="input-group-append">
                <span class="input-group-text">
                  <i class="fas fa-lock"></i>
                </span>
              </span>
            </div>
            <?php echo form_error('password','<span class="text-danger">','</span>');?>
          </div>
          <div class="row">
            <div class="col-sm-8 pt-1">
              <div class="checkbox-custom checkbox-default">
                <?php echo form_checkbox('rememberme',TRUE,$user_cookie,'id="RememberMe"');?>
                <label for="RememberMe">Ingatkan Saya</label>
              </div>
            </div>
            <div class="col-sm-4 text-right">
              <?php echo form_button(array('type'=>'submit','name'=>'btn_login','class'=>'btn btn-primary mt-2','content'=>'<i class="fas fa-sign-in-alt"></i> Masuk'));?>
            </div>
          </div>
        <?php echo form_close();?>
      </div>
    </div>
    <p class="text-center text-muted text-2 mt-3 mb-3"><?php echo $this->config->item('copyright');?></p>
  </div>
</section>
