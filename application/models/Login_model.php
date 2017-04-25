<?php

class login_model extends CI_Model {

    function login_model() {
        parent::__construct();
        $this->load->database();
    }

    function verifica_login($usuario, $senha) {
           
        $this->db->select("*");
        $this->db->from("adm_usuarios");
        $this->db->where("usuario", $usuario);
        $query = $this->db->get();

        if ($query->num_rows == 1) {
            $row = $query->row();

            if ($row->try == 3) {
                redirect("admin/login/bloqueado/".$row->usuarioID."/");
                exit;
            }
            $senha = sha1($senha);
            if ($senha == $row->senha) {
                //REGISTRA AS VARIÁVEIS DE SEÇÃO
                $this->db->update('adm_usuarios', array("try" => 0));
                $this->session->set_userdata('usuario_id', $row->usuarioID);
                $this->session->set_userdata('usuario_login', $row->login);
                $this->session->set_userdata('usuario_nome', $row->nome);
                $this->session->set_userdata('usuario_email', $row->email);
                $this->session->set_userdata('tipo', $row->tipo);
                $return = true;
            } else {
                $try = $row->try;
                $try = $try + 1;
                $this->db->update('adm_usuarios', array("try" => $try));
                $return = false;
            }
        } else {
            $return = false;
        }
        return $return;
    }
    
    function nova_senha(){
        
    }

    function check_auth() {
        if ($this->session->userdata('usuario_id')) {
            return true;
        } else {
            redirect("admin/login");
            exit();
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('admin/login', 'location');
    }

}

?>