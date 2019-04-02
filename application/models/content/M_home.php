<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

  public function __construct() {
      parent::__construct();
  }

  public function sliders_status($stts)
  {
    $this->db->where('slide_status',$stts);
    $query = $this->db->get('psr_sliders');
    return $query->result();
  }

  public function posts_latest($limit)
  {
    $this->db->limit($limit);
    $this->db->where('post_status','telah_terbit');
    $this->db->where('post_type','pos');
    $this->db->order_by('post_date,post_title,post_modified','desc');
    $query = $this->db->get('psr_posts');
    return $query->result();
  }

  public function posts_count_by_status($stts)
  {
    $this->db->where('post_status',$stts);
    $this->db->where('post_type','pos');
    $this->db->order_by('post_date,post_title,post_modified','desc');
    $this->db->from('psr_posts');
    return $this->db->count_all_results();
  }

  public function documents_count_by_type($type)
  {
    $this->db->where('doc_type',$type);
    $this->db->from('psr_documents');
    return $this->db->count_all_results();
  }

  public function galleries_count_all()
  {
    $this->db->from('psr_galleries');
    return $this->db->count_all_results();
  }

  public function links_get_all()
  {
    $this->db->order_by('link_order,link_title','asc');
    $query = $this->db->get('psr_links');
    return $query->result();
  }

  public function search_page($search)
  {
    $this->db->like('post_title',$search);
    //$this->db->or_like('post_content',$search);
    $this->db->where('post_type','laman');
    $this->db->where('post_status','telah_terbit');
    $query = $this->db->get('psr_posts');
    return $query->result();
  }

  public function search_post($search)
  {
    $this->db->like('post_title',$search);
    //$this->db->or_like('post_content',$search);
    //$this->db->where('post_type','pos');
    $this->db->where('post_status','telah_terbit');
    $this->db->order_by('post_date','desc');
    $this->db->order_by('post_title','asc');
    $query = $this->db->get('psr_posts');
    return $query->result();
  }

  public function search_gallery($search)
  {
    $this->db->like('gal_title',$search);
    //$this->db->or_like('post_content',$search);
    $query = $this->db->get('psr_galleries');
    return $query->result();
  }

}
