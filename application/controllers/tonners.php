<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tonners extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('tonners_model');
        }
        
        function index($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $limite = 10;
                $dados['tonners'] = $this->tonners_model->getTonners(null,null,null,$limite,$offset);

                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."tonners/index";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_tonners')->num_rows();
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

                $this->montaPagina('sistema_tonners/tonners/tonners_view',$dados);
            
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function novo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $this->lang->load('form_validation','portugues');

                if($this->form_validation->run('valida_tipo') == FALSE){

                    $this->montaPagina("sistema_tonners/tonners/tonners_novo");

                }

                else{

                    $_POST['data_cadastro'] = $this->site->getData();

                    $retorno = $this->tonners_model->setTonner($_POST);

                    if($retorno){

                        $this->site->location("tonners/novo/true");
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

                if($this->form_validation->run('valida_tipo') == FALSE){

                    $id = $this->uri->segment(3);
                    $dados['tonner'] = $this->tonners_model->getTonners($id,null);
                    $this->montaPagina("sistema_tonners/tonners/tonners_editar",$dados);

                }

                else{

                    $id = $_POST['id'];

                    unset($_POST['id']);

                    $this->tonners_model->editarTonner($id,$_POST);

                    $this->site->location("tonners/editar/$id/true");
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

                $this->tonners_model->editarTonner($id,$array);

                $this->site->location("tonners");
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

                $this->tonners_model->editarTonner($id,$array);

                $this->site->location("tonners");
            }

            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $busca = $_POST['busca'];

                $dados['tonners'] = $this->tonners_model->buscar($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_tonners/tonners/tonners_view',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function excluir(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                $id = $this->uri->segment(3);

                $retorno = $this->tonners_model->excluirTonner($id);

                if($retorno){

                    $this->site->location('tonners/index/true');
                }
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
}
