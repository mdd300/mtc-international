<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quem_somos extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('quem_somos_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        $this->data['active'] = 'quem-somos';
        $this->data['quem_somos'] = $this->quem_somos_model->get_quem_somos_site();
        $this->data['servicos_menu'] = $this->servicos_model->get_servicos();

        $this->data['quem_somos'] || show_404();

        $this->data['description'] = $this->data['quem_somos']->description;
        $this->data['title_meta'] = $this->data['quem_somos']->title;

        //menu & topo
        $this->data['topo'] = $this->topos_model->get_topo($this->data['active']);
        $this->data['topo'] = $this->data['topo']->imagem;

        $this->load->view('site/quem-somos', $this->data);
    }
}
