<?php

class Home_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    public function alterarSenha($id,$array = array()){
        
         $default = $this->load->database('default', TRUE);
         
         $default->where('id', $id);
         $default->update('tbl_usuarios', $array);
    }
     
}

?>