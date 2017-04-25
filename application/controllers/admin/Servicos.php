<?php

class Servicos extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["servicos"] = $this->servicos_model->get_servicos();
            $this->load->view('admin/servicos/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['servicos_detalhes'] = '';
        $this->load->view('admin/servicos/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['sort'] = $this->servicos_model->get_sort();
        $data['habilitado'] = $this->input->post("habilitado");

        $this->db->insert('servicos', $data);
        $this->session->set_flashdata('messages', 'Registro inserido com sucesso.');
        redirect('admin/servicos', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/servicos', 'location');
        }

        $this->data['servicos_detalhes'] = $this->servicos_model->get_servicos_detalhes($id);
        $this->load->view('admin/servicos/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        if ($this->servicos_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Registro atualizado com sucesso.');
            redirect('admin/servicos', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o registro. Tente novamente.');
            redirect('admin/servicos', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/servicos');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('servicos');
        }

        $servicos = explode(';', $ids);
        for ($i = 0; $i <= count($servicos) - 1; $i++) {

            if (!$this->servicos_model->excluir($servicos[$i])) {
                $ok = false;
                $erros[] = $servicos[$i];
            }
        }
        
        // $result = mysql_query("SELECT * FROM servicos") or die(mysql_error());
        // $x = 1;
        // while ($row = mysql_fetch_row($result)) {
        //     $id = $row[0];
        //     mysql_query("UPDATE servicos SET sort = '$x' WHERE id = '$id'") or die(mysql_error());
        //     $x++;
        // }

        if ($ok) {
            $this->session->set_flashdata('messages', 'itens excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $servicos_detalhes = $this->servicos_detalhes_model->get_servicos_detalhes($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $servicos_detalhes->titulo . ", ";
                else
                    $msg .= $servicos_detalhes->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes itens não foram excluidas: ' . $msg);
        }
    }

    public function subir($id, $sort) {
        if (!$this->servicos_model->subir($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }       
        
        redirect('admin/servicos', 'location');
    }

    public function descer($id, $sort) {
        if (!$this->servicos_model->descer($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }
        redirect('admin/servicos', 'location');
    }

}

?>