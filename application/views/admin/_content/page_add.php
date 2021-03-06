<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open('admin/page/insert');?>
      <header class="card-header">
        <h2 class="card-title"><?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-9">
            <div class="form-group">
              <?php
              echo form_input('post_title',set_value('post_title'),array('class'=>'form-control','placeholder'=>'Masukan judul disini..'));
              echo form_error('post_title','<span class="text-danger">','</span>');
              ?>
            </div>
            <div class="form-group">
              <textarea name="post_content" class="summernote col-lg-12" data-plugin-summernote data-plugin-options='{ "height": 335, "codemirror": { "theme": "ambiance" } }'><?php echo set_value('post_content');?></textarea>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <?php
              echo form_label('<i class="fas fa-image""></i> Gambar Unggulan','post_feature_image',array('class'=>'control-label')).'<br>';
              if($this->input->post('btn_save_lib'))
              {
                $lib = $this->M_libraries->get_by_id($this->input->post('btn_save_lib'));
                $image_properties = array(
                  'src' => $lib->lib_path,
                  'class' => 'center',
                  'width' => '100%'
                );
                $image = img($image_properties);
                echo form_hidden('post_feature_image',$lib->lib_path);
                echo form_button(array('type'=>'submit','class'=>'btn btn-transparent','name'=>'btn_post_feature_image','content'=>$image));
                echo '<div class="text-center">'.form_button(array('type'=>'submit','name'=>'remove_post_feature_image','value'=>'','content'=>'<i class="fas fa-times"></i> Hapus','class'=>'card-action btn btn-xs btn-default m-0')).'</div>';
              }
              else
              {
                $image_properties = array(
                  'src' => base_url('assets/admin/img/no-image.png'),
                  'class' => 'center',
                  'width' => '100%'
                );
                $image = img($image_properties);
                echo form_hidden('post_feature_image',$this->input->post('link_img_path'));
                echo form_button(array('type'=>'submit','class'=>'btn btn-transparent','name'=>'btn_post_feature_image','content'=>$image));
              }
              ?>
            </div>
            <div class="form-group">
              <?php
              echo form_label('<i class="fas fa-key"></i> Status','post_status',array('class'=>'control-label'));
              $status = array('telah_terbit'=>'segera terbitkan','draf'=>'Draf','menunggu_evaluasi'=>'Menunggu Evaluasi');
              $stts = array();
              foreach($status as $key=>$value)
              {
                $stts[$key] = $value;
              }
              //echo form_dropdown('post_status',$stts,set_value('post_status'),array('class'=>'form-control'));
              echo form_hidden('post_status','telah_terbit');
              echo form_input('status',$stts['telah_terbit'],array('class'=>'form-control','readonly'=>'readonly'));
              ?>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <?php
                  echo form_label('<i class="fas fa-calendar-alt""></i> Tgl. terbit','post_datepick',array('class'=>'control-label'));
                  $datepick = $this->input->post('post_datepick') ? $this->input->post('post_datepick') : date('d/m/Y');
                  ?>
                  <input type="text" name="post_datepick" value="<?php echo $datepick;?>" data-plugin-datepicker class="form-control">
                </div>
                <div class="col-md-6">
                  <?php
                  echo form_label('<i class="fas fa-clock""></i> Jam terbit','post_timepick',array('class'=>'control-label'));
                  $timepick = $this->input->post('post_timepick') ? $this->input->post('post_timepick') : date('h:i:s');
                  ?>
                  <input type="text" name="post_timepick" value="<?php echo $timepick;?>" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }'>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="btn-group d-flex">
                <?php
                echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save"></i> Tambahkan '.$page,'class'=>'btn btn-primary btn-block'));
                ?>
              </div>
            </div>

          </div>
        </div>
      </div>
      <?php echo form_close();?>
    </section>
  </div>
</div>
