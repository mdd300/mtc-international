<?php

class Clientes_descricao_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_clientes_descricao_detalhes_sort($sort){
        $this->db->select('*');
        $this->db->from('clientes_descricao');
        $this->db->where('sort', $sort);
        
        return $this->db->get()->result();
    }

    function get_sort() {
        $this->db->select('sort');
        $this->db->from('clientes_descricao');

        $result = $this->db->get()->num_rows();
        return $result + 1;
    }

    function count_clientes_descricao(){
        return $this->db->count_all('clientes_descricao');
    }

    function get_clientes_descricao_site() {
        $this->db->select('*')
                 ->from('clientes_descricao');

        return $this->db->get()->row();
    }

    function get_clientes_descricao($status = "") {
        $this->db->select('*');
        $this->db->from('clientes_descricao');

        if ($status != '') {
            $this->db->where('habilitado', $status);
        }

        $this->db->order_by('id', 'asc');

        return $this->db->get()->result();
    }

    function get_clientes_descricao_detalhes($id) {
        $this->db->select("*");
        $this->db->from("clientes_descricao");
        $this->db->where("id", $id);
        return $this->db->get()->row();
    }

    function salvar($data) {
        $this->db->insert('clientes_descricao', $data);
        return true;
    }

    function atualizar($data, $dataWhere) {
        $this->db->update('clientes_descricao', $data, $dataWhere);
        return true;
    }

    function excluir($id) {
        if ($this->db->delete('clientes_descricao', array('id' => $id)))
            return true;
        else
            return false;
    }

    function get_imagem_clientes_descricao_detalhes($id) {
        $this->db->select('imagem');
        $this->db->from('clientes_descricao');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function get_imagem_clientes_descricao_detalhes2($id) {
        $this->db->select('imagem2');
        $this->db->from('clientes_descricao');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function subir($id, $sort)
    {
        $newSort = $sort + 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('clientes_descricao');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $idrebaixado = $result->row()->id;
            $sortRebaixado = $result->row()->sort - 1;
            $this->db->where('id', $idrebaixado);
            $this->db->set('sort', $sortRebaixado);
            $this->db->update('clientes_descricao');
        }
        $this->db->where('id', $id);
        $this->db->set('sort', $newSort);
        $this->db->update('clientes_descricao');
        return TRUE;
    }

    public function descer($id, $sort)
    {
        $newSort = $sort - 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('clientes_descricao');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $idelevado = $result->row()->id;
            $sortElevado = $result->row()->sort + 1;
            $this->db->where('id', $idelevado);
            $this->db->set('sort', $sortElevado);
            $this->db->update('clientes_descricao');
        }
        $this->db->where('id', $id);
        $this->db->set('sort', $newSort);
        $this->db->update('clientes_descricao');
        return TRUE;
    }

    public function rearrange()
    {
        $result = $this->db->get('clientes_descricao')->result();
        $x = 1;
        foreach ($result as $clientes_descricao_detalhes) {
            $this->db->where('id', $clientes_descricao_detalhes->id);
            $this->db->set('sort', $x);
            $this->db->update('clientes_descricao');
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