<?php

class Landing_pages_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('image_lib');
		$this->load->helper('utility_helper');
	}  

	function fix(){
		$landing_pages = $this->db->select("*")->from("landing_pages")->get()->result();
		foreach($landing_pages as $landing_page):   
			$landing_page->descricao = str_replace("\r\n", "<br />", $landing_page->descricao);
			$id = $landing_page->id;
			unset($landing_page->id);
						
			$this->atualizar($landing_page, array("id" => $id));
		endforeach;        
	}
		
	function add_count($id) {
		$this->db->select('*');
		$this->db->from('landing_pages');
		$this->db->where('id', $id);
		$data['visualizacoes'] = $this->db->get()->row()->visualizacoes;

		$data['visualizacoes']++;
		$this->db->where('id',$id);
		$this->db->update('landing_pages', $data);
		
		return $data['visualizacoes']++;
	}

	function get_landing_pages(
		$texto = "",
		$data_de = NULL,
		$data_ate = NULL,
		$limit = NULL,
		$offset = NULL,
		$count = NULL,
		$menos_estaID = NULL,
		$order = NULL,
		$order_by = NULL
	) {
		$this->db->select('*');
		$this->db->from('landing_pages');

		if ($texto != '') {
			$this->db->like('titulo', $texto);
			$this->db->or_like('resumo', $texto);
			$this->db->or_like('descricao', $texto);
		}

		if ($data_de != '') {
			$d = get_data_for_mysql_format($data_de);
			$this->db->where('data_criacao >=', $d);
		}

		if ($data_ate != '') {
			$t = get_data_for_mysql_format($data_ate);
			$this->db->where('data_criacao <=', $t);
		}

		if (($limit) AND ($count != TRUE)) {
			$this->db->limit($limit, $offset);
		}
		
		if($menos_estaID){
			$this->db->where('id !=', $menos_estaID);
		}

		if ($order_by != NULL && $order != NULL) {
			$this->db->order_by($order_by, $order);
		} else {
			if ($order_by == NULL && $order == NULL) {
				$this->db->order_by('data_criacao', 'desc');
			} else {
				if ($order == NULL) {
					$this->db->order_by($order_by, 'desc');
				} else {
					$this->db->order_by('data_criacao', $order);
				}
			}
		}
		
		$this->db->where('habilitado', 1);
		$landing_pages = $this->db->get()->result();

		foreach($landing_pages as $landing_page):
			$landing_page->slug = $this->slug($landing_page->titulo);
		endforeach;
				 
		if ($count != TRUE) {
			return $landing_pages;
		} else {
			return count($landing_pages);
		}
	}


	function get_related($id){
		$this->db->select('*');
		$this->db->from('landing_pages');
		$this->db->where('habilitado', 1);
		$this->db->where('id !=', $id);
		$this->db->where('`id` in (select `id` from `tags_news` where `tagID` in (select `tagID` from `tags_news` where `id` = "' . $id . '"))', NULL, FALSE);
		$this->db->order_by('id', 'DESC');
		$this->db->limit(4);

		return $this->db->get()->result();
	}

	function upload_foto_grande($field) {
		$dir = realpath('assets/uploads/landing_pages');
		$config['upload_path'] = $dir;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['encrypt_name'] = TRUE;
		$config['maintain_ratio'] = FALSE;
		$config['max_size'] = '500000';
		$config['max_width'] = '10024';
		$config['max_height'] = '7068';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$field_name = $field;

		if ($this->upload->do_upload($field_name)) {
			$dados = $this->upload->data();

			$size = getimagesize($dados['full_path']);

			$config_img['image_library'] = 'GD2';
			$config_img['source_image'] = $dados['full_path'];
			$config_img['create_thumb'] = FALSE;
			$config_img['maintain_ratio'] = TRUE;
			$config_img['encrypt_name'] = TRUE;   

			$config_img['width'] = 750;
			$config_img['height'] = 372;

			$this->image_lib->initialize($config_img);

			$config['source_image'] = $dir.'/'.$dados['file_name'];
			$this->image_lib->crop($config['source_image']);
			// Returns the photo name
			return $dados['file_name'];
		} else {
			$error = array('error' => $this->upload->display_errors());
			return $error;
		}
	}

	function upload_foto_pequena($field) {
		$dir = realpath('assets/uploads/landing_pages');
		$config['upload_path'] = $dir;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['encrypt_name'] = TRUE;
		$config['maintain_ratio'] = FALSE;
		$config['max_size'] = '500000';
		$config['max_width'] = '10024';
		$config['max_height'] = '7068';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$field_name = $field;

		if ($this->upload->do_upload($field_name)) {
			$dados = $this->upload->data();
			$size = getimagesize($dados['full_path']);

			$config_img['image_library'] = 'GD2';
			$config_img['source_image'] = $dados['full_path'];
			$config_img['create_thumb'] = FALSE;
			$config_img['maintain_ratio'] = FALSE;
			$config_img['encrypt_name'] = TRUE;   

			$config_img['width'] = 1200;
			$config_img['height'] = 630;
			$this->image_lib->initialize($config_img);

			$config['source_image'] = $dir.'/'.$dados['file_name'];
			$this->image_lib->resize($config['source_image']);
			// Returns the photo name
			return $dados['file_name'];
		} else {
			$error = array('error' => $this->upload->display_errors());
			return $error;
		}
	}

	function get_landing_page($id) {
		$this->db->select("*");
		$this->db->from("landing_pages");
		$this->db->where("id", $id);

		$landing_page = $this->db->get()->row();
		return $landing_page;
	}

	function get_landing_page_slug($slug) {
		$this->db->select("*");
		$this->db->from("landing_pages");
		$this->db->like("slug", $slug, 'none');

		
		$landing_page = $this->db->get()->row();
		
		return $landing_page;
	}

	function get_landing_page_links($id) {
		$this->db->select("*");
		$this->db->from("landing_pages_links");
		$this->db->order_by("id", "DESC");
		$this->db->where("landing_page_id", $id);

		$landing_page = $this->db->get()->result();
		return $landing_page;
	}

	function salvar($data) {
		$this->db->insert('landing_pages', $data);
		return $this->db->insert_id();
	}

	function atualizar($data, $dataWhere) {
		$this->db->update('landing_pages', $data, $dataWhere);
		return true;
	}

	function excluir($id) {
		$this->db->delete('landing_pages', array("id" => $id));
		return true;
	}

	function excluir_link($id) {
		$this->db->delete('landing_pages_links', array("id" => $id));
		return true;
	}

	function slug($string, $type = '-') {
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';

        $string = utf8_decode($string);
        $string = str_replace('?', '', $string);
        $string = str_replace('&', '', $string);
        $string = str_replace('(', '', $string);
        $string = str_replace(')', '', $string);
        $string = str_replace('.', '', $string);
        $string = str_replace(' – ', '-', $string);
        $string = str_replace('%', 'porcento', $string);
        $string = strtr($string, utf8_decode($a), $b);
        $string = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);
        $string = str_replace(' - ', '-', $string);
        $string = str_replace(' ', '-', $string);
        $string = strtolower($string);
        return utf8_encode($string);
	}
}

?>