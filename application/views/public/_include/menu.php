<nav class="collapse">
  <ul class="nav nav-pills" id="mainNav">
    <li>
      <a href="<?php echo base_url();?>" class="dropdown-item">Beranda</a>
    </li>
    <?php
    $menu = $this->M_menu->get_root();
    foreach($menu as $row)
    {
      $parent = $this->M_menu->count_parent($row->menu_ID);
      $item = $parent > 0 ? 'class="dropdown"' : '';
      $toggle = $parent > 0 ? 'class="dropdown-item dropdown-toggle"' : 'class="dropdown-item"';
      echo '<li '.$item.'>';
      echo '<a href="'.$row->menu_url.'" '.$toggle.'>'.$row->menu_title.'</a>';
      if($parent)
      {
        echo '<ul class="dropdown-menu">';
        $sub_menu = $this->M_menu->get_by_parent($row->menu_ID);
        foreach($sub_menu as $rows)
        {
          $subparent = $this->M_menu->count_parent($rows->menu_ID);
          $subitem = $subparent > 0 ? 'class="dropdown-submenu"' : '';
          $subtoggle = $subparent > 0 ? 'class="dropdown-item"' : 'class="dropdown-item"';
          echo '<li '.$subitem.'>';
          echo '<a href="'.$rows->menu_url.'" '.$subtoggle.'>'.$rows->menu_title.'</a>';
          if($subparent)
          {
            echo '<ul class="dropdown-menu">';
            $sub_menu = $this->M_menu->get_by_parent($rows->menu_ID);
            foreach($sub_menu as $rows)
            {
              echo '<li>';
              echo '<a href="'.$rows->menu_url.'" '.$subtoggle.'>'.$rows->menu_title.'</a>';
              echo '</li>';
            }
            echo '</ul>';
          }
          echo '</li>';
        }
        echo '</ul>';
      }
      echo '</li>';
    }
    ?>
  </ul>
</nav>
