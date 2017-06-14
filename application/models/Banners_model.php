<?php

class banners_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_banner_sort($sort){
        $this->db->select('*');
        $this->db->from('banners');
        $this->db->where('sort', $sort);
        
        return $this->db->get()->result();
    }

    function get_sort() {
        $this->db->select('sort');
        $this->db->from('banners');

        $result = $this->db->get()->num_rows();
        return $result + 1;
    }

    function count_banners(){
        return $this->db->count_all('banners');
    }

    function get_banners($status = "") {
        $this->db->select('*');
        $this->db->from('banners');

        if ($status != '') {
            $this->db->where('habilitado', $status);
        }

        $this->db->order_by('sort', 'ASC');

        return $this->db->get()->result();
    }

    function upload_foto($field) {
        $dir = realpath('assets/uploads/banners');
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
            $config_img['maintain_ratio'] = TRUE;
            $config_img['encrypt_name'] = TRUE;

            // if ($size[0] > $size[1]) {
            //     $config_img['width'] = '2000';
            //     $config_img['height'] = $size[1];
            // } else {
            //     $config_img['width'] = $size[0];
            //     $config_img['height'] = '2000';
            // }

            $config_img['width'] = 1920;
            $config_img['height'] = 500;


            $this->image_lib->initialize($config_img);
            $this->image_lib->crop();

            // Returns the photo name
            return $dados['file_name'];
        } else {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }
    }

    function get_banner($id) {
        $this->db->select("*");
        $this->db->from("banners");
        $this->db->where("id", $id);
        return $this->db->get()->row();
    }

    function salvar($data) {
        $this->db->insert('banners', $data);
        return true;
    }

    function atualizar($data, $dataWhere) {
        $this->db->update('banners', $data, $dataWhere);
        return true;
    }

    function excluir($id) {
        if ($this->db->delete('banners', array('id' => $id)))
            return true;
        else
            return false;
    }

    function get_imagem_banner($id) {
        $this->db->select('imagem');
        $this->db->from('banners');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    function get_imagem_banner2($id) {
        $this->db->select('imagem2');
        $this->db->from('banners');
        $this->db->where('id', $id);       

        return $this->db->get()->row();
    }

    public function atualizar_ordem($id, $sort)
    {
        $this->db->set('sort', $sort);
        $this->db->where('id', $id);
        $this->db->update('banners');
        return true;
    }

    public function rearrange()
    {
        $result = $this->db->get('banners')->result();
        $x = 1;
        foreach ($result as $banner) {
            $this->db->where('id', $banner->id);
            $this->db->set('sort', $x);
            $this->db->update('banners');
            $x++;
        }        
    }


}
?>