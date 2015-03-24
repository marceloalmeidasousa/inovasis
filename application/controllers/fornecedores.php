<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fornecedores extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('fornecedores_model');
            $this->load->model('tonners_model');
            $this->load->model('ordem_compra_model');
        }
        
        function index($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $limite = 10;
                $dados['fornecedores'] = $this->fornecedores_model->getFornecedores(null,null,null,$limite,$offset);

                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."fornecedores/index";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_fornecedores')->num_rows();
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

                $this->montaPagina('sistema_tonners/fornecedores/fornecedores_view',$dados);
            
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function novo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $this->lang->load('form_validation','portugues');

                if($this->form_validation->run('valida_fornecedor') == FALSE){

                    $this->montaPagina("sistema_tonners/fornecedores/fornecedores_novo");

                }

                else{

                    $_POST['data_cadastro'] = $this->site->getData();

                    $retorno = $this->fornecedores_model->setFornecedor($_POST);

                    if($retorno){

                        $this->site->location("fornecedores/novo/true");
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

                if($this->form_validation->run('valida_fornecedor') == FALSE){

                    $id = $this->uri->segment(3);
                    $dados['fornecedor'] = $this->fornecedores_model->getFornecedores($id,null);
                    $this->montaPagina("sistema_tonners/fornecedores/fornecedores_editar",$dados);

                }

                else{

                    $id = $_POST['id'];

                    unset($_POST['id']);

                    $this->fornecedores_model->editarFornecedor($id,$_POST);

                    $this->site->location("fornecedores/editar/$id/true");
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

                $this->fornecedores_model->editarFornecedor($id,$array);

                $this->site->location("fornecedores");
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

                $this->fornecedores_model->editarFornecedor($id,$array);

                $this->site->location("fornecedores");
            }

            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $busca = $_POST['busca'];

                $dados['fornecedores'] = $this->fornecedores_model->buscar($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_tonners/fornecedores/fornecedores_view',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function excluir(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                $id = $this->uri->segment(3);

                $retorno = $this->fornecedores_model->excluirFornecedor($id);

                if($retorno){

                    $this->site->location('fornecedores/index/true');
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
                $dados['fornecedores'] = $this->fornecedores_model->getFornecedores(null,1,null,$limite,$offset);

                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."fornecedores/tonners";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_fornecedores')->num_rows();
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

                $this->montaPagina('sistema_tonners/fornecedores/fornecedores_tonners',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function config(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $id_fornecedor = $this->uri->segment(3);
                
                $this->lang->load('form_validation','portugues');
            
                if($this->form_validation->run('valida_add_tonner') == FALSE){
                
                    $dados['fornecedor'] = $this->fornecedores_model->getFornecedores($id_fornecedor);
                    $result = $this->fornecedores_model->getTonnersFornecedor($id_fornecedor,null,FALSE);
                    $dados['tonners'] = $this->tonners_model->getTonners(null,1,"nome ASC");
                    $dados['num_rows'] = $result->num_rows();
                    $dados['ft'] = $result->result();
                    
                    $this->montaPagina('sistema_tonners/fornecedores/fornecedores_config',$dados);
                }
                
                else{
                    
                    $_POST['id_fornecedor'] = $id_fornecedor;
                    $_POST['data_cadastro'] = $this->site->getData();
                    
                    $retorno = $this->fornecedores_model->setTonnerFornecedor($_POST);
                    
                    if($retorno){
                        
                        $this->site->location("fornecedores/config/$id_fornecedor/true");
                    }
                }
            }
            
            else{

                    $this->montaPagina("acesso_negado");
            }
           
         }
         
         function excluir_tonner_fornecedor(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $id = $this->uri->segment(3);
            $fornecedor = $this->uri->segment(4);
            $retorno = $this->fornecedores_model->excluirTonnerFornecedor($id);
            
            if($retorno){
                
                $this->site->location("fornecedores/config/$fornecedor/true");
            }
            
                        
            }
            else{

                    $this->montaPagina("acesso_negado");
            }
        }
        
        function creditos(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $id = $this->uri->segment(3);
                
                $dados['tonner'] = $this->fornecedores_model->getTonnersFornecedor(null,$id,TRUE);
                
                $dados['fornecedor'] = $this->fornecedores_model->getFornecedores($dados['tonner']['0']->id_fornecedor);
                $dados['saldo'] = $this->tonners_model->getSaldoTonner($id);

                //print_r($dados['tonner']);
                $this->montaPagina('sistema_tonners/fornecedores/fornecedores_creditos',$dados);

            }
            
            else{

                    $this->montaPagina("acesso_negado");
            }
           
         }
         
         public function adicionar_saldo(){
             
             $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $id = $this->uri->segment(3);
                
                $this->lang->load('form_validation','portugues');
            
                if($this->form_validation->run('valida_add_saldo') == FALSE){
                    
                    $dados['tonner'] = $this->fornecedores_model->getTonnersFornecedor(null,$id,TRUE);
                    $dados['ordens'] = $this->ordem_compra_model->getOrdens(null,1);
                    $dados['fornecedor'] = $this->fornecedores_model->getFornecedores($dados['tonner']['0']->id_fornecedor);
                    $dados['saldo'] = $this->tonners_model->getSaldoTonner($id);

                    //print_r($dados['tonner']);
                    $this->montaPagina('sistema_tonners/fornecedores/fornecedores_adicionar_saldo',$dados);
                    
                }
                
                else{
                    
                    $id = $_POST['id_tonner_fornecedor'];
                    $id_ordem = $_POST['id_ordem_compra'];
                    
                    $_POST['saldo'] = $_POST['credito'];
                    $_POST['data_cadastro'] = $this->site->getData();
                    
                    $this->db->where('id_tonner_fornecedor',$id);
                    $this->db->where('id_ordem_compra',$id_ordem);
                    $num = $this->db->get('tbl_tonners_saldo')->num_rows();

                    if($num == 0){
                        $retorno = $this->fornecedores_model->setSaldo($_POST);

                        if($retorno){

                            $this->site->location("fornecedores/creditos/$id/true");
                        }
                    }
                    
                    else{
                        
                        $this->site->location("fornecedores/creditos/$id/erro");
                    }
                     
                }
            }
            
            else{

                    $this->montaPagina("acesso_negado");
            }
             
         }
}
