<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_post extends CI_Model {

  var $table    = 'psr_posts';
  var $primary  = 'post_ID';
  var $slug     = 'post_slug';

  public function __construct() {
      parent::__construct();
  }

  public function get_per_page($limit,$offset)
  {
    $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
    $this->db->where('post_type','pos');
    $this->db->where('post_status','telah_terbit');
    $this->db->limit($limit,$offset);
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function count_page()
  {
    $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
    $this->db->where('post_type','pos');
    $this->db->where('post_status','telah_terbit');
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }

  public function get_per_page_category($limit,$offset,$category)
  {
    $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
    $this->db->where('post_type','pos');
    $this->db->where('post_status','telah_terbit');
    $this->db->like('post_category',$category);
    $this->db->limit($limit,$offset);
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function count_page_category($category)
  {
    $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
    $this->db->where('post_type','pos');
    $this->db->where('post_status','telah_terbit');
    $this->db->like('post_category',$category);
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }

  public function get_per_page_author($limit,$offset,$author)
  {
    $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
    $this->db->where('post_type','pos');
    $this->db->where('post_status','telah_terbit');
    $this->db->where('user_login',$author);
    $this->db->limit($limit,$offset);
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function count_page_author($author)
  {
    $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
    $this->db->where('post_type','pos');
    $this->db->where('post_status','telah_terbit');
    $this->db->where('post_author',$author);
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }

  public function get_by_slug($slug)
  {
    $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
    $this->db->where('post_type','pos');
    $this->db->where('post_status','telah_terbit');
    $this->db->where('post_slug',$slug);
    $query = $this->db->get($this->table);
    return $query->row();
  }

  public function get_by_author($author)
  {
    $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
    $this->db->where('post_type','pos');
    $this->db->where('post_status','telah_terbit');
    $this->db->where('post_author',$author);
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function get_latest()
  {
    $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
    $this->db->where('post_type','pos');
    $this->db->where('post_status','telah_terbit');
    $this->db->limit(5);
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function update($data,$slug)
  {
    $this->db->where($this->slug,$slug);
    $this->db->update($this->table,$data);
  }

}
