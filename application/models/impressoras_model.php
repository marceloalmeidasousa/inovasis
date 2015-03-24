<?php

class Impressoras_model extends CI_Model{
    
    function __construct() {
        
        parent::__construct();
        $this->load->database('default',TRUE);
    }
    
    public function getImpressoras($id = null, $status = null,$ordem = null,$limite = null, $offset = null){
        
        $this->db->select('*');
        $this->db->from('tbl_impressoras');
        
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
        $this->db->from('tbl_impressoras');
        
        if($nome != null){
            
            $this->db->where('nome LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setTonner($array = array()){
        
        $retorno = $this->db->insert('tbl_impressoras',$array);
        
        return $retorno;
    }
    
    
    public function editarImpressora($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_impressoras',$array);
    }
    
    public function excluirImpressora($id = null){
        
        $this->db->where('id',$id);
        return $this->db->delete('tbl_impressoras');
    }
    
    public function excluirTonnerImpressora($id = null){
        
        $this->db->where('id',$id);
        return $this->db->delete('tbl_impressoras_tonners');
    }
    
    public function getTonnersImpressora($id = null){
        
        $this->db->select('tbl_impressoras_tonners.id,id_impressora,id_tonner, tbl_tonners.nome as tonner, tbl_impressoras.nome as impressora, modelo');
        $this->db->from('tbl_impressoras_tonners');
        $this->db->join('tbl_tonners', 'tbl_tonners.id = tbl_impressoras_tonners.id_tonner');
        $this->db->join('tbl_impressoras', 'tbl_impressoras.id = tbl_impressoras_tonners.id_impressora');
        $this->db->where('tbl_impressoras_tonners.id_impressora',$id);
        
        $retorno = $this->db->get();
        
        return $retorno;
    }
    
    public function setTonnerImpressora($array = array()){
        
        $retorno = $this->db->insert('tbl_impressoras_tonners',$array);
        
        return $retorno;
    }
    
}


