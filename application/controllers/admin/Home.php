<?php

class Home extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarios_model');
    }

    function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->load->view('admin/home/index', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }
    }

    function logar() {
        if ($_POST) {
            $usuario = $this->input->post("usuario");
            $senha = $this->input->post("senha");
            if($this->usuarios_model->login($usuario, $senha)){
                redirect("admin/home/index");
            } else {
                $data["msg"] = "Usuário ou senha inválida";
                $this->load->view("admin/login/index", $data);
            }
        } else {
            return false;
        }
    }


    public function db_backup()
    {
       $this->load->dbutil();
       $backup = $this->dbutil->backup();  
       $this->load->helper('file');
       $time = time();
       write_file('assets/uploads/db/db' . $time . '.zip', $backup);
    }

    function sair() {
        $this->session->sess_destroy();
        redirect("admin/home");
    }

   

}

?>