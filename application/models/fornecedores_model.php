<?php

class Fornecedores_model extends CI_Model{
    
    function __construct() {
        
        parent::__construct();
        $this->load->database('default',TRUE);
    }
    
    public function getFornecedores($id = null, $status = null,$ordem = null,$limite = null, $offset = null){
        
        $this->db->select('*');
        $this->db->from('tbl_fornecedores');
        
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
        $this->db->from('tbl_fornecedores');
        
        if($nome != null){
            
            $this->db->where('nome LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setFornecedor($array = array()){
        
        $retorno = $this->db->insert('tbl_fornecedores',$array);
        
        return $retorno;
    }
    
    public function setSaldo($array = array()){
        
        $retorno = $this->db->insert('tbl_tonners_saldo',$array);
        
        return $retorno;
    }
    
    
    public function editarFornecedor($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_fornecedores',$array);
    }
    
    public function excluirFornecedor($id = null){
        
        $this->db->where('id',$id);
        return $this->db->delete('tbl_fornecedores');
    }
    
     public function getTonnersFornecedor($fornecedor = null,$id = null,$result = TRUE){
        
        $this->db->select('tbl_tonners_fornecedores.id,id_fornecedor,id_tonner, tbl_tonners.nome as tonner, tbl_fornecedores.nome as fornecedor');
        $this->db->from('tbl_tonners_fornecedores');
        $this->db->join('tbl_tonners', 'tbl_tonners.id = tbl_tonners_fornecedores.id_tonner');
        $this->db->join('tbl_fornecedores', 'tbl_fornecedores.id = tbl_tonners_fornecedores.id_fornecedor');
        
        if($id != null){
            $this->db->where('tbl_tonners_fornecedores.id',$id);
        }
        
        if($fornecedor != null){
            $this->db->where('tbl_tonners_fornecedores.id_fornecedor',$fornecedor);
        }
        
        $retorno = $this->db->get();
        
        if($result){
            
            return $retorno->result();
        }
        
        else{
            return $retorno;
        }
    }
    
    public function setTonnerFornecedor($array = array()){
        
        $retorno = $this->db->insert('tbl_tonners_fornecedores',$array);
        
        return $retorno;
    }
    
     public function excluirTonnerFornecedor($id = null){
        
        $this->db->where('id',$id);
        return $this->db->delete('tbl_tonners_fornecedores');
    }
}


