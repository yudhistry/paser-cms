<div class="row">
  <div class="col-md-12">
    <section class="card card-danger mb-4">
      <?php echo form_open('admin/document/delete');?>
      <header class="card-header">
        <div class="card-actions">
          <a href="<?php echo site_url('pasery/document');?>" class="card-action" title="Tutup"><i class="fas fa-times"></i></a>
        </div>
        <h2 class="card-title">Hapus <?php echo $page;?></h2>
        <p class="card-subtitle">Semua yang berelasi dengan data ini akan terhapus</p>
      </header>
      <div class="card-body">
        <h4>Apakah Anda yakin akan menghapus data dibawah ini?</h4>
        <table class="table table-hover mb-0" id="datatable-default-no">
          <thead>
            <tr>
              <th width="10px">No</th>
              <th>Nama</th>
              <th width="100px"><i class="fas fa-eye"></i></th>
              <th width="150px">Tanggal</th>
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
              $row = $this->M_documents->get_by_id($dec_id);
              if($row->doc_type == 'folder')
              {
                $type = '<div class="widget-summary">
                              <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-dark">
                                  <i class="fas fa-folder text-warning"></i>
                                </div>
                              </div>
                              <div class="widget-summary-col">
                                <div class="summary">
                                  <h4 class="title text-primary"><strong>'.$row->doc_title.'</strong></h4>
                                  <div class="info">
                                    <span class="text-muted">'.$row->doc_description.'</span>
                                  </div>
                                </div>
                                <div class="summary-footer">
                                  <a class="text-muted"><i class="fas fa-user"></i> '.anchor('pasery/document/author/'.$row->doc_author,$row->display_name).'</a>
                                </div>
                              </div>
                            </div>';
                $count  = $row->doc_view_count;
              }
              else {
                $type = '<div class="widget-summary">
                              <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-danger">
                                  <i class="fas fa-file-pdf"></i>
                                </div>
                              </div>
                              <div class="widget-summary-col">
                                <div class="summary">
                                  <h4 class="title text-primary"><strong>'.$row->doc_title.'</strong></h4>
                                  <div class="info">
                                    <span class="text-muted">'.$row->doc_description.'</span>
                                  </div>
                                </div>
                                <div class="summary-footer">
                                  <a class="text-muted"><i class="fas fa-search"></i> '.anchor($row->doc_url,'Lihat',array('target'=>'blank')).'</a>
                                  <a class="text-muted"><i class="fas fa-user ml-2"></i> '.anchor('pasery/document/author/'.$row->doc_author,$row->display_name).'</a>
                                </div>
                              </div>
                            </div>';
                $count  = $row->doc_download_count;
              }

              echo '<tr>';
              echo '<td class="text-right">'.$no++.'.</td>';
              echo '<td>'.$type.'</td>';
              echo '<td>'.$count.'</td>';
              echo '<td>';
              echo '
                <i class="fas fa-calendar"></i> '.date('d-m-Y',strtotime($row->doc_date)).'<br>
                <i class="fas fa-clock"></i> '.date('h:i:s',strtotime($row->doc_date));
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
            echo anchor('pasery/document','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
            ?>
          </div>
        </div>
      </footer>
      <?php echo form_close();?>
    </section>
  </div>
</div>
