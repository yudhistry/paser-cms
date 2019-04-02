<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_link extends CI_Model {

  var $table    = 'psr_links';
  var $primary  = 'link_ID';

  public function __construct() {
      parent::__construct();
  }

  public function get_all()
  {
    $query = $this->db->get($this->table);
    return $query->result();
  }


}
