<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open('admin/user/update/'.$this->uri->segment(4));?>
      <header class="card-header">
        <h2 class="card-title">Sunting <?php echo $page;?></h2>
      </header>
      <div class="card-body">
        <h3 class="font-weight-semibold m-0">Nama</h3>
        <hr class="dotted short">
        <div class="form-group row">
          <?php
          echo form_label('Nama Pengguna <span class="required">*</span>','user_login',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('user_login',set_value('user_login',$data->user_login),array('class'=>'form-control','readonly'=>'readonly'));
          echo form_error('user_login','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Nama Lengkap <span class="required">*</span>','user_fullname',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('user_fullname',set_value('user_fullname',$data->user_fullname),array('class'=>'form-control'));
          echo form_error('user_fullname','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>

        <h3 class="font-weight-semibold mt-5">Info Kontak</h3>
        <hr class="dotted short">
        <div class="form-group row">
          <?php
          echo form_label('Email <span class="required">*</span>','user_email',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('user_email',set_value('user_email',$data->user_email),array('class'=>'form-control'));
          echo form_error('user_email','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Situs Web','user_url',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('user_url',set_value('user_url',$data->user_url),array('class'=>'form-control'));
          echo form_error('user_url','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Telepon','user_phone',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('user_phone',set_value('user_phone',$data->user_phone),array('class'=>'form-control'));
          echo '</div>';
          ?>
        </div>
        <h3 class="font-weight-semibold mt-5">Manajemen Akun</h3>
        <hr class="dotted short">
        <div class="form-group row">
          <?php
          echo form_label('Peranan','user_role',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          $user_role = $this->M_userrole->get_all();
          $role 	   = array();
          foreach($user_role as $row)
          {
            $role[$row->usrole_ID] = $row->usrole_name;
          }
          echo form_dropdown('user_role',$role,$data->user_role,array('class'=>'form-control'));
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Sandi','user_password',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_password(array('name'=>'user_password','value'=>set_value('user_password'),'class'=>'form-control'));
          echo form_error('user_password','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Konfirmasi Sandi','user_password_confirm',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_password(array('name'=>'user_password_confirm','value'=>set_value('user_password_confirm'),'class'=>'form-control'));
          echo form_error('user_password_confirm','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
      </div>
      <div class="card-footer">
        <div class="form-group row">
          <?php
          echo form_label('','btn_save',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6 btn-group">';
          echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save"></i> Perbarui '.$page,'class'=>'btn btn-sm btn-primary'));
          echo anchor('admin/user','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
          echo form_error('ID','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
      </div>
      <?php echo form_close();?>
    </section>
  </div>
</div>
