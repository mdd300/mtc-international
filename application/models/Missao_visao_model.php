<?php

class Missao_visao_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_missao_visao_detalhes_sort($sort){
        $this->db->select('*');
        $this->db->from('missao_visao');
        $this->db->where('sort', $sort);
        
        return $this->db->get()->result();
    }

    function get_sort() {
        $this->db->select('sort');
        $this->db->from('missao_visao');

        $result = $this->db->get()->num_rows();
        return $result + 1;
    }

    function count_missao_visao(){
        return $this->db->count_all('missao_visao');
    }

    function get_missao_visao_site() {
        $this->db->select('*')
                 ->from('missao_visao');

        return $this->db->get()->row();
    }

    function get_missao_visao($status = "") {
        $this->db->select('*');
        $this->db->from('missao_visao');

        if ($status != '') {
            $this->db->where('habilitado', $status);
        }

        $this->db->order_by('id', 'asc');

        return $this->db->get()->result();
    }

    function get_missao_visao_detalhes($id) {
        $this->db->select("*");
        $this->db->from("missao_visao");
        $this->db->where("id", $id);
        return $this->db->get()->row();
    }

    function salvar($data) {
        $this->db->insert('missao_visao', $data);
        return true;
    }

    function atualizar($data, $dataWhere) {
        $this->db->update('missao_visao', $data, $dataWhere);
        return true;
    }

    function excluir($id) {
        if ($this->db->delete('missao_visao', array('id' => $id)))
            return true;
        else
            return false;
    }

    function get_imagem_missao_visao_detalhes($id) {
        $this->db->select('imagem');
        $this->db->from('missao_visao');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function get_imagem_missao_visao_detalhes2($id) {
        $this->db->select('imagem2');
        $this->db->from('missao_visao');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function subir($id, $sort)
    {
        $newSort = $sort + 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('missao_visao');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $idrebaixado = $result->row()->id;
            $sortRebaixado = $result->row()->sort - 1;
            $this->db->where('id', $idrebaixado);
            $this->db->set('sort', $sortRebaixado);
            $this->db->update('missao_visao');
        }
        $this->db->where('id', $id);
        $this->db->set('sort', $newSort);
        $this->db->update('missao_visao');
        return TRUE;
    }

    public function descer($id, $sort)
    {
        $newSort = $sort - 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('missao_visao');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $idelevado = $result->row()->id;
            $sortElevado = $result->row()->sort + 1;
            $this->db->where('id', $idelevado);
            $this->db->set('sort', $sortElevado);
            $this->db->update('missao_visao');
        }
        $this->db->where('id', $id);
        $this->db->set('sort', $newSort);
        $this->db->update('missao_visao');
        return TRUE;
    }

    public function rearrange()
    {
        $result = $this->db->get('missao_visao')->result();
        $x = 1;
        foreach ($result as $missao_visao_detalhes) {
            $this->db->where('id', $missao_visao_detalhes->id);
            $this->db->set('sort', $x);
            $this->db->update('missao_visao');
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