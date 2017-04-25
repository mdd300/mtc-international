<?php

class quem_somos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_quem_somos_detalhes_sort($sort){
        $this->db->select('*');
        $this->db->from('quem_somos');
        $this->db->where('sort', $sort);
        
        return $this->db->get()->result();
    }

    function get_sort() {
        $this->db->select('sort');
        $this->db->from('quem_somos');

        $result = $this->db->get()->num_rows();
        return $result + 1;
    }

    function count_quem_somos(){
        return $this->db->count_all('quem_somos');
    }

    function get_quem_somos_site() {
        $this->db->select('*')
                 ->from('quem_somos');

        return $this->db->get()->row();
    }

    function get_quem_somos($status = "") {
        $this->db->select('*');
        $this->db->from('quem_somos');

        if ($status != '') {
            $this->db->where('habilitado', $status);
        }

        $this->db->order_by('id', 'asc');

        return $this->db->get()->result();
    }

    function get_quem_somos_detalhes($id) {
        $this->db->select("*");
        $this->db->from("quem_somos");
        $this->db->where("id", $id);
        return $this->db->get()->row();
    }

    function salvar($data) {
        $this->db->insert('quem_somos', $data);
        return true;
    }

    function atualizar($data, $dataWhere) {
        $this->db->update('quem_somos', $data, $dataWhere);
        return true;
    }

    function excluir($id) {
        if ($this->db->delete('quem_somos', array('id' => $id)))
            return true;
        else
            return false;
    }

    function get_imagem_quem_somos_detalhes($id) {
        $this->db->select('imagem');
        $this->db->from('quem_somos');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function get_imagem_quem_somos_detalhes2($id) {
        $this->db->select('imagem2');
        $this->db->from('quem_somos');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function subir($id, $sort)
    {
        $newSort = $sort + 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('quem_somos');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $idrebaixado = $result->row()->id;
            $sortRebaixado = $result->row()->sort - 1;
            $this->db->where('id', $idrebaixado);
            $this->db->set('sort', $sortRebaixado);
            $this->db->update('quem_somos');
        }
        $this->db->where('id', $id);
        $this->db->set('sort', $newSort);
        $this->db->update('quem_somos');
        return TRUE;
    }

    public function descer($id, $sort)
    {
        $newSort = $sort - 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('quem_somos');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $idelevado = $result->row()->id;
            $sortElevado = $result->row()->sort + 1;
            $this->db->where('id', $idelevado);
            $this->db->set('sort', $sortElevado);
            $this->db->update('quem_somos');
        }
        $this->db->where('id', $id);
        $this->db->set('sort', $newSort);
        $this->db->update('quem_somos');
        return TRUE;
    }

    public function rearrange()
    {
        $result = $this->db->get('quem_somos')->result();
        $x = 1;
        foreach ($result as $quem_somos_detalhes) {
            $this->db->where('id', $quem_somos_detalhes->id);
            $this->db->set('sort', $x);
            $this->db->update('quem_somos');
            $x++;
        }        
    }

    function slug($string, $type = '-') {
        $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';

        $string = utf8_decode($string);
        $string = str_replace('?', '', $string);
        $string = str_replace('&', '', $string);
        $string = str_replace('(', '', $string);
        $string = str_replace(')', '', $string);
        $string = str_replace('.', '', $string);
        $string = str_replace(' – ', '-', $string);
        $string = str_replace('%', 'porcento', $string);
        $string = strtr($string, utf8_decode($a), $b);
        $string = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);
        $string = str_replace(' - ', '-', $string);
        $string = str_replace(' ', '-', $string);
        $string = strtolower($string);
        return utf8_encode($string);
    }

}
?>