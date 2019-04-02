<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_category extends CI_Model {

  var $table    = 'psr_categories';
  var $primary  = 'cat_ID';

  public function __construct() {
      parent::__construct();
  }

  public function get_root()
  {
    $this->db->order_by('cat_order,cat_name','asc');
    $this->db->where('cat_role',0);
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function get_by_parent($parent)
  {
    $this->db->order_by('cat_order,cat_name','asc');
    $this->db->where('cat_parent',$parent);
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function get_by_slug($slug)
  {
    $this->db->where('cat_slug',$slug);
    $query = $this->db->get($this->table);
    return $query->row();
  }

  public function get_by_id($id)
  {
    $this->db->where($this->primary,$id);
    $query = $this->db->get($this->table);
    return $query->row();
  }


}
