<?php

class Login extends CI_Controller {
    
    public function __construct(){
        parent::__construct();       
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('admin/login_model');
        $this->load->model('admin/usuarios_model');
        $this->usuarios_model->previlegio(array(3));
    }

    public function index(){
        $this->load->view('admin/login/login_view');
    }
    
    function esqueci_senha(){
        $this->load->view('admin/login/esqueceu_senha_view');
    }

    function erro()
    {
        $data['msg'] = "<b>Usuario ou senha não encontrados</b>";
        $this->load->view('admin/login/login_view',$data);
    }
    
    function esqueceu_senha_erro()
    {
        $data["msg"] = "<b>Login ou e-mail não encontrados no sistema</b>";
        $this->load->view('admin/login/esqueceu_senha_view',$data);
    }
    
    function senha_enviada()
    {
        $data["msg"] = "<b>Sua senha foi enviada para o email informado</b>";
        $this->load->view('admin/login/esqueceu_senha_view',$data);
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/login', 'location');
    }

    function logar()
    {   	    
        if ($this->login_model->verifica_login($this->input->post('usuario_login'), $this->input->post('usuario_senha'))){
            $tipo = $this->session->userdata('tipo');
            redirect('admin/home', 'location');           
        }
        else{    
            redirect('admin/login/erro', 'location');
        }
    }
    
    function recupera_senha()
    {
        if ($this->login_model->verifica_recupera_senha($this->input->post('usuario_login'), $this->input->post('usuario_email')))
        {
            redirect('admin/login/senha_enviada', 'location');
        }
        else
        {    
            redirect('admin/login/esqueceu_senha_erro', 'location');
        }
    }
    
    function gera_senha()
    {
        echo $this->encrypt->encode("1q2w3e4r5t");
    }
    
    function bloqueado($usuarioID){
        $data["msg"] = "Seu usuário foi bloqueado por múltiplas tentativas. Uma nova senha foi enviada para seu e-mail.";
        
        $usuario = $this->usuarios_model->get_usuario($usuarioID);
        
        for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 32; $x = rand(0,$z), $s .= $a{$x}, $i++); 
        
        $subject = "SITE - Nova Senha";
        echo $senha = $s;
        
        $usuario->senha = sha1($senha);
        $usuario->try = 0;
        $usuarioID = $usuario->usuarioID;
        unset($usuario->usuarioID);
        $this->usuarios_model->atualiza_usuario($usuario, "usuarioID = '$usuarioID'");
        
        /*
        $this->load->library('email');
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $this->email->initialize($config);
        $site = 'Lar Bianco';
        $nome_de = 'Site Lar Bianco';
        $de_email = 'contato@larbiancorestaurante.com.br';
        $this->email->from($de_email, $nome_de);
        $this->email->to("contato@larbiancorestaurante.com.br");
        $this->email->subject($subject);
        $mensagem = "Nome: " . $nome . "<br />";
        $mensagem .= "E-mail: " . $email . "<br />";
        $mensagem .= "Mensagem: " . $mensagem . "<br />";
        $this->email->message($mensagem);
        $this->email->send();
        */
        
        
        $this->load->view('admin/login/login_view', $data);
    }
    
}