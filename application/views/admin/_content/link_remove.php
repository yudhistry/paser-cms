<div class="row">
  <div class="col-md-12">
    <section class="card card-danger mb-4">
      <?php echo form_open('admin/link/delete');?>
      <header class="card-header">
        <h2 class="card-title">Hapus <?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <h4>Apakah Anda yakin akan menghapus data dibawah ini?</h4>
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th width="10px">No</th>
              <th width="300px">Gambar</th>
              <th>Nama</th>
              <th width="150px">Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach($checked as $id)
            {
              echo form_hidden('ID[]',$id);
              $row = $this->M_links->get_by_id($id);
              echo '<tr>';
              echo '<td class="text-right">'.$no++.'.</td>';
              echo '<td>'.img(array('src'=>$row->link_img_path,'height'=>'60')).'</td>';
              echo '<td>'.anchor('admin/settings/link/edit/'.$row->link_ID,'<strong>'.$row->link_title.'</strong>').'<br><i clas="fas fa-link"></i> '.anchor($row->link_url,$row->link_url,array('target'=>'_blank')).'</td>';
              echo '<td><i class="fas fa-calendar-alt"></i> '.date('d-m-Y',strtotime($row->link_date)).'<br><i class="fas fa-clock"></i> '.date('h:i:s',strtotime($row->link_date)).'</td>';
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
            echo anchor('pasery/setting/link','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
            ?>
          </div>
        </div>
      </footer>
      <?php echo form_close();?>
    </section>
  </div>
</div>
