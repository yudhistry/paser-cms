<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php
      echo form_open('admin/setting/update',array('class'=>'form-horizontal'));
      echo form_hidden('ID',$data->ID);
      ?>
      <header class="card-header">
        <h2 class="card-title"><?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="form-group row">
          <?php
          echo form_label('Logo','opt_logo',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-2">';
          if($data->opt_logo)
          {
            $logo = base_url('assets/library/option/logo/'.$data->opt_logo);
          }
          else
          {
            $logo = base_url('assets/admin/img/!logged-user.jpg');
          }
          $opt_logo = img(array('src'=>$logo,'class'=>'rounded img-fluid mb-1','width'=>'200px'));
          echo '<a href="#modalLogo" class="modal-with-form">'.$opt_logo.'</a>';
          echo '</div>';
          echo form_error('opt_logo','<span class="text-danger">','</span>');
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Favicon','opt_favicon',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-2">';
          if($data->opt_favicon)
          {
            $favicon = base_url('assets/library/option/favicon/'.$data->opt_favicon);
          }
          else
          {
            $favicon = base_url('assets/admin/img/!logged-user.jpg');
          }
          $opt_favicon = img(array('src'=>$favicon,'class'=>'rounded img-fluid mb-1','width'=>'100px'));
          echo '<a href="#modalFavicon" class="modal-with-form">'.$opt_favicon.'</a>';
          echo '</div>';
          echo form_error('opt_favicon','<span class="text-danger">','</span>');
          ?>
        </div>
        <hr class="dotted short">
        <div class="form-group row">
          <?php
          echo form_label('Judul Situs <span class="required">*</span>','opt_name',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('opt_name',$data->opt_name,array('class'=>'form-control'));
          echo form_error('opt_name','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Slogan','opt_slogan',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-9">';
          echo form_input('opt_slogan',$data->opt_slogan,array('class'=>'form-control'));
          echo form_error('opt_slogan','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Keterangan','opt_description',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-9">';
          echo form_textarea(array('class'=>'form-control','rows'=>'3','name'=>'opt_description','value'=>$data->opt_description));
          echo form_error('opt_description','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <hr class="dotted short">
        <div class="form-group row">
          <?php
          echo form_label('Alamat','opt_address',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-9">';
          echo form_input('opt_address',$data->opt_address,array('class'=>'form-control'));
          echo form_error('opt_address','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Telepon','opt_telp',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-9">';
          echo form_input('opt_telp',$data->opt_telp,array('class'=>'form-control'));
          echo form_error('opt_telp','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Email','opt_address',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-9">';
          echo form_input('opt_email',$data->opt_email,array('class'=>'form-control'));
          echo form_error('opt_email','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <hr class="dotted short">
        <div class="form-group row">
          <?php
          echo form_label('Facebook','opt_facebook',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-9">';
          echo form_input('opt_facebook',$data->opt_facebook,array('class'=>'form-control'));
          echo form_error('opt_facebook','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Twitter','opt_twitter',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-9">';
          echo form_input('opt_twitter',$data->opt_twitter,array('class'=>'form-control'));
          echo form_error('opt_twitter','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <hr class="dotted short">
        <div class="form-group row">
          <?php
          echo form_label('Menampilkan pos per halaman','opt_read',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-3">';
          echo '<div data-plugin-spinner data-plugin-options="{ "value":1, "min": 1, "max": 10 }">
                  <div class="input-group">
                    <input type="text" name="opt_read" value="'.set_value('opt_read',$data->opt_read).'" class="spinner-input form-control" maxlength="2" readonly>
                    <div class="input-group-append">
                      <button type="button" class="btn btn-default spinner-up">
                        <i class="fas fa-angle-up"></i>
                      </button>
                      <button type="button" class="btn btn-default spinner-down">
                        <i class="fas fa-angle-down"></i>
                      </button>
                    </div>
                  </div>
                </div>';
          echo form_error('opt_read','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
      </div>
      <div class="card-footer">
        <div class="form-group row">
          <?php
          echo form_label('','btn_save',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-edit"></i> Perbarui '.$page,'class'=>'btn btn-sm btn-primary'));
          echo form_error('ID','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
      </div>
      <?php echo form_close();?>
    </section>
    <!-- start: modal logo -->
    <div id="modalLogo" class="modal-block modal-block-primary mfp-hide">
      <section class="card">
        <?php
        echo form_open_multipart('admin/setting/logo');
        echo form_hidden('ID',$data->ID);
        ?>
        <header class="card-header">
          <h2 class="card-title">Perbaharui Logo</h2>
        </header>
        <div class="card-body">
          <div class="form-group row">
            <?php
            echo form_label('File','opt_logo',array('class'=>'col-md-3 control-label pt-2'));
            echo '<div class="col-md-9">';
            echo form_upload(array('name'=>'opt_logo','class'=>'form-control'));
            echo '</div>';
            ?>
          </div>
        </div>
        <footer class="card-footer">
          <div class="row">
            <div class="col-md-12 text-right">
              <?php
              echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save text-white"></i> Simpan','class'=>'btn btn-sm btn-primary'));
              echo form_button(array('content'=>'Batal','class'=>'btn btn-sm btn-default modal-dismiss'));
              ?>
            </div>
          </div>
        </footer>
        <?php echo form_close();?>
      </section>
    </div>
    <!-- end: modal logo -->
    <!-- start: modal favicon -->
    <div id="modalFavicon" class="modal-block modal-block-primary mfp-hide">
      <section class="card">
        <?php
        echo form_open_multipart('admin/setting/favicon');
        echo form_hidden('ID',$data->ID);
        ?>
        <header class="card-header">
          <h2 class="card-title">Perbaharui Favicon</h2>
        </header>
        <div class="card-body">
          <div class="form-group row">
            <?php
            echo form_label('File','opt_favicon',array('class'=>'col-md-3 control-label pt-2'));
            echo '<div class="col-md-9">';
            echo form_upload(array('name'=>'opt_favicon','class'=>'form-control'));
            echo '</div>';
            ?>
          </div>
        </div>
        <footer class="card-footer">
          <div class="row">
            <div class="col-md-12 text-right">
              <?php
              echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save text-white"></i> Simpan','class'=>'btn btn-sm btn-primary'));
              echo form_button(array('content'=>'Batal','class'=>'btn btn-sm btn-default modal-dismiss'));
              ?>
            </div>
          </div>
        </footer>
        <?php echo form_close();?>
      </section>
    </div>
    <!-- end: modal favicon -->
  </div>
</div>
