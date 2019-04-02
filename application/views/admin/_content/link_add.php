<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open_multipart('admin/link/insert',array('class'=>'form-horizontal'));?>
      <header class="card-header">
        <h2 class="card-title">Tambah <?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="form-group row">
          <?php
          echo form_label('Nama <span class="required">*</span>','link_title',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('link_title',set_value('link_title'),'class="form-control"');
          echo form_error('link_title','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('URL','link_url',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          echo form_input('link_url',set_value('link_url'),'class="form-control"');
          echo form_error('link_url','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
        <div class="form-group row">
          <?php
          echo form_label('Gambar','link_img_path',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6">';
          if($this->input->post('btn_save_lib'))
          {
            $lib = $this->M_libraries->get_by_id($this->input->post('btn_save_lib'));
            $image_properties = array(
              'src' => $lib->lib_path,
              'class' => 'center',
              'height' => '100'
            );
            $image = img($image_properties);
            echo form_hidden('link_img_path',$lib->lib_path);
            echo form_button(array('type'=>'submit','class'=>'btn btn-transparent','name'=>'btn_link_img_path','content'=>$image));
          }
          else
          {
            $image_properties = array(
              'src' => base_url('assets/admin/img/no-image.png'),
              'class' => 'center',
              'height' => '100'
            );
            $image = img($image_properties);
            echo form_hidden('link_img_path',$this->input->post('link_img_path'));
            echo form_button(array('type'=>'submit','class'=>'btn btn-transparent','name'=>'btn_link_img_path','content'=>$image));
          }
          echo form_error('link_img_path','<span class="text-danger">','</span>');
          echo '</div>';
          ?>
        </div>
      </div>
      <div class="card-footer">
        <div class="form-group row">
          <?php
          echo form_label('','btn_save',array('class'=>'col-md-3 control-label pt-2'));
          echo '<div class="col-md-6 btn-group">';
          echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save"></i> Tambahkan '.$subpage,'class'=>'btn btn-sm btn-primary'));
          echo anchor('pasery/setting/link','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
          echo '</div>';
          ?>
        </div>
      </div>
      <?php echo form_close();?>
    </section>
  </div>
</div>
