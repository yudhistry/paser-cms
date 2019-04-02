<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open('pasery/post/category/remove');?>
      <header class="card-header">
        <h2 class="card-title">Semua <?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <?php
            echo '<div class="btn-group">';
            echo '<a href="#modalAdd" class="modal-with-form btn btn-sm btn-default"><i class="fas fa-plus"></i> Tambah Baru</a>';
            echo form_button(array('type'=>'submit','name'=>'btn_remove','content'=>'<i class="fas fa-trash"></i> Hapus','class'=>'btn btn-sm btn-default'));
            echo '</div>';
            ?>
          </div>
          <div class="col-md-8 text-right">
          </div>
        </div>
        <hr class="dotted short">
        <table class="table table-hover mb-0" id="datatable-default">
          <thead>
            <tr>
              <th width="10px"><input type="checkbox" id="check-all"></th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th width="150px">Tanggal</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <?php echo form_close();?>
      <!-- start: modal -->
      <div id="modalAdd" class="modal-block modal-block-primary mfp-hide">
        <section class="card">
          <?php
          echo form_open_multipart('admin/category/insert');
          ?>
          <header class="card-header">
            <h2 class="card-title">Tambah Kategori</h2>
          </header>
          <div class="card-body">
            <div class="form-group row">
              <?php
              echo form_label('Nama <span class="required">*</span>','cat_name',array('class'=>'col-md-3 control-label pt-2'));
              echo '<div class="col-md-9">';
              echo form_input('cat_name',set_value('cat_name'),'class="form-control"');
              echo form_error('cat_name','<span class="text-danger">','</span>');
              echo '</div>';
              ?>
            </div>
            <div class="form-group row">
              <?php
              echo form_label('Kategori Induk','cat_parent',array('class'=>'col-md-3 control-label pt-2'));
              echo '<div class="col-md-9">';
              $kategori = $this->M_categories->get_all();
              $kat      = array('0'=>'Tidak Ada');
              foreach($kategori as $row)
              {
                if($row->cat_role == 0)
                {
                  $kat[$row->cat_ID] = $row->cat_name;
                }
              }
              echo form_dropdown('cat_parent',$kat,'',array('class'=>'form-control populate'));
              echo form_error('cat_parent','<span class="text-danger">','</span>');
              echo '</div>';
              ?>
            </div>
            <div class="form-group row">
              <?php
              echo form_label('Deskripsi','cat_description',array('class'=>'col-md-3 control-label pt-2'));
              echo '<div class="col-md-9">';
              echo form_textarea(array('name'=>'cat_description','value'=>set_value('cat_description'),'class'=>'form-control','rows'=>'4'));
              echo form_error('cat_description','<span class="text-danger">','</span>');
              echo '</div>';
              ?>
            </div>
          </div>
          <div class="card-footer">
            <div class="form-group row">
              <?php
              echo form_label('','btn_save',array('class'=>'col-md-3 control-label pt-2'));
              echo '<div class="col-md-6 btn-group">';
              echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save text-white"></i> Tambahkan '.$subpage,'class'=>'btn btn-sm btn-primary'));
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
