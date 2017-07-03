<?php

class Operacoes extends CI_Controller {

	public $data;

	public function __construct() {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('utility_helper');
		$this->load->model('usuarios_model');
		$this->load->model('operacoes_model');

	}

	public function index($offset = NULL) {
		if ($this->usuarios_model->logado()) {
			if ($this->session->userdata('tipo') == 2) {
				$usuarioID = $this->session->userdata('usuarioID');
			}
			if ($this->input->post('texto')) {
				$texto = $this->input->post('texto');
				$this->session->set_flashdata('texto', $this->input->post('texto'));
			} else {
				$texto = $this->session->flashdata('texto');
				$this->session->set_flashdata('texto', $texto);
			}

			$data_de = $this->input->post('data_de');
			$data_ate = $this->input->post('data_ate');
			$texto = $this->input->post('texto');

			$this->data["operacoes"] = $this->operacoes_model->get_operacoes($texto, $data_de, $data_ate);
			$this->load->view('admin/operacoes/lista', $this->data);
		} else {
			$this->load->view('admin/login/index', $this->data);
		}
		
	}

	public function cria() {
		$this->load->view('admin/operacoes/cria');
	}

	function salvar() {
		$data = $_POST;
		
		$img_nome = $this->operacoes_model->upload_foto_pequena('imagem');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem'] = $img_nome;
		}

		$this->db->insert('operacoes', $data);
		$id = $this->db->insert_id();

		for ($i=0; $i < count($tag); $i++) { 
			$tagID = $this->tags_model->salva_tags($tag[$i], 'operacao');
			$this->tags_model->salva_relationship($tagID, $id, 'operacao');
		}

		redirect('admin/operacoes', 'location');
	}

	public function editar($id = false) {
		if (!$id) {
			redirect('admin/operacoes', 'location');
		}
		
		$this->data['ckeditor_descricao'] = array
		(
			//id da textarea a ser substituída pelo CKEditor
			'id' => 'descricao',
 
			// caminho da pasta do CKEditor relativo a pasta raiz do CodeIgniter
			'path' => 'assets/plugins/ckeditor',
 
			// configurações opcionais
			'config' => array
			(
				'toolbar' => "Full",
				'width'   => "700px",
				'height'  => "300px",
			)
		);

		$this->data['operacao'] = $this->operacoes_model->get_operacao($id);
		
		$this->load->view('admin/operacoes/edita', $this->data);
	}

	public function atualizar() {
		$data = $_POST;
		$dataWhere['id'] = $this->input->post("id");
		$id = $this->input->post("ID");
		
		$dataWhere['id'] = $this->input->post("id");
		$id = $this->input->post("id");
		unset($data['id']);

		$img_nome = $this->operacoes_model->upload_foto_pequena('imagem');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem'] = $img_nome;
		}

		if ($this->operacoes_model->atualizar($data, $dataWhere)) {
			$this->session->set_flashdata('messages', 'Registro atualizada com sucesso.');
			redirect('admin/operacoes/editar/' .$id, 'location');
		} else {
			$this->session->set_flashdata('errors', 'Não foi possível atualizar o registro. Tente novamente.');
			redirect('admin/operacoes/editar/' . $id, 'location');
		}
	}

	public function limpar() {
		$this->session->set_flashdata('texto', '');
		$this->session->set_flashdata('data_de', '');
		$this->session->set_flashdata('data_ate', '');
		$this->session->set_flashdata('lojaID', '');
		redirect('admin/operacoes');
	}

	public function excluir_selecionados() {
		$ok = true;
		$erros = array();
		$ids = $this->input->post("ids");
		
		if (!$ids) {
			$this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
			redirect('admin/operacoes');
		}

		$operacoes = explode(';', $ids);
		for ($i = 0; $i <= count($operacoes) - 1; $i++) {
			if (!$this->operacoes_model->excluir($operacoes[$i])) {
				$ok = false;
				$erros[] = $operacoes[$i];
			}
		}
		if(!$ok){
			$this->session->set_flashdata('errors', 'Alguns registros não foram excluídas.');
		}else{
			$this->session->set_flashdata('messages', 'Registros excluídos com sucesso.');
		}
	}

	public function rearrange()
    {
        $this->operacoes_model->rearrange();
    }

    public function salvar_ordem()
    {
        $data = $_POST;

        $lis = explode( ';' , $data['new_order_array'] );

        foreach ( $lis as $key => $val ) {
            //explode each value found by "="...
            $pos = explode( '=' , $val );
            
            $id = $pos[0];
            $sort = $pos[1];

            $this->operacoes_model->atualizar_ordem($id, $sort);
        }
        
        redirect('admin/operacoes', 'location');
        $this->session->set_flashdata('messages', 'Itens reordenados');
    }
}

?>