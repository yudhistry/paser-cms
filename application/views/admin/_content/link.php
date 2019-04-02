<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open('admin/link/remove');?>
      <header class="card-header">
        <h2 class="card-title">Semua <?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <?php
            echo '<div class="btn-group">';
            echo anchor('pasery/setting/link/add','<i class="fas fa-plus"></i> Tambah Baru',array('class'=>'btn btn-sm btn-default'));
            echo form_button(array('type'=>'submit','name'=>'btn_remove','content'=>'<i class="fas fa-trash"></i> Hapus','class'=>'btn btn-sm btn-default'));
            echo '</div>';
            ?>
          </div>
          <div class="col-md-8 text-right">
            <!-- untuk konten tamahan -->
          </div>
        </div>
        <hr class="dotted short">
        <table class="table table-hover mb-0" id="datatable-default">
          <thead>
            <tr>
              <th width="10px"><input type="checkbox" id="check-all"></th>
              <th width="250px">Gambar</th>
              <th>Nama</th>
              <th width="100px">Tanggal</th>
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
