<?php

class quem_somos extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('quem_somos_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["quem_somos"] = $this->quem_somos_model->get_quem_somos();
            $this->load->view('admin/quem_somos/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['quem_somos_detalhes'] = '';
        $this->load->view('admin/quem_somos/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['sort'] = $this->quem_somos_model->get_sort();
        $data['habilitado'] = $this->input->post("habilitado");

        $this->db->insert('quem_somos', $data);
        $this->session->set_flashdata('messages', 'quem_somos_detalhes inserida com sucesso.');
        redirect('admin/quem_somos', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/quem_somos', 'location');
        }

        $this->data['quem_somos_detalhes'] = $this->quem_somos_model->get_quem_somos_detalhes($id);
        $this->load->view('admin/quem_somos/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        if ($this->quem_somos_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Quem somos atualizado com sucesso.');
            redirect('admin/quem_somos', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o quem somos. Tente novamente.');
            redirect('admin/quem_somos', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/quem_somos');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('quem_somos');
        }

        $quem_somos = explode(';', $ids);
        for ($i = 0; $i <= count($quem_somos) - 1; $i++) {

            if (!$this->quem_somos_model->excluir($quem_somos[$i])) {
                $ok = false;
                $erros[] = $quem_somos[$i];
            }
        }
        
        // $result = mysql_query("SELECT * FROM quem_somos") or die(mysql_error());
        // $x = 1;
        // while ($row = mysql_fetch_row($result)) {
        //     $id = $row[0];
        //     mysql_query("UPDATE quem_somos SET sort = '$x' WHERE id = '$id'") or die(mysql_error());
        //     $x++;
        // }

        if ($ok) {
            $this->session->set_flashdata('messages', 'itens excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $quem_somos_detalhes = $this->quem_somos_detalhes_model->get_quem_somos_detalhes($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $quem_somos_detalhes->titulo . ", ";
                else
                    $msg .= $quem_somos_detalhes->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes itens não foram excluidas: ' . $msg);
        }
    }

    public function subir($id, $sort) {
        if (!$this->quem_somos_model->subir($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }       
        
        redirect('admin/quem_somos', 'location');
    }

    public function descer($id, $sort) {
        if (!$this->quem_somos_model->descer($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }
        redirect('admin/quem_somos', 'location');
    }

}

?>