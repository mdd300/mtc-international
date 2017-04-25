<?php

class Servicos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_servicos_detalhes_sort($sort){
        $this->db->select('*');
        $this->db->from('servicos');
        $this->db->where('sort', $sort);
        
        return $this->db->get()->result();
    }

    function get_sort() {
        $this->db->select('sort');
        $this->db->from('servicos');

        $result = $this->db->get()->num_rows();
        return $result + 1;
    }

    function count_servicos(){
        return $this->db->count_all('servicos');
    }

    function get_servicos_site() {
        $this->db->select('*')
                 ->from('servicos');

        return $this->db->get()->row();
    }

    function get_servicos($status = "") {
        $this->db->select('*');
        $this->db->from('servicos');

        if ($status != '') {
            $this->db->where('habilitado', $status);
        }

        $this->db->order_by('id', 'asc');

        return $this->db->get()->result();
    }

    function get_servicos_detalhes($id) {
        $this->db->select("*");
        $this->db->from("servicos");
        $this->db->where("id", $id);
        return $this->db->get()->row();
    }

    function salvar($data) {
        $this->db->insert('servicos', $data);
        return true;
    }

    function atualizar($data, $dataWhere) {
        $this->db->update('servicos', $data, $dataWhere);
        return true;
    }

    function excluir($id) {
        if ($this->db->delete('servicos', array('id' => $id)))
            return true;
        else
            return false;
    }

    function get_imagem_servicos_detalhes($id) {
        $this->db->select('imagem');
        $this->db->from('servicos');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function get_imagem_servicos_detalhes2($id) {
        $this->db->select('imagem2');
        $this->db->from('servicos');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function subir($id, $sort)
    {
        $newSort = $sort + 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('servicos');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $idrebaixado = $result->row()->id;
            $sortRebaixado = $result->row()->sort - 1;
            $this->db->where('id', $idrebaixado);
            $this->db->set('sort', $sortRebaixado);
            $this->db->update('servicos');
        }
        $this->db->where('id', $id);
        $this->db->set('sort', $newSort);
        $this->db->update('servicos');
        return TRUE;
    }

    public function descer($id, $sort)
    {
        $newSort = $sort - 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('servicos');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $idelevado = $result->row()->id;
            $sortElevado = $result->row()->sort + 1;
            $this->db->where('id', $idelevado);
            $this->db->set('sort', $sortElevado);
            $this->db->update('servicos');
        }
        $this->db->where('id', $id);
        $this->db->set('sort', $newSort);
        $this->db->update('servicos');
        return TRUE;
    }

    public function rearrange()
    {
        $result = $this->db->get('servicos')->result();
        $x = 1;
        foreach ($result as $servicos_detalhes) {
            $this->db->where('id', $servicos_detalhes->id);
            $this->db->set('sort', $x);
            $this->db->update('servicos');
            $x++;
        }        
    }
}
?>