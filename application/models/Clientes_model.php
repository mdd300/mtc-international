<?php

class clientes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_cliente_sort($sort){
        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where('sort', $sort);
        
        return $this->db->get()->result();
    }

    function get_sort() {
        $this->db->select('sort');
        $this->db->from('clientes');

        $result = $this->db->get()->num_rows();
        return $result + 1;
    }

    function count_clientes(){
        return $this->db->count_all('clientes');
    }

    function get_clientes($status = "") {
        $this->db->select('*');
        $this->db->from('clientes');

        if ($status != '') {
            $this->db->where('habilitado', $status);
        }

        $this->db->order_by('sort', 'DESC');

        return $this->db->get()->result();
    }

    function upload_foto($field) {
        $dir = realpath('assets/uploads/clientes');
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '500000';
        $config['max_width'] = '10024';
        $config['max_height'] = '7068';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $field_name = $field;

        if ($this->upload->do_upload($field_name)) {
            $dados = $this->upload->data();

            $this->load->library('image_lib');

            $size = getimagesize($dados['full_path']);

            $config_img['image_library'] = 'GD2';
            $config_img['source_image'] = $dados['full_path'];
            $config_img['create_thumb'] = FALSE;
            $config_img['maintain_ratio'] = FALSE;
            $config_img['encrypt_name'] = TRUE;

            // if ($size[0] > $size[1]) {
            //     $config_img['width'] = '2000';
            //     $config_img['height'] = $size[1];
            // } else {
            //     $config_img['width'] = $size[0];
            //     $config_img['height'] = '2000';
            // }

            $config_img['width'] = 270;
            $config_img['height'] = 270;


            $this->image_lib->initialize($config_img);
            $this->image_lib->crop();

            // Returns the photo name
            return $dados['file_name'];
        } else {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }
    }

    function get_cliente($clienteID) {
        $this->db->select("*");
        $this->db->from("clientes");
        $this->db->where("clienteID", $clienteID);
        return $this->db->get()->row();
    }

    function salvar($data) {
        $this->db->insert('clientes', $data);
        return true;
    }

    function atualizar($data, $dataWhere) {
        $this->db->update('clientes', $data, $dataWhere);
        return true;
    }

    function excluir($clienteID) {
        if ($this->db->delete('clientes', array('clienteID' => $clienteID)))
            return true;
        else
            return false;
    }

    function get_imagem_cliente($clienteID) {
        $this->db->select('imagem');
        $this->db->from('clientes');
        $this->db->where('clienteID', $clienteID);       

        return $this->db->get()->row();
    }

    function get_imagem_cliente2($clienteID) {
        $this->db->select('imagem2');
        $this->db->from('clientes');
        $this->db->where('clienteID', $clienteID);       

        return $this->db->get()->row();
    }

    function subir($clienteID, $sort)
    {
        $newSort = $sort + 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('clientes');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $clienteIDrebaixado = $result->row()->clienteID;
            $sortRebaixado = $result->row()->sort - 1;
            $this->db->where('clienteID', $clienteIDrebaixado);
            $this->db->set('sort', $sortRebaixado);
            $this->db->update('clientes');
        }
        $this->db->where('clienteID', $clienteID);
        $this->db->set('sort', $newSort);
        $this->db->update('clientes');
        return TRUE;
    }

    public function descer($clienteID, $sort)
    {
        $newSort = $sort - 1;
        $this->db->where('sort', $newSort);
        $result = $this->db->get('clientes');
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            $clienteIDelevado = $result->row()->clienteID;
            $sortElevado = $result->row()->sort + 1;
            $this->db->where('clienteID', $clienteIDelevado);
            $this->db->set('sort', $sortElevado);
            $this->db->update('clientes');
        }
        $this->db->where('clienteID', $clienteID);
        $this->db->set('sort', $newSort);
        $this->db->update('clientes');
        return TRUE;
    }

    public function rearrange()
    {
        $result = $this->db->get('clientes')->result();
        $x = 1;
        foreach ($result as $cliente) {
            $this->db->where('clienteID', $cliente->clienteID);
            $this->db->set('sort', $x);
            $this->db->update('clientes');
            $x++;
        }        
    }


}
?>