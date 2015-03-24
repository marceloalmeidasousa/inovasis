<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vinculos extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('cursos_model');
            $this->load->model('menus_model');
            $this->load->model('disciplinas_model');
            $this->load->model('vinculos_model');
            $this->load->model('usuarios_model');
            $this->load->model('polos_model');
            $this->load->helper('ckeditor');
        }
        
        function index(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            $dados['vinculos'] = $this->vinculos_model->getVinculos();
            $this->montaPagina('vinculos/vinculos_view',$dados);
        }
        
        function novo(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_vinculo') == FALSE){

                $dados['usuarios'] = $this->usuarios_model->getUsuarios(null,1,null,'ASC');
                $dados['tipos'] = $this->vinculos_model->getTiposVinculos(null,1,'ASC');
                $dados['cursos'] = $this->cursos_model->getCursos(null,1,'ASC');
                $dados['polos']   = $this->polos_model->getPolos(null,1,'ASC');
                $dados['disciplinas']   = $this->disciplinas_model->getDisciplinas(null,1,'nome ASC');
                $this->montaPagina('vinculos/vinculos_novo',$dados);
            
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                
                $r = $this->vinculos_model->getVinculos(null,1,$_POST['usuario'],FALSE);
                
                if($r->num_rows > 0){
                    
                    $this->site->location("vinculos/novo/erro");
                }
                
                else{
                    
                    $retorno = $this->vinculos_model->setVinculo($_POST);
                
                    if($retorno){

                        $this->site->location('vinculos/novo/true');
                    }
                    
                }
            }
            
        }
         
        function editar(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_vinculo') == FALSE){
                
                $id = $this->uri->segment(3);
                
                $dados['usuarios'] = $this->usuarios_model->getUsuarios(null,1,null,'ASC');
                $dados['tipos'] = $this->vinculos_model->getTiposVinculos(null,1,'ASC');
                $dados['cursos'] = $this->cursos_model->getCursos(null,1,'ASC');
                $dados['polos']   = $this->polos_model->getPolos(null,1,'ASC');
                $dados['disciplinas']   = $this->disciplinas_model->getDisciplinas(null,1,'nome ASC');
                $dados['vinculo'] = $this->vinculos_model->getVinculos($id,null);
                $this->montaPagina("vinculos/vinculos_editar",$dados);
                
            }
            
            else{
                
                $id = $_POST['id'];
                
                //print_r($_POST);
                unset($_POST['id']);
                $this->vinculos_model->editarVinculo($id,$_POST);
                
                $this->site->location("vinculos/editar/$id/true");
            }
        }
        
        function tipos(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $dados['tipos'] = $this->vinculos_model->getTiposVinculos();
            $this->montaPagina('vinculos/vinculos_tipos',$dados);
        }
        
        function novo_tipo(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_tipo') == FALSE){
                
                $this->montaPagina('vinculos/vinculos_tipos_novo');
            
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                //$_POST['data_modificacao'] = $this->site->getData();
                
                $retorno = $this->vinculos_model->setTipoVinculo($_POST);
                
                if($retorno){
                    
                    $this->site->location('vinculos/novo_tipo/true');
                }
            }
        }
        
        function desativar(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $id = $this->uri->segment(3);
            $array = array('status' => '0');
            $this->vinculos_model->editarVinculo($id,$array);
            
            $this->site->location('vinculos');
        }
        
        function ativar(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $id = $this->uri->segment(3);
            $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
            $this->vinculos_model->ativaDesativaCurso($id,$array);
            
            $this->site->location('vinculos');
        }
        
        function desativar_tipo(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '0', 'data_modificacao' => $this->site->getData());
            $this->vinculos_model->ativaDesativaTipoCurso($id,$array);
            
            $this->site->location('vinculos/tipos');
        }
        
        function ativar_tipo(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
            $this->vinculos_model->ativaDesativaTipoCurso($id,$array);
            
            $this->site->location('vinculos/tipos');
        }
        
        function editar_tipo(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_tipo') == FALSE){
                
                $id = $this->uri->segment(3);
                
                $dados['tipo'] = $this->vinculos_model->getTiposVinculos($id,null);
                $this->montaPagina('vinculos/vinculos_tipos_editar',$dados);
            
            }
            
            else{
                
                $id = $_POST['id'];

                unset($_POST['id']);
                
                $this->vinculos_model->editarTipoVinculo($id,$_POST);
                
                $this->site->location("vinculos/editar_tipo/$id/true");
            }
        }
        
        function disciplinas(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            $dados['vinculos'] = $this->vinculos_model->getCursos();
            $this->montaPagina('vinculos/vinculos_disciplinas',$dados);
            
        }
        
        function adicionar_disciplinas(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            
            $id = $this->uri->segment(3);
            $dados['disciplinas'] = $this->disciplinas_model->getDisciplinas(null,1);
            $dados['curso'] = $this->vinculos_model->getCursos($id,null);
            $this->montaPagina("vinculos/vinculos_disciplinas_adicionar",$dados);
        }
}
