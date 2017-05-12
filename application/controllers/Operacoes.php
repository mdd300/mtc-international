<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Operacoes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('operacoes_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        $data['active'] = 'operacoes';
        $data['operacoes'] = $this->operacoes_model->get_operacoes_site();
        
        $data['servicos_menu'] = $this->servicos_model->get_servicos();

        $data['operacoes'] || show_404();

        $data['description'] = $data['operacoes']->description;

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;

        $this->load->view('site/operacoes', $data);
    }
}