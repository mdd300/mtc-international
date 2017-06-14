<?php

class File_upload_model extends CI_Model {

    function file_upload(
        $field,         //arquivo
        $path,          //a pastar, dentro de assets/uploads onde será feito o upload
        $config = false,
        $width = NULL,  //largura (opcional)
        $height = NULL  //altura (opcional)
        )
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('image_lib');


        $dir = realpath('assets/uploads/' . $path);
        $config['upload_path'] = $dir;
        $config['allowed_types'] = ($config) ? $config : 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['max_size'] = '500000';
        $config['max_width'] = '10024';
        $config['max_height'] = '7068';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $field_name = $field;


        if ($this->upload->do_upload($field_name)) {
            $dados = $this->upload->data();
            $size = getimagesize($dados['full_path']);

            $config_img['image_library'] = 'GD2';
            $config_img['source_image'] = $dados['full_path'];
            $config_img['create_thumb'] = FALSE;
            $config_img['maintain_ratio'] = TRUE;
            $config_img['encrypt_name'] = TRUE;   

            $config_img['width'] = $width;   //'270px'
            $config_img['height'] = $height;   //'131px'
            $this->image_lib->initialize($config_img);

            $config['source_image'] = $dir.'/'.$dados['file_name'];
            $this->image_lib->resize($config['source_image']);
            // Returns the photo name
            return $dados['file_name'];
        } else {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }
    


    }

    function file_multiple_upload(
    $field,         //arquivo
    $path,          //a pastar, dentro de assets/uploads onde será feito o upload
    $width = NULL,  //largura (opcional)
    $height = NULL  //altura (opcional)
    )
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('image_lib');


        $dir = realpath('assets/uploads/' . $path);
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['max_size'] = '500000';
        $config['max_width'] = '10024';
        $config['max_height'] = '7068';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $field_name = $field;


        if ($this->upload->do_multi_upload($field_name)) {
            $dados = $this->upload->get_multi_upload_data();

            $files = array();
            foreach ($dados as $file) {
                $size = getimagesize($file['full_path']);
                $config_img['image_library'] = 'GD2';
                $config_img['source_image'] = $file['full_path'];
                $config_img['create_thumb'] = FALSE;
                $config_img['maintain_ratio'] = TRUE;
                $config_img['encrypt_name'] = TRUE; 

                $config_img['width'] = $width;   //'270px'
                $config_img['height'] = $height;   //'131px'
                $this->image_lib->initialize($config_img);

                $config['source_image'] = $dir.'/'.$file['file_name'];
                $this->image_lib->resize($config['source_image']);

                $files[] = $file['file_name'];
            }
            return $files;
            
        } else {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }
    


    }
}

?>