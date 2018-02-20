<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes_descricao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clientes_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        $data['active'] = 'clientes-descricao';
        $data['clientes'] = $this->clientes_model->get_clientes();
        $data['servicos_menu'] = $this->servicos_model->get_servicos();

        /* $data['description'] = $data['clientes']->description; */
        /* $data['title_meta'] = $data['clientes']->title; */

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;

        $this->load->view('site/clientes-descricao', $data);
    }
}
