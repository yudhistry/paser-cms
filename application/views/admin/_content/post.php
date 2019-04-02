<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open('pasery/post/remove');?>
      <header class="card-header">
        <h2 class="card-title"><?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <?php
            echo '<div class="btn-group">';
            echo anchor('pasery/post/add','<i class="fas fa-plus"></i> Tambah Baru',array('class'=>'btn btn-sm btn-default'));
            echo form_button(array('type'=>'submit','name'=>'btn_remove','content'=>'<i class="fas fa-trash"></i> Hapus','class'=>'btn btn-sm btn-default'));
            echo '</div>';
            if($this->session->userdata('post_category'))
            {
              $cat = $this->M_categories->get_by_id($this->session->userdata('post_category'));
              $kat_nama = 'Kategori '.$cat->cat_name;
            }
            else {
              $kat_nama = 'Semua Kategori';
            }
            ?>
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"><?php echo $kat_nama;?> <span class="caret"></span></button>
            <div class="dropdown-menu" role="menu">
              <?php
              $kategori = $this->M_categories->get_all();
              echo anchor('admin/post/category/','Semua Kategori',array('class'=>'dropdown-item text-1'));
              foreach($kategori as $row)
              {
                echo anchor('admin/post/category/'.$row->cat_ID,'Kategori '.$row->cat_name,array('class'=>'dropdown-item text-1'));
              }
              ?>
            </div>
          </div>
          <div class="col-md-8 text-right">
            <p class="card-subtitle">
              <?php
              $all = $this->M_posts->status_all();
              $id = $this->session->userdata['logged']['ID'];
              if($this->session->userdata('post_status') or $this->session->userdata('post_author') == $id)
              {
                echo anchor('admin/post/status','Semua').' ('.$all.')';
              }
              else
              {
                echo 'Semua ('.$all.')';
              }
              $author = $this->M_posts->author($id);
              if($this->session->userdata('post_author') == $id)
              {
                echo ' | Milikku ('.$author.') ';
              }
              else
              {
                echo ' | '.anchor('admin/post/author/'.$id,'Milikku').' ('.$author.') ';
              }
              $status = array('draf'=>'Draf','menunggu_evaluasi'=>'Menunggu Evaluasi','telah_terbit'=>'Telah Terbit','sampah'=>'Sampah');
              foreach($status as $key=>$value)
              {
                $post_status = $this->M_posts->status($key);
                if($post_status)
                {
                  if($this->session->userdata('post_status') == $key)
                  {
                    echo ' | '.$value.' ('.$post_status.') ';
                  }
                  else
                  {
                    echo ' | '.anchor('admin/post/status/'.$key,$value).' ('.$post_status.') ';
                  }
                }
              }
              ?>
            </p>
          </div>
        </div>
        <hr class="dotted short">
        <table class="table table-hover mb-0" id="datatable-default">
          <thead>
            <tr>
              <th width="10px"><input type="checkbox" id="check-all"></th>
              <th>Judul</th>
              <th width="150px">Kategori</th>
              <th width="150px">Penulis</th>
              <th width="75px"><i class="fas fa-eye"></i></th>
              <th width="150px">Tanggal</th>
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
