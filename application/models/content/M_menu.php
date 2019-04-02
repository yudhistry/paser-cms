<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menu extends CI_Model {

  var $table          = "psr_menus";
  var $primary_key    = "menu_ID";

  public function __construct() {
      parent::__construct();
  }

  // ambil data
  public function get_all()
  {
    $this->db->order_by('menu_parent,menu_order,menu_title','asc');
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function get_root()
  {
    $this->db->order_by('menu_parent,menu_order,menu_title','asc');
    $this->db->where('menu_role',0);
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function count_parent($parent)
  {
    $this->db->where('menu_parent',$parent);
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }

  // ambil berdasarkan id induk
  public function get_by_parent($parent)
  {
    $this->db->where('menu_parent',$parent);
    $query = $this->db->get($this->table);
    return $query->result();
  }

  // ambil data berdasarkan id
  public function get_by_id($id)
  {
    $this->db->where($this->primary_key,$id);
    $query = $this->db->get($this->table);
    return $query->row();
  }

  // insert data
  public function insert($data)
  {
      //$this->db->set($this->primary_key,'UUID()',FALSE);
      $this->db->insert($this->table,$data);
  }

  // update data
  public function update($data,$id)
  {
      $this->db->where($this->primary_key,$id);
      $this->db->update($this->table,$data);
  }

  // update data dari id induk
  public function update_by_parent($data,$id)
  {
      $this->db->where('menu_parent',$id);
      $this->db->update($this->table,$data);
  }

  // hapus data
  public function delete($id)
  {
      $this->db->where($this->primary_key,$id);
      $this->db->delete($this->table);
  }

  public function get_by_url($url)
  {
    $this->db->where('menu_url',$url);
    $query = $this->db->get($this->table);
    return $query->row();
  }
}
