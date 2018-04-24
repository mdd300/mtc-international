<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landing_pages extends MY_Controller {

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
        $this->data['active']   = 'landing-pages';

        $this->data['landing_page']  = $this->landing_pages_model->get_landing_page_slug($slug);

        $this->data['landing_page'] || show_404();

        $id = $this->data['landing_page']->id;
        
        $this->data['description'] = $this->data['landing_page']->description;

        $this->data['landing_pages'] = $this->landing_pages_model->get_landing_pages(
            $texto = "",
            $this->data_de = NULL,
            $this->data_ate = NULL,
            $limit = NULL,
            $offset = NULL,
            $count = NULL,
            $menos_estaID = $id,
            $order = NULL,
            $order_by = NULL
        );
        $this->data['landing_page_links'] = $this->landing_pages_model->get_landing_page_links($id);

        //menu & topo
        $this->data['topo'] = $this->topos_model->get_topo($this->data['active']);
        $this->data['topo'] = $this->data['topo']->imagem;
        $this->data['areas_de_atuacao'] = $this->areas_de_atuacao_model->get_areas_de_atuacao(); 
        $this->data['servicos_menu'] = $this->servicos_model->get_servicos(); 

        $this->data['title'] = $this->data['landing_page']->title;

        $this->load->view('site/landing-page', $this->data);
    }
}
