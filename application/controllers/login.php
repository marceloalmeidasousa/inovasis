<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    
        function __construct() {
            // Call the Controller constructor
            parent::__construct();

            $this->load->model('login_model');
        }
        
        public function index(){

            if(isset($_POST['usuario'])){
                
                $this->form_validation->set_rules('usuario','usuario','required');
                $this->form_validation->set_rules('senha','senha','required');
               
                if(($this->form_validation->run() == FALSE)){
                    
                    $dados['erro'] = 'Usuário/Senha inválidos';
                    $this->load->view('login',$dados);                     
                 
                }
                
                else{
                    
                    $usuario = $_POST['usuario'];
                    $senha = crypt($_POST['senha']);
                    
                    $dados['usuario'] = $this->login_model->getUsuario($usuario,$senha);
                    
                    if($dados['usuario'] == 0){
                        
                        $dados['erro'] = 'Usuário/Senha inválidos';
                        $this->load->view('login',$dados); 
                    }
                    
                    else if($dados['usuario'] != 0){
                        
                        date_default_timezone_set("Brazil/East");
                        $tempolimite = 900;
                        $_SESSION['registro'] = time();
                        $_SESSION['limite'] = $tempolimite;
                        //$this->ci->session->userdata('logged_in') = true;
                        //$this->ci->session->userdata('nome') = $dados['usuario']['0']->nome;
                        $_SESSION['id'] = $dados['usuario']['0']->id;
                          
                        echo '<script language= "javascript">
                                location.href="'.  base_url() .'"
                              </script>';
                        
                    }
                }
            }
            
            else{
                $this->load->view('login');
            }
        }
                
        
}
