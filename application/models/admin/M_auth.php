<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    private $table          = "psr_users";
    private $primary_key    = "ID";

    public function __construct() {
      parent::__construct();
    }

    // ambil data berdasarkan email
    public function login($login)
    {
      $this->db->where('user_login',$login);
      return $this->db->get($this->table);
    }

    // ambil data berdasarkan cookie
    public function get_by_cookie($cookie)
    {
      $this->db->where('user_cookie', $cookie);
      return $this->db->get($this->table);
    }

    // ambil data berdasarkan id
    public function get_by_id($id)
    {
      $this->db->join('psr_userrole','psr_userrole.usrole_ID=psr_users.user_role');
      $this->db->where($this->primary_key,$id);
      $query = $this->db->get($this->table);
      return $query->row();
    }

    // update data coockie
    public function update($data,$id)
    {
      $this->db->where($this->primary_key,$id);
      $this->db->update($this->table,$data);
    }

}
