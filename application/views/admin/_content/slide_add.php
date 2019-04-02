<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <header class="card-header">
        <div class="card-actions">
          <a href="<?php echo site_url('pasery/setting/slide');?>" class="card-action"><i class="fas fa-times"></i></a>
        </div>
        <h2 class="card-title">Tambah <?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="tabs">
          <ul class="nav nav-tabs">
            <li class="nav-item active">
              <a class="nav-link" href="#library" data-toggle="tab"><i class="fas fa-book"></i> Daftar Pustaka</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#external" data-toggle="tab"><i class="fas fa-external-link-alt"></i> Link Eksternal</a>
            </li>
          </ul>
          <div class="tab-content">
            <div id="library" class="tab-pane active">
              <div class="row">
                <div class="col-md-4">
                  <?php
                  echo '<div class="btn-group">';
                  echo '<a href="#modalAdd" class="modal-with-form btn btn-sm btn-default"><i class="fas fa-plus"></i> Tambah Data Pustaka</a>';
                  //echo anchor('pasery/library/add','<i class="fas fa-plus"></i> Tambah Baru',array('class'=>'btn btn-sm btn-default'));
                  //echo form_button(array('type'=>'submit','name'=>'btn_remove','content'=>'<i class="fas fa-trash"></i> Hapus','class'=>'btn btn-sm btn-default'));
                  echo '</div>';
                  ?>
                  <!-- start: modal -->
                  <div id="modalAdd" class="modal-block modal-block-primary mfp-hide">
                    <section class="card">
                      <?php
                      echo form_open_multipart('admin/library_option/insert');
                      echo form_hidden('redirect','pasery/setting/slide/add');
                      ?>
                      <header class="card-header">
                        <h2 class="card-title">Tambah Pustaka</h2>
                      </header>
                      <div class="card-body">
                        <div class="form-group row">
                          <?php
                          echo form_label('Pilih berkas <span class="required">*</span>','lib_file',array('class'=>'col-md-3 control-label pt-2'));
                          echo '<div class="col-md-6">';
                          echo form_upload('lib_file','','class="form-control" title="" data-toggle="tooltip" data-trigger="hover" data-original-title="Ukuran maksimal ungahan berkas: 2M."');
                          echo form_error('lib_file','<span class="text-danger">','</span>');
                          echo '</div>';
                          ?>
                        </div>
                        <div class="form-group row">
                          <?php
                          echo form_label('Judul <span class="required">*</span>','lib_name',array('class'=>'col-md-3 control-label pt-2'));
                          echo '<div class="col-md-6">';
                          echo form_input('lib_name',set_value('lib_name'),array('class'=>'form-control'));
                          echo form_error('lib_name','<span class="text-danger">','</span>');
                          echo '</div>';
                          ?>
                        </div>
                        <div class="form-group row">
                          <?php
                          echo form_label('Keterangan','lib_content',array('class'=>'col-md-3 control-label pt-2'));
                          echo '<div class="col-md-6">';
                          echo form_textarea(array('name'=>'lib_content','value'=>set_value('lib_content'),'class'=>'form-control','rows'=>'4'));
                          echo form_error('lib_content','<span class="text-danger">','</span>');
                          echo '</div>';
                          ?>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="form-group row">
                          <?php
                          echo form_label('','btn_save',array('class'=>'col-md-3 control-label pt-2'));
                          echo '<div class="col-md-6 btn-group">';
                          echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save text-white"></i> Tambahkan Pustaka','class'=>'btn btn-sm btn-primary'));
                          echo form_button(array('content'=>'<i class="fas fa-times text-dark"></i> Batal','class'=>'btn btn-sm btn-default modal-dismiss'));
                          echo '</div>';
                          ?>
                        </div>
                      </div>
                      <?php echo form_close();?>
                    </section>
                  </div>
                  <!-- end: modal -->
                </div>
                <div class="col-md-8 text-right">
                  <!--
                  <p class="card-subtitle">
                    <?php
                    $all = $this->M_library_option->type_all();
                    if($this->session->userdata('lib_type'))
                    {
                      echo anchor('admin/library_option/type','Semua').' ('.$all.')';
                    }
                    else
                    {
                      echo 'Semua ('.$all.')';
                    }
                    $type = array('gambar'=>'Gambar','dokumen'=>'Dokumen','tidak diketahui'=>'Tidak diketahui');
                    foreach($type as $key=>$value)
                    {
                      $lib_type = $this->M_library_option->type($key);
                      if($lib_type)
                      {
                        if($this->session->userdata('lib_type') == $key)
                        {
                          echo ' | '.$value.' ('.$lib_type.') ';
                        }
                        else
                        {
                          echo ' | '.anchor('admin/library_option/type/'.$key,$value).' ('.$lib_type.') ';
                        }
                      }
                    }
                    ?>
                  </p>
                  -->
                </div>
              </div>
              <hr class="dotted short">
              <?php echo form_open_multipart('admin/slide/insert',array('class'=>'form-horizontal'));?>
              <table class="table table-hover table-bordered mb-0" id="datatable-default">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th width="100px">Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <?php echo form_close();?>
            </div>
            <div id="external" class="tab-pane">
              <?php echo form_open_multipart('admin/slide/insert',array('class'=>'form-horizontal'));?>
              <div class="form-group row">
                <?php
                echo form_label('Nama <span class="required">*</span>','slide_title',array('class'=>'col-md-3 control-label pt-2'));
                echo '<div class="col-md-6">';
                echo form_input('slide_title',set_value('slide_title'),'class="form-control"');
                echo form_error('slide_title','<span class="text-danger">','</span>');
                echo '</div>';
                ?>
              </div>
              <div class="form-group row">
                <?php
                echo form_label('Link <span class="required">*</span>','slide_url',array('class'=>'col-md-3 control-label pt-2'));
                echo '<div class="col-md-6">';
                echo form_input('slide_url',set_value('slide_url'),'class="form-control"');
                echo form_error('slide_url','<span class="text-danger">','</span>');
                echo '</div>';
                ?>
              </div>
              <div class="form-group row">
                <?php
                echo form_label('Deskripsi','slide_description',array('class'=>'col-md-3 control-label pt-2'));
                echo '<div class="col-md-6">';
                echo form_textarea(array('name'=>'slide_description','value'=>set_value('slide_description'),'class'=>'form-control','rows'=>'4'));
                echo form_error('slide_description','<span class="text-danger">','</span>');
                echo '</div>';
                ?>
              </div>
              <div class="form-group row">
                <?php
                echo form_label('','btn_save',array('class'=>'col-md-3 control-label pt-2'));
                echo '<div class="col-md-6 btn-group">';
                echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save"></i> Tambahkan '.$subpage,'class'=>'btn btn-sm btn-primary'));
                echo anchor('admin/settings/slider','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
                echo '</div>';
                ?>
              </div>
              <?php echo form_close();?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
