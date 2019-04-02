<div class="row">
  <div class="col-md-12">
    <section class="card card-danger mb-4">
      <?php echo form_open('admin/user/delete');?>
      <header class="card-header">
        <h2 class="card-title">Hapus <?php echo $page;?></h2>
      </header>
      <div class="card-body">
        <h4>Apakah Anda yakin akan menghapus data dibawah ini?</h4>
        <table class="table table-hover mb-0" id="datatable-default-no">
          <thead>
            <tr>
              <th width="10px">No</th>
              <th>Nama Pengguna</th>
              <th width="150px">Nama</yh>
              <th width="150px">Email</yh>
              <th width="100px">Peranan</th>
              <th width="150px">Terdaftar</th>
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
              $rows = $this->M_users->get_by_id($dec_id);
              echo '<tr>';
              echo '<td>'.$no++.'</td>';
              echo '<td>'.$rows->user_login.'</td>';
              echo '<td>'.$rows->user_fullname.'</td>';
              echo '<td>'.$rows->user_email.'</td>';
              echo '<td>'.$rows->usrole_name.'</td>';
              echo '<td>'.date('d-m-Y h:i:s',strtotime($rows->user_registered)).'</td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer text-right">
        <?php
        echo '<div class="btn-group">';
        echo form_button(array('type'=>'submit','name'=>'btn_delete','content'=>'<i class="fas fa-recycle"></i> Konfirmasi Penghapusan','class'=>'btn btn-sm btn-danger'));
        echo anchor('pasery/user','<i class="fas fa-times"></i> Batal',array('class'=>'btn btn-sm btn-default'));
        echo '</div>';
        ?>
      </div>
      <?php echo form_close();?>
    </section>
  </div>
</div>
