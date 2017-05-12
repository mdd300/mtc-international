<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qualidade extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('qualidade_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        $data['active'] = 'qualidade';
        $data['qualidade'] = $this->qualidade_model->get_qualidade_site();
        
        $data['servicos_menu'] = $this->servicos_model->get_servicos();

        $data['qualidade'] || show_404();

        $data['description'] = $data['qualidade']->description;

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;

        $this->load->view('site/qualidade', $data);
    }
}