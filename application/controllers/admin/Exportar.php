<?php

class Exportar extends CI_Controller {

	public $data;

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('text');

		$this->load->model('usuarios_model');
		$this->load->model('contato_model');
	}

	public function index($offset = NULL) {
		if ($this->usuarios_model->logado()) {
			
			if ($this->session->userdata('tipo') == 2) {
				$usuarioID = $this->session->userdata('usuarioID');
			}

                        $this->data['origens'] = $this->contato_model->get_origens();
                        
                        $this->load->view('admin/exportar/index', $this->data);

		} else {
			$this->load->view('admin/login/index', $this->data);
		}
	}

	public function gerar_excel()
	{
		$post = $this->input->post();

		if($post){

			$resultado = false;

			$post['origem'] = (isset($post['origem'])) ? $post['origem'] : 'Todos';
			
			$resultado = $this->contato_model->gerar_excel(array('origem' => $post['origem']));

			if($resultado){
				$this->generate_file($resultado, $post['origem']);
			}else{
				$this->session->set_flashdata('errors', 'Não há resultados para esta pesquisa.');
		        redirect('admin/exportar', 'location');
			}
		}else{
			$this->session->set_flashdata('errors', 'Por favor, clique em "Gerar Excel" para gerar o arquivo.');
	        redirect('admin/exportar', 'location');
		}
	}

	public function generate_file($data, $nome_planilha)
	{
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet

                $nome_planilha = ellipsize($nome_planilha, 25, 1 ,'...');
                $nome_planilha = UrlAmigavel($nome_planilha);
                
                
		$this->excel->getActiveSheet()->setTitle(UrlAmigavel($nome_planilha));

		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Nome');
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'E-mail');
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		
		$this->excel->getActiveSheet()->setCellValue('C1', 'Assunto');
		$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('D1', 'Mensagem');
		$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('E1', 'Data:');
		$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('F1', 'Quer receber newsletter?');
		$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);


		//merge cell A1 until D1
		// $this->excel->getActiveSheet()->mergeCells('A1:D1');
		
		//set aligment to center for that merged cell (A1 to D1)
		// $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$row_count = 2;

		foreach ($data as $item) {
			$this->excel->getActiveSheet()->setCellValue('A'.$row_count, $item->nome);
			$this->excel->getActiveSheet()->setCellValue('B'.$row_count, $item->email);
			$this->excel->getActiveSheet()->setCellValue('C'.$row_count, $item->assunto);
			$this->excel->getActiveSheet()->setCellValue('D'.$row_count, (isset($item->mensagem)) ? $item->mensagem : '');
			$this->excel->getActiveSheet()->setCellValue('E'.$row_count, $item->dateFormated);
			$this->excel->getActiveSheet()->setCellValue('F'.$row_count, ($item->opt_in == 0) ? 'Não' : 'Sim');

			$row_count++;
		}

		foreach(range('A','F') as $columnID) {
		    $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		    $this->excel->getActiveSheet()->getStyle($columnID)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

                $newName = date('Y-m-d-H:i:s') . '-' . $nome_planilha;
		$filename = $newName.'.xlsx'; //save our workbook as this file name
		
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
}
?>
