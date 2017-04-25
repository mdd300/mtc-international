<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topos_model extends CI_Model {

    public function get_topo($active)
    {
        $this->db->select('*');
        $this->db->from('topos');
        $this->db->where('pagina', $active);
        return $this->db->get()->row();
    }

    public function get_topo_id($id)
    {
        $this->db->select('*');
        $this->db->from('topos');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function get_topos()
    {
        $this->db->select('*');
        $this->db->from('topos');
        $this->db->where('habilitado', 1);
        return $this->db->get()->result();
    }

    function salvar($data) {
        $this->db->insert('topos', $data);
        return true;
    }

    function atualizar($data, $dataWhere) {
        $this->db->update('topos', $data, $dataWhere);
        return true;
    }

    function excluir($id) {
        if ($this->db->delete('topos', array('id' => $id)))
            return true;
        else
            return false;
    }

    function upload_foto($field) {
        $dir = realpath('assets/uploads/topos');
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'gif|jpg|png';
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
            $config_img['maintain_ratio'] = false;
            $config_img['encrypt_name'] = TRUE;

            $config_img['width'] = 1903;
            $config_img['height'] = 169;


            $this->image_lib->initialize($config_img);
            $this->image_lib->crop();

            // Returns the photo name
            return $dados['file_name'];
        } else {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }
    }

}

/* End of file topos_model.php */
/* Location: ./application/models/topos_model.php */