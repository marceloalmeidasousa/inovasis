<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends CI_Controller {
    
        function __construct() {

            parent::__construct();

            $this->load->model('noticias_model');
            
            // Carregar helper ckeditor de Edição HTML
            $this->load->helper('ckeditor');
        }
        
        //Método que Carrega página inicial buscando no banco todas notícias
        function index(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                $dados['noticias'] = $this->noticias_model->getNoticias();
                $this->montaPagina('sistema_site/noticias/noticias_view',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
            
        }

        function novo(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_noticia') == FALSE){
                
                $dados['error'] = "";
                
                //Chama o editor de texto ckeditor
                $array = $this->site->editorTexto('texto', 'texto','200px');
                $dados['texto'] = $array['texto'];
                
                $array = $this->site->editorTexto('pre_texto', 'pre_texto','200px');
                $dados['pre_texto'] = $array['pre_texto'];
                
                $this->montaPagina('sistema_site/noticias/noticias_novo',$dados);
            
            }
            
            else{
                
                
                $_POST['data_cadastro'] = $this->site->getData();
                $_POST['url'] = $this->site->url($_POST['titulo']);
                
                
                $retorno = $this->noticias_model->setNoticia($_POST);
                
                if($retorno){
                    
                    $this->site->location('noticias/novo/true');
                }
            }
            
        }
        
         function editar(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $this->lang->load('form_validation','portugues');
            
            $id = $this->uri->segment(3);
            if($this->form_validation->run('valida_noticia') == FALSE){
                
                $dados['error'] = "";
                
                //Chama o editor de texto ckeditor
                $array = $this->site->editorTexto('texto', 'texto','200px');
                $dados['texto'] = $array['texto'];
                
                $array = $this->site->editorTexto('pre_texto', 'pre_texto','200px');
                $dados['pre_texto'] = $array['pre_texto'];
                
                $dados['noticia'] = $this->noticias_model->getNoticias($id);
                
                $this->montaPagina('sistema_site/noticias/noticias_editar',$dados);
            
            }
            
            else{
                
                $id = $_POST['id'];
                
                unset($_POST['id']);
                
                $this->noticias_model->editarNoticia($id,$_POST);
                
                $this->site->location("noticias/editar/$id/true");
            }
            
        }
        
        //Método que ativa notícia
        function ativar(){
            
             if(isset($_GET['id'])){
                
                $array = array("status" => '1',"data_modificacao" => $this->getData());

                $this->noticias_model->ativarDesativarNoticia($_GET['id'],$array);
                
                //A função header() substituida por causa do servidor da UAI
                //header("Location: ../noticias");

                //Redirecionamento da página com javascript que substitui o header(Location: );
                echo '<script language= "javascript">
                        location.href="'.  base_url() .'noticias"
                      </script>';
            }
            
            else{              
                //A função header() substituida por causa do servidor da UAI
                //header("Location: ../noticias");

                //Redirecionamento da página com javascript que substitui o header(Location: );
                echo '<script language= "javascript">
                        location.href="'.  base_url() .'noticias"
                      </script>';
            }
            
        }
        
        //Método que desativa notícia
        function desativar(){
            
             if(isset($_GET['id'])){
                
                $array = array("status" => '0',"data_modificacao" => $this->getData());

                $this->noticias_model->ativarDesativarNoticia($_GET['id'],$array);
                
                //A função header() substituida por causa do servidor da UAI
                //header("Location: ../noticias");

                //Redirecionamento da página com javascript que substitui o header(Location: );
                echo '<script language= "javascript">
                        location.href="'.  base_url() .'noticias"
                      </script>';
            }
            
            else{              
                //A função header() substituida por causa do servidor da UAI
                //header("Location: ../noticias");

                //Redirecionamento da página com javascript que substitui o header(Location: );
                echo '<script language= "javascript">
                        location.href="'.  base_url() .'noticias"
                      </script>';
            }
            
        }
        
        //Método de criação de sequência aleatória
        private function hash($length = 4){
            
            $salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $len = strlen($salt);
            $pass = '';
            mt_srand(10000000*(double)microtime());
            
            for ($i = 0; $i < $length; $i++)
            {
              $pass .= $salt[mt_rand(0,$len - 1)];
            }
            
            return $pass;
            
        }
        
        //Método que retorna data e hora atual do servidor
        private function getData(){
            
            date_default_timezone_set('America/Sao_Paulo');
            return date('Y-m-d H:i:s');
        }
        
        //Método de edição de notícia
        function editar2(){
            //Pega segmento da URL correspondente ao ID da notícia
            $id = $this->uri->segment(3);
            
            //Verifica se o ID da notícia está preenchido
            if($id == ""){
                
                //header("Location: ../noticias");
                
                echo '<script language= "javascript">
                        location.href="'.  base_url() .'noticias"
                      </script>';
            }
            //Caso o ID da notícia esteja preenchido
            else{
                               
                    $this->lang->load('form_validation','portugues');
            
                    //Valida campos passados pelo formulário
                    if($this->form_validation->run('validacao_noticia') == FALSE){

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
                        
                        $dados['noticia'] = $this->noticias_model->getNoticias($id);
                        
                        //Carrega página de edição da notícia
                        $this->montaPagina('noticias/noticias_editar',$dados);

                        }

                        else{
                             /*    INICIO CARREGAR IMAGEM  */
                
                            //Configuração do carregamento de imagem
                
                                $config['upload_path'] = './uploads/destaques_noticias'; //Pasta
                                $config['allowed_types'] = 'gif|jpg|png'; //Tipos do arquivo/imagem
                                $config['max_size']	= '100000'; //Tamanho máximo pergmito

                                $input = "imagem_destaque"; //Nome do input da imagem

                                $this->load->library('upload', $config); //Carrega biblioteca upload

                                //Verifica se a imagem foi carregada corretamente
                                if (!$this->upload->do_upload($input)){

                                    $error = array('error' => $this->upload->display_errors());
                                    //print_r($error);
                                }


                                else{

                                    $data = array('0' => $this->upload->data());

                                    //print_r($data);
                                    //Cria novo nome para a imagem
                                    $nome = $this->hash(10);

                                    $nomeorig = $config["upload_path"] . "/" . $this->upload->file_name;   

                                    $nomedestino = $config["upload_path"] . "/$nome" .  $this->upload->file_ext;             
                                    //Renomeia nome da imagem
                                    rename($nomeorig, $nomedestino);

                                    //Setando novo nome da imagem que será gravada no banco de dados
                                    $_POST['imagem_destaque'] = $data['0']['file_name'] = $nome."".$data['0']['file_ext'];

                                    //$this->load->view('upload', $data);
                                }

                                /** ---- FIM CARREGAR IMAGEM */

                                $_POST['data_modificacao'] = $this->getData();
                                
                                //ID da notícia passado pelo POST
                                $id = $_POST['id'];
                                //Deleto o ID passado pelo hidden para que não dê problema na hora de atualizar
                                unset($_POST['id']);
                                //print_r($_POST);

                                $this->noticias_model->editarNoticia($id,$_POST);

                                //A função header() substituida por causa do servidor da UAI
                                //header("Location: ../noticias");

                                //Redirecionamento da página com javascript que substitui o header(Location: );
                                $this->site->location("noticias/editar/$id/true");
                            }
                        }
        }
}
