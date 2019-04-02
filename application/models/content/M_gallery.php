<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gallery extends CI_Model {

  var $table    = 'psr_galleries';
  var $primary  = 'gal_ID';
  var $slug     = 'gal_slug';

  public function __construct() {
      parent::__construct();
  }

  public function get_per_page($limit,$offset)
  {
    if($this->session->userdata('search'))
    {
      $this->db->like('gal_title',$this->session->userdata('search'));
      $this->db->or_like('gal_description',$this->session->userdata('search'));
    }
    $this->db->join('psr_users','psr_users.ID=psr_galleries.gal_author');
    $this->db->where('gal_file !=',0);
    $this->db->order_by('gal_date','desc');
    $this->db->order_by('gal_title','asc');
    $this->db->limit($limit,$offset);
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function count_page()
  {
    if($this->session->userdata('search'))
    {
      $this->db->like('gal_title',$this->session->userdata('search'));
      $this->db->or_like('gal_description',$this->session->userdata('search'));
    }
    $this->db->join('psr_users','psr_users.ID=psr_galleries.gal_author');
    $this->db->where('gal_file !=',0);
    $this->db->order_by('gal_date','desc');
    $this->db->order_by('gal_title','asc');
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }

  public function get_by_slug($slug)
  {
    $this->db->join('psr_users','psr_users.ID=psr_galleries.gal_author');
    $this->db->where($this->slug,$slug);
    $query = $this->db->get($this->table);
    return $query->row();
  }

  public function update($data,$slug)
  {
    $this->db->where($this->slug,$slug);
    $this->db->update($this->table,$data);
  }

}
