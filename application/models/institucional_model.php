<?php

class Institucional_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database('default',TRUE);
    }
    
     public function editarTexto($id = null, $array = null){
         
        $this->db->where('id',$id);
        $this->db->update('tbl_institucional',$array);
        
     }
     
     public function getTexto($id){
         
         $this->db->select('*');
         $this->db->from('tbl_institucional');
         $this->db->where('id',$id);

         $retorno =  $this->db->get();

         return $retorno->result();
     }
     
}

?>