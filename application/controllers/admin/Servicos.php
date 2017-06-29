<?php

class Servicos extends CI_Controller {

	public $data;

	public function __construct() {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('utility_helper');
		$this->load->model('usuarios_model');
		$this->load->model('servicos_model');

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

			$this->data["servicos"] = $this->servicos_model->get_servicos($texto, $data_de, $data_ate);
			$this->load->view('admin/servicos/lista', $this->data);
		} else {
			$this->load->view('admin/login/index', $this->data);
		}
		
	}

	public function cria() {
		$this->load->view('admin/servicos/cria');
	}

	function salvar() {
		$data = $_POST;
		
		$tag = $data['tag'];
		unset($data['tag']);

		$img_nome = $this->servicos_model->upload_foto_pequena('imagem');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem'] = $img_nome;
		}
		
		$img_nome = $this->servicos_model->upload_foto_grande('imagem2');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem2'] = $img_nome;
		}
		
		$data['slug'] = $this->servicos_model->slug($data['titulo']);

		$this->db->insert('servicos', $data);
		$id = $this->db->insert_id();

		for ($i=0; $i < count($tag); $i++) { 
			$tagID = $this->tags_model->salva_tags($tag[$i], 'servico');
			$this->tags_model->salva_relationship($tagID, $id, 'servico');
		}

		redirect('admin/servicos', 'location');
	}

	public function editar($id = false) {
		if (!$id) {
			redirect('admin/servicos', 'location');
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

		$this->data['servico'] = $this->servicos_model->get_servico($id);
		
		$this->load->view('admin/servicos/edita', $this->data);
	}

	public function atualizar() {
		$data = $_POST;
		$dataWhere['id'] = $this->input->post("id");
		$id = $this->input->post("ID");
		
		$dataWhere['id'] = $this->input->post("id");
		$id = $this->input->post("id");
		unset($data['id']);

		$img_nome = $this->servicos_model->upload_foto_pequena('imagem');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem'] = $img_nome;
		}
		
		$img_nome = $this->servicos_model->upload_foto_grande('imagem2');
		if (!is_array($img_nome) && isset($img_nome)) {
				$data['imagem2'] = $img_nome;
		}
		
		$data['slug'] = $this->servicos_model->slug($data['titulo']);

		if ($this->servicos_model->atualizar($data, $dataWhere)) {
			$this->session->set_flashdata('messages', 'Área de atuação atualizada com sucesso.');
			redirect('admin/servicos/editar/' .$id, 'location');
		} else {
			$this->session->set_flashdata('errors', 'Não foi possível atualizar a servico. Tente novamente.');
			redirect('admin/servicos/editar/' . $id, 'location');
		}
	}

	public function limpar() {
		$this->session->set_flashdata('texto', '');
		$this->session->set_flashdata('data_de', '');
		$this->session->set_flashdata('data_ate', '');
		$this->session->set_flashdata('lojaID', '');
		redirect('admin/servicos');
	}

	public function excluir_selecionados() {
		$ok = true;
		$erros = array();
		$ids = $this->input->post("ids");
		
		if (!$ids) {
			$this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
			redirect('admin/servicos');
		}

		$servicos = explode(';', $ids);
		for ($i = 0; $i <= count($servicos) - 1; $i++) {
			if (!$this->servicos_model->excluir($servicos[$i])) {
				$ok = false;
				$erros[] = $servicos[$i];
			}
		}
		if(!$ok){
			$this->session->set_flashdata('errors', 'Algumas notícias não foram excluídas.');
		}else{
			$this->session->set_flashdata('messages', 'Notícias excluídas com sucesso.');
		}
	}

	public function rearrange()
    {
        $this->servicos_model->rearrange();
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

            $this->servicos_model->atualizar_ordem($id, $sort);
        }
        
        redirect('admin/servicos', 'location');
        $this->session->set_flashdata('messages', 'Itens reordenados');
    }
}

?>