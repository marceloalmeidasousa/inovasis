<?php

class Destaques_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database('default',TRUE);
    }
    
    public function getDestaques($id = null,$status = null){
        
        $this->db->select('*');
        $this->db->from('tbl_destaques');
        
        if($id != null){
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setDestaque($array = array()){
        
        $retorno = $this->db->insert('tbl_destaques',$array);
        
        return $retorno;
    }
    
    public function editarDestaque($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_destaques',$array);
        
    }
     
    public function ativarDesativarDestaque($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_destaques',$array);
    }
}

?>