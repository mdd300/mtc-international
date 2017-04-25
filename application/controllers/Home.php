<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('text');
		$this->load->model('banners_model');
		$this->load->model('areas_de_atuacao_model');
	}
	
	public function index()
	{
		$data['active']   = 'home';
		$data['banners']  = $this->banners_model->get_banners(1);
		$data['areas_de_atuacao'] = $this->areas_de_atuacao_model->get_areas_de_atuacao();	

		$this->load->view('site/index', $data);
	}
}