<?php

class Contatos_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function getContatos($id = null, $status = null,$tipo = null){
        
        $this->db->select('id,nome,status,email,telefone,tipo as idtipo,(SELECT nome FROM tbl_contatos_tipos WHERE id = tbl_contatos.tipo) as tipo');
        $this->db->from('tbl_contatos');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
        if($tipo != null){
            
            $this->db->where('tipo',$tipo);
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function getContatosEmails(){
        
        $sql = "SELECT * FROM tbl_contatos WHERE email != \"\" AND status = 1";
        $retorno = $this->db->query($sql);
        
        return $retorno->result();
    }

    public function getConfigContato(){
        
        $this->db->select('*');
        $this->db->from('tbl_contatos_config');
        $retorno = $this->db->get();
        
        return $retorno;
    }
    
    public function setConfigContato($array){
        
        $retorno = $this->db->insert('tbl_contatos_config',$array);
        
        return $retorno;
    }

    public function editarConfigContato($id, $array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_contatos_config',$array);
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
}

?>
