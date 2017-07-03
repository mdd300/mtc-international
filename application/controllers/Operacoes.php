<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Operacoes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('text');
		$this->load->model('operacoes_model');
		$this->load->model('servicos_model');
		$this->load->model('topos_model');
	}
	
	public function index()
	{
		$data['active']   = 'operacoes';
		
		$data['servicos_menu'] = $this->servicos_model->get_servicos();

		$data['operacoes'] = $this->operacoes_model->get_operacoes();
		
		//menu & topo
		$data['topo'] = $this->topos_model->get_topo($data['active']);
		$data['topo'] = $data['topo']->imagem;
		
		
		$this->load->view('site/operacoes', $data);
	}
}