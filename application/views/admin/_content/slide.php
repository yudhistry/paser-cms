<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open('pasery/setting/slide/remove');?>
      <header class="card-header">
        <h2 class="card-title">Semua <?php echo $subpage;?></h2>
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
              $all = $this->M_slides->author_all();
              if($this->session->userdata('slide_author'))
              {
                echo anchor('admin/slide/author','Semua').' ('.$all.')';
              }
              else
              {
                echo 'Semua ('.$all.')';
              }
              $key = $this->session->userdata['logged']['ID'];
              $author = $this->M_slides->author($key);
              if($this->session->userdata('slide_author') == $key)
              {
                echo ' | Milikku ('.$author.') ';
              }
              else
              {
                echo ' | '.anchor('admin/slide/author/'.$key,'Milikku').' ('.$author.') ';
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
              <th>Nama</th>
              <th width="150px">Penulis</yh>
              <th width="100px">Status</th>
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
