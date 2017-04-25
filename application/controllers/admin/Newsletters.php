<?php

class Newsletters extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->model('usuarios_model');
        
        $this->load->model('newsletters_model');
    }

    public function index() {
        $newsletters = $this->newsletters_model->get_emails();
        
        $output = utf8_decode("E-mail");
        $output .= utf8_decode("\n");
        foreach($newsletters as $newsletter):
            $output .= utf8_decode($newsletter->email);
            $output .= utf8_decode("\n");
        endforeach;
        
        $filename = gmdate("d-m-Y_H-i", time());

        header("Content-type: application/vnd.ms-excel charset=iso-8859-1");
        header("Content-disposition: csv" . gmdate("Y-m-d") . ".csv");
        header("Content-disposition: filename=" . $filename . ".csv");

        echo $output;
        exit;
    }
}

?>