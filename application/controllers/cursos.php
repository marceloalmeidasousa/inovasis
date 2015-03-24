<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cursos extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('cursos_model');
            $this->load->model('menus_model');
            $this->load->model('disciplinas_model');
            $this->load->helper('ckeditor');
        }
        
        function index($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
                $limite = 10;

                $dados['cursos'] = $this->cursos_model->getCursos(null,null,null,$limite,$offset);

                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."cursos/index";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_cursos')->num_rows();
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

                $this->montaPagina('sistema_site/cursos/cursos_view',$dados);
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function novo(){
            
        
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_curso') == FALSE){
                
                $dados['error'] = "";
                
                //Chama o editor de texto ckeditor
                $array = $this->site->editorTexto('descricao', 'descricao','200px');
                $dados['descricao'] = $array['descricao'];
                
                $array2 = $this->site->editorTexto('detalhes', 'detalhes','200px');
                $dados['detalhes'] = $array2['detalhes'];
                
                $dados['tipos'] = $this->cursos_model->getTiposCursos(null,1);
                $this->montaPagina('sistema_site/cursos/cursos_novo',$dados);
            
            }
            
            else{
                
                $config['upload_path'] = './uploads/cursos';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100000';
		
                $field_name1 = "imagem";
		$this->load->library('upload', $config);
	
		if (!$this->upload->do_upload($field_name1)){
                    
			//$error = array('error' => $this->upload->display_errors());
                        $dados['error'] = "Você não selecionou uma imagem!";
                        //Chama o editor de texto ckeditor
                        $array = $this->site->editorTexto('descricao', 'descricao','200px');
                        $dados['descricao'] = $array['descricao'];

                        $dados['tipos'] = $this->cursos_model->getTiposCursos(null,1);
                        $this->montaPagina('sistema_site/cursos/cursos_novo',$dados);
			
		}	
		else{
			$data = array('0' => $this->upload->data());
			
                        //print_r($data);
                        
                        $nome = $this->site->hash(10);
                        
                        $nomeorig = $config["upload_path"] . "/" . $this->upload->file_name;   
                        
                        $nomedestino = $config["upload_path"] . "/$nome" .  $this->upload->file_ext;             
                        rename($nomeorig, $nomedestino);
                        
                        
                        $_POST['imagem'] = $data['0']['file_name'] = $nome."".$data['0']['file_ext'];

			//$this->load->view('upload', $data);
		}
                
                $_POST['data_cadastro'] = $this->site->getData();
                
                $_POST['data_inicio'] = $this->site->converterDataMysql($_POST['data_inicio']);
                $_POST['data_fim'] = $this->site->converterDataMysql($_POST['data_fim']);
                
                $retorno = $this->cursos_model->setCurso($_POST);
                
                if($retorno){
                    
                    $this->site->location('cursos/novo/true');
                }
            }
            
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
         
        function enviar(){
        
            $id = $_POST['id'];
            
            unset($_POST['id']);
            
            $this->cursos_model->editarInscricao($id, $_POST);
        }
        
        function inscritos(){
            
        
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
                $idcurso = $this->uri->segment(3);
            
                $dados['inscritos'] = $this->cursos_model->getInscritos(null,$idcurso);
                
                $this->montaPagina("sistema_site/cursos/cursos_inscritos",$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function pagamentos(){
            
        
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
                $idcurso = $this->uri->segment(3);
            
                $dados['inscritos'] = $this->cursos_model->getInscritos(null,$idcurso);
                
                $this->montaPagina("sistema_site/cursos/cursos_pagamentos",$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function editar(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_curso') == FALSE){
                
                $id = $this->uri->segment(3);
                
                $dados['error'] = "";
                
                //Chama o editor de texto ckeditor
                $array = $this->site->editorTexto('descricao', 'descricao','200px');
                $dados['descricao'] = $array['descricao'];
                
                $array2 = $this->site->editorTexto('detalhes', 'detalhes','200px');
                $dados['detalhes'] = $array2['detalhes'];
                
                $dados['tipos'] = $this->cursos_model->getTiposCursos(null,1);
                $dados['curso'] = $this->cursos_model->getCursos($id,null);
                
                $dados['curso'][0]->data_inicio = $this->site->converterDataPhp($dados['curso'][0]->data_inicio);
                $dados['curso'][0]->data_fim = $this->site->converterDataPhp($dados['curso'][0]->data_fim);
                
                $this->montaPagina("sistema_site/cursos/cursos_editar",$dados);
                
            }
            
            else{
                
                $config['upload_path'] = './uploads/cursos';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100000';
		
                $field_name1 = "imagem";
		$this->load->library('upload', $config);
	
		if ($this->upload->do_upload($field_name1)){
                    
			
			$data = array('0' => $this->upload->data());
			
                        //print_r($data);
                        
                        $nome = $this->site->hash(10);
                        
                        $nomeorig = $config["upload_path"] . "/" . $this->upload->file_name;   
                        
                        $nomedestino = $config["upload_path"] . "/$nome" .  $this->upload->file_ext;             
                        rename($nomeorig, $nomedestino);
                        
                        
                        $_POST['imagem'] = $data['0']['file_name'] = $nome."".$data['0']['file_ext'];

			//$this->load->view('upload', $data);
		}
                
                $id = $_POST['id'];
                
                unset($_POST['id']);
                
                $_POST['data_inicio'] = $this->site->converterDataMysql($_POST['data_inicio']);
                $_POST['data_fim'] = $this->site->converterDataMysql($_POST['data_fim']);
                
                $this->cursos_model->editarCurso($id,$_POST);
                
                $this->site->location("cursos/editar/$id/true");
            }
        }
        
        
        function excluir(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                $id = $this->uri->segment(3);

                $retorno = $this->cursos_model->excluirCurso($id);

                if($retorno){

                    $this->site->location('cursos/index/true');
                }
                
                else{
                   
                    $this->site->location('cursos/index/false');
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
                
                $dados['tipos'] = $this->cursos_model->getTiposCursos();
                $dados['cursos'] = $this->cursos_model->getCursos(null,null,null,$limite,$offset);

                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."cursos/tipos";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_cursos_tipos')->num_rows();
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
                
                $this->montaPagina('sistema_site/cursos/cursos_tipos',$dados);
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function novo_tipo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $this->lang->load('form_validation','portugues');

                if($this->form_validation->run('valida_tipo') == FALSE){

                    $this->montaPagina('sistema_site/cursos/cursos_tipos_novo');

                }

                else{

                    $_POST['data_cadastro'] = $this->site->getData();
                    //$_POST['data_modificacao'] = $this->site->getData();

                    $retorno = $this->cursos_model->setTipoCurso($_POST);

                    if($retorno){

                        $this->site->location('cursos/novo_tipo/true');
                    }
                }
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function excluir_tipo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                $id = $this->uri->segment(3);

                $retorno = $this->cursos_model->excluirTipo($id);

                if($retorno){

                    $this->site->location('cursos/tipos/true');
                }
                else{
                   
                    $this->site->location('cursos/tipos/false');
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

                    $dados['tipo'] = $this->cursos_model->getTiposCursos($id,null);
                    $this->montaPagina('sistema_site/cursos/cursos_tipos_editar',$dados);

                }
            
                else{

                    $id = $_POST['id'];

                    //$_POST['data_modificacao'] = $this->site->getData();
                    unset($_POST['id']);

                    $this->cursos_model->editarTipoCurso($id,$_POST);

                    $this->site->location("cursos/editar_tipo/$id/true");
                }
                }else{
                    $this->montaPagina("acesso_negado");
                }
        }
        
        function desativar_tipo(){
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $id = $this->uri->segment(3);

                $array = array('status' => '0');

                $this->cursos_model->editarTipoCurso($id,$array);

                $this->site->location("cursos/tipos");
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function ativar_tipo(){
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $id = $this->uri->segment(3);

                $array = array('status' => '1');

                $this->cursos_model->editarTipoCurso($id,$array);

                $this->site->location("cursos/tipos");
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function ativar(){
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $id = $this->uri->segment(3);

                $array = array('status' => '1');

                $this->cursos_model->editarCurso($id,$array);

                $this->site->location("cursos");
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function desativar(){
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $id = $this->uri->segment(3);

                $array = array('status' => '0');

                $this->cursos_model->editarCurso($id,$array);

                $this->site->location("cursos");
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function disciplinas(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            $dados['cursos'] = $this->cursos_model->getCursos();
            $this->montaPagina('cursos/cursos_disciplinas',$dados);
            
        }
        
        function adicionar_disciplinas(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            
            $id = $this->uri->segment(3);
            $dados['disciplinas'] = $this->disciplinas_model->getDisciplinas(null,1);
            $dados['curso'] = $this->cursos_model->getCursos($id,null);
            $this->montaPagina("cursos/cursos_disciplinas_adicionar",$dados);
        }
        
        function buscar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
                $busca = $_POST['busca'];

                $dados['cursos'] = $this->cursos_model->buscar($busca);
                $dados['busca'] = $busca;
                //print_r($dados);
                $this->montaPagina('sistema_site/cursos/cursos_view',$dados);
                
            }
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar_inscritos(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
                $busca = $_POST['busca'];

                $dados['inscritos'] = $this->cursos_model->buscarInscritos($busca);
                $dados['busca'] = $busca;
                //print_r($dados);
                $this->montaPagina('sistema_site/cursos/cursos_inscritos',$dados);
                
            }
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
}
