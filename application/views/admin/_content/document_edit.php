<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php
      echo form_open_multipart('admin/document/update/'.$this->uri->segment(4));
      $enc_id = $this->encryption->encrypt($folder->doc_ID);
      $enc_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id);
      echo form_hidden('doc_parent',$data->doc_parent);
      echo form_hidden('doc_slug',$data->doc_slug);
      ?>
      <header class="card-header">
        <div class="card-actions">
          <a href="<?php echo site_url('pasery/document/'.$enc_id);?>" class="card-action" title="Tutup"><i class="fas fa-chevron-left"></i></a>
        </div>
        <h2 class="card-title">
          <i class="fas fa-folder-open text-warning"></i>
          <a href="#modalEdit" class="card-action modal-with-form" title="Sunting Folder">
            <?php echo $folder->doc_title;?>
          </a>
        </h2>
        <p class="card-subtitle"><?php echo $folder->doc_description;?></p>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <h3 class="card-title">Sunting Dokumen</h3>
          </div>
        </div>
        <hr class="dotted short">
        <div class="form-group row">
          <?php
          echo form_label('Nama <span class="required">*</span>','doc_title',array('class'=>'col-md-2 control-label pt-2'));
          echo '<div class="col-md-9">';
          echo form_input('doc_title',set_value('doc_title',$data->doc_title),'class="form-control"');
          echo form_error('doc_title','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Deskripsi','doc_description',array('class'=>'col-md-2 control-label pt-2'));
          echo '<div class="col-md-9">';
          echo form_textarea(array('name'=>'doc_description','value'=>set_value('doc_description',$data->doc_description),'class'=>'form-control','rows'=>'4'));
          echo form_error('doc_description','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Tanggal Terbit <span class="required">*</span>','doc_endorsement',array('class'=>'col-md-2 control-label pt-2'));
          echo '<div class="col-md-3">';
          $datepick = $data->doc_endorsement ? date('d/m/Y',strtotime($data->doc_endorsement)) : date('d/m/Y');
          ?>
          <input type="text" name="doc_endorsement" value="<?php echo $datepick;?>" data-plugin-datepicker class="form-control">
          <?php
          echo form_error('doc_endorsement','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('File <span class="required">*</span>','doc_file',array('class'=>'col-md-2 control-label pt-2'));
          echo '<div class="col-md-9">';
          echo form_upload('doc_file',set_value('doc_file'),'class="form-control" title="" data-toggle="tooltip" data-trigger="hover" data-original-title="Ukuran maksimal ungahan berkas: 10M. Format: pdf"');
          echo form_error('doc_file','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
      </div>
      <div class="card-footer">
        <div class="form-group row">
          <?php
          echo form_label('','btn_save_doc',array('class'=>'col-md-2 control-label pt-2'));
          echo '<div class="col-md-9 btn-group">';
          echo form_button(array('type'=>'submit','name'=>'btn_save_doc','content'=>'<i class="fas fa-save"></i> Perbarui '.$page,'class'=>'btn btn-sm btn-primary'));
          echo anchor('pasery/document/'.$enc_id,'<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
          echo '</div>';
          ?>
        </div>
      </div>
      <?php echo form_close();?>
      <!-- start: modal -->
      <div id="modalEdit" class="modal-block modal-block-primary mfp-hide">
        <section class="card">
          <?php
          echo form_open_multipart('admin/document/update/'.$this->uri->segment(4));
          ?>
          <header class="card-header">
            <h2 class="card-title">Sunting Folder</h2>
          </header>
          <div class="card-body">
            <div class="form-group row">
              <?php
              echo form_label('Nama','doc_title',array('class'=>'col-md-3 text-lg-right pt-2'));
              echo '<div class="col-md-9">';
              echo form_input('doc_title',set_value('doc_title',$data->doc_title),array('class'=>'form-control'));
              echo '</div>';
              ?>
            </div>
            <div class="form-group row">
              <?php
              echo form_label('Keterangan','doc_description',array('class'=>'col-md-3 text-lg-right pt-2'));
              echo '<div class="col-md-9">';
              echo form_textarea(array('name'=>'doc_description','value'=>set_value('doc_description',$data->doc_description),'class'=>'form-control','rows'=>'3'));
              echo '</div>';
              ?>
            </div>
          </div>
          <div class="card-footer">
            <div class="form-group row">
              <?php
              echo form_label('','btn_save',array('class'=>'col-md-3 control-label pt-2'));
              echo '<div class="col-md-6 btn-group">';
              echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save text-white"></i> Perbarui Folder','class'=>'btn btn-sm btn-primary'));
              echo form_button(array('content'=>'<i class="fas fa-times text-dark"></i> Batal','class'=>'btn btn-sm btn-default modal-dismiss'));
              echo '</div>';
              ?>
            </div>
          </div>
          <?php echo form_close();?>
        </section>
      </div>
      <!-- end: modal -->
    </section>
  </div>
</div>
