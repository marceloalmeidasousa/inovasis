<?php

class Ouvidoria_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function getAssuntos($id = null, $status = null){
        
        $this->db->select('*');
        $this->db->from('tbl_ouvidoria_assuntos');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    
    public function setAssunto($array){
        
        $retorno = $this->db->insert('tbl_ouvidoria_assuntos',$array);
        
        return $retorno;
    }

    public function editarAssunto($id, $array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_ouvidoria_assuntos',$array);
    }
    
    public function getContatosTipos($id = null, $status = null){
        
        $this->db->select('*');
        $this->db->from('tbl_contatos_tipos');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setTipoContato($array){
        
        $retorno = $this->db->insert('tbl_contatos_tipos',$array);
        
        return $retorno;
    }
    
    public function editarContato($id, $array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_contatos',$array);
        
    }
    
    public function editarTipo($id, $array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_contatos_tipos',$array);
        
    }
    
    public function setContato($array){
        
        $retorno = $this->db->insert('tbl_contatos',$array);
        
        return $retorno;
    }
    
    public function getPadrao($padrao){
        
        $this->db->select('*');
        $this->db->from('tbl_contatos_tipos');
        $this->db->where('padrao',$padrao);
        
        $retorno = $this->db->get();
        
        return $retorno;
    }
    
    public function getConfigOuvidoria(){
        
        $this->db->select('*');
        $this->db->from('tbl_ouvidoria_config');
        $retorno = $this->db->get();
        
        return $retorno;
        
    }
    
    public function setConfigOuvidoria($array){
        
        $retorno = $this->db->insert('tbl_ouvidoria_config',$array);
        
        return $retorno;
        
    }
    
    public function editarConfigOuvidoria($id,$array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_ouvidoria_config',$array);
        
    }
}

?>
