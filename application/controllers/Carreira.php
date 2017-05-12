<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carreira extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('carreira_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        $data['active'] = 'carreira';
        $data['carreira'] = $this->carreira_model->get_carreira_site();
        
        $data['servicos_menu'] = $this->servicos_model->get_servicos();

        $data['carreira'] || show_404();

        $data['description'] = $data['carreira']->description;

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;

        $this->load->view('site/carreira', $data);
    }
}