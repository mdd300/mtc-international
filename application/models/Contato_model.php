<?php

class Contato_model extends CI_Model {

	public function save_contact($dados, $origem)
	{
		return $this->db->insert('contato', array('nome' => $dados['name'], 
												  'email' => $dados['email'],
												  // 'telefone' => (isset($dados['telephone'])) ? $dados['telephone'] : null,
												  'assunto' => (isset($dados['subject'])) ? $dados['subject'] : null,
												  'mensagem' => (isset($dados['message'])) ? $dados['message'] : null,
												  // 'tipo' => (isset($dados['tipo'])) ? $dados['tipo'] : null,
												  'opt_in' => (isset($dados['opt_in'])) ? 1 : 0,
												  'origem' => $origem));
	}

	public function gerar_excel($params = array())
	{
		$options = array(
			'origem' => false,
			'tipo' => false
		);

		$params = array_merge($options, $params);

		$this->db->select('*')
				 ->select('DATE_FORMAT(data_criacao,"%d/%m/%Y %H:%i:%s") AS dateFormated', false)
				 ->from('contato')
				 ->order_by('contato.data_criacao', 'DESC');

		if($params['origem']){
			if($params['origem'] != 'Todos'){
				$this->db->where('origem', $params['origem']);			
			}
		}

		if($params['tipo']){
			if($params['tipo'] == 'Todos'){
				$this->db->where('tipo IS NOT NULL');
			}else{
				$this->db->where('tipo', $params['tipo']);
			}
		}

		$query = $this->db->get();

		return ($query->num_rows()) ? $query->result() : false;
	}

	public function save_newsletter($dados)
    {
    
        $saved = false;

        $exist = $this->db->select('email')
        		          ->from('newsletters')
        		          ->where('email', $dados['email'])
        		          ->get()
        		          ->row();
        
        if(!$exist){
        	$saved = $this->db->insert('newsletters', array('email' => $dados['email']));
        }

        return $saved;
    }

}