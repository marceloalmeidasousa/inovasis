<?php require_once 'valida.php'; if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Institucional extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('institucional_model');
            $this->load->helper('ckeditor');
        }
        
        public function index(){
            
            $this->montaPagina('institucional/institucional_view');
        }
        
        function editar(){
            
            $this->lang->load('form_validation','portugues');
            
            $id = 1;
            
            if($this->form_validation->run('valida_institucional') == FALSE){
                
                $dados['texto'] = $this->institucional_model->getTexto($id);

                $dados['editor_texto'] = array(
                        'id'   => 'texto',
                        'path' => '/ckeditor/',
                        'config' => array('toolbar' => "Full",'height'  => "500px",
                    )
                );
                
                $this->montaPagina('institucional/institucional_editar',$dados);
            }
            
            else{
                
                $_POST['data_modificacao'] = $this->site->getData();
                
                $this->institucional_model->editarTexto($id,$_POST);
                
                $this->site->location('institucional/editar/true');
            }
        }
        

}
