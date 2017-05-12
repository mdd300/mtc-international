<?php

class Areas_de_atuacao extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('areas_de_atuacao_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["areas_de_atuacao"] = $this->areas_de_atuacao_model->get_areas_de_atuacao();
            $this->load->view('admin/areas_de_atuacao/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['areas_de_atuacao_detalhes'] = '';
        $this->load->view('admin/areas_de_atuacao/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['sort'] = $this->areas_de_atuacao_model->get_sort();
        $data['habilitado'] = $this->input->post("habilitado");

        $this->db->insert('areas_de_atuacao', $data);
        $this->session->set_flashdata('messages', 'Registro inserido com sucesso.');
        redirect('admin/areas_de_atuacao', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/areas_de_atuacao', 'location');
        }

        $this->data['areas_de_atuacao_detalhes'] = $this->areas_de_atuacao_model->get_areas_de_atuacao_detalhes($id);
        $this->load->view('admin/areas_de_atuacao/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        if ($this->areas_de_atuacao_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Registro atualizado com sucesso.');
            redirect('admin/areas_de_atuacao', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o registro. Tente novamente.');
            redirect('admin/areas_de_atuacao', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/areas_de_atuacao');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('areas_de_atuacao');
        }

        $areas_de_atuacao = explode(';', $ids);
        for ($i = 0; $i <= count($areas_de_atuacao) - 1; $i++) {

            if (!$this->areas_de_atuacao_model->excluir($areas_de_atuacao[$i])) {
                $ok = false;
                $erros[] = $areas_de_atuacao[$i];
            }
        }
        
        // $result = mysql_query("SELECT * FROM areas_de_atuacao") or die(mysql_error());
        // $x = 1;
        // while ($row = mysql_fetch_row($result)) {
        //     $id = $row[0];
        //     mysql_query("UPDATE areas_de_atuacao SET sort = '$x' WHERE id = '$id'") or die(mysql_error());
        //     $x++;
        // }

        if ($ok) {
            $this->session->set_flashdata('messages', 'itens excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $areas_de_atuacao_detalhes = $this->areas_de_atuacao_detalhes_model->get_areas_de_atuacao_detalhes($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $areas_de_atuacao_detalhes->titulo . ", ";
                else
                    $msg .= $areas_de_atuacao_detalhes->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes itens não foram excluidas: ' . $msg);
        }
    }

    public function subir($id, $sort) {
        if (!$this->areas_de_atuacao_model->subir($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }       
        
        redirect('admin/areas_de_atuacao', 'location');
    }

    public function descer($id, $sort) {
        if (!$this->areas_de_atuacao_model->descer($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }
        redirect('admin/areas_de_atuacao', 'location');
    }

}

?>