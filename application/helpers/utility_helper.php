<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (!function_exists('objectToArray')) {

	function objectToArray($object) {
		if (count($object) > 1) {
			$arr = array();
			for ($i = 0; $i < count($object); $i++) {
				$arr[] = get_object_vars($object[$i]);
			}

			return $arr;
		} else {
			return get_object_vars($object);
		}
	}

}

if (!function_exists('get_youtube_id')) {
	function get_youtube_id($value)
	{
	    preg_match("/(?<=(v|i)=)[a-zA-Z0-9-]+(?=&)|(?<=(?:v|i)\/)[^&\n]+|(?<=embed\/)[^\"&\n]+|(?<=(?:v|i)=)[^&\n]+|(?<=youtu.be\/)[^&\n]+/", $value, $matches);
	    return $matches[0];
	}
}

/**
 * Transforma p em brbr
 *
 * @access	public
 * @param $string string
 * @return	string
 */
if (!function_exists('pToBr')) {

	function pToBr($string) {
		return str_replace('<p>', '', str_replace('</p>', '<br /><br />', $string));
	}

}

/**
 * Retorna o título, concatenando com o título padrão
 *
 * @access	public
 * @param   $titulo string
 * @return	string
 */
if (!function_exists('busca_config')) {

	function busca_config($id) {
		$CI = &get_instance();

		$CI->db->select('valor');
		$CI->db->from('configs');
		$CI->db->where('id_config', $id);

		$dados = $CI->db->get()->row();

		return $dados->valor;
	}

}

if (!function_exists('doubleToMoney')) {
	function doubleToMoney($value) {
		$value = (float) $value;
		return "R$" . number_format($value, '2', ',', '.');
	}
}

if (!function_exists('moneyToDouble')) {
	function moneyToDouble($value) {
		$value = str_replace('R$', '', $value);
		$value = str_replace('.', '', $value);
		$value = str_replace(',', '.', $value);
		return (DOUBLE) $value;
	}
}

setlocale(LC_MONETARY, "pt_BR", "ptb");
if (!function_exists('frmPreco')) {

	function frmPreco($preco) {
		return number_format($preco, '2', ',', '.');
	}

}

if (!function_exists('arrayToUrlSearch')) {

	function arrayToUrlSearch($array) {
		$url = array();

		foreach ($array as $key => $value) {
			if (!empty($value)) {
				$value = str_replace('/', '-', $value);
				$url[] = "$key/$value";
			}
		}

		return implode('/', $url);
	}

}

if (!function_exists('get_data_for_mysql_format')) {

	function get_data_for_mysql_format($date) {
		list($dia, $mes, $ano) = explode('/', $date);

		return "$ano-$mes-$dia";
	}

}

if (!function_exists('format_data_mysql')) {

	function format_data_mysql($date) {
		list($data, $hora) = explode(' ', $date);

		list($ano, $mes, $dia) = explode('-', $data);

		return "$dia/$mes/$ano";
	}

}

if (!function_exists('format_day_mysql')) {

	function format_day_mysql($date) {
		list($data, $hora) = explode(' ', $date);

		list($ano, $mes, $dia) = explode('-', $data);

		return $dia;
	}

}

if (!function_exists('format_day_mysql')) {
	function format_day_mysql($date) {
		list($data, $hora) = explode(' ', $date);

		list($ano, $mes, $dia) = explode('-', $data);

		return $dia;
	}
}

if (!function_exists('format_month_mysql')) {

	function format_month_mysql($date) {
		list($data, $hora) = explode(' ', $date);

		list($ano, $mes, $dia) = explode('-', $data);

		switch ($mes) {
			case '01':
				$mes = 'Jan';
				break;
			case '02':
				$mes = 'Fev';
				break;
			case '03':
				$mes = 'Mar';
				break;
			case '04':
				$mes = 'Abr';
				break;
			case '05':
				$mes = 'Mai';
				break;
			case '06':
				$mes = 'Jun';
				break;
			case '07':
				$mes = 'Jul';
				break;
			case '08':
				$mes = 'Ago';
				break;
			case '09':
				$mes = 'Set';
				break;
			case '10':
				$mes = 'Out';
				break;
			case '11':
				$mes = 'Nov';
				break;
			case '12':
				$mes = 'Dez';
				break;
		}

		return $mes;
	}

}

if (!function_exists('format_data_extensa_mysql')) {

	function format_data_extensa_mysql($date) {
		list($data, $hora) = explode(' ', $date);

		list($ano, $mes, $dia) = explode('-', $data);

		switch ($mes) {
			case '01':
				$mes = 'janeiro';
				break;
			case '02':
				$mes = 'fevereiro';
				break;
			case '03':
				$mes = 'março';
				break;
			case '04':
				$mes = 'abril';
				break;
			case '05':
				$mes = 'maio';
				break;
			case '06':
				$mes = 'junho';
				break;
			case '07':
				$mes = 'julho';
				break;
			case '08':
				$mes = 'agosto';
				break;
			case '09':
				$mes = 'setembro';
				break;
			case '10':
				$mes = 'outubro';
				break;
			case '11':
				$mes = 'novembro';
				break;
			case '12':
				$mes = 'dezembro';
				break;
		}

		return $dia." de ".$mes." de ".$ano;
	}

}

if (!function_exists('format_year_mysql')) {

	function format_year_mysql($date) {
		list($data, $hora) = explode(' ', $date);

		list($ano, $mes, $dia) = explode('-', $data);

		return $ano;
	}

}

if (!function_exists('format_date_mysql')) {
	function format_date_mysql($date) {
		list($ano, $mes, $dia) = explode('-', $date);
		return "$dia/$mes/$ano";
	}
}

if (!function_exists('get_date')) {
	function get_date($date) {
		list($data, $hora) = explode(' ', $date);
		return "$data";
	}
}

if (!function_exists('format_data_mysql_pipe')) {

	function format_data_mysql_pipe($date) {
		list($data, $hora) = explode(' ', $date);

		list($ano, $mes, $dia) = explode('-', $data);

		return "$dia | $mes | $ano";
	}

}

if (!function_exists('format_data_mysql_dot')) {

	function format_data_mysql_dot($date) {
		list($data, $hora) = explode(' ', $date);

		list($ano, $mes, $dia) = explode('-', $data);

		return "$dia.$mes.$ano";
	}

}

if (!function_exists('get_day_week')){
	function get_day_week($date){
		list($data, $hora) = explode(' ', $date);
		list($ano, $mes, $dia) = explode('-', $data);

		$jd=cal_to_jd(CAL_GREGORIAN,$mes,$dia,$ano);

		$dw = jddayofweek($jd,1);

		switch ($dw) {
			case 'Monday':
				$dw = 'Segunda-feira';
				break;
			case 'Tuesday':
				$dw = 'Terça-feira';
				break;
			case 'Wednesday':
				$dw = 'Quarta-feira';
				break;
			case 'Thursday':
				$dw = 'Quinta-feira';
				break;
			case 'Friday':
				$dw = 'Sexta-feira';
				break;
			case 'Saturday':
				$dw = 'Sábado';
				break;
			case 'Sunday':
				$dw = 'Domingo';
				break;
		}

		return $dw;
	}
}

if (!function_exists('format_hora_mysql')) {

	function format_hora_mysql($date) {
		list($data, $hora) = explode(' ', $date);

		list($h, $min, $sec) = explode(':', $hora);

		return "$h:$min";
	}

}
/**
 * Funçao para formatar a data
 * entra AAAA/MM/DD HH:MM:SS e sai DD/MM/AAAA HH:MM:SS
 */
if (!function_exists('data_iso_to_pt')) {

	function data_iso_to_pt($date) {
		list($data, $hora) = explode(' ', $date);
		$hora = !empty($hora) ? $hora : date('H:i:s');
		$data = implode('/', array_reverse(explode('-', $data))) . ' ' . $hora;

		return $data;
	}
}

/**
 * Funçao para formatar a data
 * entra DD/MM/AAAA HH:MM:SS e sai AAAA/MM/DD HH:MM:SS
 */
if (!function_exists('data_pt_to_iso')) {

	function data_pt_to_iso($date) {
		list($data, $hora) = explode(' ', $date);
		$hora = !empty($hora) ? $hora : date('H:i:s');
		$data = implode('-', array_reverse(explode('/', $data))) . ' ' . $hora;

		return $data;
	}
}

/**
 * Retorna o html do banner
 */
if (!function_exists('htmlBanner')) {

	function htmlBanner($result) {
		if (count($result) == 0) {
			return '';
		}

		@$arquivo = explode(".", $result->arquivo);

		if ($result->width == 0) {
			$width = '';
		} else {
			$width = 'width="' . $result->width . '"';
		}

		if ($result->height == 0) {
			$height = '';
		} else {
			$height = 'height="' . $result->height . '"';
		}

		if (@$arquivo[1] == 'swf') {
			return "
			<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' " . $width . " " . $height . " id='index' align='middle'>
			<param name='allowScriptAccess' value='sameDomain' />
			<param name='movie' value='" . base_url() . "uploads/banners/" . $result->arquivo . "' />
			<param name='quality' value='high' />
			<param name='bgcolor' value='#FFFFFF' />
			<param name='scale' value='noscale' />
			<param name='wmode' value='transparent' />
			<embed src='" . base_url() . "uploads/banners/" . $result->arquivo . "' FlashVars='' wmode='transparent' quality='high' bgcolor='#FFFFFF' " . $width . " " . $height . " name='index' align='top' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />
			</object>";
		} else {
			$html = '';

			$class = '';
			if ($result->key == 'home_topo2') {
				$class = 'class = "welcome"';
			} elseif ($result->key == 'sidebar') {
				$class = 'class="banner-promocao"';
			}

			if ($result->link) {
				$html .= '<a href="' . $result->link . '" title="' . $result->titulo . '">';
			}

			$html .= "<img $class src='" . base_url() . "uploads/banners/" . $result->arquivo . "' alt='" . $result->titulo . "' " . $width . " " . $height . " />";

			if ($result->link) {
				$html .= '</a>';
			}

			return $html;
		}
	}

}

if (!function_exists('pr')) {

	function pr($var, $exit = false) {
		if (is_string($var)) {
			$var = htmlentities($var);
		}
		echo "<pre>";
		print_r($var);
		echo "</pre>";

		if ($exit) {
			exit();
		}
	}

}

if (!function_exists('get_cidade')) {
	function get_cidade($cidade_id) {

		$CI = &get_instance();

		$CI->db->select('nome');
		$CI->db->from('cidades');
		$CI->db->where('id_cidade', $cidade_id);

		$dados = $CI->db->get()->row();

		if ($dados) {
			return $dados->nome;
		} else {
			return 'Não Informado';
		}
	}
}

if (!function_exists('get_estado')) {
	function get_estado($estado) {
		switch ($estado) {
			case 'AC':
				$estado = 'Acre';
				break;
			case 'AL':
				$estado = 'Alagoas';
				break;
			case 'AM':
				$estado = 'Amazonas';
				break;
			case 'BA':
				$estado = 'Bahia';
				break;
			case 'CE':
				$estado = 'Ceará';
				break;
			case 'DF':
				$estado = 'Distrito Federal';
				break;
			case 'ES':
				$estado = 'Espírito Santo';
				break;
			case 'GO':
				$estado = 'Goiás';
				break;
			case 'MA':
				$estado = 'Maranhão';
				break;
			case 'MT':
				$estado = 'Mato Grosso';
				break;
			case 'MS':
				$estado = 'Mato Grosso do Sul';
				break;
			case 'MG':
				$estado = 'Minas Gerais';
				break;
			case 'PA':
				$estado = 'Pará';
				break;
			case 'PB':
				$estado = 'Paraíba';
				break;
			case 'PR':
				$estado = 'Paraná';
				break;
			case 'PE':
				$estado = 'Pernambuco';
				break;
			case 'PI':
				$estado = 'Piauí';
				break;
			case 'RJ':
				$estado = 'Rio de Janeiro';
				break;
			case 'RN':
				$estado = 'Rio Grande do Norte';
				break;
			case 'RS':
				$estado = 'Rio Grande do Sul';
				break;
			case 'RO':
				$estado = 'Rondônia';
				break;
			case 'RR':
				$estado = 'Roraima';
				break;
			case 'SC':
				$estado = 'Santa Catarina';
				break;
			case 'SP':
				$estado = 'São Paulo';
				break;
			case 'SE':
				$estado = 'Sergipe';
				break;
			case 'TO':
				$estado = 'Tocantins';
				break;
		}
		return $estado;
	}
}

if (!function_exists('getShortURL')) {
	function getShortURL($url) {

		$CI = &get_instance();

		$CI->load->library('Http');
		Http::post('http://goo.gl/api/shorten', array(
			'url' => $url,
		));

		$resp = json_decode(Http::result());

		return $resp->short_url;
	}
}
//devolve os meses por extenso
//entra 01/04/2014 ou 01-04-2014 ou 01.04.2014
//sai 01 de abril de 2014
if (!function_exists('data_escrita')) {
	function data_escrita($date) {

		list($data, $hora) = explode(' ', $date);
		list($ano, $mes, $dia) = explode('-', $data);

		switch ($mes) {
			case '01':
				$mes = 'janeiro';
				break;
			case '02':
				$mes = 'fevereiro';
				break;
			case '03':
				$mes = 'março';
				break;
			case '04':
				$mes = 'abril';
				break;
			case '05':
				$mes = 'maio';
				break;
			case '06':
				$mes = 'junho';
				break;
			case '07':
				$mes = 'julho';
				break;
			case '08':
				$mes = 'agosto';
				break;
			case '09':
				$mes = 'setembro';
				break;
			case '10':
				$mes = 'outubro';
				break;
			case '11':
				$mes = 'novembro';
				break;
			case '12':
				$mes = 'dezembro';
				break;
		}
		return $dia . " de " . $mes . " de " . $ano;
	}
}

//devolve os meses por extenso
//entra 01/04/2014 ou 01-04-2014 ou 01.04.2014
//sai Abr<br>01
if (!function_exists('data_abr')) {
	function data_abr($data) {
		$char = substr($data, 4, 1);
		$date = explode($char, $data);
		$a = $date[0];
		$m = $date[1];
		$d = $date[2];
		switch ($m) {
			case '01':
				$m = 'Jan';
				break;
			case '02':
				$m = 'Fev';
				break;
			case '03':
				$m = 'Mar';
				break;
			case '04':
				$m = 'Abr';
				break;
			case '05':
				$m = 'Mai';
				break;
			case '06':
				$m = 'Jun';
				break;
			case '07':
				$m = 'Jul';
				break;
			case '08':
				$m = 'Ago';
				break;
			case '09':
				$m = 'Set';
				break;
			case '10':
				$m = 'Out';
				break;
			case '11':
				$m = 'Nov';
				break;
			case '12':
				$m = 'Dez';
				break;
		}
		return $m . "<br>" . $d;
	}
}

//devolve os meses por extenso
//entra 01/04/2014 ou 01-04-2014 ou 01.04.2014
//sai <b>01</b><br>Abr
if (!function_exists('data_abr_reverse')) {
	function data_abr_reverse($data) {
		$char = substr($data, 4, 1);
		$date = explode($char, $data);
		$a = $date[0];
		$m = $date[1];
		$d = $date[2];
		switch ($m) {
			case '01':
				$m = 'Jan';
				break;
			case '02':
				$m = 'Fev';
				break;
			case '03':
				$m = 'Mar';
				break;
			case '04':
				$m = 'Abr';
				break;
			case '05':
				$m = 'Mai';
				break;
			case '06':
				$m = 'Jun';
				break;
			case '07':
				$m = 'Jul';
				break;
			case '08':
				$m = 'Ago';
				break;
			case '09':
				$m = 'Set';
				break;
			case '10':
				$m = 'Out';
				break;
			case '11':
				$m = 'Nov';
				break;
			case '12':
				$m = 'Dez';
				break;
		}
		return "<b>" . $d . "</b><br>" . $m;
	}
}

if (!function_exists('Debugar')) {

	function Debugar($objeto, $stop = 0) {

		if (!empty($objeto)) {
			echo '<pre>';
			print_r($objeto);
			echo "</pre>";
		} else {
			echo 'Empty!';
		}

		if ($stop == 1) {
			die();

		}
	}
}

if (!function_exists('UrlAmigavel')) {
	/*
	function UrlAmigavel($text){
	$text = strtr($text, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUC");
	//$clean = iconv('ISO-8859-1', 'UTF-8', $text);
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
	$clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
	$clean = strtolower(trim($clean, '_'));
	$clean = preg_replace("/[\/_| -]+/", '_', $clean);

	return $clean;
	}
	 */
	setlocale(LC_ALL, 'en_US.UTF8');
	function UrlAmigavel($url, $trocar = array(), $limitador = '_') {
		if (!empty($trocar)) {
			$url = str_replace((array) $trocar, ' ', $url);
		}

		$url_limpa = iconv('UTF-8', 'ASCII//TRANSLIT', $url);
		$url_limpa = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $url_limpa);
		$url_limpa = strtolower(trim($url_limpa, '_'));
		$url_limpa = preg_replace("/[\/_|+ -]+/", $limitador, $url_limpa);

		return $url_limpa;
	}

}


/**
 * 
 * @param Array $list
 * @param int $p
 * @return multitype:multitype:
 * @link http://www.php.net/manual/en/function.array-chunk.php#75022
 */

if (!function_exists('partition')){
	function partition(Array $list, $p) {
	    $listlen = count($list);
	    $partlen = floor($listlen / $p);
	    $partrem = $listlen % $p;
	    $partition = array();
	    $mark = 0;
	    for($px = 0; $px < $p; $px ++) {
	        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
	        $partition[$px] = array_slice($list, $mark, $incr);
	        $mark += $incr;
	    }
	    return $partition;
	}
}


/**
 * Redirect to previous page if http referer is set. Otherwise to server root.
 */
 
if ( ! function_exists('redirect_back'))
{
    function redirect_back()
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else
        {
            header('Location: http://'.$_SERVER['SERVER_NAME']);
        }
        exit;
    }
}
