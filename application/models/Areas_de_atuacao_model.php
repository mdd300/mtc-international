<?php

class Areas_de_atuacao_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_areas_de_atuacao_detalhes_sort($sort){
        $this->db->select('*');
        $this->db->from('areas_de_atuacao');
        $this->db->where('sort', $sort);
        
        return $this->db->get()->result();
    }

    function get_sort() {
        $this->db->select('sort');
        $this->db->from('areas_de_atuacao');

        $result = $this->db->get()->num_rows();
        return $result + 1;
    }

    function count_areas_de_atuacao(){
        return $this->db->count_all('areas_de_atuacao');
    }

    function get_areas_de_atuacao_site() {
        $this->db->select('*')
                 ->from('areas_de_atuacao');

        return $this->db->get()->row();
    }

    function get_areas_de_atuacao($status = "") {
        $this->db->select('*');
        $this->db->from('areas_de_atuacao');

        if ($status != '') {
            $this->db->where('habilitado', $status);
        }

        $this->db->order_by('id', 'asc');

        return $this->db->get()->result();
    }

    function get_areas_de_atuacao_detalhes($id) {
        $this->db->select("*");
        $this->db->from("areas_de_atuacao");
        $this->db->where("id", $id);
        return $this->db->get()->row();
    }

    function salvar($data) {
        $this->db->insert('areas_de_atuacao', $data);
        return true;
    }

    function atualizar($data, $dataWhere) {
        $this->db->update('areas_de_atuacao', $data, $dataWhere);
        return true;
    }

    function excluir($id) {
        if ($this->db->delete('areas_de_atuacao', array('id' => $id)))
            return true;
        else
            return false;
    }

    function get_imagem_areas_de_atuacao_detalhes($id) {
        $this->db->select('imagem');
        $this->db->from('areas_de_atuacao');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function get_imagem_areas_de_atuacao_detalhes2($id) {
        $this->db->select('imagem2');
        $this->db->from('areas_de_atuacao');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function subir($id, $sort)
    {
        $newSort = $sort + 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('areas_de_atuacao');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $idrebaixado = $result->row()->id;
            $sortRebaixado = $result->row()->sort - 1;
            $this->db->where('id', $idrebaixado);
            $this->db->set('sort', $sortRebaixado);
            $this->db->update('areas_de_atuacao');
        }
        $this->db->where('id', $id);
        $this->db->set('sort', $newSort);
        $this->db->update('areas_de_atuacao');
        return TRUE;
    }

    public function descer($id, $sort)
    {
        $newSort = $sort - 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('areas_de_atuacao');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $idelevado = $result->row()->id;
            $sortElevado = $result->row()->sort + 1;
            $this->db->where('id', $idelevado);
            $this->db->set('sort', $sortElevado);
            $this->db->update('areas_de_atuacao');
        }
        $this->db->where('id', $id);
        $this->db->set('sort', $newSort);
        $this->db->update('areas_de_atuacao');
        return TRUE;
    }

    public function rearrange()
    {
        $result = $this->db->get('areas_de_atuacao')->result();
        $x = 1;
        foreach ($result as $areas_de_atuacao_detalhes) {
            $this->db->where('id', $areas_de_atuacao_detalhes->id);
            $this->db->set('sort', $x);
            $this->db->update('areas_de_atuacao');
            $x++;
        }        
    }
}
?>