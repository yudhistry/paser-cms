<div class="row">
  <div class="col-md-12">
    <section class="card card-danger mb-4">
      <?php echo form_open('admin/gallery/delete');?>
      <header class="card-header">
        <h2 class="card-title">Hapus <?php echo $page;?></h2>
      </header>
      <div class="card-body">
        <h4>Apakah Anda yakin akan menghapus data dibawah ini?</h4>
        <table class="table table-hover mb-0" id="datatable-default-no">
          <thead>
            <tr>
              <th width="10px">No</th>
              <th>Nama</th>
              <th width="100px">Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach($checked as $id)
            {
              echo form_hidden('ID[]',$id);
              $row = $this->M_galleries->get_by_id($id);
              $count = $row->gal_file ? count(explode(',',$row->gal_file)) : '0';
              echo '<tr>';
              echo '<td class="text-right">'.$no++.'.</td>';
              echo '<td>';
              echo '
                <div class="widget-summary">
                  <div class="widget-summary-col widget-summary-col-icon">
                    <div class="summary-icon bg-dark">
                      <i class="fas fa-folder text-warning"></i>
                    </div>
                  </div>
                  <div class="widget-summary-col">
                    <div class="summary">
                      <h4 class="title"><strong>'.$row->gal_title.'</strong></h4>
                      <div class="info">
                        <span class="amount text-muted">'.$count.'</span>
                        <span class="text-primary">( <i class="fas fa-user"></i> '.$row->display_name.' )</span>
                      </div>
                    </div>
                    <div class="summary-footer">
                      <a class="text-muted">'.$row->gal_description.'</a>
                    </div>
                  </div>
                </div>
              ';
              echo '</td>';
              echo '<td>';
              echo '
                <i class="fas fa-calendar"></i> '.date('d-m-Y',strtotime($row->gal_date)).'<br>
                <i class="fas fa-clock"></i> '.date('h:i:s',strtotime($row->gal_date));
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
            echo anchor('pasery/gallery','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
            ?>
          </div>
        </div>
      </footer>
      <?php echo form_close();?>
    </section>
  </div>
</div>
