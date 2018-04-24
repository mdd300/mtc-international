<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sustentabilidade extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('sustentabilidade_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        $this->data['active'] = 'sustentabilidade';
        $this->data['servicos_menu'] = $this->servicos_model->get_servicos();
        
        $this->data['sustentabilidade'] = $this->sustentabilidade_model->get_sustentabilidade_site();

        $this->data['sustentabilidade'] || show_404();

        $this->data['description'] = $this->data['sustentabilidade']->description;

        //menu & topo
        $this->data['topo'] = $this->topos_model->get_topo($this->data['active']);
        $this->data['topo'] = $this->data['topo']->imagem;

        $this->load->view('site/sustentabilidade', $this->data);
    }
}
