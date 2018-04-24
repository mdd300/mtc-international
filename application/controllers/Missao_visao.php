<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Missao_visao extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('missao_visao_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() 
    {
        $this->data['active'] = 'missao-visao';

        $this->data['missao_visao'] = $this->missao_visao_model->get_missao_visao_site();
        $this->data['servicos_menu'] = $this->servicos_model->get_servicos();

        $this->data['missao_visao'] || show_404();

        $this->data['description'] = $this->data['missao_visao']->description;
        $this->data['title_meta'] = $this->data['missao_visao']->title;

        //menu & topo
        $this->data['topo'] = $this->topos_model->get_topo($this->data['active']);
        $this->data['topo'] = $this->data['topo']->imagem;

        $this->load->view('site/missao-visao', $this->data);
    }
}
