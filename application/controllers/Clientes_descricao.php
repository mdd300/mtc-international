<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes_descricao extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clientes_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        $this->data['active'] = 'clientes-descricao';
        $this->data['clientes'] = $this->clientes_model->get_clientes();
        $this->data['servicos_menu'] = $this->servicos_model->get_servicos();

        /* $this->data['description'] = $this->data['clientes']->description; */
        /* $this->data['title_meta'] = $this->data['clientes']->title; */

        //menu & topo
        $this->data['topo'] = $this->topos_model->get_topo($this->data['active']);
        $this->data['topo'] = $this->data['topo']->imagem;

        $this->load->view('site/clientes-descricao', $this->data);
    }
}
