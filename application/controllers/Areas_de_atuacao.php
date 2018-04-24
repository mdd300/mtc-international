<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Areas_de_atuacao extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('servicos_model');
        $this->load->model('topos_model');
        $this->load->model('areas_de_atuacao_model');
    }

    public function index() {
        show_404();

        $this->data['active'] = 'areas-de-atuacao';
        
        $this->data['servicos_menu'] = $this->servicos_model->get_servicos();
        
        $this->data['areas_de_atuacao'] = $this->areas_de_atuacao_model->get_areas_de_atuacao_site();

        $this->data['areas_de_atuacao'] || show_404();

        $this->data['description'] = $this->data['areas_de_atuacao']->description;

        //menu & topo
        $this->data['topo'] = $this->topos_model->get_topo($this->data['active']);
        $this->data['topo'] = $this->data['topo']->imagem;

        $this->load->view('site/areas-de-atuacao', $this->data);
        
    }
}
