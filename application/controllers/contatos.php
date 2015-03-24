<?php require_once 'valida.php'; if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contatos extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('contatos_model');
        }
        
        public function index(){
            $dados['contatos'] = $this->contatos_model->getContatos();
            $this->montaPagina('contatos/contatos_view',$dados);
        }
        
        function novo(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_contato') == FALSE){
                
                $dados['tipos'] = $this->contatos_model->getContatosTipos(null,1);
                $this->montaPagina('contatos/contatos_novo',$dados);
            
            }
            
             else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                $retorno = $this->contatos_model->setContato($_POST);
                
                if($retorno){
                    
                    $this->site->location('contatos/novo/true');
                }
            }
        }
        
        function editar(){
            
            $id = $this->uri->segment(3);
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_contato') == FALSE){
                $dados['tipos'] = $this->contatos_model->getContatosTipos(null,1);
                $dados['contato'] = $this->contatos_model->getContatos($id);
                $this->montaPagina('contatos/contatos_editar',$dados);
            
            }
            
             else{
                
                 //$_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                $this->contatos_model->editarContato($id,$_POST);
                
                $this->site->location("contatos/editar/$id/true");
                
                
            }
        }
        
        function tipos(){
            $dados['tipos'] = $this->contatos_model->getContatosTipos();
            //print_r($dados);
            $this->montaPagina('contatos/contatos_tipos',$dados);
        }
        
        function tipos_novo(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_tipo_polo') == FALSE){
                
                $dados['num_rows'] = $this->contatos_model->getPadrao(1);
                $dados['num_rows'] = $dados['num_rows']->num_rows();
                //print_r($dados);
                $this->montaPagina('contatos/contatos_tipos_novo',$dados);
            
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                $retorno = $this->contatos_model->setTipoContato($_POST);
                
                if($retorno){
                    
                    $this->site->location('contatos/tipos_novo/true');
                }
            }
        }
        
        function tipos_editar(){
            
            $id = $this->uri->segment(3);
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_tipo_polo') == FALSE){
                $r = $this->contatos_model->getPadrao(1);
                
                $default = $r->result();
                
                if($r->num_rows() == 1){
                    
                    $dados['nao_existe'] = FALSE;
                    if($id == $default['0']->id){
                        $dados['padrao'] = TRUE;
                    }
                    else{
                        $dados['padrao'] = FALSE;  
                    }
                }
                
                else{
                    $dados['padrao'] = FALSE;
                    $dados['nao_existe'] = TRUE;
                }
                
                $dados['tipo'] = $this->contatos_model->getContatosTipos($id);
                $this->montaPagina('contatos/contatos_tipos_editar',$dados);
            
            }
            
            else{
                
                //$_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                $this->contatos_model->editarTipo($id,$_POST);
                
                $this->site->location("contatos/tipos_editar/$id/true");
                
            }
        }
        
        function desativar_tipo(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '0', 'data_modificacao' => $this->site->getData());
            $this->contatos_model->editarTipo($id,$array);
            
            $this->site->location('contatos/tipos');
        }
        
        function ativar_tipo(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
            $this->contatos_model->editarTipo($id,$array);
            
            $this->site->location('contatos/tipos');
        }
        
        
        function desativar(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '0', 'data_modificacao' => $this->site->getData());
            $this->contatos_model->editarContato($id,$array);
            
            $this->site->location('contatos');
        }
        
        function ativar(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
            $this->contatos_model->editarContato($id,$array);
            
            $this->site->location('contatos');
        }
        
        function config(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_contato_config') == FALSE){
                
                $dados['contato'] = $this->contatos_model->getConfigContato();
                $dados['contato'] = $dados['contato']->result();
                $dados['contatos'] = $this->contatos_model->getContatosEmails(null,1);
                $this->montaPagina("contatos/contatos_config_view",$dados);
            
            }
            
             else{
              
                 $result = $this->contatos_model->getConfigContato();
                 
                 if($result->num_rows() == 0){
                     
                     $_POST['data_cadastro'] = $this->site->getData();
                     $_POST['data_modificacao'] = $this->site->getData();
                     
                     $retorno = $this->contatos_model->setConfigContato($_POST);
                     
                     if($retorno){
                         $this->site->location("contatos/config/true");
                     }
                 }
                 
                 else if($result->num_rows() == 1){
                     $id = $_POST['id'];
                     unset($_POST['id']);
                     $_POST['data_modificacao'] = $this->site->getData();
                     
                     $this->contatos_model->editarConfigContato($id,$_POST);
                     $this->site->location("contatos/config/true");
                 }
                 
                 else if($result->num_rows() > 1){
                     
                     $this->site->location("contatos/config/erro");
                 }
             }
            
        }

}
