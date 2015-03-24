<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagamento extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('cursos_model');
            $this->load->model('menus_model');
            $this->load->model('disciplinas_model');
            $this->load->model('vinculos_model');
            $this->load->model('usuarios_model');
            $this->load->model('polos_model');
            $this->load->model('bolsas_model');
            $this->load->model('pagamento_model');
            $this->load->helper('ckeditor');
        }
        
        function index(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            $dados['lotes'] = $this->pagamento_model->getLotes();
            
            $this->montaPagina('pagamento/pagamento_view',$dados);
        }
        
        function novo(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            
            $this->lang->load('form_validation','portugues');
            
            $r = $this->pagamento_model->getLotes(null,1,$this->site->getData(FALSE),null,FALSE);
            
            if($r->num_rows() == 0){
            if($this->form_validation->run('valida_pagamento') == FALSE){
                
                $this->montaPagina('pagamento/pagamento_novo');
             
            }
            
            else{
                
                $_POST['data_modificacao'] = $this->site->getData();
                $_POST['data_abertura'] = $this->site->converterDataMysql($_POST['data_abertura']);
                $_POST['data_fechamento'] = $this->site->converterDataMysql($_POST['data_fechamento']);
                //print_r($_POST);
                
                $retorno = $this->pagamento_model->setLotePagamento($_POST);
                
                if($retorno){
                    
                    $this->site->location('pagamento');
                }
            }
            
            }
            
            else if($r->num_rows() > 0){
                
                $this->montaPagina("pagamento/pagamento_erro");
            }
        }
        
        function editar(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            
            $id = $this->uri->segment(3);
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_pagamento') == FALSE){
                
                $dados['lote'] = $this->pagamento_model->getLotes($id);
                $this->montaPagina('pagamento/pagamento_editar',$dados);
             
            }
            
            else{
                
                $r = $this->pagamento_model->getLotes(null,1,$this->site->getData(FALSE),null,FALSE);
          
                if($r->num_rows() == 0 || $this->input->post('status') == 0){
                $_POST['data_abertura'] = $this->site->converterDataMysql($_POST['data_abertura']);
                $_POST['data_fechamento'] = $this->site->converterDataMysql($_POST['data_fechamento']);
                //print_r($_POST);
      
                $array = $this->input->post();
                
                //print_r($array);
                $this->pagamento_model->editarLote($id,$array);
                    
                $this->site->location("pagamento/editar/$id/true");
                }
                
                else{
                   
                    $this->montaPagina("pagamento/pagamento_erro");
                }
            }
        }
        
        function ativar(){
           
            $this->auth->check_logged($this->router->class , $this->router->method);
           
            $r = $this->pagamento_model->getLotes(null,1,$this->site->getData(FALSE),null,FALSE);
           
           if($r->num_rows == 0){  
            $id = $this->uri->segment(3);
            
            $array = array('status' => '1');
            
            $this->pagamento_model->editarLote($id,$array);
            $this->site->location('pagamento');
           }
           
           else if($r->num_rows > 0){
               
               $this->montaPagina("pagamento/pagamento_erro");
           }
        }
        
        function desativar(){
           
            $this->auth->check_logged($this->router->class , $this->router->method);
           
            $id = $this->uri->segment(3);
            
            $array = array('status' => '0');
            
            $this->pagamento_model->editarLote($id,$array);
            $this->site->location('pagamento');
            
        }

}
