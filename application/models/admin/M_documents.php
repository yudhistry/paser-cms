<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_documents extends CI_Model {

  var $table          = "psr_documents";
  var $column_order   = array(null,'doc_title','doc_author','doc_date');
  var $column_search  = array('doc_title','doc_author');
  var $order          = array('doc_date'=>'desc');
  var $primary_key    = "doc_ID";

  public function __construct() {
      parent::__construct();
  }

  private function _get_datatables_query()
  {
      if($this->session->userdata('doc_author'))
      {
          $this->db->where('doc_author',$this->session->userdata('doc_author'));
      }
      if($this->session->userdata('doc_parent'))
      {
          $this->db->where('doc_parent',$this->session->userdata('doc_parent'));
      }
      else {
        $this->db->where('doc_parent','0');
      }
      $this->db->join('psr_users','psr_users.ID=psr_documents.doc_author');
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
    if($this->session->userdata('doc_author'))
    {
        $this->db->where('doc_author',$this->session->userdata('doc_author'));
    }
    if($this->session->userdata('doc_parent'))
    {
        $this->db->where('doc_parent',$this->session->userdata('doc_parent'));
    }
    else {
      $this->db->where('doc_parent','0');
    }
    $this->db->join('psr_users','psr_users.ID=psr_documents.doc_author');
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  public function author_all()
  {
    if($this->session->userdata('doc_parent'))
    {
        $this->db->where('doc_parent',$this->session->userdata('doc_parent'));
    }
    else {
      $this->db->where('doc_parent','0');
    }
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }

  public function author($author)
  {
    if($this->session->userdata('doc_author'))
    {
        $this->db->where('doc_author',$author);
    }
    if($this->session->userdata('doc_parent'))
    {
        $this->db->where('doc_parent',$this->session->userdata('doc_parent'));
    }
    else {
      $this->db->where('doc_parent','0');
    }
    $this->db->where('doc_author',$author);
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }

  // ambil data
  public function get_all()
  {
      $query = $this->db->get($this->table);
      return $query->result();
  }

  public function get_folder()
  {
    $this->db->where('doc_type','folder');
    $this->db->group_by('doc_parent,doc_ID');
    $this->db->order_by('doc_role,doc_title','asc');
    $query = $this->db->get($this->table);
    return $query->result();
  }

  // ambil data berdasarkan id
  public function get_by_id($id)
  {
    $this->db->join('psr_users','psr_users.ID=psr_documents.doc_author');
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
    // ambil baris data array
    $this->db->or_where('doc_parent',$id);
    $query  = $this->db->get($this->table);
    $row    = $query->row_array();
    if($row['doc_type'] == 'file')
    {
      // hapus berkas baris data array
      unlink('./assets/library/document/'.$row['doc_file']);
    }
    // hapus baris data
    $this->db->where($this->primary_key,$id);
    $this->db->or_where('doc_parent',$id);
    $this->db->delete($this->table);
  }

}
