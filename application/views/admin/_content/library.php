<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open('pasery/library/remove');?>
      <header class="card-header">
        <h2 class="card-title"><?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <?php
            echo '<div class="btn-group">';
            echo anchor('pasery/library/add','<i class="fas fa-plus"></i> Tambah Baru',array('class'=>'btn btn-sm btn-default'));
            echo form_button(array('type'=>'submit','name'=>'btn_remove','content'=>'<i class="fas fa-trash"></i> Hapus','class'=>'btn btn-sm btn-default'));
            echo '</div>';
            ?>
          </div>
          <div class="col-md-8 text-right">
            <p class="card-subtitle">
              <?php
              $all = $this->M_libraries->type_all();
              if($this->session->userdata('lib_type'))
              {
                echo anchor('admin/library/type','Semua').' ('.$all.')';
              }
              else
              {
                echo 'Semua ('.$all.')';
              }
              $type = array('gambar'=>'Gambar','dokumen'=>'Dokumen','tidak diketahui'=>'Tidak diketahui');
              foreach($type as $key=>$value)
              {
                $lib_type = $this->M_libraries->type($key);
                if($lib_type)
                {
                  if($this->session->userdata('lib_type') == $key)
                  {
                    echo ' | '.$value.' ('.$lib_type.') ';
                  }
                  else
                  {
                    echo ' | '.anchor('admin/library/type/'.$key,$value).' ('.$lib_type.') ';
                  }
                }
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
              <th width="150px">Tanggal</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <?php echo form_close();?>
    </section>
  </div>
</div>
