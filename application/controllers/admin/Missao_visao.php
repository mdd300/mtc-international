<?php

class Missao_visao extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('missao_visao_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["missao_visao"] = $this->missao_visao_model->get_missao_visao();
            $this->load->view('admin/missao_visao/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['missao_visao_detalhes'] = '';
        $this->load->view('admin/missao_visao/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['sort'] = $this->missao_visao_model->get_sort();
        $data['habilitado'] = $this->input->post("habilitado");

        $this->db->insert('missao_visao', $data);
        $this->session->set_flashdata('messages', 'missao_visao_detalhes inserida com sucesso.');
        redirect('admin/missao_visao', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/missao_visao', 'location');
        }

        $this->data['missao_visao_detalhes'] = $this->missao_visao_model->get_missao_visao_detalhes($id);
        $this->load->view('admin/missao_visao/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        if ($this->missao_visao_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Registro atualizado com sucesso.');
            redirect('admin/missao_visao', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o registro. Tente novamente.');
            redirect('admin/missao_visao', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/missao_visao');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('missao_visao');
        }

        $missao_visao = explode(';', $ids);
        for ($i = 0; $i <= count($missao_visao) - 1; $i++) {

            if (!$this->missao_visao_model->excluir($missao_visao[$i])) {
                $ok = false;
                $erros[] = $missao_visao[$i];
            }
        }
        
        // $result = mysql_query("SELECT * FROM missao_visao") or die(mysql_error());
        // $x = 1;
        // while ($row = mysql_fetch_row($result)) {
        //     $id = $row[0];
        //     mysql_query("UPDATE missao_visao SET sort = '$x' WHERE id = '$id'") or die(mysql_error());
        //     $x++;
        // }

        if ($ok) {
            $this->session->set_flashdata('messages', 'itens excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $missao_visao_detalhes = $this->missao_visao_detalhes_model->get_missao_visao_detalhes($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $missao_visao_detalhes->titulo . ", ";
                else
                    $msg .= $missao_visao_detalhes->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes itens não foram excluidas: ' . $msg);
        }
    }

    public function subir($id, $sort) {
        if (!$this->missao_visao_model->subir($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }       
        
        redirect('admin/missao_visao', 'location');
    }

    public function descer($id, $sort) {
        if (!$this->missao_visao_model->descer($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }
        redirect('admin/missao_visao', 'location');
    }

}

?>