<?php

class Ordem_compra_model extends CI_Model{
    
    function __construct() {
        
        parent::__construct();
        $this->load->database('default',TRUE);
    }
    
    public function getOrdens($id = null, $status = null,$ordem = null,$limite = null, $offset = null){
        
        $this->db->select('*');
        $this->db->from('tbl_ordem_compra');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
        if($ordem != null){
            
            $this->db->order_by($ordem);
        }
        
        if($limite != null){
            
            $this->db->limit($limite,$offset);
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
        
    }
    
    public function buscar($nome = null){
        
        $this->db->select('*');
        $this->db->from('tbl_ordem_compra');
        
        if($nome != null){
            
            $this->db->where('nome LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setOrdem($array = array()){
        
        $retorno = $this->db->insert('tbl_ordem_compra',$array);
        
        return $retorno;
    }
    
    
    public function editarOrdem($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_ordem_compra',$array);
    }
    
    public function excluirOrdem($id = null){
        
        $this->db->where('id',$id);
        return $this->db->delete('tbl_ordem_compra');
    }
    
}


