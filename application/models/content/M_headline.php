<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_headline extends CI_Model {

  var $table    = 'psr_post';
  var $primary  = 'post_ID';

  public function __construct() {
      parent::__construct();
  }

  public function get_latest()
  {
    $this->db->join('psr_users','psr_users.ID=psr_posts.post_author');
    $this->db->where('post_type','pos');
    $this->db->where('post_status','telah_terbit');
    $this->db->where('post_headline','on');
    $this->db->limit(5);
    $query = $this->db->get('psr_posts');
    return $query->result();
  }


}
