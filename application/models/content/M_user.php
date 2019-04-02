<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

  var $table    = 'psr_users';
  var $primary  = 'user_ID';

  public function __construct() {
      parent::__construct();
  }

  public function get_by_userlogin($author)
  {
    $this->db->where('user_login',$author);
    $query = $this->db->get($this->table);
    return $query->row();
  }


}
