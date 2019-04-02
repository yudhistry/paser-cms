<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_document extends CI_Model {

  var $table    = 'psr_documents';
  var $primary  = 'doc_ID';
  var $slug     = 'doc_slug';

  public function __construct() {
      parent::__construct();
  }

  public function get_per_page($limit,$offset)
  {
    if($this->session->userdata('doc_parent_public'))
    {
        $this->db->where('doc_parent',$this->session->userdata('doc_parent_public'));
    }
    else {
      $this->db->where('doc_parent','0');
    }
    $this->db->join('psr_users','psr_users.ID=psr_documents.doc_author');
    //$this->db->where('doc_type','file');
    $this->db->order_by('doc_type','desc');
    $this->db->order_by('doc_date','desc');
    $this->db->order_by('doc_title','asc');
    $this->db->limit($limit,$offset);
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function count_page()
  {
    if($this->session->userdata('doc_parent_public'))
    {
        $this->db->where('doc_parent',$this->session->userdata('doc_parent_public'));
    }
    else {
      $this->db->where('doc_parent','0');
    }
    $this->db->join('psr_users','psr_users.ID=psr_documents.doc_author');
    //$this->db->where('doc_type','file');
    $this->db->order_by('doc_date','desc');
    $this->db->order_by('doc_title','asc');
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }

  public function get_per_page_search($limit,$offset)
  {
    if($this->session->userdata('search_public'))
    {
      $this->db->like('doc_title',$this->session->userdata('search_public'));
      //$this->db->or_like('doc_description',$this->session->userdata('search'));
    }
    $this->db->join('psr_users','psr_users.ID=psr_documents.doc_author');
    //$this->db->where('doc_type','file');
    $this->db->order_by('doc_type','desc');
    $this->db->order_by('doc_date','desc');
    $this->db->order_by('doc_title','asc');
    $this->db->limit($limit,$offset);
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function count_page_search()
  {
    if($this->session->userdata('search_public'))
    {
      $this->db->like('doc_title',$this->session->userdata('search_public'));
      //$this->db->or_like('doc_description',$this->session->userdata('search'));
    }
    $this->db->join('psr_users','psr_users.ID=psr_documents.doc_author');
    //$this->db->where('doc_type','file');
    $this->db->order_by('doc_date','desc');
    $this->db->order_by('doc_title','asc');
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }

  public function get_by_slug($slug)
  {
    $this->db->join('psr_users','psr_users.ID=psr_documents.doc_author');
    $this->db->where($this->slug,$slug);
    $query = $this->db->get($this->table);
    return $query->row();
  }

  public function get_by_id($id)
  {
    $this->db->join('psr_users','psr_users.ID=psr_documents.doc_author');
    $this->db->where($this->primary,$id);
    $query = $this->db->get($this->table);
    return $query->row();
  }

  public function update($data,$slug)
  {
    $this->db->where($this->slug,$slug);
    $this->db->update($this->table,$data);
  }

}
