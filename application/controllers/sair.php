<?php require_once 'valida.php' ;if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sair extends CI_Controller {
    
        function __construct() {
            // Call the Controller constructor
            parent::__construct();
        }
        
        public function index(){
            
            //session_start();
            
            unset($_SESSION['logado']);
            
            session_destroy();
            
            echo '<script language= "javascript">
                                location.href="'. base_url() .'"
                              </script>';
        }
        

}
