<?php defined('BASEPATH') or exit('No direct script access allowed');

class Slug
{
    private $CI;
    private $latin = array('á', 'é', 'í', 'ó', 'ú', 'ñ', 'ç', 'ü', 'à', 'è', 'ì', 'ò', 'ù', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ', 'Ç', 'Ü', 'À', 'È', 'Ì', 'Ò', 'Ù');
    private $plain = array('a', 'e', 'i', 'o', 'u', 'n', 'c', 'u', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'N', 'C', 'U', 'A', 'E', 'I', 'O', 'U');

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
    }

    public function create_slug_post($string,$table)
    {
        //Change the latin characters to plain characters
        $slug = str_replace($this->latin, $this->plain, $string);
        //Creates a human-friendly URL string with dashes
        $slug = url_title($slug);
        //Make the string lowercase
        $slug = strtolower($slug);
        //Set the initial counter to append at the end of the string (if duplicate)
        $i = 0;
        $params = array ();
        $params['post_slug'] = $slug;
        //Check if POST contains an 'id'. If it does, exclude the actual post in the check
        if ($this->CI->input->post('post_ID')) {
            $params['post_ID !='] = $this->CI->input->post('post_ID');
        }
        while ($this->CI->db->where($params)->get($table)->num_rows()) {
            if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
            }
            $params['post_slug'] = $slug;
        }
        return $slug;
    }

    public function create_slug_category($string,$table)
    {
        //Change the latin characters to plain characters
        $slug = str_replace($this->latin, $this->plain, $string);
        //Creates a human-friendly URL string with dashes
        $slug = url_title($slug);
        //Make the string lowercase
        $slug = strtolower($slug);
        //Set the initial counter to append at the end of the string (if duplicate)
        $i = 0;
        $params = array ();
        $params['cat_slug'] = $slug;
        //Check if POST contains an 'id'. If it does, exclude the actual post in the check
        if ($this->CI->input->post('cat_ID')) {
            $params['cat_ID !='] = $this->CI->input->post('cat_ID');
        }
        while ($this->CI->db->where($params)->get($table)->num_rows()) {
            if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
            }
            $params['cat_slug'] = $slug;
        }
        return $slug;
    }

    public function create_slug_agenda($string,$table)
    {
        //Change the latin characters to plain characters
        $slug = str_replace($this->latin, $this->plain, $string);
        //Creates a human-friendly URL string with dashes
        $slug = url_title($slug);
        //Make the string lowercase
        $slug = strtolower($slug);
        //Set the initial counter to append at the end of the string (if duplicate)
        $i = 0;
        $params = array ();
        $params['agenda_slug'] = $slug;
        //Check if POST contains an 'id'. If it does, exclude the actual post in the check
        if ($this->CI->input->post('agenda_ID')) {
            $params['agenda_ID !='] = $this->CI->input->post('agenda_ID');
        }
        while ($this->CI->db->where($params)->get($table)->num_rows()) {
            if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
            }
            $params['agenda_slug'] = $slug;
        }
        return $slug;
    }

    public function create_slug_gallery($string,$table)
    {
        //Change the latin characters to plain characters
        $slug = str_replace($this->latin, $this->plain, $string);
        //Creates a human-friendly URL string with dashes
        $slug = url_title($slug);
        //Make the string lowercase
        $slug = strtolower($slug);
        //Set the initial counter to append at the end of the string (if duplicate)
        $i = 0;
        $params = array ();
        $params['gal_slug'] = $slug;
        //Check if POST contains an 'id'. If it does, exclude the actual post in the check
        if ($this->CI->input->post('gal_ID')) {
            $params['gal_ID !='] = $this->CI->input->post('gal_ID');
        }
        while ($this->CI->db->where($params)->get($table)->num_rows()) {
            if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
            }
            $params['gal_slug'] = $slug;
        }
        return $slug;
    }

    public function create_slug_document($string,$table)
    {
        //Change the latin characters to plain characters
        $slug = str_replace($this->latin, $this->plain, $string);
        //Creates a human-friendly URL string with dashes
        $slug = url_title($slug);
        //Make the string lowercase
        $slug = strtolower($slug);
        //Set the initial counter to append at the end of the string (if duplicate)
        $i = 0;
        $params = array ();
        $params['doc_slug'] = $slug;
        //Check if POST contains an 'id'. If it does, exclude the actual post in the check
        if ($this->CI->input->post('doc_ID')) {
            $params['doc_ID !='] = $this->CI->input->post('doc_ID');
        }
        while ($this->CI->db->where($params)->get($table)->num_rows()) {
            if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
            }
            $params['doc_slug'] = $slug;
        }
        return $slug;
    }

    public function create_slug_law($string,$table)
    {
        //Change the latin characters to plain characters
        $slug = str_replace($this->latin, $this->plain, $string);
        //Creates a human-friendly URL string with dashes
        $slug = url_title($slug);
        //Make the string lowercase
        $slug = strtolower($slug);
        //Set the initial counter to append at the end of the string (if duplicate)
        $i = 0;
        $params = array ();
        $params['law_slug'] = $slug;
        //Check if POST contains an 'id'. If it does, exclude the actual post in the check
        if ($this->CI->input->post('law_ID')) {
            $params['law_ID !='] = $this->CI->input->post('law_ID');
        }
        while ($this->CI->db->where($params)->get($table)->num_rows()) {
            if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
            }
            $params['law_slug'] = $slug;
        }
        return $slug;
    }


}
