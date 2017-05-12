<?php

class Operacoes extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('operacoes_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["operacoes"] = $this->operacoes_model->get_operacoes();
            $this->load->view('admin/operacoes/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['operacoes_detalhes'] = '';
        $this->load->view('admin/operacoes/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['sort'] = $this->operacoes_model->get_sort();
        $data['habilitado'] = $this->input->post("habilitado");

        $this->db->insert('operacoes', $data);
        $this->session->set_flashdata('messages', 'Registro inserido com sucesso.');
        redirect('admin/operacoes', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/operacoes', 'location');
        }

        $this->data['operacoes_detalhes'] = $this->operacoes_model->get_operacoes_detalhes($id);
        $this->load->view('admin/operacoes/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        if ($this->operacoes_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Registro atualizado com sucesso.');
            redirect('admin/operacoes', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o registro. Tente novamente.');
            redirect('admin/operacoes', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/operacoes');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('operacoes');
        }

        $operacoes = explode(';', $ids);
        for ($i = 0; $i <= count($operacoes) - 1; $i++) {

            if (!$this->operacoes_model->excluir($operacoes[$i])) {
                $ok = false;
                $erros[] = $operacoes[$i];
            }
        }
        
        // $result = mysql_query("SELECT * FROM operacoes") or die(mysql_error());
        // $x = 1;
        // while ($row = mysql_fetch_row($result)) {
        //     $id = $row[0];
        //     mysql_query("UPDATE operacoes SET sort = '$x' WHERE id = '$id'") or die(mysql_error());
        //     $x++;
        // }

        if ($ok) {
            $this->session->set_flashdata('messages', 'itens excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $operacoes_detalhes = $this->operacoes_detalhes_model->get_operacoes_detalhes($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $operacoes_detalhes->titulo . ", ";
                else
                    $msg .= $operacoes_detalhes->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes itens não foram excluidas: ' . $msg);
        }
    }

    public function subir($id, $sort) {
        if (!$this->operacoes_model->subir($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }       
        
        redirect('admin/operacoes', 'location');
    }

    public function descer($id, $sort) {
        if (!$this->operacoes_model->descer($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }
        redirect('admin/operacoes', 'location');
    }

}

?>