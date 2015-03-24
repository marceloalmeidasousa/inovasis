<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfis extends CI_Controller {
    
        function __construct() {
            // Call the Controller constructor
            parent::__construct();

            $this->load->model('perfis_model');
             $this->load->model('menus_model');
        }
        
        function index($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
                $limite = 10;
                $dados['perfis'] = $this->perfis_model->getPerfis(null,null,$limite,$offset);
                
                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."perfis/index";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_perfis')->num_rows();
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
                
                $this->montaPagina('sistema_sisadmin/perfis/perfis_view',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function novo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_perfil') == FALSE){
                
                 $this->montaPagina("sistema_sisadmin/perfis/perfis_novo");
            }
            
            else{
            
                $_POST['data_cadastro'] = $this->site->getData();
                
                $retorno = $this->perfis_model->setPerfil($_POST);
                
                //Gera Log
                $this->site->log($this->session->userdata('id_usuario'),$this->router->method." perfil '".$_POST['nome']."'");
               
                if($retorno){
                    
                    $this->site->location('perfis/novo/true');
                } 
            }
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function editar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $id = $this->uri->segment(3);
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_perfil') == FALSE){
                
                $dados['perfil'] = $this->perfis_model->getPerfis($id);
                
                $dados['perfil'] = $dados['perfil']['0'];
                $this->montaPagina("sistema_sisadmin/perfis/perfis_editar",$dados);
            }
            
            else{
            
                $id = $_POST['id'];
                unset($_POST['id']);
                
                $this->perfis_model->editarPerfil($id,$_POST);
                
                //Gerar log
                $this->site->log($this->session->userdata('id_usuario'),$this->router->method." perfil $id");
               
                $this->site->location("perfis/editar/$id/true");

            }
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }

        function adiciona_permissao(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $id_perfil = $this->uri->segment(3);
            
            $this->perfis_model->removerPermissoes($id_perfil);
            
            foreach($_POST as $val){
                
                $array = array('id_metodo' => $val, 'id_perfil' =>$id_perfil);
                
                $this->perfis_model->setPermissao($array);
            }
            
            $this->site->location("perfis/configurar/$id_perfil");
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }


        function permissoes($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
                $limite = 10;
                $dados['perfis'] = $this->perfis_model->getPerfis(null,null,$limite,$offset);
                
                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."perfis/permissoes";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_perfis')->num_rows();
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
                $this->montaPagina("sistema_sisadmin/perfis/perfis_configuracoes",$dados);
            }
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function configurar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $id = $this->uri->segment(3);
            
            $dados['perfil'] = $this->perfis_model->getPerfis($id);
            $dados['classes'] = $this->perfis_model->getClasses();
            
            $this->montaPagina("sistema_sisadmin/perfis/perfis_configurar",$dados);
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
                
        function desativar(){
            
        
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $id = $this->uri->segment(3);
             
             $array = array('status' => '0');
             
             $this->perfis_model->editarPerfil($id,$array);
             
             //Gera log
             $this->site->log($this->session->userdata('id_usuario'),$this->router->method." perfil $id");
               
             $this->site->location("perfis");
             }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function ativar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
             $id = $this->uri->segment(3);
             
             $array = array('status' => '1');
             
             $this->perfis_model->editarPerfil($id,$array);
             
             //Gera log
             $this->site->log($this->session->userdata('id_usuario'),$this->router->method." perfil $id");
               
             $this->site->location("perfis");
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
      
        function excluir(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                $id = $this->uri->segment(3);

                $this->db->where('id_perfil',$id);
                $num = $this->db->get('tbl_usuarios')->num_rows();
                
                if($num == 0){
                    
                    $retorno = $this->perfis_model->excluirPerfil($id);

                    if($retorno){

                        $this->site->location('perfis/index/true');
                    }
                }
                
                else{
                   
                    $this->site->location('perfis/index/false');
                }
                
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $busca = $_POST['busca'];

                $dados['perfis'] = $this->perfis_model->buscar($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_sisadmin/perfis/perfis_view',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar_perfil(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $busca = $_POST['busca'];

                $dados['perfis'] = $this->perfis_model->buscar($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_sisadmin/perfis/perfis_configuracoes',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
}
