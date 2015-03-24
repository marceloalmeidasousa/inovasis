<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polos extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('polos_model');
            $this->load->model('cursos_model');
            $this->load->model('menus_model');
        }
        
        public function index(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            $dados['polos'] = $this->polos_model->getPolos();
            $this->montaPagina('polos/polos_view',$dados);
        }
        
        function novo(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_polo') == FALSE){
                
                $dados['tipos'] = $this->polos_model->getTipoPolos(null,1,"nome ASC");
                $this->montaPagina("polos/polos_novo",$dados);
                
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                $retorno = $this->polos_model->setPolo($_POST);
                
                if($retorno){
                    
                    $this->site->location("polos/novo/true");
                    /*echo '<script language= "javascript">
                            location.href="'.  base_url() .'polos/novo/true"
                          </script>';*/
                }
            }
        }
        
        function editar(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_polo') == FALSE){
                
                $id = $this->uri->segment(3);
                $dados['polo'] = $this->polos_model->getPolos($id,null);
                $dados['tipos'] = $this->polos_model->getTipoPolos(null,1,"nome ASC");
                $this->montaPagina("polos/polos_editar",$dados);
                
            }
            
            else{
                
                $id = $_POST['id'];
                $_POST['data_modificacao'] = $this->site->getData();
                unset($_POST['id']);
                
                $this->polos_model->editarPolo($id,$_POST);
                
                $this->site->location("polos/editar/$id/true");
            }
            
        }
        
        function tipos(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $dados['tipos'] = $this->polos_model->getTipoPolos();
            $this->montaPagina("polos/polos_tipos",$dados);
        }

        function novo_tipo(){
            
             $this->auth->check_logged($this->router->class , $this->router->method);
             $this->lang->load('form_validation','portugues');
             
             if($this->form_validation->run('valida_tipo') == FALSE){
                 
                 $this->montaPagina("polos/polos_tipos_novo");
             }
            
             else{
                 
                 $_POST['data_modificacao'] = $this->site->getData();
                 
                 $retorno = $this->polos_model->setTipoPolo($_POST);
                 
                 if($retorno){
                     
                     $this->site->location('polos/novo_tipo/true');
                                         
                 }
                 
                 else{
                     $this->site->location('polos/novo_tipo/erro');
                 }

             }
        }
        
        function desativar(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $id = $this->uri->segment(3);
            
            $array = array('status' => '0','data_modificacao' => $this->site->getData());
            
            $this->polos_model->ativarDesativarPolo($id,$array);
            
            $this->site->location("polos");
            /*echo '<script language= "javascript">
                    location.href="'.  base_url() .'polos"
                  </script>';*/
        }
        
        function ativar(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            $id = $this->uri->segment(3);
            
            $array = array('status' => '1','data_modificacao' => $this->site->getData());
            
            $this->polos_model->ativarDesativarPolo($id,$array);
            
            $this->site->location("polos");

        }
        
        function desativar_tipo(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            
            $id = $this->uri->segment(3);
            
            $array = array('status' => '0','data_modificacao' => $this->site->getData());
            
            $this->polos_model->ativarDesativarTipoPolo($id,$array);
            
            $this->site->location("polos/tipos");
        }
        
        function ativar_tipo(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            
            $id = $this->uri->segment(3);
            
            $array = array('status' => '1','data_modificacao' => $this->site->getData());
            
            $this->polos_model->ativarDesativarTipoPolo($id,$array);
            
            $this->site->location("polos/tipos");
            
        }
        
        function editar_tipo(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            
            $this->lang->load('form_validation','portugues');
             
            if($this->form_validation->run('valida_tipo') == FALSE){

                $id = $this->uri->segment(3);
            
                $dados['tipo'] = $this->polos_model->getTipoPolos($id,null);

                $this->montaPagina("polos/polos_tipos_editar",$dados);
            }
             
            else{
                
                $id = $_POST['id'];
                $_POST['data_modificacao'] = $this->site->getData();
                unset($_POST['id']);
                
                $this->polos_model->editarTiposPolos($id,$_POST);
                
                $this->site->location("polos/editar_tipo/$id/true");

            }
            
        }


        
        public function cursos(){
            
            $dados['polos'] = $this->polos_model->getPolos(null,1);
            $this->montaPagina("polos/polos_cursos",$dados);
        }
        
        public function cursos_polo(){
            
            $id = $this->uri->segment(3);
            
            $dados['polo'] = $this->polos_model->getPolos($id);
            $dados['cursos'] = $this->cursos_model->getCursos(null,1);
            $dados['cursos_polo'] = $this->polos_model->getCursosPolo($id);
            
            $this->montaPagina("polos/polos_cursos_config",$dados);
        }
        
        public function cursos_polo_adicionar(){
            
            $idpolo = $this->uri->segment(3);
            $idcurso = $this->uri->segment(4);
            
            $array = array('idpolo' => $idpolo, 'idcurso' => $idcurso,'data_cadastro' => $this->site->getData(),
                'data_modificacao' => $this->site->getData()
                );
            
            $retorno = $this->polos_model->setCursoPolo($array);
            
            if($retorno){
                
                $this->site->location("polos/cursos_polo/$idpolo");
            }
        }
        
        
        public function cursos_polo_remover(){
            
            $idpolo = $this->uri->segment(3);
            $idcurso = $this->uri->segment(4);
                        
            $retorno = $this->polos_model->removerCursoPolo($idpolo,$idcurso);
            
            if($retorno){
                
                $this->site->location("polos/cursos_polo/$idpolo");
            }
        }
}
