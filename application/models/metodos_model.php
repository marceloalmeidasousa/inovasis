<?php

class Metodos_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function getMetodos($id = null, $status = null,$ordem = null,$limite = null, $offset = null){
        
        $this->db->select('*');
        $this->db->from('tbl_metodos');
        
        if ($id != null) {
            $this->db->where('id', $id);
        }

        if ($status != null) {
            $this->db->where('status', $status);
        }

        if ($ordem != null) {
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
        $this->db->from('tbl_metodos');
        
        if($nome != null){
            
            $this->db->where('nome LIKE','%'.$nome.'%');
            $this->db->or_where('descricao LIKE','%'.$nome.'%');
            $this->db->or_where('apelido LIKE','%'.$nome.'%');
            $this->db->or_where('classe LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
   
    public function editarMetodo($id,$array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_metodos',$array);
    }
    
    public function excluirMetodo($id = null){
        
        $this->db->where('id',$id);
        $retorno = $this->db->delete('tbl_metodos');

         return $retorno;
    }
    
    public function excluirPermissoes($id = null){
        
        $this->db->where('id_metodo',$id);
        $retorno = $this->db->delete('tbl_permissoes');

         return $retorno;
    }
}

