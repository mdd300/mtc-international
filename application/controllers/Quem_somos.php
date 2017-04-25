<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quem_somos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('quem_somos_model');
        $this->load->model('topos_model');
        $this->load->model('areas_de_atuacao_model');
    }

    public function index() {
        $data['active'] = 'quem-somos';
        $data['quem_somos'] = $this->quem_somos_model->get_quem_somos_site();
        $data['areas_de_atuacao'] = $this->areas_de_atuacao_model->get_areas_de_atuacao();  

        $data['quem_somos'] || show_404();

        $data['description'] = $data['quem_somos']->description;

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;

        $this->load->view('site/quem-somos', $data);
    }
}