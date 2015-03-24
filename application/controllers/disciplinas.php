<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disciplinas extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('disciplinas_model');
            $this->load->model('menus_model');
        }
        
        function index($offset = 0){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            
            $limite = 10;
            $dados['disciplinas'] = $this->disciplinas_model->getDisciplinas(null,null,null,$limite,$offset);
            
            /*Paginação*/
            $this->load->library('pagination');
            
            $config['base_url'] = base_url()."disciplinas/index";
            $config['per_page'] = $limite;
            $config['total_rows'] = $this->db->get('tbl_disciplinas')->num_rows();
            $config['uri_segment'] = 3;
            $config['num_links'] = 3;
            
            $config['full_tag_open'] = '<br /><div class="pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';

            $config['first_link'] = 'Primeira';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '<li>';

            $config['last_link'] = 'Ultima';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = 'Próximo';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = 'Anterior';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';        

            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
        
            $this->pagination->initialize($config);
            $dados['paginacao'] = $this->pagination->create_links();

            $this->montaPagina('disciplinas/disciplinas_view',$dados);
        }
        
        function novo(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_disciplina') == FALSE){
                
                $this->montaPagina('disciplinas/disciplinas_novo');
            
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                
                $retorno = $this->disciplinas_model->setDisciplina($_POST);
                
                if($retorno){
                    
                    $this->site->location('disciplinas/novo/true');
                }
            }
            
        }
         
        function editar(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_disciplina') == FALSE){
                
                $id = $this->uri->segment(3);
                $dados['disciplina'] = $this->disciplinas_model->getDisciplinas($id,null);
                $this->montaPagina("disciplinas/disciplinas_editar",$dados);
                
            }
            
            else{
                
                $id = $_POST['id'];
                
                unset($_POST['id']);
                $this->disciplinas_model->editarDisciplina($id,$_POST);
                
                $this->site->location("disciplinas/editar/$id/true");
            }
        }
        
        function tipos(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $dados['tipos'] = $this->cursos_model->getTiposCursos();
            $this->montaPagina('cursos/cursos_tipos',$dados);
        }
        
        function tipos_novo(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_tipo') == FALSE){
                
                $this->montaPagina('cursos/cursos_tipos_novo');
            
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                //$_POST['data_modificacao'] = $this->site->getData();
                
                $retorno = $this->cursos_model->setTipoCurso($_POST);
                
                if($retorno){
                    
                    $this->site->location('cursos/tipos_novo/true');
                }
            }
        }
        
        function desativar(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $id = $this->uri->segment(3);
            $array = array('status' => '0', 'data_modificacao' => $this->site->getData());
            $this->disciplinas_model->editarDisciplina($id,$array);
            
            $this->site->location('disciplinas');
        }
        
        function ativar(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $id = $this->uri->segment(3);
            $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
            $this->disciplinas_model->editarDisciplina($id,$array);
            
            $this->site->location('disciplinas');
        }
        
        function desativar_tipo(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '0', 'data_modificacao' => $this->site->getData());
            $this->cursos_model->ativaDesativaTipoCurso($id,$array);
            
            $this->site->location('cursos/tipos');
        }
        
        function ativar_tipo(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
            $this->cursos_model->ativaDesativaTipoCurso($id,$array);
            
            $this->site->location('cursos/tipos');
        }
        
        function tipos_editar(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_tipo') == FALSE){
                
                $id = $this->uri->segment(3);
                
                $dados['tipo'] = $this->cursos_model->getTiposCursos($id,null);
                $this->montaPagina('cursos/cursos_tipos_editar',$dados);
            
            }
            
            else{
                
                $id = $_POST['id'];
                
                $_POST['data_modificacao'] = $this->site->getData();
                unset($_POST['id']);
                
                $this->cursos_model->editarTipoCurso($id,$_POST);
                
                $this->site->location("cursos/tipos_editar/$id/true");
            }
        }
        
        function buscar(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            
            $busca = $_POST['busca'];
            
            $dados['disciplinas'] = $this->disciplinas_model->buscar($busca);
            $dados['busca'] = $busca;
            //print_r($dados);
            $this->montaPagina('disciplinas/disciplinas_view',$dados);
        }
}
