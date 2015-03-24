<?php

class Departamentos_model extends CI_Model{
    
    function __construct() {
        
        parent::__construct();
        $this->load->database('default',TRUE);
    }
    
    public function getDepartamentos($id = null, $tipo = null, $status = null,$ordem = null,$limite = null, $offset = null){
        
        $this->db->select('*');
        $this->db->from('tbl_departamentos');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($tipo != null){
            
            $this->db->where('tipo',$tipo);
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
        $this->db->from('tbl_departamentos');
        
        if($nome != null){
            
            $this->db->where('nome LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    
    public function buscar_tipo($nome = null){
        
        $this->db->select('*');
        $this->db->from('tbl_departamentos_tipos');
        
        if($nome != null){
            
            $this->db->where('nome LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setDepartamento($array = array()){
        
        $retorno = $this->db->insert('tbl_departamentos',$array);
        
        return $retorno;
    }
    
    
    public function editarDepartamento($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_departamentos',$array);
    }
    
    public function excluirDepartamento($id = null){
        
        $this->db->where('id',$id);
        $retorno = $this->db->delete('tbl_departamentos');

         return $retorno;
    }
    
    public function excluirTipo($id = null){
        
        $this->db->where('id',$id);
        $retorno = $this->db->delete('tbl_departamentos_tipos');

         return $retorno;
    }
    
     public function setTipoDepartamento($array = array()){
        
        $retorno = $this->db->insert('tbl_departamentos_tipos',$array);
        
        return $retorno;
    }
     
    public function getTiposDepartamentos($id = null, $status = null,$ordem = null,$limite = null, $offset = null){
        
        $this->db->select('*');
        $this->db->from('tbl_departamentos_tipos');
        
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
    
    public function editarTipo($id = null ,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_departamentos_tipos',$array);
        
    }
    
     public function getImpressorasDepartamento($id = null){
        
        $this->db->select('tbl_departamentos_impressoras.id,
                            tbl_departamentos_impressoras.id_departamento,
                            tbl_departamentos_impressoras.id_impressora,
                            tbl_departamentos.nome as departamento,
                            tbl_impressoras.nome as impressora,
                            tbl_impressoras.modelo as modelo');
        $this->db->from('tbl_departamentos_impressoras');
        $this->db->join('tbl_departamentos', 'tbl_departamentos.id = tbl_departamentos_impressoras.id_departamento');
        $this->db->join('tbl_impressoras', 'tbl_impressoras.id = tbl_departamentos_impressoras.id_impressora');
        $this->db->where('tbl_departamentos_impressoras.id_departamento',$id);
        
        $retorno = $this->db->get();
        
        return $retorno;
    }
    
    public function setImpressoraDepartamento($array = array()){
        
        $retorno = $this->db->insert('tbl_departamentos_impressoras',$array);
        
        return $retorno;
    }
    
     public function excluirImpressoraDepartamento($id = null){
        
        $this->db->where('id',$id);
        return $this->db->delete('tbl_departamentos_impressoras');
    }
    
}


