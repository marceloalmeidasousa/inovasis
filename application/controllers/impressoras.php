<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Impressoras extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('impressoras_model');
            $this->load->model('tonners_model');
        }
        
        function index($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $limite = 10;
                $dados['impressoras'] = $this->impressoras_model->getImpressoras(null,null,null,$limite,$offset);

                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."impressoras/index";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_impressoras')->num_rows();
                $config['uri_segment'] = 3;
                $config['num_links'] = 3;

                $config['full_tag_open'] = '<br /><div class="pagination pagination-mini"><ul>';
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

                $this->montaPagina('sistema_tonners/impressoras/impressoras_view',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        function novo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_impressora') == FALSE){
                
                $this->montaPagina("sistema_tonners/impressoras/impressoras_novo");
                
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                
                $retorno = $this->impressoras_model->setTonner($_POST);
                
                if($retorno){
                    
                    $this->site->location("impressoras/novo/true");
                }
            }
        }
        
        else{
                
                $this->montaPagina("acesso_negado");
        }
        
        }
        
        function editar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_impressora') == FALSE){
                
                $id = $this->uri->segment(3);
                $dados['impressora'] = $this->impressoras_model->getImpressoras($id,null);
                $this->montaPagina("sistema_tonners/impressoras/impressoras_editar",$dados);
                
            }
            
            else{
                
                $id = $_POST['id'];
               
                unset($_POST['id']);
                
                $this->impressoras_model->editarImpressora($id,$_POST);
                
                $this->site->location("impressoras/editar/$id/true");
            }
            }
        
            else{

                    $this->montaPagina("acesso_negado");
            }
        }
        
        function desativar(){
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            $id = $this->uri->segment(3);
            
            $array = array('status' => '0');
            
            $this->impressoras_model->editarImpressora($id,$array);
            
            $this->site->location("impressoras");
            }
        
            else{

                    $this->montaPagina("acesso_negado");
            }
        }
        
        function ativar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            $id = $this->uri->segment(3);
            
            $array = array('status' => '1');
            
            $this->impressoras_model->editarImpressora($id,$array);
            
            $this->site->location("impressoras");
            
            }
        
            else{

                    $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $busca = $_POST['busca'];
            
            $dados['impressoras'] = $this->impressoras_model->buscar($busca);
            $dados['busca'] = $busca;

            $this->montaPagina('sistema_tonners/impressoras/impressoras_view',$dados);
            
            }
            else{

                    $this->montaPagina("acesso_negado");
            }
           
         }
        
        function excluir(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $id = $this->uri->segment(3);
            
            $retorno = $this->impressoras_model->excluirImpressora($id);
            
            if($retorno){
                
               $this->site->location('impressoras/index/true');
            }
            
                        
            }
            else{

                    $this->montaPagina("acesso_negado");
            }
        }
        
        function excluir_tonner_impressora(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $id = $this->uri->segment(3);
            $impressora = $this->uri->segment(4);
            $retorno = $this->impressoras_model->excluirTonnerImpressora($id);
            
            if($retorno){
                
                $this->site->location("impressoras/config/$impressora/true");
            }
            
                        
            }
            else{

                    $this->montaPagina("acesso_negado");
            }
        }
        
        function tonners($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $limite = 10;
                $dados['impressoras'] = $this->impressoras_model->getImpressoras(null,1,null,$limite,$offset);

                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."impressoras/tonners";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_impressoras')->num_rows();
                $config['uri_segment'] = 3;
                $config['num_links'] = 3;

                $config['full_tag_open'] = '<br /><div class="pagination pagination-mini"><ul>';
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

                $this->montaPagina('sistema_tonners/impressoras/impressoras_tonners',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function config(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $id = $this->uri->segment(3);
                
                $this->lang->load('form_validation','portugues');
            
                if($this->form_validation->run('valida_add_tonner') == FALSE){
                
                    $dados['impressora'] = $this->impressoras_model->getImpressoras($id);
                    $result = $this->impressoras_model->getTonnersImpressora($id);
                    $dados['tonners'] = $this->tonners_model->getTonners(null,1,"nome ASC");
                    $dados['num_rows'] = $result->num_rows();
                    $dados['it'] = $result->result();

                    $this->montaPagina('sistema_tonners/impressoras/impressoras_config',$dados);
                }
                
                else{
                    
                    $_POST['id_impressora'] = $id;
                    $_POST['data_cadastro'] = $this->site->getData();
                    
                    $retorno = $this->impressoras_model->setTonnerImpressora($_POST);
                    
                    if($retorno){
                        
                        $this->site->location("impressoras/config/$id/true");
                    }
                }
            }
            
            else{

                    $this->montaPagina("acesso_negado");
            }
           
         }
}
