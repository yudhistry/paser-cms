<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open('admin/document/remove/'.$this->uri->segment(3));?>
      <header class="card-header">
        <div class="card-actions">
          <a href="<?php echo site_url('pasery/document');?>" class="card-action" title="Tutup"><i class="fas fa-times"></i></a>
        </div>
        <h2 class="card-title">
          <i class="fas fa-folder-open text-warning"></i>
          <a href="#modalEdit" class="card-action modal-with-form" title="Sunting Folder">
            <?php echo $data->doc_title;?>
          </a>
        </h2>
        <p class="card-subtitle"><?php echo $data->doc_description;?></p>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <?php
            echo '<div class="btn-group">';
            echo '<a href="'.site_url('pasery/document/add/'.$this->uri->segment(3)).'" class="btn btn-sm btn-default"><i class="fas fa-plus"></i> Tambah Dokumen</a>';
            echo form_button(array('type'=>'submit','name'=>'btn_remove','content'=>'<i class="fas fa-trash"></i> Hapus','class'=>'btn btn-sm btn-default'));
            echo '</div>';
            ?>
          </div>
          <div class="col-md-8 text-right">
            <p class="card-subtitle">
              <?php
              $all = $this->M_documents->author_all();
              if($this->session->userdata('doc_author'))
              {
                echo anchor('admin/document/author','Semua').' ('.$all.')';
              }
              else
              {
                echo 'Semua ('.$all.')';
              }
              $key = $this->session->userdata['logged']['ID'];
              $author = $this->M_documents->author($key);
              if($this->session->userdata('doc_author') == $key)
              {
                echo ' | Milikku ('.$author.') ';
              }
              else
              {
                echo ' | '.anchor('admin/document/author/'.$key,'Milikku').' ('.$author.') ';
              }
              ?>
            </p>
          </div>
        </div>
        <hr class="dotted short">
        <table class="table table-hover mb-0" id="datatable-default">
          <thead>
            <tr>
              <th width="10px"><input type="checkbox" id="check-all"></th>
              <th>Nama</th>
              <th width="50px"><i class="fas fa-download"></i></th>
              <th width="100px">Tanggal</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <?php echo form_close();?>
      <!-- start: modal -->
      <div id="modalEdit" class="modal-block modal-block-primary mfp-hide">
        <section class="card">
          <?php
          echo form_open_multipart('admin/document/update/'.$this->uri->segment(3));
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
