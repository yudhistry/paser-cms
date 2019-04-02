<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_slide extends CI_Model {

  var $table    = 'psr_slides';
  var $primary  = 'slide_ID';

  public function __construct() {
      parent::__construct();
  }

  public function get_all()
  {
    $this->db->where('slide_status','aktif');
    $query = $this->db->get($this->table);
    return $query->result();
  }


}
