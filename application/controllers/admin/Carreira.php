<?php

class Carreira extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('carreira_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["carreira"] = $this->carreira_model->get_carreira();
            $this->load->view('admin/carreira/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['carreira_detalhes'] = '';
        $this->load->view('admin/carreira/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['sort'] = $this->carreira_model->get_sort();
        $data['habilitado'] = $this->input->post("habilitado");

        $this->db->insert('carreira', $data);
        $this->session->set_flashdata('messages', 'Registro inserido com sucesso.');
        redirect('admin/carreira', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/carreira', 'location');
        }

        $this->data['carreira_detalhes'] = $this->carreira_model->get_carreira_detalhes($id);
        $this->load->view('admin/carreira/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        if ($this->carreira_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Registro atualizado com sucesso.');
            redirect('admin/carreira', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o registro. Tente novamente.');
            redirect('admin/carreira', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/carreira');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('carreira');
        }

        $carreira = explode(';', $ids);
        for ($i = 0; $i <= count($carreira) - 1; $i++) {

            if (!$this->carreira_model->excluir($carreira[$i])) {
                $ok = false;
                $erros[] = $carreira[$i];
            }
        }
        
        // $result = mysql_query("SELECT * FROM carreira") or die(mysql_error());
        // $x = 1;
        // while ($row = mysql_fetch_row($result)) {
        //     $id = $row[0];
        //     mysql_query("UPDATE carreira SET sort = '$x' WHERE id = '$id'") or die(mysql_error());
        //     $x++;
        // }

        if ($ok) {
            $this->session->set_flashdata('messages', 'itens excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $carreira_detalhes = $this->carreira_detalhes_model->get_carreira_detalhes($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $carreira_detalhes->titulo . ", ";
                else
                    $msg .= $carreira_detalhes->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes itens não foram excluidas: ' . $msg);
        }
    }

    public function subir($id, $sort) {
        if (!$this->carreira_model->subir($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }       
        
        redirect('admin/carreira', 'location');
    }

    public function descer($id, $sort) {
        if (!$this->carreira_model->descer($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }
        redirect('admin/carreira', 'location');
    }

}

?>