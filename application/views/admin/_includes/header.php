<header class="header">
  <div class="logo-container">
    <a href="<?php echo base_url('pasery');?>" class="logo">
      <img src="<?php echo base_url('assets/library/option/logo.png');?>" width="auto" height="35" alt="<?php echo $option->opt_name;?>" />
    </a>
    <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
      <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
    </div>
  </div>
  <!-- start: search & user box -->
  <div class="header-right">
    <span class="separator"></span>
    <div id="userbox" class="userbox">
      <a href="#" data-toggle="dropdown">
        <figure class="profile-picture">
          <?php
          if($this->session->userdata['logged']['user_avatar'])
          {
              $avatar = base_url('assets/library/user/'.$this->session->userdata['logged']['user_avatar']);
          }
          else
          {
              $avatar = base_url('assets/admin/img/!logged-user.jpg');
          }
          ?>
          <img src="<?php echo $avatar;?>" alt="<?php echo $this->session->userdata['logged']['user_login'];?>" class="rounded-circle" data-lock-picture="<?php echo $avatar;?>" />
        </figure>
        <div class="profile-info" data-lock-name="<?php echo $this->session->userdata['logged']['user_login'];?>" data-lock-email="<?php echo $this->session->userdata['logged']['user_email'];?>">
          <span class="name"><?php echo $this->session->userdata['logged']['display_name'];?></span>
          <span class="role"><?php echo $this->session->userdata['logged']['usrole_name'];?></span>
        </div>
        <i class="fa custom-caret"></i>
      </a>
      <div class="dropdown-menu">
        <ul class="list-unstyled mb-2">
          <li class="divider"></li>
          <li>
            <a role="menuitem" tabindex="-1" href="<?php echo site_url('pasery/profile/'.$this->session->userdata['logged']['ID']);?>"><i class="fas fa-user"></i> Profil Anda</a>
          </li>
          <li>
            <a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/auth/logout');?>"><i class="fas fa-power-off"></i> Keluar</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- end: search & user box -->
</header>
