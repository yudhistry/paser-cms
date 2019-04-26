<div class="row">
  <div class="col-md-12">
    <section class="card card-danger mb-4">
      <?php echo form_open('admin/category/delete');?>
      <header class="card-header">
        <h2 class="card-title">Hapus <?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <h4>Apakah Anda yakin akan menghapus data dibawah ini?</h4>
        <table class="table table-hover mb-0" id="datatable-default-no">
          <thead>
            <tr>
              <th width="10px">No</th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th width="150px">Slug</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach($checked as $id)
            {
              $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
              $dec_id = $this->encryption->decrypt($dec_id);
              echo form_hidden('ID[]',$id);
              $row = $this->M_categories->get_by_id($dec_id);
              echo '<tr>';
              echo '<td class="text-right">'.$no++.'.</td>';
              echo '<td>'.$row->cat_name.'</td>';
              echo '<td>'.$row->cat_description.'</td>';
              echo '<td>'.$row->cat_slug.'</td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
      <footer class="card-footer">
        <div class="col-md-12 text-right">
          <div class="btn-group">
            <?php
            echo form_button(array('type'=>'submit','name'=>'btn_delete','class'=>'btn btn-sm btn-danger','content'=>'<i class="fas fa-recycle"></i> Konfirmasi Penghapusan'));
            echo anchor('pasery/post/category','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
            ?>
          </div>
        </div>
      </footer>
      <?php echo form_close();?>
    </section>
  </div>
</div>
