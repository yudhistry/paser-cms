<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php
      echo form_open('admin/profile/update',array('class'=>'form-horizontal'));
      echo form_hidden('ID',$data->ID);
      ?>
      <header class="card-header">
        <h2 class="card-title"><?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <h3 class="font-weight-semibold m-0">Nama</h3>
        <hr class="dotted short">
        <div class="form-group row">
          <?php
          echo form_label('Nama Pengguna','user_login',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('user_login',$data->user_login,array('class'=>'form-control','readonly'=>'readonly'));
          echo form_error('user_login','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Nama Lengkap <span class="required">*</span>','user_fullname',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('user_fullname',$data->user_fullname,array('class'=>'form-control'));
          echo form_error('user_fullname','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Nama yang ditampilkan','display_name',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          $name 	= array($data->user_login,$data->user_fullname);
          $dn 	= array();
          foreach($name as $key=>$value)
          {
            $dn[$value] = $value;
          }
          echo form_dropdown('display_name',$dn,$data->display_name,array('class'=>'form-control'));
          echo '</div>';
          ?>
        </div>
        <h3 class="font-weight-semibold mt-5">Info Kontak</h3>
        <hr class="dotted short">
        <div class="form-group row">
          <?php
          echo form_label('Email <span class="required">*</span>','user_email',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('user_email',$data->user_email,array('class'=>'form-control'));
          echo form_error('user_email','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Situs Web','user_url',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('user_url',$data->user_url,array('class'=>'form-control'));
          echo form_error('user_url','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Telepon','user_phone',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('user_phone',$data->user_phone,array('class'=>'form-control'));
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Alamat','user_address',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('user_address',$data->user_address,array('class'=>'form-control'));
          echo '</div>';
          ?>
        </div>
        <h3 class="font-weight-semibold mt-5">Tentang Diri Anda</h3>
        <hr class="dotted short">
        <div class="form-group row">
          <?php
          echo form_label('Info Biografi','user_bio',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_textarea(array('name'=>'user_bio','value'=>$data->user_bio,'class'=>'form-control','rows'=>'3'));
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Foto Profil','user_avatar',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-2">';
          if($data->user_avatar)
          {
            $avatar = base_url('assets/library/user/'.$data->user_avatar);
          }
          else
          {
            $avatar = base_url('assets/admin/img/!logged-user.jpg');
          }
          $img = img(array('src'=>$avatar,'class'=>'rounded img-fluid mb-1'));
          echo '<a href="#modalAvatar" class="modal-with-form">'.$img.'</a>';
          echo '</div>';
          echo form_error('user_avatar','<span class="text-danger">','</span>');
          ?>
        </div>
        <h3 class="font-weight-semibold mt-5">Manajemen Akun</h3>
        <hr class="dotted short">
        <div class="form-group row">
          <?php
          echo form_label('Sandi baru','user_password',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_password(array('name'=>'user_password','value'=>set_value('user_password'),'class'=>'form-control'));
          echo form_error('user_password','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Konfirmasi Sandi baru','user_password_confirm',array('class'=>'col-md-3 control-label pt-2'));
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
          echo '<div class="col-md-6">';
          echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-edit"></i> Perbaharui Profil','class'=>'btn btn-sm btn-primary'));
          echo form_error('ID','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
      </div>
      <?php echo form_close();?>
    </section>
    <!-- start: modal foto -->
    <div id="modalAvatar" class="modal-block modal-block-primary mfp-hide">
      <section class="card">
        <?php
        echo form_open_multipart('admin/profile/avatar');
        echo form_hidden('ID',$data->ID);
        ?>
        <header class="card-header">
          <h2 class="card-title">Perbaharui Foto Profil</h2>
        </header>
        <div class="card-body">
          <div class="form-group row">
            <?php
            echo form_label('File','user_avatar',array('class'=>'col-md-3 control-label pt-2'));
            echo '<div class="col-md-9">';
            echo form_upload(array('name'=>'user_avatar','class'=>'form-control'));
            echo '</div>';
            ?>
          </div>
        </div>
        <footer class="card-footer">
          <div class="row">
            <div class="col-md-12 text-right">
              <?php
              echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save text-white"></i> Simpan','class'=>'btn btn-sm btn-primary'));
              echo form_button(array('content'=>'<i class="fas fa-times text-dark"></i> Batal','class'=>'btn btn-sm btn-default modal-dismiss'));
              ?>
            </div>
          </div>
        </footer>
        <?php echo form_close();?>
      </section>
    </div>
    <!-- end: modal foto -->
  </div>
</div>
