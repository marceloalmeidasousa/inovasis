<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banners extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('banners_model');
        }
        
        public function index(){
             
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $dados['banners'] = $this->banners_model->getBanners();
                $this->montaPagina('sistema_site/banners/banners_view',$dados);
            }
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function novo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $this->lang->load('form_validation','portugues');

                if($this->form_validation->run('valida_banner') == FALSE){

                    $ordem = $this->banners_model->getOrdem($this->site->getData());

                    if($ordem->num_rows() == 0){
                        $dados['ordem'] = 0;
                    }

                    else{

                        $dados['ordem'] = $ordem->result();
                    }

                    $dados['data_atual'] = $this->site->getData();
                    $dados['data_atual'] = date("d/m/Y", strtotime($dados['data_atual']));
                    $this->montaPagina('sistema_site/banners/banners_novo',$dados);

                }

                else{


                    //Configuração do carregamento de imagem

                    $config['upload_path'] = './uploads/banners'; //Pasta
                    $config['allowed_types'] = 'gif|jpg|png'; //Tipos do arquivo/imagem
                    $config['max_size']	= '100000'; //Tamanho máximo pergmito

                    $input = "imagem"; //Nome do input da imagem

                    $this->load->library('upload', $config); //Carrega biblioteca upload

                    //Verifica se a imagem foi carregada corretamente
                    if (!$this->upload->do_upload($input)){

                        $error = array('error' => $this->upload->display_errors());
                        $this->site->location('banners/novo/erro');
                    }


                    else{

                        $data = array('0' => $this->upload->data());

                        //print_r($data);
                        //Cria novo nome para a imagem
                        $nome = $this->site->hash(10);

                        $nomeorig = $config["upload_path"] . "/" . $this->upload->file_name;   

                        $nomedestino = $config["upload_path"] . "/$nome" .  $this->upload->file_ext;             
                        //Renomeia nome da imagem
                        rename($nomeorig, $nomedestino);

                        //Setando novo nome da imagem que será gravada no banco de dados
                        $_POST['imagem'] = $data['0']['file_name'] = $nome."".$data['0']['file_ext'];

                        //$this->load->view('upload', $data);
                    }

                    $_POST['data_inicio'] = implode("-",array_reverse(explode("/",$_POST['data_inicio'])));
                    $_POST['data_fim'] = implode("-",array_reverse(explode("/",$_POST['data_fim'])));
                    $_POST['data_fim'] = $_POST['data_fim']." 23:59:00";
                    $_POST['data_cadastro'] = $this->site->getData();
                    $_POST['data_modificacao'] = $this->site->getData();

                    $retorno = $this->banners_model->setBanner($_POST);

                    //print_r($_POST);

                    if($retorno){

                        $this->site->location('banners/novo/true');
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
            
            if($this->form_validation->run('valida_banner') == FALSE){
                
                $id = $this->uri->segment(3);
                
                $ordem = $this->banners_model->getOrdem($this->site->getData());
                
                if($ordem->num_rows() == 0){
                    $dados['ordem'] = 1;
                }
                
                else{
                    
                    $dados['ordem'] = $ordem->result();
                }
                
                $dados['banner'] = $this->banners_model->getBanners($id);
                $dados['data_atual'] = $this->site->getData();
                $dados['data_atual'] = date("d/m/Y", strtotime($dados['data_atual']));
                
                $this->montaPagina('sistema_site/banners/banners_editar',$dados);
            
            }
            
            else{
                               
                //Configuração do carregamento de imagem
                
                $config['upload_path'] = './uploads/banners'; //Pasta
		$config['allowed_types'] = 'gif|jpg|png'; //Tipos do arquivo/imagem
		$config['max_size']	= '100000'; //Tamanho máximo pergmito
		
                $input = "imagem"; //Nome do input da imagem
                
		$this->load->library('upload', $config); //Carrega biblioteca upload
	
                //Verifica se a imagem foi carregada corretamente
		if ($this->upload->do_upload($input)){
                    
                    $data = array('0' => $this->upload->data());

                    //print_r($data);
                    //Cria novo nome para a imagem
                    $nome = $this->site->hash(10);

                    $nomeorig = $config["upload_path"] . "/" . $this->upload->file_name;   

                    $nomedestino = $config["upload_path"] . "/$nome" .  $this->upload->file_ext;             
                    //Renomeia nome da imagem
                    rename($nomeorig, $nomedestino);

                    //Setando novo nome da imagem que será gravada no banco de dados
                    $_POST['imagem'] = $data['0']['file_name'] = $nome."".$data['0']['file_ext'];

                    //$this->load->view('upload', $data);
                }
                
                $_POST['data_inicio'] = implode("-",array_reverse(explode("/",$_POST['data_inicio'])));
                $_POST['data_fim'] = implode("-",array_reverse(explode("/",$_POST['data_fim'])));
                $_POST['data_fim'] = $_POST['data_fim']." 23:59:00";
                //$_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                $id = $_POST['id'];
                
                unset($_POST['id']);
                
                $this->banners_model->editarBanner($id,$_POST);
                
                $this->site->location("banners/editar/$id/true");
                
                //print_r($_POST);
                
                /*if($retorno){
                    
                    
                }*/
            
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
                $array = array('status' => '0', 'data_modificacao' => $this->site->getData());
                $this->banners_model->ativaDesativaBanner($id,$array);

                $this->site->location('banners');
            }
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function ativar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $id = $this->uri->segment(3);
                $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
                $this->banners_model->ativaDesativaBanner($id,$array);

                $this->site->location('banners');
            }
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }

}
