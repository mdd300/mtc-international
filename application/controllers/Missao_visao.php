<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Missao_visao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('missao_visao_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        $data['active'] = 'missao-visao';
        $data['missao_visao'] = $this->missao_visao_model->get_missao_visao_site();
       $data['servicos_menu'] = $this->servicos_model->get_servicos();

        $data['missao_visao'] || show_404();

        $data['description'] = $data['missao_visao']->description;

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;

        $this->load->view('site/missao-visao', $data);
    }
}