<?php

class Clientes_descricao extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('clientes_descricao_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["clientes_descricao"] = $this->clientes_descricao_model->get_clientes_descricao();
            $this->load->view('admin/clientes_descricao/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['clientes_descricao_detalhes'] = '';
        $this->load->view('admin/clientes_descricao/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['sort'] = $this->clientes_descricao_model->get_sort();
        $data['habilitado'] = $this->input->post("habilitado");

        $this->db->insert('clientes_descricao', $data);
        $this->session->set_flashdata('messages', 'clientes_descricao_detalhes inserida com sucesso.');
        redirect('admin/clientes_descricao', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/clientes_descricao', 'location');
        }

        $this->data['clientes_descricao_detalhes'] = $this->clientes_descricao_model->get_clientes_descricao_detalhes($id);
        $this->load->view('admin/clientes_descricao/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        if ($this->clientes_descricao_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Registro atualizado com sucesso.');
            redirect('admin/clientes_descricao', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o registro. Tente novamente.');
            redirect('admin/clientes_descricao', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/clientes_descricao');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('clientes_descricao');
        }

        $clientes_descricao = explode(';', $ids);
        for ($i = 0; $i <= count($clientes_descricao) - 1; $i++) {

            if (!$this->clientes_descricao_model->excluir($clientes_descricao[$i])) {
                $ok = false;
                $erros[] = $clientes_descricao[$i];
            }
        }
        
        // $result = mysql_query("SELECT * FROM clientes_descricao") or die(mysql_error());
        // $x = 1;
        // while ($row = mysql_fetch_row($result)) {
        //     $id = $row[0];
        //     mysql_query("UPDATE clientes_descricao SET sort = '$x' WHERE id = '$id'") or die(mysql_error());
        //     $x++;
        // }

        if ($ok) {
            $this->session->set_flashdata('messages', 'itens excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $clientes_descricao_detalhes = $this->clientes_descricao_detalhes_model->get_clientes_descricao_detalhes($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $clientes_descricao_detalhes->titulo . ", ";
                else
                    $msg .= $clientes_descricao_detalhes->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes itens não foram excluidas: ' . $msg);
        }
    }

    public function subir($id, $sort) {
        if (!$this->clientes_descricao_model->subir($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }       
        
        redirect('admin/clientes_descricao', 'location');
    }

    public function descer($id, $sort) {
        if (!$this->clientes_descricao_model->descer($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }
        redirect('admin/clientes_descricao', 'location');
    }

}

?>