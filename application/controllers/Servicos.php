<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('servicos_model');
		$this->load->model('topos_model');
	}
	
	public function index()
	{
		$data['active']   = 'servicos';
		
		$data['servicos_menu'] = $this->servicos_model->get_servicos();

		$data['servicos'] = $this->servicos_model->get_servicos();

		$data['description'] = 'LOGÍSTICA PARA E-COMMERCE - Operações Logísticas Internas e externas.';
		$data['title'] = 'MTC LOG - Logística Reversa, implementação de WMS, transporte, serviços técnicos, reengenharia de embalagens de exportação e muito mais.';
		
		//menu & topo
		$data['topo'] = $this->topos_model->get_topo($data['active']);
		$data['topo'] = $data['topo']->imagem;
		
		
		$this->load->view('site/servicos', $data);
	}

	public function exibe($slug = false) {
				
		$data['active'] = 'servico';
		
		$data['servico'] = $this->servicos_model->get_servicos_slug($slug);
		$data['servico'] || show_404();
		
		$data['title'] = $data['servico']->titulo;
		
		$data['description'] = $data['servico']->description;
		$data['title_meta'] = $data['servico']->title;

		$data['servicos'] = $this->servicos_model->get_servicos(
			$texto = "",
			$data_de = NULL,
			$data_ate = NULL,
			$limit = NULL,
			$offset = NULL,
			$count = NULL,
			$menos_estaID = $data['servico']->id,
			$order = NULL,
			$order_by = NULL
		);
		
		//menu & topo
		$data['topo'] = $this->topos_model->get_topo($data['active']);
		$data['topo'] = $data['topo']->imagem;
		
		$data['servicos_menu'] = $this->servicos_model->get_servicos();
		
		$this->load->view('site/servico', $data);
	}
}