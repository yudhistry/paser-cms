<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_library extends CI_Model {

  var $table    = 'psr_libraries';
  var $primary  = 'lib_ID';

  public function __construct() {
      parent::__construct();
  }

  public function get_by_id($id)
  {
    $this->db->where($this->primary,$id);
    $query = $this->db->get($this->table);
    return $query->row();
  }


}
