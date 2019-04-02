<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pages extends CI_Model {

  var $table          = "psr_posts";
  var $column_order   = array(null,'post_title','display_name','comment_count','post_date');
  var $column_search  = array('post_title','display_name','comment_count','post_date');
  var $order          = array('post_date,post_title,post_author'=>'desc');
  var $primary_key    = "post_ID";

  public function __construct() {
      parent::__construct();
  }

  private function _get_datatables_query()
  {
      if($this->session->userdata('post_status'))
      {
          $this->db->where('post_status',$this->session->userdata('post_status'));
      }
      if($this->session->userdata('post_author'))
      {
          $this->db->where('post_author',$this->session->userdata('post_author'));
      }
      $this->db->where('post_type','laman');
      $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
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
      if($this->session->userdata('post_status'))
      {
          $this->db->where('post_status',$this->session->userdata('post_status'));
      }
      if($this->session->userdata('post_author'))
      {
          $this->db->where('post_author',$this->session->userdata('post_author'));
      }
      $this->db->where('post_type','laman');
      $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
      $this->db->from($this->table);
      return $this->db->count_all_results();
  }

  public function status_all()
  {
    $this->db->where('post_type','laman');
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }

  public function status($stts)
  {
    $this->db->where('post_status',$stts);
    $this->db->where('post_type','laman');
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }

  public function author($author)
  {
    $this->db->where('post_author',$author);
    $this->db->where('post_type','laman');
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }

  // ambil data
  public function get_all()
  {
      $this->db->where('post_type','laman');
      $query = $this->db->get($this->table);
      return $query->result();
  }

  // ambil data berdasarkan id
  public function get_by_id($id)
  {
      $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
      $this->db->where('post_type','laman');
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

  // hapus data
  public function delete($id)
  {
      $this->db->where($this->primary_key,$id);
      $this->db->delete($this->table);
  }

  public function get_by_slug($slug)
  {
    $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
    $this->db->where('post_type','laman');
    $this->db->where('post_slug',$slug);
    $query = $this->db->get($this->table);
    return $query->row();
  }

}