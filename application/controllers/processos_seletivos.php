<?php require_once 'valida.php'; if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Processos_seletivos extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('processos_seletivos_model');
        }
        
        function index(){
            
            $dados['processos'] = $this->processos_seletivos_model->getProcessosSeletivos();
            $this->montaPagina('processos_seletivos/processos_seletivos_view',$dados);
        }
        
        function novo(){
            $this->lang->load('form_validation','portugues');
             
            if($this->form_validation->run('valida_processo_seletivo') == FALSE){
                $dados['tipos'] = $this->processos_seletivos_model->getTiposProcessosSeletivos(null,1);
                $this->montaPagina("processos_seletivos/processos_seletivos_novo",$dados);
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                
                $retorno = $this->processos_seletivos_model->setProcessoSeletivo($_POST);
                
                if($retorno){
                    
                    $this->site->location("processos_seletivos");
                }
            }
        }
        
        
        function editar(){
            
            $id = $this->uri->segment(3);
            $this->lang->load('form_validation','portugues');
             
            if($this->form_validation->run('valida_processo_seletivo') == FALSE){
                
                $dados['tipos'] = $this->processos_seletivos_model->getTiposProcessosSeletivos(null,1);
                $dados['processo'] = $this->processos_seletivos_model->getProcessosSeletivos($id,null);
                $this->montaPagina("processos_seletivos/processos_seletivos_editar",$dados);
            }
            
            else{
                
                $id = $_POST['id'];
                unset($_POST['id']);
                
                $_POST['data_cadastro'] = $this->site->getData();
                //$_POST['data_modificacao'] = $this->site->getData();
                
                $this->processos_seletivos_model->editarProcessoSeletivo($id,$_POST);

                $this->site->location("processos_seletivos/editar/$id/true");
            }
        }
        
        function tipos(){
            
            $dados['tipos'] = $this->processos_seletivos_model->getTiposProcessosSeletivos();
            $this->montaPagina('processos_seletivos/processos_seletivos_tipos',$dados);
            
        }
        
        function tipos_novo(){
            
            $this->lang->load('form_validation','portugues');
             
             if($this->form_validation->run('valida_tipo_polo') == FALSE){
                $this->montaPagina("processos_seletivos/processos_seletivos_tipos_novo");
             }
             
             else{
                 
                 $_POST['data_cadastro'] = $this->site->getData();
                 $_POST['data_modificacao'] = $this->site->getData();
                 
                 $retorno = $this->processos_seletivos_model->setTipoProcessoSeletivo($_POST);
                 
                 if($retorno){
                     
                     $this->site->location("processos_seletivos/tipos/true");
                 }
             }
        }
        
        function tipos_editar(){
            
            $id = $this->uri->segment(3);
            
            $this->lang->load('form_validation','portugues');
             
             if($this->form_validation->run('valida_tipo_polo') == FALSE){
                
                $dados['tipo'] = $this->processos_seletivos_model->getTiposProcessosSeletivos($id,null);
                $this->montaPagina("processos_seletivos/processos_seletivos_tipos_editar",$dados);
             }
             
             else{
                 
                 $id = $_POST['id'];
                 
                 unset($_POST['id']);
                //$_POST['data_cadastro'] = $this->site->getData();
                $_POST['data_modificacao'] = $this->site->getData();
                 
                $this->processos_seletivos_model->editarTipoProcessoSeletivo($id,$_POST);
                 
                $this->site->location("processos_seletivos/tipos_editar/$id/true");
             }
        }
        
        function tipos_ativar(){
            
            $id = $this->uri->segment(3);
            
            $array = array('status' => '1','data_modificacao' => $this->site->getData());
            
            $this->processos_seletivos_model->editarTipoProcessoSeletivo($id,$array);
            
            $this->site->location("processos_seletivos/tipos");
        }
        
        function tipos_desativar(){
            
            $id = $this->uri->segment(3);
            
            $array = array('status' => '0','data_modificacao' => $this->site->getData());
            
            $this->processos_seletivos_model->editarTipoProcessoSeletivo($id,$array);
            
            $this->site->location("processos_seletivos/tipos");
        }

        function ativar(){
            
            $id = $this->uri->segment(3);
            
            $array = array('status' => '1','data_modificacao' => $this->site->getData());
            
            $this->processos_seletivos_model->editarProcessoSeletivo($id,$array);
            
            $this->site->location("processos_seletivos");
        }
        
        function desativar(){
            
            $id = $this->uri->segment(3);
            
            $array = array('status' => '0','data_modificacao' => $this->site->getData());
            
            $this->processos_seletivos_model->editarProcessoSeletivo($id,$array);
            
            $this->site->location("processos_seletivos");
        }
        
        function arquivos(){
            $dados['processos'] = $this->processos_seletivos_model->getProcessosSeletivos();
            $this->montaPagina("processos_seletivos/processos_seletivos_arquivos",$dados);
        }
        
        function arquivos_config(){
            
            $id = $this->uri->segment(3);
            $dados['processo'] = $this->processos_seletivos_model->getProcessosSeletivos($id);
            $dados['arquivos'] = $this->processos_seletivos_model->getArquivos($id);
            $this->montaPagina("processos_seletivos/processos_seletivos_config",$dados);
        }
        
        function arquivos_novo(){
            $id = $this->uri->segment(3);
            
            $this->lang->load('form_validation','portugues');
             
             if($this->form_validation->run('valida_arquivo') == FALSE){
                $dados['processo'] = $this->processos_seletivos_model->getProcessosSeletivos($id);
                $this->montaPagina("processos_seletivos/processos_seletivos_arquivos_novo",$dados);
             }
             
             else{
                 
                
                $idprocesso = $_POST['idprocesso'];
                
                $config['upload_path'] = './uploads/processos_seletivos'; //Pasta
		$config['allowed_types'] = 'pdf'; //Tipos do arquivo/imagem
		$config['max_size']	= '100000'; //Tamanho máximo pergmito
		
                $input = "arquivo"; //Nome do input da imagem
                
		$this->load->library('upload', $config); //Carrega biblioteca upload
	
                //Verifica se a imagem foi carregada corretamente
		if (!$this->upload->do_upload($input)){

                    $this->site->location("processos_seletivos/arquivos_novo/$idprocesso/erro_arquivo");
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
                    
                    unset($_POST['idprocesso']);
                    $_POST['data_cadastro'] = $this->site->getData();
                    $_POST['data_modificacao'] = $this->site->getData();

                    $this->processos_seletivos_model->setArquivo($_POST);

                    $arquivo = $this->processos_seletivos_model->getIdNomeArquivo($_POST['arquivo']);

                    $idarquivo = $arquivo['0']->id;
                    $array = array('idprocesso' =>$idprocesso,'idarquivo' => $idarquivo,'data_cadastro' => $this->site->getData(),'data_modificacao' => $this->site->getData());

                    $this->processos_seletivos_model->setArquivoProcessoSeletivo($array);

                    $this->site->location("processos_seletivos/arquivos_novo/$idprocesso/true");
                }
                
             }
        }
        
        function arquivo_desativar(){
            
            $id = $this->uri->segment(4);
            $idprocesso = $this->uri->segment(3);
            
            $array = array('status' => '0','data_modificacao' => $this->site->getData());
            
            $this->processos_seletivos_model->editarArquivo($id,$array);
            
            $this->site->location("processos_seletivos/arquivos_config/$idprocesso");
        }
        
        function arquivo_ativar(){
            
            $id = $this->uri->segment(4);
            $idprocesso = $this->uri->segment(3);
            
            $array = array('status' => '1','data_modificacao' => $this->site->getData());
            
            $this->processos_seletivos_model->editarArquivo($id,$array);
            
            $this->site->location("processos_seletivos/arquivos_config/$idprocesso");
        }
        
        function arquivos_editar(){
            
            $idarquivo = $this->uri->segment(4);
            $idprocesso = $this->uri->segment(3);
            
               $this->lang->load('form_validation','portugues');
             
             if($this->form_validation->run('valida_arquivo') == FALSE){
                $dados['processo'] = $this->processos_seletivos_model->getProcessosSeletivos($idprocesso);
                $dados['arquivo'] = $this->processos_seletivos_model->getArquivo($idarquivo);
                $this->montaPagina("processos_seletivos/processos_seletivos_arquivos_editar",$dados);
             }
             
             else{
                 
                
                $idprocesso = $_POST['idprocesso'];
                $idarquivo = $_POST['idarquivo'];
                
                $config['upload_path'] = './uploads/processos_seletivos'; //Pasta
		$config['allowed_types'] = 'pdf'; //Tipos do arquivo/imagem
		$config['max_size']	= '100000'; //Tamanho máximo pergmito
		
                $input = "arquivo"; //Nome do input da imagem
                
		$this->load->library('upload', $config); //Carrega biblioteca upload
	
                //Verifica se a imagem foi carregada corretamente
		if (!$this->upload->do_upload($input)){

                   // $this->site->location("processos_seletivos/arquivos_editar/$idprocesso/$idarquivo/erro_arquivo");
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
                
                    unset($_POST['idprocesso']);
                    unset($_POST['idarquivo']);
                    //$_POST['data_cadastro'] = $this->site->getData();
                    $_POST['data_modificacao'] = $this->site->getData();

                    $this->processos_seletivos_model->editarArquivo($idarquivo,$_POST);


                    $this->site->location("processos_seletivos/arquivos_editar/$idprocesso/$idarquivo/true");
               
                
             }
        
        }
}
