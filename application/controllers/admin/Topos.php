<?php

class Topos extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('topos_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["topos"] = $this->topos_model->get_topos();
            $this->load->view('admin/topos/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['topo'] = '';
        $this->load->view('admin/topos/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['habilitado'] = $this->input->post("habilitado");

        $imagem = $this->topos_model->upload_foto('imagem');
         
        if (!is_array($imagem) && isset($imagem)) {
            if (!is_array($imagem)) {
                $data['imagem'] = $imagem;
            }
        }

        $this->db->insert('topos', $data);
        $this->session->set_flashdata('messages', 'topo inserida com sucesso.');
        redirect('admin/topos', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/topos', 'location');
        }

        $this->data['topo'] = $this->topos_model->get_topo_id($id);
        $this->load->view('admin/topos/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        $img_nome = $this->topos_model->upload_foto('imagem');

        if (!is_array($img_nome) && isset($img_nome)) {
            $data['imagem'] = $img_nome;
        }
        // echo "<pre>";
        // var_dump('oi');
        // exit;

        if ($this->topos_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'topo atualizado com sucesso.');
            redirect('admin/topos', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o topo. Tente novamente.');
            redirect('admin/topos', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/topos');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('topos');
        }

        $topos = explode(';', $ids);
        for ($i = 0; $i <= count($topos) - 1; $i++) {

            if (!$this->topos_model->excluir($topos[$i])) {
                $ok = false;
                $erros[] = $topos[$i];
            }
        }
    

        if ($ok) {
            $this->session->set_flashdata('messages', 'topos excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $topo = $this->topo_model->get_topo($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $topo->titulo . ", ";
                else
                    $msg .= $topo->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes topos não foram excluidas: ' . $msg);
        }
    }

}

?>