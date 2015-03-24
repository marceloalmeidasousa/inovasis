<?php

class Login_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
     public function getUsuario($usuario = null){
         
         $default = $this->load->database('default', TRUE);
         
         $default->select('*');
         $default->from('tbl_usuarios');
         $default->where('usuario',$usuario);
         
         $retorno = $default->get();
         
         if($retorno->num_rows() == 0){
             
             return 0;
         }
         
         else if($retorno->num_rows() == 1){
        
            return $retorno->result();
            
         }   
      }
     
}

?>