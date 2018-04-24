<?php
    class MY_Controller extends CI_Controller {
        public $data;

        public function __construct() {
            parent::__construct();
            $this->load->model('landing_pages_model');

            //Menu
            $this->data['landing_pages_menu'] = $this->landing_pages_model->get_landing_pages();
            // var_dump($this->data['']);
            // $this->data['exame_menu'] = $data['obstetricia'] = $this->obstetricias_model->get_obstetricias();
            // $this->data['ultrassonografia_menu'] = $data['ultrassonografias'] = $this->ultrassonografias_model->get_ultrassonografias();
            // $this->data['reproducao_humana_menu'] = $data['reproducao_humanas'] = $this->reproducao_humanas_model->get_reproducao_humanas();
        }

    }
?>
