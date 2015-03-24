<?php

class Tonners_model extends CI_Model{
    
    function __construct() {
        
        parent::__construct();
        $this->load->database('default',TRUE);
    }
    
    public function getTonners($id = null, $status = null,$ordem = null,$limite = null, $offset = null){
        
        $this->db->select('*');
        $this->db->from('tbl_tonners');
        
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
        $this->db->from('tbl_tonners');
        
        if($nome != null){
            
            $this->db->where('nome LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setTonner($array = array()){
        
        $retorno = $this->db->insert('tbl_tonners',$array);
        
        return $retorno;
    }
    
    
    public function editarTonner($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_tonners',$array);
    }
    
    public function excluirTonner($id = null){
        
        $this->db->where('id',$id);
        return $this->db->delete('tbl_tonners');
    }
    
    public function getSaldoTonner($id = null){
        
        $this->db->select('tbl_tonners_saldo.id,id_tonner_fornecedor,id_ordem_compra,credito,saldo,nome as ordem_compra');
        $this->db->from('tbl_tonners_saldo');
        $this->db->join('tbl_ordem_compra','tbl_ordem_compra.id = tbl_tonners_saldo.id_ordem_compra');
        $this->db->where('id_tonner_fornecedor',$id);
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
}


