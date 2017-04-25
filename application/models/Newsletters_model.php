<?php

class newsletters_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function salvar($data) {
        $this->db->insert('newsletters', $data);
        return true;
    }
    
    function get_emails(){
        $this->db->select('*');
        $this->db->from('newsletters');
        return $this->db->get()->result();
    }
}
?>