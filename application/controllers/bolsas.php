<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bolsas extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('cursos_model');
            $this->load->model('menus_model');
            $this->load->model('vinculos_model');
            $this->load->model('bolsas_model');
            $this->load->model('disciplinas_model');
            $this->load->model('pagamento_model');
            $this->load->helper('ckeditor');
        }
        
        function index(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            $id_usuario =  $this->session->userdata('id_usuario');
            $r = $this->vinculos_model->getVinculos(null,1,$id_usuario,FALSE);
            
            if($r->num_rows() > 0){
                $dados['vinculo'] = $r->result();
                $id_curso = $dados['vinculo']['0']->curso;

                $dados['vinculos'] = $this->vinculos_model->getVinculos(null,1,null,TRUE,'nome_usuario ASC',$id_curso);

                $this->montaPagina('bolsas/bolsas_view',$dados);
            }
            
            else if($r->num_rows == 0){
                
                $this->montaPagina("bolsas/bolsas_erro");
            }
        }
        
        function autorizacao(){
        
            $this->auth->check_logged($this->router->class , $this->router->method);
            
            $id_vinculo = $this->uri->segment(3);
            $id_usuario = $this->uri->segment(4);
            $logado =  $this->session->userdata('id_usuario');
            
            if($id_usuario != $logado){
            if(!$_POST){
            
                
                $dados['vinculo'] = $this->vinculos_model->getVinculos($id_vinculo,1,$id_usuario,TRUE);

                $dados['disciplina'] = $this->disciplinas_model->getDisciplinas($dados['vinculo']['0']->disciplina);

                $carga_horaria = $dados['disciplina']['0']->carga_horaria;

                $num = $carga_horaria / 15;

                if($num > 2.5 && $num < 4){

                    $dados['num_bolsas'] = 3;
                }

                else{

                    $dados['num_bolsas'] = $num;
                }
                
                $data_atual = $this->site->getData(FALSE);
                $dados['lotes'] = $this->pagamento_model->getLotes(null,1,$data_atual,null,FALSE);
                $dados['num_bolsas'];
                $dados['status'] = $this->bolsas_model->getStatus(null,1);
                $this->montaPagina("bolsas/bolsas_autorizacao",$dados);
            
            }
            
            else{
                
                $_POST['vinculo'] = $id_vinculo;
                $lote_atual = $r = $this->pagamento_model->getLotes(null,1,$this->site->getData(FALSE),null,TRUE);
                
                $lote_atual = $lote_atual['0']->id; 
                
                $_POST['lote'] = $lote_atual;
                //print_r($_POST);
                $retorno = $this->bolsas_model->setBolsa($_POST);
                
                if($retorno){
                    
                    $this->site->location("bolsas/autorizacao/$id_vinculo/$id_usuario");
                }
            }
            }
            
            else{
                
                $this->montaPagina("bolsas/bolsas_erro_usuario");
            }
            
        }
        
        function pagamento(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            echo "efetuar pagamento";
        }
        
        function novo(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_curso') == FALSE){
                
                $dados['tipos'] = $this->cursos_model->getTiposCursos(null,1);
                $this->montaPagina('cursos/cursos_novo',$dados);
            
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                
                $retorno = $this->cursos_model->setCurso($_POST);
                
                if($retorno){
                    
                    $this->site->location('cursos/novo/true');
                }
            }
            
        }
         
        function editar(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_curso') == FALSE){
                
                $id = $this->uri->segment(3);
                $dados['tipos'] = $this->cursos_model->getTiposCursos(null,1);
                $dados['curso'] = $this->cursos_model->getCursos($id,null);
                $this->montaPagina("cursos/cursos_editar",$dados);
                
            }
            
            else{
                
                $id = $_POST['id'];
                
                unset($_POST['id']);
                $this->cursos_model->editarCurso($id,$_POST);
                
                $this->site->location("cursos/editar/$id/true");
            }
        }
        
        function tipos(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $dados['tipos'] = $this->cursos_model->getTiposCursos();
            $this->montaPagina('cursos/cursos_tipos',$dados);
        }
        
        function tipos_novo(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_tipo') == FALSE){
                
                $this->montaPagina('cursos/cursos_tipos_novo');
            
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                //$_POST['data_modificacao'] = $this->site->getData();
                
                $retorno = $this->cursos_model->setTipoCurso($_POST);
                
                if($retorno){
                    
                    $this->site->location('cursos/tipos_novo/true');
                }
            }
        }
        
        function desativar(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $id = $this->uri->segment(3);
            $array = array('status' => '0', 'data_modificacao' => $this->site->getData());
            $this->cursos_model->ativaDesativaCurso($id,$array);
            
            $this->site->location('cursos');
        }
        
        function ativar(){
            $this->auth->check_logged($this->router->class , $this->router->method);
            $id = $this->uri->segment(3);
            $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
            $this->cursos_model->ativaDesativaCurso($id,$array);
            
            $this->site->location('cursos');
        }
        
        function desativar_tipo(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '0', 'data_modificacao' => $this->site->getData());
            $this->cursos_model->ativaDesativaTipoCurso($id,$array);
            
            $this->site->location('cursos/tipos');
        }
        
        function ativar_tipo(){
            
            $id = $this->uri->segment(3);
            $array = array('status' => '1', 'data_modificacao' => $this->site->getData());
            $this->cursos_model->ativaDesativaTipoCurso($id,$array);
            
            $this->site->location('cursos/tipos');
        }
        
        function tipos_editar(){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_tipo') == FALSE){
                
                $id = $this->uri->segment(3);
                
                $dados['tipo'] = $this->cursos_model->getTiposCursos($id,null);
                $this->montaPagina('cursos/cursos_tipos_editar',$dados);
            
            }
            
            else{
                
                $id = $_POST['id'];
                
                $_POST['data_modificacao'] = $this->site->getData();
                unset($_POST['id']);
                
                $this->cursos_model->editarTipoCurso($id,$_POST);
                
                $this->site->location("cursos/tipos_editar/$id/true");
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
}
