<?php require_once 'valida.php'; if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('downloads_model');

        }
        
        public function index(){

            $dados['downloads'] = $this->downloads_model->getDownloads();
            $this->montaPagina('downloads/downloads_view',$dados);
        }
        
        function novo(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_downloads') == FALSE){
                
                $dados['categorias'] = $this->downloads_model->getCategorias(null,1);
                $this->montaPagina('downloads/downloads_novo',$dados);
            
            }
            
            else{
                               
                //Configuração do carregamento de imagem
                
                $config['upload_path'] = './uploads/documentos'; //Pasta
		$config['allowed_types'] = 'gif|jpg|png|doc|pdf|docx|txt|zip|rar|xls|xlsx'; //Tipos do arquivo/imagem
		$config['max_size']	= '100000'; //Tamanho máximo pergmito
		
                $input = "arquivo"; //Nome do input da imagem
                
		$this->load->library('upload', $config); //Carrega biblioteca upload
	
                //Verifica se a imagem foi carregada corretamente
		if (!$this->upload->do_upload($input)){
                    
                    $error = array('error' => $this->upload->display_errors());
                    $this->site->location('downloads/novo/erro');
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
                    $_POST['arquivo'] = $data['0']['file_name'] = $nome."".$data['0']['file_ext'];

                    //$this->load->view('upload', $data);
                }
                
                $_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                //print_r($_POST);
                $retorno = $this->downloads_model->setDownload($_POST);
                
                //print_r($_POST);
                
                if($retorno){
                    
                    $this->site->location('downloads/novo/true');
                }
            
            }
        }
        
        function categorias_novo(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_tipo_polo') == FALSE){
                
                $this->montaPagina('downloads/downloads_categorias_novo');
            
            }
            
            else{
               
                $_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
               
                $retorno = $this->downloads_model->setCategoria($_POST);
                
                //print_r($_POST);
                
                if($retorno){
                    
                    $this->site->location('downloads/categorias_novo/true');
                }
            
            }
        }
        
        public function categorias(){
            
            $dados['categorias'] = $this->downloads_model->getCategorias();
            $this->montaPagina("downloads/downloads_categorias",$dados);
        }
        
       function categorias_editar(){
            
            $id = $this->uri->segment(3);
           
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_tipo_polo') == FALSE){
                
                $dados['categoria'] = $this->downloads_model->getCategorias($id);
                $this->montaPagina('downloads/downloads_categorias_editar',$dados);
            
            }
            
            else{
               
                $id = $_POST['id'];
                unset($_POST['id']);
                //$_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
               
                $this->downloads_model->editarCategoria($id,$_POST);
 
                $this->site->location("downloads/categorias_editar/$id/true");

            
            }
        }
        
        function desativar(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '0', 'data_modificacao' => $this->site->getData());
            $this->downloads_model->editarDownload($id,$array);
            
            $this->site->location('downloads');
        }
        
        function ativar(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
            $this->downloads_model->editarDownload($id,$array);
            
            $this->site->location('downloads');
        }
        
        
        function categorias_desativar(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '0', 'data_modificacao' => $this->site->getData());
            $this->downloads_model->editarCategoria($id,$array);
            
            $this->site->location('downloads/categorias');
        }
        
        function categorias_ativar(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
            $this->downloads_model->editarCategoria($id,$array);
            
            $this->site->location('downloads/categorias');
        }

        
       function editar(){
            
           $id = $this->uri->segment(3);
           $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_downloads') == FALSE){
                $dados['doc'] = $this->downloads_model->getDownloads($id);
                $dados['categorias'] = $this->downloads_model->getCategorias(null,1);
                $this->montaPagina('downloads/downloads_editar',$dados);
            
            }
            
            else{
                               
                //Configuração do carregamento de imagem
                
                $config['upload_path'] = './uploads/documentos'; //Pasta
		$config['allowed_types'] = 'gif|jpg|png|doc|pdf|docx|txt|zip|rar|xls|xlsx'; //Tipos do arquivo/imagem
		$config['max_size']	= '100000'; //Tamanho máximo pergmito
		
                $input = "arquivo"; //Nome do input da imagem
                
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
                    $_POST['arquivo'] = $data['0']['file_name'] = $nome."".$data['0']['file_ext'];

                    //$this->load->view('upload', $data);
                }
                
                $id = $_POST['id'];
                unset($_POST['id']);
                //$_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                //print_r($_POST);
                $this->downloads_model->editarDownload($id,$_POST);
                
                //print_r($_POST);
                
                 $this->site->location("downloads/editar/$id/true");
            
            }
        }
}
