<?php

class Landing_pages extends CI_Controller {

	public $data;

	public function __construct() {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('utility_helper');
		$this->load->model('usuarios_model');
		$this->load->model('landing_pages_model');

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

			$this->data["landing_pages"] = $this->landing_pages_model->get_landing_pages($texto, $data_de, $data_ate);
			$this->load->view('admin/landing_pages/lista', $this->data);
		} else {
			$this->load->view('admin/login/index', $this->data);
		}
		
	}

	public function cria() {
		$this->load->view('admin/landing_pages/cria');
	}

	function salvar() {
		$data = $_POST;
		
		$img_nome = $this->landing_pages_model->upload_foto_pequena('imagem');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem'] = $img_nome;
		}
		$img_nome = $this->landing_pages_model->upload_foto_grande('imagem2');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem2'] = $img_nome;
		}
		$data['slug'] = $this->landing_pages_model->slug($data['titulo']);

		$this->db->insert('landing_pages', $data);
		$id = $this->db->insert_id();

		redirect('admin/landing_pages', 'location');
	}

	public function editar($id = false) {
		if (!$id) {
			redirect('admin/landing_pages', 'location');
		}

		$data['landing_page'] = $this->landing_pages_model->get_landing_page($id);
		$data['landing_page_links'] = $this->landing_pages_model->get_landing_page_links($id);

		$this->load->view('admin/landing_pages/edita', $data);
	}

	function inserir_link() {
		$data = $_POST;

		$this->db->insert('landing_pages_links', $data);
		$lp_id = $data['landing_page_id'];

		$this->session->set_flashdata('links', 'true');
		redirect('admin/landing_pages/editar/' . $lp_id, 'location');
	}

	public function excluir_link($id) {
		$this->landing_pages_model->excluir_link($id);
		redirect('admin/landing_pages/', 'location');
	}

	public function atualizar() {
		$data = $_POST;
		$dataWhere['id'] = $this->input->post("id");
		$id = $this->input->post("ID");
		
		$dataWhere['id'] = $this->input->post("id");
		$id = $this->input->post("id");
		unset($data['id']);

		$img_nome = $this->landing_pages_model->upload_foto_pequena('imagem');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem'] = $img_nome;
		}
		
		$img_nome = $this->landing_pages_model->upload_foto_grande('imagem2');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem2'] = $img_nome;
		}
		
		$data['slug'] = $this->landing_pages_model->slug($data['titulo']);

		if ($this->landing_pages_model->atualizar($data, $dataWhere)) {
			$this->session->set_flashdata('messages', 'Landing page atualizada com sucesso.');
			redirect('admin/landing_pages/editar/' .$id, 'location');
		} else {
			$this->session->set_flashdata('errors', 'Não foi possível atualizar a landing page. Tente novamente.');
			redirect('admin/landing_pages/editar/' . $id, 'location');
		}
	}

	public function limpar() {
		$this->session->set_flashdata('texto', '');
		$this->session->set_flashdata('data_de', '');
		$this->session->set_flashdata('data_ate', '');
		$this->session->set_flashdata('lojaID', '');
		redirect('admin/landing_pages');
	}

	public function excluir_selecionados() {
		$ok = true;
		$erros = array();
		$ids = $this->input->post("ids");
		
		if (!$ids) {
			$this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
			redirect('admin/landing_pages');
		}

		$landing_pages = explode(';', $ids);
		for ($i = 0; $i <= count($landing_pages) - 1; $i++) {
			if (!$this->landing_pages_model->excluir($landing_pages[$i])) {
				$ok = false;
				$erros[] = $landing_pages[$i];
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
