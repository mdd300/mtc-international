<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		
        $this->load->library('email');
        $this->load->helper('email');
        
        $this->load->model('contato_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
	}

	public function index()
    {
        $data['active'] = 'contato';
        $data['servicos_menu'] = $this->servicos_model->get_servicos(); 
        
        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;
        
        $this->load->view('site/contato', $data);
	}

    public function send_contact()
    {
        $post = $this->input->post();

        $return = array('status' => false, 'class' => 'danger', 'message' => 'Ocorreu um erro no envio, tente novamente mais tarde.');

        if($post){

            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Nome', 'trim|required');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
            $this->form_validation->set_rules('subject', 'Assunto', 'trim|required');
            $this->form_validation->set_rules('message', 'Mensagem', 'trim|required');

            if($this->form_validation->run()){

                $origem = (isset($post['origem'])) ? $post['origem'] : 'Contato';

                if($this->contato_model->save_contact($post, $origem)){

                    $this->_send_notifications($post, 'Contato');

                    $return = array('status' => true, 'class' => 'success', 'message' => 'Mensagem enviada com sucesso!');
                }
            }else{
                $errors = array_values($this->form_validation->error_array());
                $return = array('status' => false, 'class' => 'warning', 'message' => $errors[0]);
            }
        }

        echo json_encode($return);
    }

    public function send_appointment()
    {
        $post = $this->input->post();

        $return = array('status' => false, 'class' => 'danger', 'message' => 'Ocorreu um erro no envio, tente novamente mais tarde.');

        if($post){

            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Nome', 'trim|required');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
            $this->form_validation->set_rules('subject', 'Assunto', 'trim|required');
            $this->form_validation->set_rules('message', 'Mensagem', 'trim|required');

            if($this->form_validation->run()){

                if($this->contato_model->save_contact($post, 'Consulta')){

                    $this->_send_notifications($post,'Consulta');

                    $return = array('status' => true, 'class' => 'success', 'message' => 'Mensagem enviada com sucesso!');
                }
            }else{
                $errors = array_values($this->form_validation->error_array());
                $return = array('status' => false, 'class' => 'warning', 'message' => $errors[0]);
            }
        }

        echo json_encode($return);
    }

    private function _send_notifications($dados, $origem)
    {
        $this->load->library('email');
        
        $dados = $this->input->post();

        $mensagem = "Nome: " . $dados['name'] . "<br />";
        $mensagem .= "E-mail: " . $dados['email'] . "<br />";
        if(isset($dados['telephone'])){
            $mensagem .= "Telefone: " . $dados['telephone'] . "<br>";
        }
        $mensagem .= "Assunto: " . $dados['subject'] . "<br />";
        $mensagem .= "Mensagem: " . $dados['message'] . "<br />";           

        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $subject = ($dados['subject'] != '') ? $dados['subject'].' - '.$origem : $origem;
        
        $this->email->initialize($config);

        $this->email->from('contato@grupomtc.com.br', 'Grupo MTC');
        $this->email->to('contato@grupomtc.com.br');
        $this->email->subject($subject);
        $this->email->message($mensagem);
        
        if ($this->email->send(FALSE))
        {
            $this->email->print_debugger();
        }

        $this->email->clear(TRUE);

        $this->email->from('contato@grupomtc.com.br', 'Grupo MTC');
        $this->email->to($dados['email']);
        $this->email->subject('Recebemos sua mensagem');

        $mensagem_cliente  = '<h3>' . $dados['name'] . ',</h3>';
        $mensagem_cliente .= '<p>';
        $mensagem_cliente .= 'Obrigado por entrar em contato com o Grupo MTC.';
        $mensagem_cliente .= '<br>';
        $mensagem_cliente .= 'Em breve entraremos em contato.';
        $mensagem_cliente .= '<br>';
        $mensagem_cliente .= 'Tels.: 55 11 3842-6300 | 55 11 3842-6701';    
        $mensagem_cliente .= '<br>';
        $mensagem_cliente .= '<a href="http://grupomtc.com.br/">www.grupomtc.com.br</a>';
        $mensagem_cliente .= '</p>';
        $mensagem_cliente .= '<img src="' . site_url('assets/images/logo.png') . '" alt="Grupo MTC">';

        $this->email->message($mensagem_cliente);
        $this->email->send();
    }

    public function send_newsletter()
    {
        $post = $this->input->post();
        
        $return = array('status' => false, 'class' => 'danger', 'message' => 'Ocorreu um erro no cadastro, tente novamente mais tarde.');

        if($post){

            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');

            if($this->form_validation->run()){
                if($this->contato_model->save_newsletter($post)){
                    $return = array('status' => true, 'class' => 'success', 'message' => 'E-mail cadastrado com sucesso!');
                }else{
                    $return = array('status' => false, 'class' => 'warning', 'message' => 'E-mail já cadastrado.');
                }
            }else{
                $errors = array_values($this->form_validation->error_array());
                $return = array('status' => false, 'class' => 'warning', 'message' => $errors[0]);
            }
        }

        echo json_encode($return);
    }

}