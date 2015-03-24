<?php

class Perfis_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
        
    public function getPerfis($id = null, $status = null,$limite = null,$offset = null){
        
        $this->db->select('*');
        $this->db->from('tbl_perfis');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
        if($limite != null){
            
            $this->db->limit($limite,$offset);
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }

    public function setPerfil($array){
        
        $retorno = $this->db->insert('tbl_perfis',$array);
        
        return $retorno;
    }

    public function editarPerfil($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_perfis',$array);
        
    }
    
    public function ativarDesativarUsuario($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_usuarios',$array);
        
    }
    
    public function getClasses(){
        
        $sql = "SELECT DISTINCT(upper(classe)) as classe, upper(nome) as nome FROM tbl_metodos ORDER BY classe ASC";
        
        $retorno = $this->db->query($sql);
        
        return $retorno->result();
    }
    
    public function getMetodos($classe = null){
        
        $this->db->select('*');
        $this->db->from('tbl_metodos');
        $this->db->where('classe',$classe);
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setPermissao($array){
        
        $this->db->insert('tbl_permissoes',$array);
    }
    
    public function getExistePermissao($metodo,$perfil){
        
        $this->db->select('*');
        $this->db->from('tbl_permissoes');
        $this->db->where('id_metodo',$metodo);
        $this->db->where('id_perfil',$perfil);
        
        $retorno = $this->db->get();
        
        return $retorno->num_rows();
        
    }
    
    public function removerPermissoes($id_perfil){
        
        $this->db->where('id_perfil',$id_perfil);
        $this->db->delete('tbl_permissoes');
    }
    
    public function excluirPerfil($id = null){
        
        $this->db->where('id',$id);
        $retorno = $this->db->delete('tbl_perfis');

         return $retorno;
    }
    
    public function buscar($nome = null){
        
        $this->db->select('*');
        $this->db->from('tbl_perfis');
        
        if($nome != null){
            
            $this->db->where('nome LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
}

?>
