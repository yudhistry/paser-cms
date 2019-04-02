<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_options extends CI_Model {

    private $table          = "psr_options";
    private $primary_key    = "ID";

    public function __construct() {
        parent::__construct();
    }

    // ambil data berdasarkan email
    public function get_by_id($id)
    {
        $this->db->where($this->primary_key,$id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    // update data
    public function update($data,$id)
    {
        $this->db->where($this->primary_key,$id);
        $this->db->update($this->table,$data);
    }

}
