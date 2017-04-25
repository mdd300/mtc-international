<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Servicos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('servicos_model');
        $this->load->model('topos_model');
        $this->load->model('areas_de_atuacao_model');
    }

    public function index() {
        $data['active'] = 'servicos';
        $data['servicos'] = $this->servicos_model->get_servicos_site();
        $data['areas_de_atuacao'] = $this->areas_de_atuacao_model->get_areas_de_atuacao();

        $data['servicos'] || show_404();

        $data['description'] = $data['servicos']->description;

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;

        $this->load->view('site/servicos', $data);
    }
}