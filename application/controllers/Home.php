<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$data['active']   = 'home';
		$data['banners']  = $this->banners_model->get_banners(1);

		$data['servicos_menu'] = $this->servicos_model->get_servicos(
			$texto = "",
			$data_de = NULL,
			$data_ate = NULL,
			$limit = 9
		);

		$data['clientes'] = $this->clientes_model->get_clientes();
		$data['clientes'] = array_chunk($data['clientes'], 4);
		
		$data['servicos'] = $this->servicos_model->get_servicos();
		
		$data['operacoes'] = $this->operacoes_model->get_operacoes();

		$data['noticias'] = $this->noticias_model->get_noticias(
			$texto = '',
			$data_de = NULL,
			$data_ate = NULL,
			$limit = 2,
			$offset = NULL,
			$count = NULL,
			$menos_estaID = NULL,
			$order = NULL,
			$order_by = NULL
		);

		$this->load->view('site/index', $data);
	}
}