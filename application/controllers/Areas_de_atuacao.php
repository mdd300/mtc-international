<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Areas_de_atuacao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('servicos_model');
        $this->load->model('topos_model');
        $this->load->model('areas_de_atuacao_model');
    }

    public function index() {
        show_404();

        $data['active'] = 'areas-de-atuacao';
        
        $data['servicos_menu'] = $this->servicos_model->get_servicos();
        
        $data['areas_de_atuacao'] = $this->areas_de_atuacao_model->get_areas_de_atuacao_site();

        $data['areas_de_atuacao'] || show_404();

        $data['description'] = $data['areas_de_atuacao']->description;

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;

        $this->load->view('site/areas-de-atuacao', $data);
        
    }
}