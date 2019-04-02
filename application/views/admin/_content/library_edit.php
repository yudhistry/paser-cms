<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open_multipart('admin/library/update/'.$this->uri->segment(4));?>
      <header class="card-header">
        <h2 class="card-title">Sunting <?php echo $page;?></h2>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-5">
                <?php
                if($data->lib_type == 'gambar')
                {
                  $src = $data->lib_path;
                }
                elseif($data->lib_type == 'dokumen')
                {
                  $src = base_url('assets/library/default-document.png');
                }
                else {
                  $src = base_url('assets/library/default-unknown.png');
                }
                $image_properties = array(
                  'src'   => $src,
                  'class' => 'thumbnail thumb-preview thumb-image img-fluid m-0 center',
                  'width' => '100%'
                );
                echo img($image_properties);
                ?>
              </div>
              <div class="col-md-7">
                <div class="alert alert-default pl-2 pt-2 pr-2 pb-1 text-2" style="height:100%">
                  <h4 class="pl-3">Properti</h4>
                  <div class="form-group row m-0">
                    <?php
                    echo form_label('<i class="fas fa-file"></i>','',array('class'=>'col-md-1 control-label text-right pr-0'));
                    echo '<div class="col-md-11">';
                    echo $data->lib_file;
                    echo '</div>';
                    ?>
                  </div>
                  <div class="form-group row m-0">
                    <?php
                    echo form_label('<i class="fas fa-link"></i>','',array('class'=>'col-md-1 control-label text-right pr-0'));
                    echo '<div class="col-md-11">';
                    echo $data->lib_path;
                    echo '</div>';
                    ?>
                  </div>
                  <div class="form-group row m-0">
                    <?php
                    echo form_label('<i class="fas fa-bookmark"></i>','',array('class'=>'col-md-1 control-label text-right pr-0'));
                    echo '<div class="col-md-11">';
                    echo ucwords($data->lib_type);
                    echo '</div>';
                    ?>
                  </div>
                  <div class="form-group row m-0">
                    <?php
                    echo form_label('<i class="fas fa-calendar"></i>','',array('class'=>'col-md-1 control-label text-right pr-0'));
                    echo '<div class="col-md-11">';
                    echo date('d-m-Y h:i:s',strtotime($data->lib_date));
                    echo '</div>';
                    ?>
                  </div>
                  <div class="form-group row m-0">
                    <?php
                    echo form_label('<i class="fas fa-user"></i>','',array('class'=>'col-md-1 control-label text-right pr-0'));
                    echo '<div class="col-md-11">';
                    echo $data->display_name;
                    echo '</div>';
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php
              echo form_label('Pilih berkas','lib_file',array('class'=>'control-label mb-0'));
              echo form_upload('lib_file','','class="form-control" title="" data-toggle="tooltip" data-trigger="hover" data-original-title="Ukuran maksimal ungahan berkas: 2M."');
              echo form_error('lib_file','<span class="text-danger">','</span>');
              ?>
            </div>
            <div class="form-group">
              <?php
              echo form_label('Judul <span class="required">*</span>','lib_name',array('class'=>'control-label mb-0'));
              echo form_input('lib_name',$data->lib_name,array('class'=>'form-control'));
              echo form_error('lib_name','<span class="text-danger">','</span>');
              ?>
            </div>
            <div class="form-group">
              <?php
              echo form_label('Keterangan','lib_content',array('class'=>'control-label mb-0'));
              echo form_textarea(array('name'=>'lib_content','value'=>$data->lib_content,'class'=>'form-control','rows'=>'3'));
              echo form_error('lib_content','<span class="text-danger">','</span>');
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="form-group row">
          <?php
          echo form_label('','btn_save',array('class'=>'col-md-8 control-label pt-2'));
          echo '<div class="col-md-4 btn-group">';
          echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save"></i> Perbarui '.$page,'class'=>'btn btn-sm btn-primary'));
          echo anchor('pasery/library','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
          echo form_error('lib_ID','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
      </div>
      <?php echo form_close();?>
    </section>
  </div>
</div>
