<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <header class="card-header">
        <div class="card-actions">
          <a href="<?php echo site_url('pasery/setting/link/add');?>" class="card-action"><i class="fas fa-times"></i></a>
        </div>
        <h2 class="card-title">Tambah <?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <?php
            echo '<div class="btn-group">';
            echo '<a href="#modalAdd" class="modal-with-form btn btn-sm btn-default"><i class="fas fa-plus"></i> Tambah Data Pustaka</a>';
            echo '</div>';
            ?>
            <!-- start: modal -->
            <div id="modalAdd" class="modal-block modal-block-primary mfp-hide">
              <section class="card">
                <?php
                echo form_open_multipart('admin/library_option/insert');
                echo form_hidden('redirect','pasery/setting/link/add');
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
          </div>
        </div>
        <hr class="dotted short">
        <?php
        echo form_open_multipart('admin/link/add',array('class'=>'form-horizontal'));
        echo form_hidden('link_title',$this->input->post('link_title'));
        echo form_hidden('link_url',$this->input->post('link_url'));
        ?>
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
    </section>
  </div>
</div>
