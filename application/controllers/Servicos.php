<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicos extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('servicos_model');
		$this->load->model('topos_model');
	}
	
	public function index()
	{
		$this->data['active']   = 'servicos';
		
		$this->data['servicos_menu'] = $this->servicos_model->get_servicos();

		$this->data['servicos'] = $this->servicos_model->get_servicos();

		$this->data['description'] = 'LOGÍSTICA PARA E-COMMERCE - Operações Logísticas Internas e externas.';
		$this->data['title'] = 'MTC LOG - Logística Reversa, implementação de WMS, transporte, serviços técnicos, reengenharia de embalagens de exportação e muito mais.';
		
		//menu & topo
		$this->data['topo'] = $this->topos_model->get_topo($this->data['active']);
		$this->data['topo'] = $this->data['topo']->imagem;
		
		
		$this->load->view('site/servicos', $this->data);
	}

	public function exibe($slug = false) {
				
		$this->data['active'] = 'servico';
		
		$this->data['servico'] = $this->servicos_model->get_servicos_slug($slug);
		$this->data['servico'] || show_404();
		
		$this->data['title'] = $this->data['servico']->titulo;
		
		$this->data['description'] = $this->data['servico']->description;
		$this->data['title_meta'] = $this->data['servico']->title;

		$this->data['servicos'] = $this->servicos_model->get_servicos(
			$texto = "",
			$this->data_de = NULL,
			$this->data_ate = NULL,
			$limit = NULL,
			$offset = NULL,
			$count = NULL,
			$menos_estaID = $this->data['servico']->id,
			$order = NULL,
			$order_by = NULL
		);
		
		//menu & topo
		$this->data['topo'] = $this->topos_model->get_topo($this->data['active']);
		$this->data['topo'] = $this->data['topo']->imagem;
		
		$this->data['servicos_menu'] = $this->servicos_model->get_servicos();
		
		$this->load->view('site/servico', $this->data);
	}
}
