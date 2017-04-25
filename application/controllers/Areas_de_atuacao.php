<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas_de_atuacao extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('areas_de_atuacao_model');
		$this->load->model('topos_model');
	}
	
	public function index()
	{
		$data['active']   = 'areas-de-atuacao';
		$data['areas_de_atuacao'] = $this->areas_de_atuacao_model->get_areas_de_atuacao();

		//menu & topo
		$data['topo'] = $this->topos_model->get_topo($data['active']);
		$data['topo'] = $data['topo']->imagem;
		
		$data['areas_menu'] = $this->areas_de_atuacao_model->get_areas_de_atuacao();
		
		$this->load->view('site/areas-de-atuacao', $data);
	}

	public function exibe($slug = false) {
				
		$data['active'] = 'areas-de-atuacao';
		$data['area_de_atuacao'] = $this->areas_de_atuacao_model->get_area_de_atuacao_slug($slug);
		$data['area_de_atuacao'] || show_404();
		$data['title'] = $data['area_de_atuacao']->titulo;
		$data['description'] = $data['area_de_atuacao']->description;

		$data['areas_de_atuacao'] = $this->areas_de_atuacao_model->get_areas_de_atuacao(
			$texto = "",
			$data_de = NULL,
			$data_ate = NULL,
			$limit = NULL,
			$offset = NULL,
			$count = NULL,
			$menos_estaID = $data['area_de_atuacao']->id,
			$order = NULL,
			$order_by = NULL
		);
		
		//menu & topo
		$data['topo'] = $this->topos_model->get_topo($data['active']);
		$data['topo'] = $data['topo']->imagem;
		$data['areas_menu'] = $this->areas_de_atuacao_model->get_areas_de_atuacao();
		
		$this->load->view('site/area-de-atuacao', $data);
	}
}