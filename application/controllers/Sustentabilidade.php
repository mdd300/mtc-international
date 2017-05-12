<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sustentabilidade extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('sustentabilidade_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        $data['active'] = 'sustentabilidade';
        $data['servicos_menu'] = $this->servicos_model->get_servicos();
        
        $data['sustentabilidade'] = $this->sustentabilidade_model->get_sustentabilidade_site();

        $data['sustentabilidade'] || show_404();

        $data['description'] = $data['sustentabilidade']->description;

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;

        $this->load->view('site/sustentabilidade', $data);
    }
}