<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open('admin/gallery/remove/'.$this->uri->segment(4));?>
      <header class="card-header">
        <div class="card-actions">
          <a href="<?php echo site_url('pasery/gallery');?>" class="card-action" title="Tutup"><i class="fas fa-times"></i></a>
        </div>
        <h2 class="card-title">
          <i class="fas fa-folder-open text-warning"></i>
          <a href="#modalEdit" class="card-action modal-with-form" title="Sunting Folder">
            <?php echo $data->gal_title;?>
          </a>
        </h2>
        <p class="card-subtitle"><?php echo $data->gal_description;?></p>
      </header>
      <div class="card-body">
        <div class="row">
        <?php
        echo '<div class="img-thumbnail m-2">';
        echo '<a class="float-left" href="'.site_url('pasery/gallery/library/'.$this->uri->segment(4)).'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Gambar">';
        //echo img(array('src'=>base_url('assets/admin/img/post-thumb-1.jpg'),'height'=>'150'));
        echo '<h1 class="fas fa-plus-circle p-5 m-0"></h1>';
        echo '</a>';
        echo '</div>';

        if($data->gal_file)
        {
          $files = explode(',',$data->gal_file);
          foreach($files as $key => $value)
          {
            $row = $this->M_libraries->get_by_id($value);
            echo '<div class="img-thumbnail m-2">';
            echo form_button(array('type'=>'submit','name'=>'btn_gal_file','value'=>$value,'class'=>'btn btn-xs btn-transparent float-right p-0','content'=>'<i class="fas fa-times-circle text-danger"></i>'));
            //echo '<a href="'.site_url('admin/libraries/gallery/delete/'.$data->gal_ID.':'.$value).'" class="pull-right text-danger"><i class="fas fa-times-circle"></i></a>';
            echo '<div class="popup-gallery">';
            echo '<a class="" href="'.$row->lib_path.'" title="'.$row->lib_name.'">';
            echo img(array('src'=>$row->lib_path,'height'=>'100'));
            echo '</a>';
            echo '</div>';
            echo '</div>';
          }
        }
        ?>
      </div>
      </div>
      <?php echo form_close();?>
      <!-- start: modal -->
      <div id="modalEdit" class="modal-block modal-block-primary mfp-hide">
        <section class="card">
          <?php
          echo form_open_multipart('admin/gallery/update/'.$this->uri->segment(4));
          ?>
          <header class="card-header">
            <h2 class="card-title">Sunting Folder</h2>
          </header>
          <div class="card-body">
            <div class="form-group row">
              <?php
              echo form_label('Nama','gal_title',array('class'=>'col-md-3 text-lg-right pt-2'));
              echo '<div class="col-md-9">';
              echo form_input('gal_title',set_value('gall_title',$data->gal_title),array('class'=>'form-control'));
              echo '</div>';
              ?>
            </div>
            <div class="form-group row">
              <?php
              echo form_label('Keterangan','gal_description',array('class'=>'col-md-3 text-lg-right pt-2'));
              echo '<div class="col-md-9">';
              echo form_textarea(array('name'=>'gal_description','value'=>set_value('gal_description',$data->gal_description),'class'=>'form-control','rows'=>'3'));
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
