<?php

class Disciplinas_model extends CI_Model{
    
    function __construct() {
        
        parent::__construct();
        $this->load->database('default',TRUE);
    }
    
    public function getDisciplinas($id = null, $status = null,$ordem = null,$limite = null, $offset = null){
        
        $this->db->select('*');
        $this->db->from('tbl_disciplinas');
        
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
        $this->db->from('tbl_disciplinas');
        
        if($nome != null){
            
            $this->db->where('nome LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setDisciplina($array = array()){
        
        $retorno = $this->db->insert('tbl_disciplinas',$array);
        
        return $retorno;
    }
    
    public function getTiposCursos($id = null, $status = null){
        
        $this->db->select('*');
        $this->db->from('tbl_cursos_tipos');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setTipoCurso($array = array()){
        
        $retorno = $this->db->insert('tbl_cursos_tipos',$array);
        
        return $retorno;
    }
    
    public function excluirTipo($id = null){
        
        $this->db->where('id',$id);
        $retorno = $this->db->delete('tbl_cursos_tipos');

         return $retorno;
    }
    
    public function ativaDesativaTipoCurso($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_cursos_tipos',$array);
    }
    
    public function ativaDesativaCurso($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_cursos',$array);
    }
    
    public function editarDisciplina($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_disciplinas',$array);
    }
}

?>
