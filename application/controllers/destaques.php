<?php require_once 'valida.php'; if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Destaques extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('destaques_model');
            $this->load->helper('ckeditor');
        }
        
        public function index(){
            
            $dados['destaques'] = $this->destaques_model->getDestaques();
            $this->montaPagina('destaques/destaques_view',$dados);
        }
        
        function novo(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_destaque') == FALSE){
                
                //Array da Área de Edicação do Checkeditor para o input texto
                $dados['editor_texto'] = array(
                        'id'   => 'texto',
                        'path' => '/ckeditor/',
                        'config' => array('toolbar' => "Full",'height'  => "200px",
                    )
                );
                
                //Array da Área de Edicação do Checkeditor para o input pre_texto
                $dados['editor_pre_texto'] = array(
                        'id'   => 'pre_texto',
                        'path' => '/ckeditor/',
                        'config' => array('toolbar' => "Full",'height'  => "200px",
                    )
                );
                
                
                $this->montaPagina("destaques/destaques_novo",$dados);
                
            }
            
            else{
                
                /*    INICIO CARREGAR IMAGEM  */
                //Configuração de CROPPING da Imagem
                
                //Configuração do carregamento de imagem
                $config['upload_path'] = './uploads/destaques'; //Pasta
		$config['allowed_types'] = 'gif|jpg|png'; //Tipos do arquivo/imagem
		$config['max_size']	= '100000'; //Tamanho máximo pergmito
		
                $input = "imagem_destaque"; //Nome do input da imagem
                
		$this->load->library('upload', $config); //Carrega biblioteca upload
	
                //Verifica se a imagem foi carregada corretamente
		if (!$this->upload->do_upload($input)){
                    
                    $_POST['imagem_destaque'] = "img-default-destaque.png";
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
                    $_POST['imagem_destaque'] = $data['0']['file_name'] = $nome."".$data['0']['file_ext'];
                    $this->site->geraMiniatura($data['0']['file_name']);
                    //$this->load->view('upload', $data);
		}
                
                /** ---- FIM CARREGAR IMAGEM */
                
                //Seta data de cadastro e modificação do array com data atual do servidor
                $_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                //print_r($_FILES['imagem_destaque']['name']);
                //print_r($_POST);
                
                $retorno = $this->destaques_model->setDestaque($_POST);
                
                if($retorno){
                    
                    $this->site->location("destaques/novo/true");
                }
            }
        }
        
        function editar(){
            
            $id = $this->uri->segment(3);
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_destaque') == FALSE){
                
                //Array da Área de Edicação do Checkeditor para o input texto
                $dados['editor_texto'] = array(
                        'id'   => 'texto',
                        'path' => '/ckeditor/',
                        'config' => array('toolbar' => "Full",'height'  => "200px",
                    )
                );
                
                //Array da Área de Edicação do Checkeditor para o input pre_texto
                $dados['editor_pre_texto'] = array(
                        'id'   => 'pre_texto',
                        'path' => '/ckeditor/',
                        'config' => array('toolbar' => "Full",'height'  => "200px",
                    )
                );
                
                $dados['destaque'] = $this->destaques_model->getDestaques($id,null);
                
                $this->montaPagina("destaques/destaques_editar",$dados);
                
            }
            
            else{
                
                /*    INICIO CARREGAR IMAGEM  */
                
                //Configuração do carregamento de imagem
                
                $id = $_POST['id'];
                unset($_POST['id']);
                
                $config['upload_path'] = './uploads/destaques'; //Pasta
		$config['allowed_types'] = 'gif|jpg|png'; //Tipos do arquivo/imagem
		$config['max_size']	= '100000'; //Tamanho máximo pergmito
		
                $input = "imagem_destaque"; //Nome do input da imagem
                
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
                    $_POST['imagem_destaque'] = $data['0']['file_name'] = $nome."".$data['0']['file_ext'];

                    //$this->load->view('upload', $data);
		}
                
                /** ---- FIM CARREGAR IMAGEM */
                
                //Seta data de cadastro e modificação do array com data atual do servidor
                $_POST['data_modificacao'] = $this->site->getData();
                
                //print_r($_FILES['imagem_destaque']['name']);
                //print_r($_POST);
                
                $this->destaques_model->editarDestaque($id,$_POST);
                
                    
                $this->site->location("destaques/editar/$id/true");

            }
        }
        
        function desativar(){
            
            $id = $this->uri->segment(3);
            
            $array = array('status' => '0','data_modificacao' => $this->site->getData());
            
            $this->destaques_model->ativarDesativarDestaque($id,$array);
            
            $this->site->location("destaques");
        }
        
        function ativar(){
            
            $id = $this->uri->segment(3);
            
            $array = array('status' => '1','data_modificacao' => $this->site->getData());
            
            $this->destaques_model->ativarDesativarDestaque($id,$array);
            
            $this->site->location("destaques");
        }

}
