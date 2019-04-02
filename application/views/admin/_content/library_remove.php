<div class="row">
  <div class="col-md-12">
    <section class="card card-danger mb-4">
      <?php echo form_open('admin/library/delete');?>
      <header class="card-header">
        <h2 class="card-title">Hapus <?php echo $page;?></h2>
      </header>
      <div class="card-body">
        <h4>Apakah Anda yakin akan menghapus data dibawah ini?</h4>
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th width="10px">No</th>
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
              $row = $this->M_libraries->get_by_id($id);
              if($row->lib_type == 'gambar')
              {
                $thumbnail = '<img src="'.$row->lib_path.'" class="thumbnail thumb-preview thumb-image img-fluid m-0" width="100px" height="100px">';
              }
              elseif($row->lib_type == 'dokumen')
              {
                $thumbnail = '<img src="'.base_url('assets/library/default-document.png').'" class="thumbnail thumb-preview thumb-image img-fluid m-0" width="100px" height="100px">';
              }
              else {
                $thumbnail = '<img src="'.base_url('assets/library/default-unknown.png').'" class="thumbnail thumb-preview thumb-image img-fluid m-0" width="100px" height="100px">';
              }
              echo '<tr>';
              echo '<td class="text-right">'.$no++.'.</td>';
              echo '<td>';
              echo '
              <div class="row m-0">
                <div class="col-ms-4">
                  '.$thumbnail.'
                </div>
                <div class="col-md-8">
                  '.anchor('pasery/library/'.$row->lib_ID,'<strong>'.$row->lib_name.'</strong>').'<br>
                  <i class="fas fa-file"></i> '.$row->lib_file.'<br>
                  <i class="fas fa-link"></i> '.$row->lib_path.'
                </div>
              </div>
              ';
              echo '</td>';
              echo '<td>';
              echo '
              <i class="fas fa-bookmark"></i> '.ucwords($row->lib_type).'<br>
              <i class="fas fa-calendar"></i> '.date('d-m-Y',strtotime($row->lib_date)).'<br>
              <i class="fas fa-clock"></i> '.date('h:i:s',strtotime($row->lib_date));
              echo '</td>';
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
            echo anchor('pasery/library','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
            ?>
          </div>
        </div>
      </footer>
      <?php echo form_close();?>
    </section>
  </div>
</div>
