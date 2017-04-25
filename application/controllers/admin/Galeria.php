<?php

class Galeria extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('galeria_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["galerias"] = $this->galeria_model->get_galerias();
            $this->load->view('admin/galeria/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->load->view('admin/galeria/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['habilitado'] = $this->input->post("habilitado");

        $data['sort'] = $this->galeria_model->get_sort();

        $imagem = $this->galeria_model->upload_foto('imagem');
         
        if (!is_array($imagem) && isset($imagem)) {
            if (!is_array($imagem)) {
                $data['imagem'] = $imagem;
            }
        }

        $this->db->insert('galerias', $data);
        $this->session->set_flashdata('messages', 'galeria inserida com sucesso.');
        redirect('admin/galeria', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/galeria', 'location');
        }

        $this->data['galeria'] = $this->galeria_model->get_galeria($id);
        $this->load->view('admin/galeria/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        $img_nome = $this->galeria_model->upload_foto('imagem');

        if (!is_array($img_nome) && isset($img_nome)) {
            if (!is_array($img_nome)) {
                @$imagem = $this->galeria_model->get_imagem_galeria($id);
                if (@$imagem) {
                    unlink('assets/uploads/galerias/' . $imagem);
                }
                $data['imagem'] = $img_nome;
            }
        }

        if ($this->galeria_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'galeria atualizado com sucesso.');
            redirect('admin/galeria', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o galeria. Tente novamente.');
            redirect('admin/galeria', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/galeria');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('galerias');
        }

        $galerias = explode(';', $ids);
        for ($i = 0; $i <= count($galerias) - 1; $i++) {
            if (!$this->galeria_model->excluir($galerias[$i])) {
                $ok = false;
                $erros[] = $galerias[$i];
            }
        }
        echo "<pre>";
        var_dump($ids);
        exit;
        if(!$ok){
            $this->session->set_flashdata('errors', 'Algumas notícias não foram excluídas.');
        }else{
            $this->session->set_flashdata('messages', 'Notícias excluídas com sucesso.');
        }
    }

    public function subir($id, $sort) {
        if (!$this->galeria_model->subir($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os galerias, tente novamente.');
        }       

        redirect('admin/galeria', 'location');
    }

    public function descer($id, $sort) {
        if (!$this->galeria_model->descer($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os galerias, tente novamente.');
        }
        redirect('admin/galeria', 'location');
    }

}

?>