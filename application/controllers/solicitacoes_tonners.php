<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Solicitacoes_tonners extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('solicitacoes_tonners_model');
            $this->load->model('departamentos_model');
            $this->load->model('tonners_model');
        }
        
        function index($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $limite = 10;
                $dados['solicitacoes'] = $this->solicitacoes_tonners_model->getSolicitacoesTonners(null,null,"tbl_solicitacoes_tonners.data_cadastro DESC",$limite,$offset);

                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."solicitacoes_tonners/index";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_solicitacoes_tonners')->num_rows();
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

                $this->montaPagina('sistema_tonners/solicitacoes_tonners/solicitacoes_tonners_view',$dados);
            
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function novo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $this->lang->load('form_validation','portugues');

                if($this->form_validation->run('valida_solicitacoes') == FALSE){

                    $dados['tipos'] = $this->departamentos_model->getTiposDepartamentos(null,1,"nome ASC");
                    $dados['status'] = $this->solicitacoes_tonners_model->getStatus(null,1,"nome ASC");
                    $dados['tonners'] = $this->tonners_model->getTonners(null,1,"nome ASC");
                    
                    $this->montaPagina("sistema_tonners/solicitacoes_tonners/solicitacoes_tonners_novo",$dados);

                }

                else{

                    
                    $_POST['data_cadastro'] = $this->site->getData();

                    $retorno = $this->solicitacoes_tonners_model->setSolicitacao($_POST);

                    if($retorno){

                       $this->site->location("solicitacoes_tonners/novo/true");
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

                if($this->form_validation->run('valida_solicitacoes_editar') == FALSE){

                    $id = $this->uri->segment(3);
                    $dados['solicitacao'] = $this->solicitacoes_tonners_model->getSolicitacoesTonners($id,null);
                    $dados['status'] = $this->solicitacoes_tonners_model->getStatus(null,1,"nome ASC");
                    
                    $this->montaPagina("sistema_tonners/solicitacoes_tonners/solicitacoes_tonners_editar",$dados);

                }

                else{

                    $id = $_POST['id'];
                    
                    $_POST['data_devolucao'] = $this->site->converterDataMysql($_POST['data_devolucao']);
                            
                    unset($_POST['id']);

                    $this->solicitacoes_tonners_model->editarSolicitacaoTonner($id,$_POST);

                    $this->site->location("solicitacoes_tonners/editar/$id/true");
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

                $this->solicitacoes_tonners_model->editarTonner($id,$array);

                $this->site->location("solicitacoes_tonners");
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

                $this->solicitacoes_tonners_model->editarTonner($id,$array);

                $this->site->location("solicitacoes_tonners");
            }

            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $busca = $_POST['busca'];

                $dados['solicitacoes'] = $this->solicitacoes_tonners_model->buscar($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_tonners/solicitacoes_tonners/solicitacoes_tonners_view',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function excluir(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                $id = $this->uri->segment(3);

                $retorno = $this->solicitacoes_tonners_model->excluirSolicitacaoTonner($id);

                if($retorno){

                    $this->site->location('solicitacoes_tonners/index/true');
                }
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function busca_departamento(){
            
            $tipo = $this->uri->segment(3);
            
            $departamentos = $this->departamentos_model->getDepartamentos(null, $tipo,1,"nome ASC");
            
         ?>   
         
        <option value="">Selecione o Departamento</option>
       <?php 
       
                foreach($departamentos as $val){
                 
                    echo "<option value=\"$val->id\">$val->nome</option>";
                }
       
        }
       
        
       function status($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $limite = 10;
                $dados['status'] = $this->solicitacoes_tonners_model->getStatus(null,null,null,$limite,$offset);

                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."solicitacoes_tonners/status";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_solicitacoes_tonners_status')->num_rows();
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

                $this->montaPagina('sistema_tonners/solicitacoes_tonners/solicitacoes_tonners_status',$dados);
            
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function novo_status(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $this->lang->load('form_validation','portugues');

                if($this->form_validation->run('valida_editar_status') == FALSE){
                    
                    $this->montaPagina("sistema_tonners/solicitacoes_tonners/solicitacoes_tonners_status_novo");

                }

                else{

                   $retorno = $this->solicitacoes_tonners_model->setStatus($_POST);

                    if($retorno){

                       $this->site->location("solicitacoes_tonners/novo_status/true");
                    }
                }
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function editar_status(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $this->lang->load('form_validation','portugues');

                if($this->form_validation->run('valida_editar_status') == FALSE){

                    $id = $this->uri->segment(3);
                    $dados['status'] = $this->solicitacoes_tonners_model->getStatus($id);
                    
                    $this->montaPagina("sistema_tonners/solicitacoes_tonners/solicitacoes_tonners_status_editar",$dados);

                }

                else{

                    $id = $_POST['id'];
                          
                    unset($_POST['id']);

                    $this->solicitacoes_tonners_model->editarStatus($id,$_POST);

                    $this->site->location("solicitacoes_tonners/editar_status/$id/true");
                }
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function desativar_status(){
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $id = $this->uri->segment(3);

                $array = array('status' => '0');

                $this->solicitacoes_tonners_model->editarStatus($id,$array);

                $this->site->location("solicitacoes_tonners/status");
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function ativar_status(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $id = $this->uri->segment(3);

                $array = array('status' => '1');

                $this->solicitacoes_tonners_model->editarStatus($id,$array);

                $this->site->location("solicitacoes_tonners/status");
            }

            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar_status(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $busca = $_POST['busca'];

                $dados['solicitacoes'] = $this->solicitacoes_tonners_model->buscar($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_tonners/solicitacoes_tonners/solicitacoes_tonners_view',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
         function excluir_status(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                
                $id = $this->uri->segment(3);

                $this->db->where('status',$id);
                $num = $this->db->get('tbl_solicitacoes_tonners')->num_rows();
                
                if($num == 0){
                    
                    $retorno = $this->solicitacoes_tonners_model->excluirStatus($id);

                    if($retorno){

                        $this->site->location('solicitacoes_tonners/status/true');
                    }
                }
                
                else{
                   
                    $this->site->location('solicitacoes_tonners/status/false');
                }
                
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
}
