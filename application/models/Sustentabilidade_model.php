<?php

class Sustentabilidade_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_sustentabilidade_detalhes_sort($sort){
        $this->db->select('*');
        $this->db->from('sustentabilidade');
        $this->db->where('sort', $sort);
        
        return $this->db->get()->result();
    }

    function get_sort() {
        $this->db->select('sort');
        $this->db->from('sustentabilidade');

        $result = $this->db->get()->num_rows();
        return $result + 1;
    }

    function count_sustentabilidade(){
        return $this->db->count_all('sustentabilidade');
    }

    function get_sustentabilidade_site() {
        $this->db->select('*')
                 ->from('sustentabilidade');

        return $this->db->get()->row();
    }

    function get_sustentabilidade($status = "") {
        $this->db->select('*');
        $this->db->from('sustentabilidade');

        if ($status != '') {
            $this->db->where('habilitado', $status);
        }

        $this->db->order_by('id', 'asc');

        return $this->db->get()->result();
    }

    function get_sustentabilidade_detalhes($id) {
        $this->db->select("*");
        $this->db->from("sustentabilidade");
        $this->db->where("id", $id);
        return $this->db->get()->row();
    }

    function salvar($data) {
        $this->db->insert('sustentabilidade', $data);
        return true;
    }

    function atualizar($data, $dataWhere) {
        $this->db->update('sustentabilidade', $data, $dataWhere);
        return true;
    }

    function excluir($id) {
        if ($this->db->delete('sustentabilidade', array('id' => $id)))
            return true;
        else
            return false;
    }

    function get_imagem_sustentabilidade_detalhes($id) {
        $this->db->select('imagem');
        $this->db->from('sustentabilidade');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function get_imagem_sustentabilidade_detalhes2($id) {
        $this->db->select('imagem2');
        $this->db->from('sustentabilidade');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function subir($id, $sort)
    {
        $newSort = $sort + 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('sustentabilidade');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $idrebaixado = $result->row()->id;
            $sortRebaixado = $result->row()->sort - 1;
            $this->db->where('id', $idrebaixado);
            $this->db->set('sort', $sortRebaixado);
            $this->db->update('sustentabilidade');
        }
        $this->db->where('id', $id);
        $this->db->set('sort', $newSort);
        $this->db->update('sustentabilidade');
        return TRUE;
    }

    public function descer($id, $sort)
    {
        $newSort = $sort - 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('sustentabilidade');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $idelevado = $result->row()->id;
            $sortElevado = $result->row()->sort + 1;
            $this->db->where('id', $idelevado);
            $this->db->set('sort', $sortElevado);
            $this->db->update('sustentabilidade');
        }
        $this->db->where('id', $id);
        $this->db->set('sort', $newSort);
        $this->db->update('sustentabilidade');
        return TRUE;
    }

    public function rearrange()
    {
        $result = $this->db->get('sustentabilidade')->result();
        $x = 1;
        foreach ($result as $sustentabilidade_detalhes) {
            $this->db->where('id', $sustentabilidade_detalhes->id);
            $this->db->set('sort', $x);
            $this->db->update('sustentabilidade');
            $x++;
        }        
    }
}
?>