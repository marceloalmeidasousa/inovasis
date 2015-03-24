<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
    
        function __construct() {
            // Call the Controller constructor
            parent::__construct();

            $this->load->model('home_model');
            $this->load->model('login_model');
            $this->load->model('menus_model');
            //$this->load->helper('logs');
            //$this->load->helper('cookie');
        }
        
        public function index(){

            $permissao = $this->auth->check_logged($this->router->class , $this->router->method);
            
            if($permissao){
                //redirect(base_url().'login', 'refresh');
                $this->montaPagina('home');
            }
            
            else{
                
                $this->montaPagina("acesso_negado");
            }
        }
        
        function void(){
            $data['js_to_load'] = null;       
            $this->montaPagina("home",$data);
        }   
        
    function acesso_negado(){

        $this->montaPagina("acesso_negado");
    }

    function login(){
        $this->load->view('login');
    }

    function dologin(){
        $usuario = $this->input->post('usuario');
        $senha = $this->input->post('senha');

        if($usuario=="" || $this->input->post('senha') == ""){
            
            redirect(base_url().'login', 'refresh');
            exit();
        }

        if(isset($_POST['lembrar'])){           
            setcookie("usuario", $usuario);
            setcookie("lembrar", "checked");
        }

        
        $result = $this->login_model->getUsuario($usuario,$senha);
        
        if($result == 0){           
            
            $dados['erro'] = 'Usuário incorreto!';
            $this->load->view('login',$dados);
        }
        
        else{
            
            //print_r($result);
            //Senha passada pelo usuário via POST/formulário
            $senhaUsuario = $senha;

            //Senha do usuário armazenada no banco de dados
            $senhaDoBanco = $result['0']->senha; 

            //Faz a criptografia através da função crypt
            $senhaHash = crypt($senhaUsuario, $senhaDoBanco);
            
            if(strcmp($senhaHash, $senhaDoBanco) === 0 ){
				date_default_timezone_set('America/Sao_Paulo');
                $login = array(
                        'id_usuario'    =>   $result[0]->id,
                        'usuario'       =>   $result[0]->usuario,
                        'logged_in'     =>   TRUE,
                        'perfil'        =>   $result['0']->id_perfil,
                        'registro' => time(),
                        'limite'   => 900,
                        'data' => date("d/m/Y h:i:s")
                );
                
                //print_r($login);

                $data['ip'] = getenv("REMOTE_ADDR");
                $data['usuario'] = $result[0]->id;
                $data['acao'] = "login usuario '".$result[0]->usuario."'";
                $data['data'] = $this->site->getData();

                $this->db->insert('tbl_log',$data);  

                $this->session->set_userdata($login);
                //redirect(base_url().'home/void', 'refresh');
                
                $this->site->location("home/void");
            }

            else{
                $dados['erro'] = 'Senha incorreta!';
                $this->load->view('login',$dados);
            }
            
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        $this->site->location("login");
    }
    
    function alterar_senha(){
        
        $id =  $this->session->userdata('id_usuario');
        $senha = array("senha" => crypt($this->input->post('senha')));
        
        //print_r($senha);
        $this->home_model->alterarSenha($id,$senha);
        $this->site->location("home");
    }


}
