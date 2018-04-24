<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tecnologia extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tecnologia_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        $this->data['active'] = 'tecnologia';
        $this->data['tecnologia'] = $this->tecnologia_model->get_tecnologia_site();
        
        $this->data['servicos_menu'] = $this->servicos_model->get_servicos();

        $this->data['tecnologia'] || show_404();

        $this->data['description'] = $this->data['tecnologia']->description;
        $this->data['title_meta'] = $this->data['tecnologia']->title;

        //menu & topo
        $this->data['topo'] = $this->topos_model->get_topo($this->data['active']);
        $this->data['topo'] = $this->data['topo']->imagem;

        $this->load->view('site/tecnologia', $this->data);
    }
}
