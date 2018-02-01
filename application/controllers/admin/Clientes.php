<?php

class Clientes extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('clientes_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["clientes"] = $this->clientes_model->get_clientes();
            $this->load->view('admin/clientes/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['cliente'] = '';
        $this->load->view('admin/clientes/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['sort'] = $this->clientes_model->get_sort();
        $data['habilitado'] = $this->input->post("habilitado");

        $imagem = $this->clientes_model->upload_foto('imagem');
         
        if (!is_array($imagem) && isset($imagem)) {
            if (!is_array($imagem)) {
                $data['imagem'] = $imagem;
            }
        }

        $this->db->insert('clientes', $data);
        $this->session->set_flashdata('messages', 'Cliente inserida com sucesso.');
        redirect('admin/clientes', 'location');
    }

    public function editar($clienteID = false) {
        if (!$clienteID) {
            redirect('admin/clientes', 'location');
        }

        $this->data['cliente'] = $this->clientes_model->get_cliente($clienteID);
        $this->load->view('admin/clientes/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['clienteID'] = $this->input->post("clienteID");
        $clienteID = $this->input->post("clienteID");
        unset($data['clienteID']);

        $img_nome = $this->clientes_model->upload_foto('imagem');

        if (!is_array($img_nome) && isset($img_nome)) {
            if (!is_array($img_nome)) {
                @$imagem = $this->clientes_model->get_imagem_cliente($clienteID);
                if (!empty($imagem)) {
                    unlink('assets/uploads/clientes/' . $imagem);
                }
                $data['imagem'] = $img_nome;
            }
        }

        if ($this->clientes_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Cliente atualizado com sucesso.');
            redirect('admin/clientes', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o cliente. Tente novamente.');
            redirect('admin/clientes', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/clientes');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('clientes');
        }

        $clientes = explode(';', $ids);
        for ($i = 0; $i <= count($clientes) - 1; $i++) {

            if (!$this->clientes_model->excluir($clientes[$i])) {
                $ok = false;
                $erros[] = $clientes[$i];
            }
        }
    

        if ($ok) {
            $this->session->set_flashdata('messages', 'Clientes excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $cliente = $this->cliente_model->get_cliente($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $cliente->titulo . ", ";
                else
                    $msg .= $cliente->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes clientes não foram excluidas: ' . $msg);
        }
    }

    public function subir($clienteID, $sort) {
        if (!$this->clientes_model->subir($clienteID, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os clientes, tente novamente.');
        }       
        
        redirect('admin/clientes', 'location');
    }

    public function descer($clienteID, $sort) {
        if (!$this->clientes_model->descer($clienteID, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os clientes, tente novamente.');
        }
        redirect('admin/clientes', 'location');
    }

}

?>
