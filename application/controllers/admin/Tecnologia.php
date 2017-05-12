<?php

class Tecnologia extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('tecnologia_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["tecnologia"] = $this->tecnologia_model->get_tecnologia();
            $this->load->view('admin/tecnologia/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['tecnologia_detalhes'] = '';
        $this->load->view('admin/tecnologia/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['sort'] = $this->tecnologia_model->get_sort();
        $data['habilitado'] = $this->input->post("habilitado");

        $this->db->insert('tecnologia', $data);
        $this->session->set_flashdata('messages', 'Registro inserido com sucesso.');
        redirect('admin/tecnologia', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/tecnologia', 'location');
        }

        $this->data['tecnologia_detalhes'] = $this->tecnologia_model->get_tecnologia_detalhes($id);
        $this->load->view('admin/tecnologia/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        if ($this->tecnologia_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Registro atualizado com sucesso.');
            redirect('admin/tecnologia', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o registro. Tente novamente.');
            redirect('admin/tecnologia', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/tecnologia');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('tecnologia');
        }

        $tecnologia = explode(';', $ids);
        for ($i = 0; $i <= count($tecnologia) - 1; $i++) {

            if (!$this->tecnologia_model->excluir($tecnologia[$i])) {
                $ok = false;
                $erros[] = $tecnologia[$i];
            }
        }
        
        // $result = mysql_query("SELECT * FROM tecnologia") or die(mysql_error());
        // $x = 1;
        // while ($row = mysql_fetch_row($result)) {
        //     $id = $row[0];
        //     mysql_query("UPDATE tecnologia SET sort = '$x' WHERE id = '$id'") or die(mysql_error());
        //     $x++;
        // }

        if ($ok) {
            $this->session->set_flashdata('messages', 'itens excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $tecnologia_detalhes = $this->tecnologia_detalhes_model->get_tecnologia_detalhes($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $tecnologia_detalhes->titulo . ", ";
                else
                    $msg .= $tecnologia_detalhes->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes itens não foram excluidas: ' . $msg);
        }
    }

    public function subir($id, $sort) {
        if (!$this->tecnologia_model->subir($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }       
        
        redirect('admin/tecnologia', 'location');
    }

    public function descer($id, $sort) {
        if (!$this->tecnologia_model->descer($id, $sort)) {
            $this->session->set_flashdata('errors', 'Erro ao reordenar os itens, tente novamente.');
        }
        redirect('admin/tecnologia', 'location');
    }

}

?>