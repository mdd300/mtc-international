<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato extends MY_Controller {

	public function __construct()
    {
		parent::__construct();
		
        $this->load->library('email');
        $this->load->library('mailchimp');
        $this->load->helper('email');
        
        $this->load->model('contato_model');
        $this->load->model('file_upload_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
	}

	public function index()
    {
        $this->data['active'] = 'contato';

        $this->data['description'] = 'LOGÍSTICA PARA E-COMMERCE - Operações Logísticas Internas e externas.';
        $this->data['title_meta'] = 'MTC LOG - Logística Reversa, implementação de WMS, transporte, serviços técnicos, reengenharia de embalagens de exportação e muito mais.';
        
        //menu & topo
        $this->data['topo'] = $this->topos_model->get_topo($this->data['active']);
        $this->data['topo'] = $this->data['topo']->imagem;
        $this->data['servicos_menu'] = $this->servicos_model->get_servicos(); 
        
        $this->load->view('site/contato', $this->data);
    }

    public function trabalhe_conosco()
    {
        $this->data['active'] = 'trabalhe-conosco';

        $this->data['description'] = 'LOGÍSTICA PARA E-COMMERCE - Operações Logísticas Internas e externas.';
        $this->data['title_meta'] = 'MTC LOG - Logística Reversa, implementação de WMS, transporte, serviços técnicos, reengenharia de embalagens de exportação e muito mais.';
        
        //menu & topo
        $this->data['topo'] = $this->topos_model->get_topo($this->data['active']);
        $this->data['topo'] = $this->data['topo']->imagem;
        $this->data['servicos_menu'] = $this->servicos_model->get_servicos(); 
        
        $this->load->view('site/trabalhe-conosco', $this->data);
    }

    public function area_cliente()
    {
        $data['active'] = 'area-cliente';
        
        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;
        $data['servicos_menu'] = $this->servicos_model->get_servicos(); 
        
        $this->load->view('site/area-cliente', $data);
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
                
                if(isset($post['opt_in'])) {
                    $this->mailchimp->call('POST', 'lists/03cf57ca3d/members', [
                        'email_address' => $post['email'],
                        'merge_fields'  => [
                            'FNAME'     => $post['name'],
                            'ORIGIN'    => $origem
                        ],
                        'status'        => 'subscribed'
                    ]);
                }

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

    public function send_work()
    {
        $post = $this->input->post();

        $return = array('status' => false, 'class' => 'danger', 'message' => 'Ocorreu um erro no envio, tente novamente mais tarde.');

        if($post){

            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Nome', 'trim|required');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
            $this->form_validation->set_rules('phone', 'Telefone', 'trim|required');
            $this->form_validation->set_rules('joboffer', 'Vaga Pretendida', 'trim|required');
            $this->form_validation->set_rules('message', 'Mensagem', 'trim|required');

            if($this->form_validation->run()){

                $origem = (isset($post['origem'])) ? $post['origem'] : 'Trabalhe Conosco';

                $curriculo = $this->file_upload_model->file_upload(
                    'curriculo',
                    'curriculos',
                    'pdf|doc|docx',
                    NULL,
                    NULL
                );

                if(!is_array($curriculo)){
                    $post['curriculo'] = $curriculo;
                }
                
                if(isset($post['opt_in'])) {
                    $this->mailchimp->call('POST', 'lists/03cf57ca3d/members', [
                        'email_address' => $post['email'],
                        'merge_fields'  => [
                            'FNAME'     => $post['name'],
                            'ORIGIN'    => $origem
                        ],
                        'status'        => 'subscribed'
                    ]);
                }

                if($this->contato_model->save_contact($post, $origem)){

                    $this->_send_notifications($post, 'Trabalhe Conosco');

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
        
        $mensagem = "Nome: " . $dados['name'] . "<br />";
        $mensagem .= "E-mail: " . $dados['email'] . "<br />";
        
        if(isset($dados['phone'])){
            $mensagem .= "Telefone: " . $dados['phone'] . "<br>";
        }
        if(isset($dados['subject'])){
            $mensagem .= "Assunto: " . $dados['subject'] . "<br />";
        }
        if(isset($dados['joboffer'])){
            $mensagem .= "Vaga pretendida: " . $dados['joboffer'] . "<br />";
        }
        if(isset($dados['message'])){
            $mensagem .= "Mensagem: " . $dados['message'] . "<br />";
        }

        if (isset($dados['curriculo']) && !is_array($dados['curriculo']) ) {
            $mensagem .= "<a href='" . base_url() . "assets/uploads/curriculos/" . $dados['curriculo'] . "'>" . "Veja o currículo" . "</a>" . "<br />";
        }

        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $config['smpt_host'] = 'ppmx.mailcorp.com.br.';
        $config['smtp_user'] = 'comercial2@mtclog.com.br';
        $config['smtp_pass'] = 'Mt6@@2k18';


        $subject = (isset($dados['subject']) && $dados['subject'] != '') ? $dados['subject'].' - '.$origem : $origem;
        
        $this->email->initialize($config);

        $this->email->from('contato@mtclog.com.br', 'Grupo MTC');
        if(isset($dados['curriculo'])){
            $this->email->to('vanessa@grupomtc.com.br');
        }else{
            $this->email->to('contato@mtclog.com.br');
        }
        $this->email->subject($subject);
        $this->email->message($mensagem);
        
        if ($this->email->send(FALSE))
        {
            $this->email->print_debugger();
        }

        $this->email->clear(TRUE);

        $this->email->from('contato@mtclog.com.br', 'Grupo MTC');
        $this->email->to($dados['email']);
        $this->email->subject('Recebemos sua mensagem');

        $mensagem_cliente  = '<h3>' . $dados['name'] . ',</h3>';
        $mensagem_cliente .= '<p>';
        $mensagem_cliente .= 'Obrigado por entrar em contato com o Grupo MTC.';
        $mensagem_cliente .= '<br>';
        $mensagem_cliente .= 'Em breve entraremos em contato.';
        $mensagem_cliente .= '<br>';
        $mensagem_cliente .= 'Tels.: 55 11 4810-1174';    
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
                $this->mailchimp->call('POST', 'lists/03cf57ca3d/members', [
                    'email_address' => $post['email'],
                    'status'        => 'subscribed'
                ]);
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
