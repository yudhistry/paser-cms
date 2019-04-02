<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_page extends CI_Model {

  var $table          = "psr_posts";
  var $primary_key    = "post_ID";
  var $slug           = "post_slug";

  public function __construct() {
      parent::__construct();
  }

  public function get_by_slug($slug)
  {
    $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
    $this->db->where('post_type','laman');
    $this->db->where('post_slug',$slug);
    $query = $this->db->get($this->table);
    return $query->row();
  }

  public function update($data,$slug)
  {
    $this->db->where($this->slug,$slug);
    $this->db->update($this->table,$data);
  }

}
