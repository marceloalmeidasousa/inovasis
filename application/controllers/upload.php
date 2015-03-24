<?php require_once 'valida.php'; if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {
    
        function __construct() {
            // Call the Controller constructor
            parent::__construct();
            
       }
        
        public function index(){
            
            //$dados['cursos'] = $this->extensao_model->getCurso();
            //$this->montaPagina("upload",$dados);
            $this->load->view('upload', array('error' => ' ' ));
        }
        
        function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			
			$this->load->view('upload', $error);
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());
			
			$this->load->view('upload', $data);
		}
	}	

}
