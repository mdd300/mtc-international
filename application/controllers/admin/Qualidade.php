<?php

class Qualidade extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('qualidade_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["qualidade"] = $this->qualidade_model->get_qualidade();
            $this->load->view('admin/qualidade/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['qualidade_detalhes'] = '';
        $this->load->view('admin/qualidade/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['sort'] = $this->qualidade_model->get_sort();
        $data['habilitado'] = $this->input->post("habilitado");

        $this->db->insert('qualidade', $data);
        $this->session->set_flashdata('messages', 'Registro inserido com sucesso.');
        redirect('admin/qualidade', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/qualidade', 'location');
        }

        $this->data['qualidade_detalhes'] = $this->qualidade_model->get_qualidade_detalhes($id);
        $this->load->view('admin/qualidade/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        if ($this->qualidade_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Registro atualizado com sucesso.');
            redirect('admin/qualidade', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o registro. Tente novamente.');
            redirect('admin/qualidade', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/qualidade');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('qualidade');
        }

        $qualidade = explode(';', $ids);
        for ($i = 0; $i <= count($qualidade) - 1; $i++) {

            if (!$this->qualidade_model->excluir($qualidade[$i])) {
                $ok = false;
                $erros[] = $qualidade[$i];
            }
        }
        
        // $result = mysql_query("SELECT * FROM qualidade") or die(mysql_error());
        // $x = 1;
        // while ($row = mysql_fetch_row($result)) {
        //     $id = $row[0];
        //     mysql_query("UPDATE qualidade SET sort = '$x' WHERE id = '$id'") or die(mysql_error());
        //     $x++;
        // }

        if ($ok) {
            $this->session->set_flashdata('messages', 'itens excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $qualidade_detalhes = $this->qualidade_detalhes_model->get_qualidade_detalhes($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $qualidade_detalhes->titulo . ", ";
                else
                    $msg .= $qualidade_detalhes->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes itens não foram excluidas: ' . $msg);
        }
    }

    public function subir($id, $sort) {
        if (!$this->qualidade_model->subir($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }       
        
        redirect('admin/qualidade', 'location');
    }

    public function descer($id, $sort) {
        if (!$this->qualidade_model->descer($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }
        redirect('admin/qualidade', 'location');
    }

}

?>