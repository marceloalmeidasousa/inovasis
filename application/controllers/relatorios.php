<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorios extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            $this->load->model('cursos_model');
            $this->load->model('menus_model');
            $this->load->model('vinculos_model');
            $this->load->model('disciplinas_model');
            $this->load->model('bolsas_model');
            $this->load->model('pagamento_model');
            $this->load->helper('ckeditor');
        }
        
        function relatorio_bolsas_por_lote(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            $dados['lotes'] = $this->pagamento_model->getLotes();
            $this->montaPagina('relatorios/relatorio_bolsas_por_lote',$dados);
        }
        
        function relatorio_bolsas_por_lote_resultado(){
            
            $id_lote = $this->uri->segment(3);
            
            $r = $this->bolsas_model->getBolsasCompleto($id_lote);
            
            $lote = $this->pagamento_model->getLotes($id_lote);
            
            $bolsas = $r->result();
            ?>

            <div class="span8">
            <table class="table table-bordered">
                <tr>
                    <th>Lote</th><td><?=$lote['0']->nome?></td><th>Data de Abertura</th><td><?=$this->site->converterDataPhp($lote['0']->data_abertura)?></td>
                </tr>
                <tr>
                    <th>Nº de Bolsas</th><td> <?=$r->num_rows();?></td><th>Data de Fechamento</th><td><?=$this->site->converterDataPhp($lote['0']->data_fechamento)?></td>
                </tr>
            </table>
            </div>

<table class="table table-bordered">
    <tr>
        <th>Nome</th><th>Polo</th><th>Curso</th><th>Nº Bolsa</th>
    </tr>
    
    <?php foreach($bolsas as$val){?>
    
    <tr>
        <td><?=$val->usuario?></td><td><?=$val->polo?></td><td><?=$val->curso?></td><td><?=$val->numero?> ª</td>
    </tr>
    
    <?php } ?>
</table>
            
       <?php } 
        
        function vinculos(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            $id_usuario =  $this->session->userdata('id_usuario');
            $dados['vinculos'] = $this->vinculos_model->getVinculos(null,null,$id_usuario,TRUE,"status DESC");
            $this->montaPagina('meus_dados/meus_vinculos',$dados);
        }
        
        function bolsas(){
            
            $this->auth->check_logged($this->router->class , $this->router->method);
            $id_usuario =  $this->session->userdata('id_usuario');
            $dados['vinculo'] = $this->vinculos_model->getVinculos(null,1,$id_usuario);
            
            $dados['disciplina'] = $this->disciplinas_model->getDisciplinas($dados['vinculo']['0']->disciplina);
            
            $carga_horaria = $dados['disciplina']['0']->carga_horaria;
            
            $num = $carga_horaria / 15;
            
            if($num > 2.5 && $num < 4){
                
                $dados['num_bolsas'] = 3;
            }
            
            else{
                
                $dados['num_bolsas'] = $num;
            }
            
            $dados['num_bolsas'];
            $dados['status'] = $this->bolsas_model->getStatus(null,1);
            
            $this->montaPagina('meus_dados/minhas_bolsas',$dados);
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
