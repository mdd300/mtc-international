<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes_descricao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clientes_descricao_model');
        $this->load->model('topos_model');
        $this->load->model('servicos_model');
    }

    public function index() {
        $data['active'] = 'clientes-descricao';
        $data['clientes_descricao'] = $this->clientes_descricao_model->get_clientes_descricao_site();
        $data['servicos_menu'] = $this->servicos_model->get_servicos();

        $data['clientes_descricao'] || show_404();

        $data['description'] = $data['clientes_descricao']->description;
        $data['title_meta'] = $data['clientes_descricao']->title;

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;

        $this->load->view('site/clientes-descricao', $data);
    }
}