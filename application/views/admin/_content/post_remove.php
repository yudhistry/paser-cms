<div class="row">
  <div class="col-md-12">
    <section class="card card-danger mb-4">
      <?php echo form_open('admin/post/delete');?>
      <header class="card-header">
        <h2 class="card-title">Hapus <?php echo $page;?></h2>
      </header>
      <div class="card-body">
        <h4>Apakah Anda yakin akan menghapus data dibawah ini?</h4>
        <table class="table table-hover mb-0" id="datatable-default-no">
          <thead>
            <tr>
              <th width="10px">No</th>
              <th>Judul</th>
              <th width="180px">Kategori</th>
              <th width="180px">Penulis</th>
              <th width="75px"><i class="fas fa-eye"></i></th>
              <th width="180px">Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach($checked as $id)
            {
              $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
              $dec_id = $this->encryption->decrypt($dec_id);
              echo form_hidden('ID[]',$dec_id);
              $row = $this->M_posts->get_by_id($dec_id);
              $post_category  = explode(',',$row->post_category);
              $cat_name       = array();
              foreach($post_category as $key=>$value)
              {
                $cat = $this->M_categories->get_by_id($value);
                $cat_name[$value] = $cat->cat_name;
              }
              echo '<tr>';
              echo '<td class="text-right">'.$no++.'.</td>';
              echo '<td><strong>'.$row->post_title.'</strong><br></td>';
              echo '<td>'.implode(', ',$cat_name).'</td>';
              echo '<td>'.$row->display_name.'</td>';
              echo '<td>'.$row->post_view_count.'</td>';
              echo '<td><i class="fas fa-bookmark"></i> '.ucwords(str_replace('_',' ',$row->post_status)).'<br><i class="fas fa-calendar"></i> '.date('d-m-Y h:i:s',strtotime($row->post_date)).'</td>';
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
            echo anchor('pasery/page','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
            ?>
          </div>
        </div>
      </footer>
      <?php echo form_close();?>
    </section>
  </div>
</div>
