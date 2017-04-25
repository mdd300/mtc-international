<?php

class Usuarios extends CI_Controller {

    public $data;
    
    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        // $this->usuarios_model->previlegio(array(1));
        
        $this->load->model('usuarios_model');
    }

    public function index($offset = NULL) {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            if ($this->input->post('nome')) {
                $nome = $this->input->post('nome');
                $this->session->set_flashdata('nome', $this->input->post('nome'));
            } else {
                $nome = $this->session->flashdata('nome');
                $this->session->set_flashdata('nome', $nome);
            } 
            
            $limit = 10;
            $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $this->data["usuarios"] = $this->usuarios_model->get_usuarios(@$tipo, $nome, $limit, $offset, NULL);
            $total_usuarios = $this->usuarios_model->get_usuarios(@$tipo, $nome, $limit, $offset, TRUE);
           
            $config = array();
            $config["base_url"] = base_url() . "admin/usuarios/index/";
            $config["total_rows"] = $total_usuarios;
            $config["per_page"] = $limit;
            $config["uri_segment"] = 4;
            $this->pagination->initialize($config);
            
            $this->data["links"] = $this->pagination->create_links();
            $this->data["total_usuarios"] = $total_usuarios;
            
            $this->load->view('admin/usuarios/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }
       
    }

    public function cria() {
        $this->load->view('admin/usuarios/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $usuarioID = $this->usuarios_model->salvar($data);

        $this->session->set_flashdata('messages', 'Usuário inserido com sucesso.');
        redirect('admin/usuarios', 'location');
    }

    public function editar($usuarioID = false) {
        if (!$usuarioID) {
            redirect('admin/usuarios', 'location');
        }
        $this->data['usuario'] = $this->usuarios_model->get_usuario($usuarioID);
        $this->load->view('admin/usuarios/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['adm_usuarioID'] = $this->input->post("usuarioID");
        $usuarioID = $this->input->post("usuarioID");
        unset($data['usuarioID']);
        if ($this->usuarios_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Usuário atualizado com sucesso.');
            // echo "<pre>";
            // var_dump($data);
            // exit;
            redirect('admin/usuarios/editar/'.$usuarioID, 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o usuário. Tente novamente.');
            redirect('admin/usuarios', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('nome', '');
        redirect('admin/usuarios');
    }

    public function excluir_selecionados() {
        $ids = $this->input->post("ids");
        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('usuarios');
        }
        $usuarios = explode(';', $ids);
        for ($i = 0; $i <= count($usuarios) - 1; $i++) {

            if (!$this->usuarios_model->excluir($usuarios[$i])) {
                $ok = false;
                $erros[] = $usuarios[$i];
            }
        }
        $this->session->set_flashdata('messages', 'Usuários excluidos com sucesso.');
    }
}
?>