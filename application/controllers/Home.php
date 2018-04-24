<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('text');
		$this->load->model('banners_model');
		$this->load->model('servicos_model');
		$this->load->model('operacoes_model');
		$this->load->model('clientes_model');
		$this->load->model('noticias_model');
	}
	
	public function index()
	{
		$this->data['active']   = 'home';
		$this->data['banners']  = $this->banners_model->get_banners(1);

		$this->data['servicos_menu'] = $this->servicos_model->get_servicos(
			$texto = "",
			$this->data_de = NULL,
			$this->data_ate = NULL,
			$limit = 9
		);

		$this->data['clientes'] = $this->clientes_model->get_clientes();
		$this->data['clientes'] = array_chunk($this->data['clientes'], 4);
		
		$this->data['servicos'] = $this->servicos_model->get_servicos();
		
		$this->data['operacoes'] = $this->operacoes_model->get_operacoes();

		$this->data['noticias'] = $this->noticias_model->get_noticias(
			$texto = '',
			$this->data_de = NULL,
			$this->data_ate = NULL,
			$limit = 2,
			$offset = NULL,
			$count = NULL,
			$menos_estaID = NULL,
			$order = NULL,
			$order_by = NULL
		);

		$this->load->view('site/index', $this->data);
	}
}
