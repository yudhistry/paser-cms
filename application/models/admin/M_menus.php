<?php
/*
| -------------------------------------------------------------------
| Model Paser CMS
| -------------------------------------------------------------------
|
| penulis     : yudhistira ramadhany
| surel       : yudhistira.ramadhany.yr@gmail.com
| jabatan     : kepala seksi aplikasi dan pengembangan informatika
| organisasi  : dinas komunikasi, informatika, statistik dan persandian
| instansi    : pemerintah kabupaten paser
|
| Model ini sebagai koneksi ke basis data pada tabel 'psr_menus'
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menus extends CI_Model {

  var $table          = "psr_menus";
  var $primary_key    = "menu_ID";

  public function __construct() {
    parent::__construct();
  }

  public function get_all()
  {
    $this->db->order_by('menu_order,menu_title','asc');
    $query = $this->db->get($this->table);
    return $query->result();
  }

  // ambil berdasarkan id induk
  public function get_by_parent($parent)
  {
    $this->db->where('menu_parent',$parent);
    $this->db->order_by('menu_order,menu_title','asc');
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

  // tambah data
  public function insert($data)
  {
    $this->db->insert($this->table,$data);
  }

  // perbarui data
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
}
