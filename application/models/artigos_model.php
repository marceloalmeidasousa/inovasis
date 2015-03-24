<?php

class Artigos_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database('default', TRUE);
    }
    
    //Método que seleciona as notícias do banco de dados de acordo os parâmetros
    public function getArtigos($id = null, $status = null){
        
           $this->db->select('*');
           $this->db->from('tbl_artigos');
           
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
    public function setArtigo($array = array()){
        
        $retorno = $this->db->insert('tbl_artigos', $array);;
        
        return $retorno;
    }
    
    //Método update banco de dados - ativa/desativa notícia
    public function ativarDesativarArtigo($id = null, $array = array()){
                         
         $this->db->where('id', $id);
         $this->db->update('tbl_artigos', $array); 
    }
    
    //Método update de notícia
    public function editarArtigo($id = null, $array = array()){
        
         $this->db->where('id', $id);
         $this->db->update('tbl_artigos', $array); 
    }
}

?>