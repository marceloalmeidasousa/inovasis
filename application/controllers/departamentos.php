<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departamentos extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('departamentos_model');
            $this->load->model('impressoras_model');
        }
        
        function index($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $limite = 10;
                $dados['departamentos'] = $this->departamentos_model->getDepartamentos(null,null,null,null,$limite,$offset);

                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."departamentos/index";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_departamentos')->num_rows();
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

                $this->montaPagina('sistema_tonners/departamentos/departamentos_view',$dados);
            
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function novo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $this->lang->load('form_validation','portugues');

                if($this->form_validation->run('valida_departamento') == FALSE){

                    $dados['tipos'] = $this->departamentos_model->getTiposDepartamentos(null,1);
                    $this->montaPagina("sistema_tonners/departamentos/departamentos_novo",$dados);

                }

                else{

                    $_POST['data_cadastro'] = $this->site->getData();

                    $retorno = $this->departamentos_model->setDepartamento($_POST);

                    if($retorno){

                        $this->site->location("departamentos/novo/true");
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

                if($this->form_validation->run('valida_departamento') == FALSE){

                    $id = $this->uri->segment(3);
                    $dados['departamento'] = $this->departamentos_model->getDepartamentos($id,null);
                    $dados['tipos'] = $this->departamentos_model->getTiposDepartamentos(null,1);
                    $this->montaPagina("sistema_tonners/departamentos/departamentos_editar",$dados);

                }

                else{

                    $id = $_POST['id'];

                    unset($_POST['id']);

                    $this->departamentos_model->editarDepartamento($id,$_POST);

                    $this->site->location("departamentos/editar/$id/true");
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

                $this->departamentos_model->editarDepartamento($id,$array);

                $this->site->location("departamentos");
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

                $this->departamentos_model->editarDepartamento($id,$array);

                $this->site->location("departamentos");
            }

            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $busca = $_POST['busca'];

                $dados['departamentos'] = $this->departamentos_model->buscar($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_tonners/departamentos/departamentos_view',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function excluir(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                $id = $this->uri->segment(3);

                $this->db->where('id_departamento',$id);
                $num = $this->db->get('tbl_solicitacoes_tonners')->num_rows();
                
                if($num == 0){
                    
                    $retorno = $this->departamentos_model->excluirDepartamento($id);

                    if($retorno){

                    $this->site->location('departamentos/index/true');
                    }
                }
                
                else{
                   
                    $this->site->location('departamentos/index/false');
                }
                
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function excluir_tipo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                
                $id = $this->uri->segment(3);

                $this->db->where('tipo',$id);
                $num = $this->db->get('tbl_departamentos')->num_rows();
                
                if($num == 0){
                    
                    $retorno = $this->departamentos_model->excluirTipo($id);

                    if($retorno){

                        $this->site->location('departamentos/tipos/true');
                    }
                }
                
                else{
                   
                    $this->site->location('departamentos/tipos/false');
                }
                
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
         function tipos($offset = 0){
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                
                $limite = 10;
                
                $dados['tipos'] = $this->departamentos_model->getTiposDepartamentos(null,null,null,$limite, $offset);
                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."departamentos/tipos";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_departamentos_tipos')->num_rows();
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
                
                
                $this->montaPagina("sistema_tonners/departamentos/departamentos_tipos",$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }

        function novo_tipo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                $this->lang->load('form_validation','portugues');

                if($this->form_validation->run('valida_tipo') == FALSE){

                    $this->montaPagina("sistema_tonners/departamentos/departamentos_tipos_novo");
                }

                else{

                   $retorno = $this->departamentos_model->setTipoDepartamento($_POST);

                    if($retorno){

                        $this->site->location('departamentos/novo_tipo/true');

                    }

                    else{
                        $this->site->location('departamentos/novo_tipo/erro');
                    }

                }
             
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function editar_tipo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
            
            $this->lang->load('form_validation','portugues');
             
            if($this->form_validation->run('valida_tipo') == FALSE){

                $id = $this->uri->segment(3);
            
                $dados['tipo'] = $this->departamentos_model->getTiposDepartamentos($id);

                $this->montaPagina("sistema_tonners/departamentos/departamentos_tipos_editar",$dados);
            }
             
            else{
                
                $id = $_POST['id'];
               
                unset($_POST['id']);
                
                $this->departamentos_model->editarTipo($id,$_POST);
                
                $this->site->location("departamentos/editar_tipo/$id/true");

            }
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function desativar_tipo(){
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $id = $this->uri->segment(3);

                $array = array('status' => '0');

                $this->departamentos_model->editarTipo($id,$array);

                $this->site->location("departamentos/tipos");
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function ativar_tipo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $id = $this->uri->segment(3);

                $array = array('status' => '1');

                $this->departamentos_model->editarTipo($id,$array);

                $this->site->location("departamentos/tipos");
            }

            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar_tipo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $busca = $_POST['busca'];

                $dados['tipos'] = $this->departamentos_model->buscar_tipo($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_tonners/departamentos/departamentos_tipos',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        
        //CONFIGURAÇÃO DAS IMPRESSORAS DO DEPARTAMENTO
        
        function impressoras($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $limite = 10;
                $dados['departamentos'] = $this->departamentos_model->getDepartamentos(null,null,null,null,$limite,$offset);

                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."departamentos/impressoras";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_departamentos')->num_rows();
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

                $this->montaPagina('sistema_tonners/departamentos/departamentos_impressoras',$dados);
            
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
            
                if($this->form_validation->run('valida_add_impressora') == FALSE){
                
                    $dados['departamento'] = $this->departamentos_model->getDepartamentos($id);
                    $result = $this->departamentos_model->getImpressorasDepartamento($id);
                    $dados['impressoras'] = $this->impressoras_model->getImpressoras(null,1,"nome ASC");
                    $dados['num_rows'] = $result->num_rows();
                    $dados['di'] = $result->result();
                    
                    $this->montaPagina('sistema_tonners/departamentos/departamentos_impressoras_config',$dados);
                }
                
                else{
                    
                    $_POST['id_departamento'] = $id;
                    
                    //print_r($_POST);
                    $retorno = $this->departamentos_model->setImpressoraDepartamento($_POST);
                    
                    if($retorno){
                        
                        $this->site->location("departamentos/config/$id/true");
                    }
                }
            }
            
            else{

                    $this->montaPagina("acesso_negado");
            }
           
         }
         function excluir_impressora_departamento(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
                $id = $this->uri->segment(3);
                $departamento = $this->uri->segment(4);
                $retorno = $this->departamentos_model->excluirImpressoraDepartamento($id);

                if($retorno){

                    $this->site->location("departamentos/config/$departamento/true");
                }
            
                        
            }
            else{

                    $this->montaPagina("acesso_negado");
            }
        }
        
        
         
}
