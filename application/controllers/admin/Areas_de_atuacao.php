<?php

class Areas_de_atuacao extends CI_Controller {

	public $data;

	public function __construct() {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('utility_helper');
		$this->load->model('usuarios_model');
		$this->load->model('areas_de_atuacao_model');

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

			$this->data["areas_de_atuacao"] = $this->areas_de_atuacao_model->get_areas_de_atuacao($texto, $data_de, $data_ate);
			$this->load->view('admin/areas_de_atuacao/lista', $this->data);
		} else {
			$this->load->view('admin/login/index', $this->data);
		}
		
	}

	public function cria() {
		$this->load->view('admin/areas_de_atuacao/cria');
	}

	function salvar() {
		$data = $_POST;
		
		$tag = $data['tag'];
		unset($data['tag']);

		$img_nome = $this->areas_de_atuacao_model->upload_foto_pequena('imagem');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem'] = $img_nome;
		}
		
		$img_nome = $this->areas_de_atuacao_model->upload_foto_grande('imagem2');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem2'] = $img_nome;
		}
		
		$data['slug'] = $this->areas_de_atuacao_model->slug($data['titulo']);

		$this->db->insert('areas_de_atuacao', $data);
		$id = $this->db->insert_id();

		for ($i=0; $i < count($tag); $i++) { 
			$tagID = $this->tags_model->salva_tags($tag[$i], 'area_de_atuacao');
			$this->tags_model->salva_relationship($tagID, $id, 'area_de_atuacao');
		}

		redirect('admin/areas_de_atuacao', 'location');
	}

	public function editar($id = false) {
		if (!$id) {
			redirect('admin/areas_de_atuacao', 'location');
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

		$this->data['area_de_atuacao'] = $this->areas_de_atuacao_model->get_area_de_atuacao($id);
		
		$this->load->view('admin/areas_de_atuacao/edita', $this->data);
	}

	public function atualizar() {
		$data = $_POST;
		$dataWhere['id'] = $this->input->post("id");
		$id = $this->input->post("ID");
		
		$dataWhere['id'] = $this->input->post("id");
		$id = $this->input->post("id");
		unset($data['id']);

		$img_nome = $this->areas_de_atuacao_model->upload_foto_pequena('imagem');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem'] = $img_nome;
		}
		
		$img_nome = $this->areas_de_atuacao_model->upload_foto_grande('imagem2');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem2'] = $img_nome;
		}
		
		$data['slug'] = $this->areas_de_atuacao_model->slug($data['titulo']);

		if ($this->areas_de_atuacao_model->atualizar($data, $dataWhere)) {
			$this->session->set_flashdata('messages', 'Área de atuação atualizada com sucesso.');
			redirect('admin/areas_de_atuacao/editar/' .$id, 'location');
		} else {
			$this->session->set_flashdata('errors', 'Não foi possível atualizar a area_de_atuacao. Tente novamente.');
			redirect('admin/areas_de_atuacao/editar/' . $id, 'location');
		}
	}

	public function limpar() {
		$this->session->set_flashdata('texto', '');
		$this->session->set_flashdata('data_de', '');
		$this->session->set_flashdata('data_ate', '');
		$this->session->set_flashdata('lojaID', '');
		redirect('admin/areas_de_atuacao');
	}

	public function excluir_selecionados() {
		$ok = true;
		$erros = array();
		$ids = $this->input->post("ids");
		
		if (!$ids) {
			$this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
			redirect('admin/areas_de_atuacao');
		}

		$areas_de_atuacao = explode(';', $ids);
		for ($i = 0; $i <= count($areas_de_atuacao) - 1; $i++) {
			if (!$this->areas_de_atuacao_model->excluir($areas_de_atuacao[$i])) {
				$ok = false;
				$erros[] = $areas_de_atuacao[$i];
			}
		}
		if(!$ok){
			$this->session->set_flashdata('errors', 'Algumas notícias não foram excluídas.');
		}else{
			$this->session->set_flashdata('messages', 'Notícias excluídas com sucesso.');
		}
	}    
}

?>