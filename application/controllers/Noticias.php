<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->helper('text');
        $this->load->model('noticias_model');
        $this->load->model('servicos_model');
        $this->load->model('topos_model');
	}

	public function index() {
    
	    $data['active'] = 'noticias';

        //pagination
        $limit = 6;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["noticias"] = $this->noticias_model->get_noticias(NULL, NULL, NULL, $limit, $offset, NULL);
        $total_noticias = $this->noticias_model->get_noticias(NULL, NULL, NULL, $limit, $offset, TRUE);
        $config = array();
        $config["base_url"] = base_url() . "noticias/index";

        $config["total_rows"] = $total_noticias;
        $config["per_page"] = $limit;
        $config["uri_segment"] = 3;
        //styling pagination
        $config['full_tag_open'] = '<ul class="pagination custom-pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="current"><a>';
        $config['cur_tag_close'] = '</li></a>';
        $config['next_link'] = '&raquo';
        $config['prev_link'] = '&laquo;';
        $config['last_link'] = FALSE;
        $config['first_link'] = FALSE;
        $config['last_tag_open'] = '<li>';
        $config['first_tag_open'] = '<li>';
        $config['next_tag_open'] = '<li class="pagination-next">';
        $config['prev_tag_open'] = '<li class="pagination-prev">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();
        $data["total_noticias"] = $total_noticias;

        $data['description'] = 'LOGÍSTICA PARA E-COMMERCE - Operações Logísticas Internas e externas.';
        $data['title_meta'] = 'MTC LOG - Logística Reversa, implementação de WMS, transporte, serviços técnicos, reengenharia de embalagens de exportação e muito mais.';

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;
        $data['servicos_menu'] = $this->servicos_model->get_servicos();
                
        $this->load->view('site/noticias', $data);
    }

    public function pesquisa($slug = false) {

        $slug || show_404();
    
        $data['active'] = 'noticia';

        //pagination
        $limit = 6;
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["noticias"] = $this->noticias_model->get_noticias(NULL, NULL, NULL, $limit, $offset, NULL, NULL, NULL, NULL, $slug);

        $data['noticias'] || show_404();
        
        $total_noticias = $this->noticias_model->get_noticias(NULL, NULL, NULL, $limit, $offset, TRUE, NULL, NULL, NULL, $slug);
        $config = array();
        $config["base_url"] = base_url() . "noticias/pesquisa/".$slug;

        $config["total_rows"] = $total_noticias;
        $config["per_page"] = $limit;
        $config["uri_segment"] = 4;
        //styling pagination
        $config['full_tag_open'] = '<ul class="pagination custom-pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="current"><a>';
        $config['cur_tag_close'] = '</li></a>';
        $config['next_link'] = '&raquo';
        $config['prev_link'] = '&laquo;';
        $config['last_link'] = FALSE;
        $config['first_link'] = FALSE;
        $config['last_tag_open'] = '<li>';
        $config['first_tag_open'] = '<li>';
        $config['next_tag_open'] = '<li class="pagination-next">';
        $config['prev_tag_open'] = '<li class="pagination-prev">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();
        $data["total_noticias"] = $total_noticias;

        $data['description'] = 'LOGÍSTICA PARA E-COMMERCE - Operações Logísticas Internas e externas.';
        $data['title_meta'] = 'MTC LOG - Logística Reversa, implementação de WMS, transporte, serviços técnicos, reengenharia de embalagens de exportação e muito mais.';

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;
        $data['servicos_menu'] = $this->servicos_model->get_servicos();
                
        $this->load->view('site/noticias', $data);
    }

    public function show($slug = false)
    {
        $slug || show_404();

        $data['active']   = 'noticia';
        $data['noticia']  = $this->noticias_model->get_noticia_slug($slug);
        
        $data['noticia'] || show_404();

        $data['description'] = $data['noticia']->description;
        $data['title_meta'] = $data['noticia']->title;

        $data['mais_noticias'] = $this->noticias_model->get_noticias(
            $texto = "",
            $data_de = NULL,
            $data_ate = NULL,
            $limit = 4,
            $offset = NULL,
            $count = NULL,
            $menos_estaID = $data['noticia']->noticiaID,
            $order = NULL,
            $order_by = NULL
        );

        //menu & topo
        $data['topo'] = $this->topos_model->get_topo($data['active']);
        $data['topo'] = $data['topo']->imagem;
        $data['servicos_menu'] = $this->servicos_model->get_servicos();
        
        $this->load->view('site/noticia', $data);
    }
}