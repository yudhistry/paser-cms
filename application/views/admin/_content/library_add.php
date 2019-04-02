<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open_multipart('admin/library/insert');?>
      <header class="card-header">
        <h2 class="card-title"><?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="form-group row">
          <?php
          echo form_label('Pilih berkas <span class="required">*</span>','lib_file',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_upload('lib_file',set_value('lib_file'),'class="form-control" title="" data-toggle="tooltip" data-trigger="hover" data-original-title="Ukuran maksimal ungahan berkas: 2M."');
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
          echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save"></i> Tambahkan '.$page,'class'=>'btn btn-sm btn-primary'));
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
