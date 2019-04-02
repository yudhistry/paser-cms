<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_categories extends CI_Model {

  var $table          = "psr_categories";
  var $column_order   = array(null,'cat_name','cat_description','cat_slug');
  var $column_search  = array('cat_name','cat_description','cat_slug');
  var $order          = array('cat_order,cat_name,cat_slug'=>'asc');
  var $primary_key    = "cat_ID";

  public function __construct() {
      parent::__construct();
  }

  private function _get_datatables_query()
  {
      $this->db->from($this->table);
      $i = 0;
      foreach ($this->column_search as $item)
      {
          if($_POST['search']['value'])
          {

              if($i===0)
              {
                  $this->db->group_start();
                  $this->db->like($item, $_POST['search']['value']);
              }
              else
              {
                  $this->db->or_like($item, $_POST['search']['value']);
              }

              if(count($this->column_search) - 1 == $i)
                  $this->db->group_end();
          }
          $i++;
      }

      if(isset($_POST['order']))
      {
          $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      }
      else if(isset($this->order))
      {
          $order = $this->order;
          $this->db->order_by(key($order), $order[key($order)]);
      }
  }

  function get_datatables()
  {
      $this->_get_datatables_query();
      if($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      return $query->result();
  }

  function count_filtered()
  {
      $this->_get_datatables_query();
      $query = $this->db->get();
      return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  // ambil data
  public function get_all()
  {
    $this->db->order_by('cat_order,cat_name','asc');
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

  public function like_by_id($id)
  {
    $this->db->like($this->primary_key,$id);
    $query = $this->db->get($this->table);
    return $query->row();
  }

  // insert data
  public function insert($data)
  {
      $this->db->set($this->primary_key,'UUID()',FALSE);
      $this->db->insert($this->table,$data);
  }

  // update data
  public function update($data,$id)
  {
      $this->db->where($this->primary_key,$id);
      $this->db->update($this->table,$data);
  }

  // hapus data
  public function delete($id)
  {
      $this->db->where($this->primary_key,$id);
      $this->db->delete($this->table);
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
}
