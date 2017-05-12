<?php

class Noticias extends CI_Controller {

	public $data;

	public function __construct() {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('utility_helper');
		$this->load->model('usuarios_model');
		$this->load->model('noticias_model');

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

			$this->data["noticias"] = $this->noticias_model->get_noticias($texto, $data_de, $data_ate);
			$this->load->view('admin/noticias/lista', $this->data);
		} else {
			$this->load->view('admin/login/index', $this->data);
		}
		
	}

	public function cria() {
		$this->load->view('admin/noticias/cria');
	}

	function salvar() {
		$data = $_POST;
		
		$tag = $data['tag'];
		unset($data['tag']);

		$img_nome = $this->noticias_model->upload_foto_pequena('imagem');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem'] = $img_nome;
		}
		
		$img_nome = $this->noticias_model->upload_foto_grande('imagem2');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem2'] = $img_nome;
		}
		
		$data['slug'] = $this->noticias_model->slug($data['titulo']);

		$this->db->insert('noticias', $data);
		$noticiaID = $this->db->insert_id();

		for ($i=0; $i < count($tag); $i++) { 
			$tagID = $this->tags_model->salva_tags($tag[$i], 'noticia');
			$this->tags_model->salva_relationship($tagID, $noticiaID, 'noticia');
		}

		redirect('admin/noticias', 'location');
	}

	public function editar($noticiaID = false) {
		if (!$noticiaID) {
			redirect('admin/noticias', 'location');
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

		$this->data['noticia'] = $this->noticias_model->get_noticia($noticiaID);
		
		$this->load->view('admin/noticias/edita', $this->data);
	}

	public function atualizar() {
		$data = $_POST;
		$dataWhere['noticiaID'] = $this->input->post("noticiaID");
		$noticiaID = $this->input->post("ID");
		
		$dataWhere['noticiaID'] = $this->input->post("noticiaID");
		$noticiaID = $this->input->post("noticiaID");
		unset($data['noticiaID']);

		$img_nome = $this->noticias_model->upload_foto_pequena('imagem');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem'] = $img_nome;
		}
		
		$img_nome = $this->noticias_model->upload_foto_grande('imagem2');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem2'] = $img_nome;
		}
		
		$data['slug'] = $this->noticias_model->slug($data['titulo']);

		if ($this->noticias_model->atualizar($data, $dataWhere)) {
			$this->session->set_flashdata('messages', 'Noticia atualizada com sucesso.');
			redirect('admin/noticias/editar/' .$noticiaID, 'location');
		} else {
			$this->session->set_flashdata('errors', 'Não foi possível atualizar a noticia. Tente novamente.');
			redirect('admin/noticias/editar/' . $noticiaID, 'location');
		}
	}

	public function limpar() {
		$this->session->set_flashdata('texto', '');
		$this->session->set_flashdata('data_de', '');
		$this->session->set_flashdata('data_ate', '');
		$this->session->set_flashdata('lojaID', '');
		redirect('admin/noticias');
	}

	public function excluir_selecionados() {
		$ok = true;
		$erros = array();
		$ids = $this->input->post("ids");
		
		if (!$ids) {
			$this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
			redirect('admin/noticias');
		}

		$noticias = explode(';', $ids);
		for ($i = 0; $i <= count($noticias) - 1; $i++) {
			if (!$this->noticias_model->excluir($noticias[$i])) {
				$ok = false;
				$erros[] = $noticias[$i];
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