<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tecnologia extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tecnologia_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        $data['active'] = 'tecnologia';
        $data['tecnologia'] = $this->tecnologia_model->get_tecnologia_site();
        
        $data['servicos_menu'] = $this->servicos_model->get_servicos();

        $data['tecnologia'] || show_404();

        $data['description'] = $data['tecnologia']->description;
        $data['title_meta'] = $data['tecnologia']->title;

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;

        $this->load->view('site/tecnologia', $data);
    }
}