<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Operacoes extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('text');
		$this->load->model('operacoes_model');
		$this->load->model('servicos_model');
		$this->load->model('topos_model');
	}
	
	public function index()
	{
		$this->data['active']   = 'operacoes';
		
		$this->data['servicos_menu'] = $this->servicos_model->get_servicos();

		$this->data['operacoes'] = $this->operacoes_model->get_operacoes();

		$this->data['title_meta'] = 'LOGÍSTICA PARA E-COMMERCE - Operações Logísticas Internas e externas.';
		$this->data['description'] = 'MTC LOG - Logística Reversa, implementação de WMS, transporte, serviços técnicos, reengenharia de embalagens de exportação e muito mais.';
		
		//menu & topo
		$this->data['topo'] = $this->topos_model->get_topo($this->data['active']);
		$this->data['topo'] = $this->data['topo']->imagem;
		
		
		$this->load->view('site/operacoes', $this->data);
	}
}
