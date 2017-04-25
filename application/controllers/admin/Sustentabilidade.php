<?php

class Sustentabilidade extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('sustentabilidade_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["sustentabilidade"] = $this->sustentabilidade_model->get_sustentabilidade();
            $this->load->view('admin/sustentabilidade/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['sustentabilidade_detalhes'] = '';
        $this->load->view('admin/sustentabilidade/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['sort'] = $this->sustentabilidade_model->get_sort();
        $data['habilitado'] = $this->input->post("habilitado");

        $this->db->insert('sustentabilidade', $data);
        $this->session->set_flashdata('messages', 'Registro inserido com sucesso.');
        redirect('admin/sustentabilidade', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/sustentabilidade', 'location');
        }

        $this->data['sustentabilidade_detalhes'] = $this->sustentabilidade_model->get_sustentabilidade_detalhes($id);
        $this->load->view('admin/sustentabilidade/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        if ($this->sustentabilidade_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Registro atualizado com sucesso.');
            redirect('admin/sustentabilidade', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o registro. Tente novamente.');
            redirect('admin/sustentabilidade', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/sustentabilidade');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('sustentabilidade');
        }

        $sustentabilidade = explode(';', $ids);
        for ($i = 0; $i <= count($sustentabilidade) - 1; $i++) {

            if (!$this->sustentabilidade_model->excluir($sustentabilidade[$i])) {
                $ok = false;
                $erros[] = $sustentabilidade[$i];
            }
        }
        
        // $result = mysql_query("SELECT * FROM sustentabilidade") or die(mysql_error());
        // $x = 1;
        // while ($row = mysql_fetch_row($result)) {
        //     $id = $row[0];
        //     mysql_query("UPDATE sustentabilidade SET sort = '$x' WHERE id = '$id'") or die(mysql_error());
        //     $x++;
        // }

        if ($ok) {
            $this->session->set_flashdata('messages', 'itens excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $sustentabilidade_detalhes = $this->sustentabilidade_detalhes_model->get_sustentabilidade_detalhes($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $sustentabilidade_detalhes->titulo . ", ";
                else
                    $msg .= $sustentabilidade_detalhes->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes itens não foram excluidas: ' . $msg);
        }
    }

    public function subir($id, $sort) {
        if (!$this->sustentabilidade_model->subir($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }       
        
        redirect('admin/sustentabilidade', 'location');
    }

    public function descer($id, $sort) {
        if (!$this->sustentabilidade_model->descer($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }
        redirect('admin/sustentabilidade', 'location');
    }

}

?>