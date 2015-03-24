<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends CI_Controller {
    
        function __construct() {

            parent::__construct();
            
            $this->load->model('menus_model');
        }
        
        public function index($offset = 0){

            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
                $limite = 10;
                
                $dados['menus'] = $this->menus_model->getMenus(null,null,null,$limite,$offset);
                
                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."menus/index";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_menus')->num_rows();
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

                $this->montaPagina('sistema_sisadmin/menus/menus_view',$dados);
            }
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        public function novo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_perfil') == FALSE){
                $this->montaPagina('sistema_sisadmin/menus/menus_novo');
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                
                $retorno = $this->menus_model->setMenu($_POST);
                
                if($retorno){
                    
                    $this->site->location("menus/novo/true");
                }
            }
            }else{
                
                $this->montaPagina("acesso_negado");
            }
            
        }
        
        public function editar(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $id = $this->uri->segment(3);
                    
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_perfil') == FALSE){
                
                $dados['menu'] = $this->menus_model->getMenus($id);
                $this->montaPagina('sistema_sisadmin/menus/menus_editar',$dados);
            }
            
            else{
                
               $this->menus_model->editarMenu($id,$_POST);
                
               $this->site->location("menus/editar/$id/true");
               
            }
            }else{
                
                $this->montaPagina("acesso_negado");
            }
            
        }
        
        public function ativar(){

            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){

            $id = $this->uri->segment(3);
            
            $array = array('status' => 1);
            
            $this->menus_model->editarMenu($id,$array);
            
            $this->site->location("menus");
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        public function desativar(){

            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){

            $id = $this->uri->segment(3);
            
            $array = array('status' => 0);
            
            $this->menus_model->editarMenu($id,$array);
            
            $this->site->location("menus");
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        public function itens($offset = 0){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
                $limite = 10;
                $dados['itens'] = $this->menus_model->getItens(null,null,null,$limite, $offset);
                
                /*Paginação*/
                $this->load->library('pagination');

                $config['base_url'] = base_url()."menus/itens";
                $config['per_page'] = $limite;
                $config['total_rows'] = $this->db->get('tbl_menus_itens')->num_rows();
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
                
                $this->montaPagina('sistema_sisadmin/menus/menus_itens',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        public function itens_novo(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_item_menu') == FALSE){
                
                $dados['metodos'] = $this->menus_model->getMetodos(null,null,"apelido ASC");
                $dados['menus'] = $this->menus_model->getMenus(null,1);
                
                $this->montaPagina('sistema_sisadmin/menus/menus_itens_novo',$dados);
            }
            
            else{
                
                $_POST['data_cadastro'] = $this->site->getData();
                
                $retorno = $this->menus_model->setItemMenu($_POST);
                
                if($retorno){
                    
                    $this->site->location("menus/itens_novo/true");
                }
            }
            }else{
                
                $this->montaPagina("acesso_negado");
            }
            
        }
        
        public function editar_item(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
            
            $id = $this->uri->segment(3);
            
            $this->lang->load('form_validation','portugues');
            
            if($this->form_validation->run('valida_item_menu') == FALSE){
                
                $dados['metodos'] = $this->menus_model->getMetodos();
                $dados['menus'] = $this->menus_model->getMenus(null,1);
                $dados['item'] = $this->menus_model->getItens($id);
                
                $this->montaPagina('sistema_sisadmin/menus/menus_itens_editar',$dados);
            }
            
            else{
                
                $this->menus_model->editarItemMenu($id,$_POST);
                    
                $this->site->location("menus/editar_item/$id/true");
                
            }
            }else{
                
                $this->montaPagina("acesso_negado");
            }
            
        }
        
        public function desativar_item(){

            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){

            $id = $this->uri->segment(3);
            
            $array = array('status' => 0);
            
            $this->menus_model->editarItemMenu($id,$array);
            
            $this->site->location("menus/itens");
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        public function ativar_item(){

            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){

            $id = $this->uri->segment(3);
            
            $array = array('status' => 1);
            
            $this->menus_model->editarItemMenu($id,$array);
            
            $this->site->location("menus/itens");
            }else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function excluir(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                $id = $this->uri->segment(3);

                $this->db->where('id_menu',$id);
                $num = $this->db->get('tbl_menus_itens')->num_rows();
                
                if($num == 0){
                    
                    $retorno = $this->menus_model->excluirMenu($id);

                    if($retorno){

                        $this->site->location('menus/index/true');
                    }
                }
                
                else{
                   
                    $this->site->location('menus/index/false');
                }
                
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function excluir_item(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);

            if($permissao){
                
                $id = $this->uri->segment(3);
                 
                $retorno = $this->menus_model->excluirItemMenu($id);

                if($retorno){

                    $this->site->location('menus/itens/true');
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

                $dados['menus'] = $this->menus_model->buscar($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_sisadmin/menus/menus_view',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function buscar_item(){
            
            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                
                $busca = $_POST['busca'];

                $dados['itens'] = $this->menus_model->buscar_item($busca);
                $dados['busca'] = $busca;

                $this->montaPagina('sistema_sisadmin/menus/menus_itens',$dados);
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
}
