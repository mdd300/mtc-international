<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Quotation
{	
	private static $apiUrl = "http://developers.agenciaideias.com.br/cotacoes/json";
  	private static $content;

    public static function my_file_get_contents($site_url){ 
        $ch = curl_init();  
        $timeout = 10;  
        curl_setopt($ch, CURLOPT_URL, $site_url);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);    
        $file_contents = curl_exec($ch);    
        curl_close($ch);

        return $file_contents;
    }

  	public static function init() {	 
		self::$content = self::my_file_get_contents(self::$apiUrl);
		self::$content = json_decode(self::$content);
	}

	public static function dolar() {
        self::init();
        return array(
            "quotation" => self::$content->dolar->cotacao,
            "variation" => self::$content->dolar->variacao,
            "status" => self::getVariation(self::$content->dolar->variacao)
        );
    }

    public static function bovespa() { 
        self::init();
        return array(
            "quotation" => self::$content->bovespa->cotacao,
            "variation" => self::$content->bovespa->variacao,
            "status" => self::getVariation(self::$content->bovespa->variacao)
        );
    }

    public static function euro() { 
        self::init();
        return array(
            "quotation" => self::$content->euro->cotacao,
            "variation" => self::$content->euro->variacao,
            "status" => self::getVariation(self::$content->euro->variacao)
        );
    }

    public static function getVariation($variation) {
        if (strpos($variation, "+")) {
            return "+";
        } else {
            return "-";
        }
  	}
}