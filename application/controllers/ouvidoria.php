<?php require_once 'valida.php'; if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ouvidoria extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('ouvidoria_model');
            $this->load->model('contatos_model');
        }
        
        public function index(){
            $dados['assuntos'] = $this->ouvidoria_model->getAssuntos();
            $this->montaPagina('ouvidoria/ouvidoria_view',$dados);
        }
        
        function novo_assunto(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_tipo_polo') == FALSE){
                
                $this->montaPagina('ouvidoria/ouvidoria_assunto_novo');
            
            }
            
             else{
                
                 
                $_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                
                $retorno = $this->ouvidoria_model->setAssunto($_POST);
                
                if($retorno){
                    
                    $this->site->location('ouvidoria/novo_assunto/true');
                }
            }
        }
        
       function editar_assunto(){
            
           $id = $this->uri->segment(3);
           $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_tipo_polo') == FALSE){
                
                $dados['assunto'] = $this->ouvidoria_model->getAssuntos($id);
                $this->montaPagina('ouvidoria/ouvidoria_assunto_editar',$dados);
            
            }
            
             else{
                
                 $id = $_POST['id'];
                 
                 unset($_POST['id']);
                $_POST['data_modificacao'] = $this->site->getData();
                
                
                $this->ouvidoria_model->editarAssunto($id,$_POST);
                $this->site->location("ouvidoria/editar_assunto/$id/true");
                
            }
        }

        
        function desativar_assunto(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '0', 'data_modificacao' => $this->site->getData());
            $this->ouvidoria_model->editarAssunto($id,$array);
            
            $this->site->location('ouvidoria');
        }
        
        function ativar_assunto(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
            $this->ouvidoria_model->editarAssunto($id,$array);
            
            $this->site->location('ouvidoria');
        }
        

        function config(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_contato_config') == FALSE){
                
                $dados['contato'] = $this->ouvidoria_model->getConfigOuvidoria();
                $dados['contato'] = $dados['contato']->result();
                $dados['contatos'] = $this->contatos_model->getContatosEmails(null,1);
                $this->montaPagina("ouvidoria/ouvidoria_config_view",$dados);
            
            }
            
             else{
              
                 $result = $this->ouvidoria_model->getConfigOuvidoria();
                 
                 if($result->num_rows() == 0){
                     
                     $_POST['data_cadastro'] = $this->site->getData();
                     $_POST['data_modificacao'] = $this->site->getData();
                     
                     $retorno = $this->ouvidoria_model->setConfigOuvidoria($_POST);
                     
                     if($retorno){
                        $this->site->location("ouvidoria/config/true");
                     }
                 }
                 
                 else if($result->num_rows() == 1){
                     $id = $_POST['id'];
                     unset($_POST['id']);
                     $_POST['data_modificacao'] = $this->site->getData();
                     
                     $this->ouvidoria_model->editarConfigOuvidoria($id,$_POST);
                     $this->site->location("ouvidoria/config/true");
                 }
                 
                 else if($result->num_rows() > 1){
                     
                     $this->site->location("ouvidoria/config/erro");
                 }
             }
            
        }
}
