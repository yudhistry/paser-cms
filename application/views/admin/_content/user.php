<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open('pasery/user/remove');?>
      <header class="card-header">
        <h2 class="card-title"><?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <?php
            echo '<div class="btn-group">';
            echo anchor('pasery/setting/slide/add','<i class="fas fa-plus"></i> Tambah Baru',array('class'=>'btn btn-sm btn-default'));
            echo form_button(array('type'=>'submit','name'=>'btn_remove','content'=>'<i class="fas fa-trash"></i> Hapus','class'=>'btn btn-sm btn-default'));
            echo '</div>';
            ?>
          </div>
          <div class="col-md-8 text-right">
            <p class="card-subtitle">
              <?php
              $all = $this->M_userrole->count_all();
              if($this->session->userdata('user_role'))
              {
                echo anchor('admin/user/role','Semua').' ('.$all.')';
              }
              else
              {
                echo 'Semua ('.$all.')';
              }
              $role = $this->M_userrole->get_all();
              foreach($role as $row)
              {
                $user_role = $this->M_users->role($row->usrole_ID);
                if($user_role)
                {
                  if($this->session->userdata('user_role') == $row->usrole_ID)
                  {
                    echo ' | '.$row->usrole_name.' ('.$user_role.') ';
                  }
                  else
                  {
                    echo ' | '.anchor('admin/user/role/'.$row->usrole_ID,$row->usrole_name).' ('.$user_role.') ';
                  }
                }
              }
              ?>
          </div>
        </div>
        <hr class="dotted short">
        <table class="table table-hover mb-0" id="datatable-default">
          <thead>
            <tr>
              <th width="10px"><input type="checkbox" id="check-all"></th>
              <th>Nama Pengguna</th>
              <th width="150px">Nama</yh>
              <th width="150px">Email</yh>
              <th width="100px">Peranan</th>
              <th width="150px">Terdaftar</th>
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
