<?php

class Downloads_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function getDownloads($id = null, $status = null){
        
        $this->db->select('*');
        $this->db->from('tbl_downloads');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function getCategorias($id = null, $status = null){
        
        $this->db->select('*');
        $this->db->from('tbl_downloads_categorias');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
        $this->db->order_by('nome','ASC');
        $retorno = $this->db->get();
        
        return $retorno->result();
    }

    public function setDownload($array){
        
        $retorno = $this->db->insert('tbl_downloads',$array);
        
        return $retorno;
    }
    
    public function editarDownload($id, $array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_downloads',$array);
        
    }
    
    public function setCategoria($array){
        
        $retorno = $this->db->insert('tbl_downloads_categorias',$array);
        
        return $retorno;
    }
    
    public function editarCategoria($id,$array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_downloads_categorias',$array);
        
    }
}

?>
