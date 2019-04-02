<div class="row">
  <div class="col-md-12">
    <section class="card card-danger mb-4">
      <?php echo form_open('admin/slide/delete');?>
      <header class="card-header">
        <h2 class="card-title">Hapus <?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <h4>Apakah Anda yakin akan menghapus data dibawah ini?</h4>
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th width="10px">No</th>
              <th>Nama</th>
              <th width="150px">Penulis</yh>
              <th width="100px">Status</th>
              <th width="150px">Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach($checked as $id)
            {
              echo form_hidden('ID[]',$id);
              $row = $this->M_slides->get_by_id($id);
              $badge  = $row->slide_status == 'aktif' ? 'badge badge-success' : 'badge badge-danger';
              $status = $row->slide_status == 'aktif' ? 'Aktif' : 'Tidak Aktif';
              echo '<tr>';
              echo '<td class="text-right">'.$no++.'.</td>';
              echo '<td>'.img(array('src'=>$row->slide_url,'height'=>'100')).'</td>';
              echo '<td>'.$row->display_name.'</td>';
              echo '<td><div class="'.$badge.' w-100 text-2">'.$status.'</div></td>';
              echo '<td><i class="fas fa-calendar"></i> '.date('d-m-Y',strtotime($row->slide_date)).'<br><i class="fas fa-clock"></i> '.date('h:i:s',strtotime($row->slide_date)).'</td>';
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
            echo form_button(array('type'=>'submit','name'=>'btn_delete','class'=>'btn btn-sm btn-danger','content'=>'<i class="fas fa-recycle"></i> Setuju'));
            echo anchor('admin/settings/slider','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
            ?>
          </div>
        </div>
      </footer>
      <?php echo form_close();?>
    </section>
  </div>
</div>
