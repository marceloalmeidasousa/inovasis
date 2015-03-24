<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ordem_compra extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('ordem_compra_model');
        }
        
        function index($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $limite = 10;
                $dados['ordem_compra'] = $this->ordem_compra_model->getOrdens(null,null,null,$limite,$offset);

                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."ordem_compra/index";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_ordem_compra')->num_rows();
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

                $this->montaPagina('sistema_tonners/ordem_compra/ordem_view',$dados);
            
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

                    $this->montaPagina("sistema_tonners/ordem_compra/ordem_novo");

                }

                else{

                    $_POST['data_cadastro'] = $this->site->getData();

                    $retorno = $this->ordem_compra_model->setOrdem($_POST);

                    if($retorno){

                        $this->site->location("ordem_compra/novo/true");
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
                    $dados['tonner'] = $this->ordem_compra_model->getOrdens($id,null);
                    $this->montaPagina("sistema_tonners/ordem_compra/ordem_editar",$dados);

                }

                else{

                    $id = $_POST['id'];

                    unset($_POST['id']);

                    $this->ordem_compra_model->editarOrdem($id,$_POST);

                    $this->site->location("ordem_compra/editar/$id/true");
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

                $this->ordem_compra_model->editarOrdem($id,$array);

                $this->site->location("ordem_compra");
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

                $this->ordem_compra_model->editarOrdem($id,$array);

                $this->site->location("ordem_compra");
            }

            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $busca = $_POST['busca'];

                $dados['ordem_compra'] = $this->ordem_compra_model->buscar($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_tonners/ordem_compra/ordem_compra_view',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function excluir(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                
                $id = $this->uri->segment(3);

                $this->db->where('id_ordem_compra',$id);
                echo $num = $this->db->get('tbl_tonners_saldo')->num_rows();

                if($num == 0){
                    $retorno = $this->ordem_compra_model->excluirOrdem($id);

                    if($retorno){

                        $this->site->location('ordem_compra/index/true');
                    }
                }
                else{
                    
                    $this->site->location('ordem_compra/index/false');
                }
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
}
