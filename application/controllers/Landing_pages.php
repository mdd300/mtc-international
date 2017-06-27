<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landing_pages extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->helper('text');
        $this->load->model('topos_model');
        $this->load->model('landing_pages_model');
        $this->load->model('areas_de_atuacao_model');
        $this->load->model('servicos_model');
	}

	public function index($slug)
    {
        $data['active']   = 'landing-pages';

        $data['landing_page']  = $this->landing_pages_model->get_landing_page_slug($slug);

        $data['landing_page'] || show_404();

        $id = $data['landing_page']->id;
        
        $data['description'] = $data['landing_page']->description;

        $data['landing_pages'] = $this->landing_pages_model->get_landing_pages(
            $texto = "",
            $data_de = NULL,
            $data_ate = NULL,
            $limit = NULL,
            $offset = NULL,
            $count = NULL,
            $menos_estaID = $id,
            $order = NULL,
            $order_by = NULL
        );
        $data['landing_page_links'] = $this->landing_pages_model->get_landing_page_links($id);

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;
        $data['areas_de_atuacao'] = $this->areas_de_atuacao_model->get_areas_de_atuacao(); 
        $data['servicos_menu'] = $this->servicos_model->get_servicos(); 
        
        $this->load->view('site/landing-page', $data);
    }
}