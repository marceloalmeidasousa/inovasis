<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    
        function __construct() {
            // Call the Controller constructor
            parent::__construct();

            $this->load->model('usuarios_model');
            $this->load->model('menus_model');
            $this->load->model('perfis_model');
        }
        
        function index($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $limite = 10;
                $dados['usuarios'] = $this->usuarios_model->getUsuarios(null,null,null,null,$limite,$offset);
                
                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."usuarios/index";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_usuarios')->num_rows();
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

                $this->montaPagina("sistema_sisadmin/usuarios/usuarios_view",$dados);
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function importar($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $limite = 10;
                $dados['usuarios'] = $this->usuarios_model->getUsuariosMoodle(null,null,$limite,$offset);
                
                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."usuarios/importar";
                $config['per_page'] = $limite;
                $DB1 = $this->load->database('banco_2', TRUE);
                $config['total_rows'] = $DB1->get('mdl_user')->num_rows();
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

                $this->montaPagina("sistema_sisadmin/usuarios/usuarios_importar",$dados);
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function novo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $this->lang->load('form_validation','portugues');

                if($this->form_validation->run('valida_usuario') == FALSE){
                    
                     $id_moodle = $this->uri->segment(3);
                     
                     $dados['usuario'] = $this->usuarios_model->getUsuariosMoodle($id_moodle);
                     $dados['perfis'] = $this->perfis_model->getPerfis(null,1);
                     $this->montaPagina("sistema_sisadmin/usuarios/usuarios_novo",$dados);
                }

                else{
                    //print_r($_POST);
                    $id_moodle = $_POST['id_moodle'];
                    $cpf = $_POST['cpf'];
                    $usuario = $_POST['usuario'];
                    
                    //Deixa todas letras maiúsculas
                    $_POST['nome'] = strtoupper($_POST['nome']);
                    
                    $this->db->where('cpf',$cpf);
                    $this->db->or_where('usuario',$usuario);
                    $num = $this->db->get('tbl_usuarios')->num_rows();
                    
                    
                    if($num == 0){
                        $_POST['data_cadastro'] = $this->site->getData();

                        $retorno = $this->usuarios_model->setUsuario($_POST);

                        if($retorno){
                            $this->db->where('cpf',$cpf);
                            $u = $this->db->get('tbl_usuarios')->result();
                            $id = $u['0']->id;
                            //print_r($u);
                            $this->site->location("usuarios/editar/$id/true");

                       }
                    }
                    
                    else{
                        
                        $this->site->location("usuarios/novo/$id_moodle/erro");
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
            
            if($this->form_validation->run('valida_usuario_editar') == FALSE){
                
                $id = $this->uri->segment(3);
                
                $dados['perfis'] = $this->perfis_model->getPerfis(null,1);
                $dados['usuario'] = $this->usuarios_model->getUsuarios($id,null);
                $this->montaPagina("sistema_sisadmin/usuarios/usuarios_editar",$dados);
            }
            
            else{
                
                $cpf = $_POST['cpf'];
                $usuario = $_POST['usuario'];
                $id = $_POST['id'];
                
                //Deixa todas letras maiúsculas
                $_POST['nome'] = strtoupper($_POST['nome']);
                
               //Verifica se não existe outro usuário com mesmo mesmo CPF ou LOGIN no sistema         
                $sql = "SELECT * FROM tbl_usuarios WHERE id != $id AND (cpf = '$cpf' OR usuario = '$usuario')";
                $num = $this->db->query($sql)->num_rows();
                
                //Caso não exista ele altera os dados no Sistema e no Moodle
                if($num == 0){
                    
                    unset($_POST['id']);
                    //Pega ID para alterar dados no Moodle
                    $id_moodle = $_POST['id_moodle'];
                    
                    //Separar nome e sobrenome para alterar no Moodle
                    $pega_nome = explode(" ", $_POST['nome']);
                    @$sobrenome = $pega_nome[1]." ".$pega_nome[2]." ".$pega_nome[3]." ".$pega_nome[4];
                    $nome = $pega_nome[0];
                    
                    //Array para alterar dados no Moodle
                    $array = array('firstname' => $nome,
                                    'lastname' => $sobrenome,
                                    'email' =>  $_POST['email'],
                                    'username' => $_POST['usuario']
                        );
                    
                    //print_r($array);
                    //Alterar dados no sistema
                    $this->usuarios_model->editarUsuario($id,$_POST);
                    //Alterar dados no Moodle
                    $this->usuarios_model->editarUsuarioMoodle($id_moodle,$array);
                    
                    $this->site->location("usuarios/editar/$id/true");
                }
                
                //Caso exista ele retorna o erro
                else{
                    
                    $this->site->location("usuarios/editar/$id/erro");
                }
                
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
            
            $array = array('status' => '0','data_modificacao' => $this->site->getData());
            
            $this->usuarios_model->ativarDesativarUsuario($id,$array);
            
            $this->site->location("usuarios");
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function ativar(){
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            $id = $this->uri->segment(3);
            
            $array = array('status' => '1','data_modificacao' => $this->site->getData());
            
            $this->usuarios_model->ativarDesativarUsuario($id,$array);
            
            $this->site->location("usuarios");
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
      
        function excluir(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                $id = $this->uri->segment(3);

                $retorno = $this->usuarios_model->excluirUsuario($id);

                if($retorno){

                    $this->site->location('usuarios/index/true');
                }
                else{
                   
                    $this->site->location('usuarios/index/false');
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

                $dados['usuarios'] = $this->usuarios_model->buscar($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_sisadmin/usuarios/usuarios_view',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar_usuario_moodle(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $busca = $_POST['busca'];

                $dados['usuarios'] = $this->usuarios_model->buscarUsuarioMoodle($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_sisadmin/usuarios/usuarios_importar',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function alterar_senha(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_usuario_senha') == FALSE){
                
                $id = $this->uri->segment(3);
                
                $dados['perfis'] = $this->perfis_model->getPerfis(null,1);
                $dados['usuario'] = $this->usuarios_model->getUsuarios($id,null);
                $this->montaPagina("sistema_sisadmin/usuarios/usuarios_alterar_senha",$dados);
            }
            
            else{
                
                $id = $_POST['id'];
                $id_moodle = $_POST['id_moodle'];
                
                $_POST['senha'] = crypt($_POST['senha']);
                
                $array = array('password' => $_POST['senha']);
                
                unset($_POST['id']);
                
                $this->usuarios_model->editarUsuario($id,$_POST);
                $this->usuarios_model->editarUsuarioMoodle($id_moodle,$array);
                
                $this->site->location("usuarios/alterar_senha/$id/true");
            }

                
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
            
        }
}
