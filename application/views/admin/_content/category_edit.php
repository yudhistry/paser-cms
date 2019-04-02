<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open('admin/category/update/'.$this->uri->segment(5));?>
      <header class="card-header">
        <h2 class="card-title">Sunting <?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="card-body">
          <div class="form-group row">
            <?php
            echo form_label('Nama <span class="required">*</span>','cat_name',array('class'=>'col-md-3 control-label pt-2'));
            echo '<div class="col-md-9">';
            echo form_input('cat_name',set_value('cat_name',$data->cat_name),'class="form-control"');
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
              if($row->cat_role == 0 and $row->cat_ID <> $data->cat_ID)
              {
                $kat[$row->cat_ID] = $row->cat_name;
              }
            }
            echo form_dropdown('cat_parent',$kat,$data->cat_parent,array('class'=>'form-control populate'));
            echo form_error('cat_parent','<span class="text-danger">','</span>');
            echo '</div>';
            ?>
          </div>
          <div class="form-group row">
            <?php
            echo form_label('Deskripsi','cat_description',array('class'=>'col-md-3 control-label pt-2'));
            echo '<div class="col-md-9">';
            echo form_textarea(array('name'=>'cat_description','value'=>set_value('cat_description',$data->cat_description),'class'=>'form-control','rows'=>'4'));
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
            echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save text-white"></i> Perbarui '.$subpage,'class'=>'btn btn-sm btn-primary'));
            echo anchor('pasery/post/category','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
            echo '</div>';
            ?>
          </div>
        </div>
      </div>
      <?php echo form_close();?>
    </section>
  </div>
</div>
