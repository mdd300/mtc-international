<?php

class Banners extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuarios_model');
        $this->load->model('banners_model');
    }

    public function index() {
        if ($this->usuarios_model->logado()) {
            if ($this->session->userdata('tipo') == 2) {
                $usuarioID = $this->session->userdata('usuarioID');
            }
            $this->data["banners"] = $this->banners_model->get_banners();
            $this->load->view('admin/banners/lista', $this->data);
        } else {
            $this->load->view('admin/login/index', $this->data);
        }        
    }

    public function cria() {
        $this->data['banner'] = '';
        $this->load->view('admin/banners/cria', $this->data);
    }

    function salvar() {
        $data = $_POST;
        $data['sort'] = $this->banners_model->get_sort();
        $data['habilitado'] = $this->input->post("habilitado");

        $imagem = $this->banners_model->upload_foto('imagem');
         
        if (!is_array($imagem) && isset($imagem)) {
            if (!is_array($imagem)) {
                $data['imagem'] = $imagem;
            }
        }

        $this->db->insert('banners', $data);
        $this->session->set_flashdata('messages', 'Banner inserida com sucesso.');
        redirect('admin/banners', 'location');
    }

    public function editar($id = false) {
        if (!$id) {
            redirect('admin/banners', 'location');
        }

        $this->data['banner'] = $this->banners_model->get_banner($id);
        $this->load->view('admin/banners/edita', $this->data);
    }

    public function atualizar() {
        $data = $_POST;
        $dataWhere['id'] = $this->input->post("id");
        $id = $this->input->post("id");
        unset($data['id']);

        $img_nome = $this->banners_model->upload_foto('imagem');

        if (!is_array($img_nome) && isset($img_nome)) {
            if (!is_array($img_nome)) {
                @$imagem = $this->banners_model->get_imagem_banner($id);
                if (@$imagem) {
                    unlink('assets/uploads/banners/' . $imagem);
                }
                $data['imagem'] = $img_nome;
            }
        }

        if ($this->banners_model->atualizar($data, $dataWhere)) {
            $this->session->set_flashdata('messages', 'Banner atualizado com sucesso.');
            redirect('admin/banners', 'location');
        } else {
            $this->session->set_flashdata('errors', 'Não foi possível atualizar o banner. Tente novamente.');
            redirect('admin/banners', 'location');
        }
    }

    public function limpar() {
        $this->session->set_flashdata('status', '');

        redirect('admin/banners');
    }

    public function excluir_selecionados() {
        $ok = true;
        $erros = array();
        $ids = $this->input->post("ids");

        if (!$ids) {
            $this->session->set_flashdata('errors', 'Você deve selecionar pelo menos um registro para excluir');
            redirect('banners');
        }

        $banners = explode(';', $ids);
        for ($i = 0; $i <= count($banners) - 1; $i++) {

            if (!$this->banners_model->excluir($banners[$i])) {
                $ok = false;
                $erros[] = $banners[$i];
            }
        }
    

        if ($ok) {
            $this->session->set_flashdata('messages', 'Banners excluidos com sucesso.');
        } else {
            $msg = '';
            for ($i = 0; $i <= count($erros) - 2; $i++) {
                $banner = $this->banner_model->get_banner($erros[$i]);
                if ($i < count($erros) - 2)
                    $msg .= $banner->titulo . ", ";
                else
                    $msg .= $banner->titulo . ".";
            }

            $this->session->set_flashdata('errors', 'Os seguintes banners não foram excluidas: ' . $msg);
        }
    }

    public function rearrange()
    {
        $this->banners_model->rearrange();
    }

    public function salvar_ordem()
    {
        $data = $_POST;

        $lis = explode( ';' , $data['new_order_array'] );

        foreach ( $lis as $key => $val ) {
            //explode each value found by "="...
            $pos = explode( '=' , $val );
            
            $id = $pos[0];
            $sort = $pos[1];

            $this->banners_model->atualizar_ordem($id, $sort);
        }
        
        redirect('admin/banners', 'location');
        $this->session->set_flashdata('messages', 'Itens reordenados');
    }

}

?>