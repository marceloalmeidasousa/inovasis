<?php require_once 'valida.php'; if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('videos_model');
        }
        
        public function index(){

            $dados['videos'] = $this->videos_model->getVideos();
            $this->montaPagina('videos/videos_view',$dados);
        }
        
        function novo(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_video') == FALSE){
                
                $this->montaPagina('videos/videos_novo');
            
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                $retorno = $this->videos_model->setVideo($_POST);
                
                if($retorno){
                    
                    $this->site->location("videos/novo/true");
                }
            }
            
        }
        
         function editar(){
            
            $this->lang->load('form_validation','portugues');
            
            $id = $this->uri->segment(3);
            
            if($this->form_validation->run('valida_video') == FALSE){
                
                $dados['video'] = $this->videos_model->getVideos($id);
                $this->montaPagina('videos/videos_editar',$dados);
            
            }
            
            else{
                
                $id = $_POST['id'];
                
                unset($_POST['id']);
                
                //$_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                $this->videos_model->editarVideo($id,$_POST);
                
                $this->site->location("videos/editar/$id/true");
            }
            
        }
        
        function desativar(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '0', 'data_modificacao' => $this->site->getData());
            $this->videos_model->editarVideo($id,$array);
            
            $this->site->location('videos');
        }
        
        function ativar(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
            $this->videos_model->editarVideo($id,$array);
            
            $this->site->location('videos');
        }

}
