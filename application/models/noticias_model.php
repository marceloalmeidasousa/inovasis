<?php

class Noticias_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database('default', TRUE);
    }
    
    //Método que seleciona as notícias do banco de dados de acordo os parâmetros
    public function getNoticias($id = null, $status = null){
        
           $this->db->select('*');
           $this->db->from('tbl_noticias');
           
           if($id != null){
            $this->db->where('id',$id);
           }
           
           if($status != null){
             $this->db->where('status',$status);
           }
           
           $this->db->order_by('id','DESC');
           
           $retorno = $this->db->get();
           
           return $retorno->result();
    }
     
    //Método de cadastro da notícia no banco de dados
    public function setNoticia($array = array()){
        
        $retorno = $this->db->insert('tbl_noticias', $array);;
        
        return $retorno;
    }
    
    //Método update banco de dados - ativa/desativa notícia
    public function ativarDesativarNoticia($id = null, $array = array()){
                         
         $this->db->where('id', $id);
         $this->db->update('tbl_noticias', $array); 
    }
    
    //Método update de notícia
    public function editarNoticia($id = null, $array = array()){
        
         $this->db->where('id', $id);
         $this->db->update('tbl_noticias', $array); 
    }
}

?>