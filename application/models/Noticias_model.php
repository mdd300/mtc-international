<?php

class Noticias_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('image_lib');
		$this->load->helper('utility_helper');
	}  

	function fix(){
		$noticias = $this->db->select("*")->from("noticias")->get()->result();
		foreach($noticias as $noticia):   
			$noticia->descricao = str_replace("\r\n", "<br />", $noticia->descricao);
			$noticiaID = $noticia->noticiaID;
			unset($noticia->noticiaID);
						
			$this->atualizar($noticia, array("noticiaID" => $noticiaID));
		endforeach;        
	}
		
	function add_count($noticiaID) {
		$this->db->select('*');
		$this->db->from('noticias');
		$this->db->where('noticiaID', $noticiaID);
		$data['visualizacoes'] = $this->db->get()->row()->visualizacoes;

		$data['visualizacoes']++;
		$this->db->where('noticiaID',$noticiaID);
		$this->db->update('noticias', $data);
		
		return $data['visualizacoes']++;
	}

	function get_noticias(
		$texto = "",
		$data_de = NULL,
		$data_ate = NULL,
		$limit = NULL,
		$offset = NULL,
		$count = NULL,
		$menos_estaID = NULL,
		$order = NULL,
		$order_by = NULL,
		$pesquisa = FALSE
	) {
		$this->db->select('*');
		$this->db->from('noticias');

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

		if (($limit) && ($offset) && ($count != TRUE)) {
			$this->db->limit($limit, $offset);
		}

		if (($limit) && (is_null($offset)) && ($count != TRUE)) {
			$this->db->limit($limit);
		}
		
		if($menos_estaID){
			$this->db->where('noticiaID !=', $menos_estaID);
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

		if($pesquisa){
			$this->db->where('tipo', $pesquisa);
		}
		
		$this->db->where('habilitado', 1);
		$noticias = $this->db->get()->result();

		foreach($noticias as $noticia):
			$noticia->slug = $this->slug($noticia->titulo);
		endforeach;
				 
		if ($count != TRUE) {
			return $noticias;
		} else {
			return count($noticias);
		}
	}


	function get_related($noticiaID){
		$this->db->select('*');
		$this->db->from('noticias');
		$this->db->where('habilitado', 1);
		$this->db->where('noticiaID !=', $noticiaID);
		$this->db->where('`noticiaID` in (select `noticiaID` from `tags_news` where `tagID` in (select `tagID` from `tags_news` where `noticiaID` = "' . $noticiaID . '"))', NULL, FALSE);
		$this->db->order_by('noticiaID', 'DESC');
		$this->db->limit(4);

		return $this->db->get()->result();
	}

	function upload_foto_grande($field) {
		$dir = realpath('assets/uploads/noticias');
		$config['upload_path'] = $dir;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['encrypt_name'] = TRUE;
		$config['maintain_ratio'] = TRUE;
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

			$config_img['width'] = 869;
			$config_img['height'] = 499;

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
		$dir = realpath('assets/uploads/noticias');
		$config['upload_path'] = $dir;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['encrypt_name'] = TRUE;
		$config['maintain_ratio'] = TRUE;
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

			$config_img['width'] = 499;
			$config_img['height'] = 499;
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

	function get_noticia($noticiaID) {
		$this->db->select("*");
		$this->db->from("noticias");
		$this->db->where("noticiaID", $noticiaID);

		$noticia = $this->db->get()->row();
		return $noticia;
	}

	function get_noticia_slug($slug) {
		$this->db->select("*");
		$this->db->from("noticias");
		$this->db->like("slug", $slug, 'none');

		
		$noticia = $this->db->get()->row();
		
		return $noticia;
	}

	function salvar($data) {
		$this->db->insert('noticias', $data);
		return $this->db->insert_id();
	}

	function atualizar($data, $dataWhere) {
		$this->db->where('noticiaID', $dataWhere['noticiaID'])->update('noticias', $data);
		return true;
	}

	function excluir($noticiaID) {
		$this->db->delete('noticias', array("noticiaID" => $noticiaID));
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