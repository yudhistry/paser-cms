<aside id="sidebar-left" class="sidebar-left">
  <div class="sidebar-header">
    <div class="sidebar-title">
      Navigasi
    </div>
    <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
      <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
    </div>
  </div>
  <div class="nano">
    <div class="nano-content">
      <nav id="menu" class="nav-main" role="navigation">
        <ul class="nav nav-main">
          <?php $beranda = $page == 'Beranda' ? 'nav-active' : '';?>
          <li class="<?php echo $beranda;?>">
            <a class="nav-link" href="<?php echo site_url('pasery/dashboard');?>">
              <i class="fas fa-home" aria-hidden="true"></i><span>Beranda</span>
            </a>
          </li>
          <?php $pos = $page == 'Pos' ? 'nav-parent nav-expanded nav-active' : 'nav-parent';?>
          <li class="<?php echo $pos;?>">
            <a class="nav-link" href="#">
              <i class="fas fa-thumbtack" aria-hidden="true"></i><span>Pos</span>
            </a>
            <ul class="nav nav-children">
              <?php $semua_pos = $subpage == 'Semua Pos' ? 'nav-active' : '';?>
              <li class="<?php echo $semua_pos;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/post');?>">Semua Pos</a>
              </li>
              <?php $tambah_pos = $subpage == 'Tambah Pos' ? 'nav-active' : '';?>
              <li class="<?php echo $tambah_pos;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/post/add');?>">Tambah Pos</a>
              </li>
              <?php $kategori = $subpage == 'Kategori' ? 'nav-active' : '';?>
              <li class="<?php echo $kategori;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/post/category');?>">Kategori</a>
              </li>
            </ul>
          </li>
          <?php $pustaka = $page == 'Pustaka' ? 'nav-parent nav-expanded nav-active' : 'nav-parent';?>
          <li class="<?php echo $pustaka;?>">
            <a class="nav-link" href="#">
              <i class="fas fa-book" aria-hidden="true"></i><span>Pustaka</span>
            </a>
            <ul class="nav nav-children">
              <?php $semua_pustaka = $subpage == 'Semua Pustaka' ? 'nav-active' : '';?>
              <li class="<?php echo $semua_pustaka;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/library');?>">Semua Pustaka</a>
              </li>
              <?php $tambah_pustaka = $subpage == 'Tambah Pustaka' ? 'nav-active' : '';?>
              <li class="<?php echo $tambah_pustaka;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/library/add');?>">Tambah Pustaka</a>
              </li>
            </ul>
          </li>
          <?php $galeri = $page == 'Galeri' ? 'nav-active' : '';?>
          <li class="<?php echo $galeri;?>">
            <a class="nav-link" href="<?php echo site_url('pasery/gallery');?>">
              <i class="fas fa-images" aria-hidden="true"></i><span>Galeri</span>
            </a>
          </li>
          <?php $dokumen = $page == 'Dokumen' ? 'nav-active' : '';?>
          <li class="<?php echo $dokumen;?>">
            <a class="nav-link" href="<?php echo site_url('pasery/document');?>">
              <i class="fas fa-file-alt" aria-hidden="true"></i><span>Dokumen</span>
            </a>
          </li>
          <!-- start: menu admin -->
          <?php if($this->session->userdata['logged']['user_role'] == 1) { ?>
          <?php $laman = $page == 'Laman' ? 'nav-parent nav-expanded nav-active' : 'nav-parent';?>
          <li class="<?php echo $laman;?>">
            <a class="nav-link" href="#">
              <i class="fas fa-file" aria-hidden="true"></i><span>Laman</span>
            </a>
            <ul class="nav nav-children">
              <?php $semua_laman = $subpage == 'Semua Laman' ? 'nav-active' : '';?>
              <li class="<?php echo $semua_laman;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/page');?>">Semua Laman</a>
              </li>
              <?php $tambah_laman = $subpage == 'Tambah Laman' ? 'nav-active' : '';?>
              <li class="<?php echo $tambah_laman;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/page/add');?>">Tambah Laman</a>
              </li>
            </ul>
          </li>
          <?php $pengguna = $page == 'Pengguna' ? 'nav-parent nav-expanded nav-active' : 'nav-parent';?>
          <li class="<?php echo $pengguna;?>">
            <a class="nav-link" href="#">
              <i class="fas fa-users" aria-hidden="true"></i><span>Pengguna</span>
            </a>
            <ul class="nav nav-children">
              <?php $semua_pengguna = $subpage == 'Semua Pengguna' ? 'nav-active' : '';?>
              <li class="<?php echo $semua_pengguna;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/user');?>">Semua Pengguna</a>
              </li>
              <?php $tambah_pengguna = $subpage == 'Tambah Pengguna' ? 'nav-active' : '';?>
              <li class="<?php echo $tambah_pengguna;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/user/add');?>">Tambah Pengguna</a>
              </li>
              <?php $profil = $subpage == 'Profil Anda' ? 'nav-active' : '';?>
              <li class="<?php echo $profil;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/profile');?>">Profil Anda</a>
              </li>
            </ul>
          </li>
          <?php $pengaturan = $page == 'Pengaturan' ? 'nav-parent nav-expanded nav-active' : 'nav-parent';?>
          <li class="<?php echo $pengaturan;?>">
            <a class="nav-link" href="#">
              <i class="fas fa-sliders-h" aria-hidden="true"></i><span>Pengaturan</span>
            </a>
            <ul class="nav nav-children">
              <?php $umum = $subpage == 'Umum' ? 'nav-active' : '';?>
              <li class="<?php echo $umum;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/setting');?>">Umum</a>
              </li>
              <?php $menu = $subpage == 'Menu' ? 'nav-active' : '';?>
              <li class="<?php echo $menu;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/setting/menu');?>">Menu</a>
              </li>
              <?php $slide = $subpage == 'Slide' ? 'nav-active' : '';?>
              <li class="<?php echo $slide;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/setting/slide');?>">Slide</a>
              </li>
              <?php $tautan = $subpage == 'Tautan' ? 'nav-active' : '';?>
              <li class="<?php echo $tautan;?>">
                  <a class="nav-link" href="<?php echo site_url('pasery/setting/link');?>">Tautan</a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!-- end: menu admin -->
        </ul>
      </nav>
    </div>
    <script>
        // Maintain Scroll Position
        if (typeof localStorage !== 'undefined') {
            if (localStorage.getItem('sidebar-left-position') !== null) {
                var initialPosition = localStorage.getItem('sidebar-left-position'),
                    sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                sidebarLeft.scrollTop = initialPosition;
            }
        }
    </script>
  </div>
</aside>
