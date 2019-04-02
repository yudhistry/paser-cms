<?php
/*
| -------------------------------------------------------------------
| Model Paser CMS
| -------------------------------------------------------------------
|
| penulis     : yudhistira ramadhany
| surel       : yudhistira.ramadhany.yr@gmail.com
| jabatan     : kepala seksi aplikasi dan pengembangan informatika
| organisasi  : dinas komunikasi, informatika, statistik dan persandian
| instansi    : pemerintah kabupaten paser
|
| Model ini sebagai koneksi ke basis data pada tabel 'psr_userrole'
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class M_userrole extends CI_Model {

    var $table          = "psr_userrole";
    var $column_order   = array(null,'usrole_name','usrole_slug');
    var $column_search  = array('usrole_name','usrole_slug');
    var $order          = array('usrole_name'=>'asc');
    var $primary_key    = "usrole_ID";

    public function __construct() {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function role_all()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    // ambil data berdasarkan email
    public function get_by_id($id)
    {
        $this->db->where($this->primary_key,$id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    // insert data
    public function insert($data)
    {
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

}
