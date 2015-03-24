<?php

class Solicitacoes_tonners_model extends CI_Model{
    
    function __construct() {
        
        parent::__construct();
        $this->load->database('default',TRUE);
    }
    
    public function getSolicitacoesTonners($id = null, $status = null,$ordem = null,$limite = null, $offset = null){
        
        $this->db->select('tbl_solicitacoes_tonners.id,tbl_solicitacoes_tonners.quantidade,tbl_solicitacoes_tonners.email,tbl_solicitacoes_tonners_status.nome as status,tbl_tonners.nome as tonner,
tbl_departamentos.nome as departamento,tbl_solicitacoes_tonners.responsavel_entrega,tbl_solicitacoes_tonners.responsavel_devolucao,tbl_solicitacoes_tonners_status.css');
        $this->db->select("DATE_FORMAT(tbl_solicitacoes_tonners.data_cadastro,('%d/%m/%Y')) as data_cadastro");
        $this->db->select("DATE_FORMAT(tbl_solicitacoes_tonners.data_devolucao,('%d/%m/%Y')) as data_devolucao");
        $this->db->from('tbl_solicitacoes_tonners');
        $this->db->join('tbl_departamentos','tbl_departamentos.id = tbl_solicitacoes_tonners.id_departamento');
        $this->db->join('tbl_tonners','tbl_tonners.id = tbl_solicitacoes_tonners.id_tonner');
        $this->db->join('tbl_solicitacoes_tonners_status','tbl_solicitacoes_tonners_status.id = tbl_solicitacoes_tonners.status');
        
        if($id != null){
            
            $this->db->where('tbl_solicitacoes_tonners.id',$id);
        }
        
        if($status != null){
            
            $this->db->where('tbl_solicitacoes_tonners.status',$status);
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
        
        $sql = "SELECT 
	
	s.id,
	s.id_departamento,
	s.id_tonner as tonner,
	DATE_FORMAT(s.data_cadastro,('%d/%m/%Y')) as data_cadastro,
	s.data_devolucao,
	s.email,
	s.quantidade,
	s.responsavel_devolucao,
	s.responsavel_entrega,
	s.status,
	d.nome as departamento,
	st.nome as status,
        st.css,
	t.nome as tonner
	
        FROM tbl_solicitacoes_tonners s
        JOIN tbl_departamentos d ON
        d.id = s.id_departamento
        JOIN tbl_tonners t ON
        t.id = s.id_tonner 
        JOIN tbl_solicitacoes_tonners_status st ON
        st.id = s.status
        WHERE (d.nome LIKE '%$nome%') 

        OR (s.responsavel_entrega LIKE '%$nome%')
        OR (s.responsavel_devolucao LIKE '%$nome%')
        OR (st.nome LIKE '%$nome%')
        OR (t.nome LIKE '%$nome%')";
        
        
        $retorno = $this->db->query($sql);
        
        return $retorno->result();
    }
    
    public function setSolicitacao($array = array()){
        
        $retorno = $this->db->insert('tbl_solicitacoes_tonners',$array);
        
        return $retorno;
    }
    
    
    public function editarSolicitacaoTonner($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_solicitacoes_tonners',$array);
    }
    
    public function excluirSolicitacaoTonner($id = null){
        
        $this->db->where('id',$id);
        return $this->db->delete('tbl_solicitacoes_tonners');
    }
    
    public function getStatus($id = null, $status = null,$ordem = null,$limite = null, $offset = null){
        
        $this->db->select('*');
        $this->db->from('tbl_solicitacoes_tonners_status');
        
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
    
    public function setStatus($array = array()){
        
        $retorno = $this->db->insert('tbl_solicitacoes_tonners_status',$array);
        
        return $retorno;
    }
    
    
    public function editarStatus($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_solicitacoes_tonners_status',$array);
    }
    
    public function excluirStatus($id = null){
        
        $this->db->where('id',$id);
        return $this->db->delete('tbl_solicitacoes_tonners_status');
    }
}


