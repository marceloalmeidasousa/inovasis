<?php

class Vinculos_model extends CI_Model{
    
    function __construct() {
        
        parent::__construct();
        $this->load->database('default',TRUE);
    }
    
    public function getVinculos($id = null, $status = null, $usuario = null, $result = TRUE,$ordem = null,$curso = null){
        
        $this->db->select('id,curso,polo,usuario,disciplina,tipo,status,
                            (SELECT nome FROM tbl_usuarios WHERE id = tbl_vinculos.usuario) as nome_usuario,
                            (SELECT nome FROM tbl_vinculos_tipos WHERE id = tbl_vinculos.tipo) as vinculo,
                            (SELECT nome FROM tbl_cursos WHERE id = tbl_vinculos.curso) as nome_curso,
                            (SELECT nome FROM tbl_polos WHERE id = tbl_vinculos.polo) as nome_polo,
                            (SELECT nome FROM tbl_disciplinas WHERE id = tbl_vinculos.disciplina) as nome_disciplina');
        $this->db->from('tbl_vinculos');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($usuario != null){
            
            $this->db->where('usuario',$usuario);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }

        if($curso != null){
            
            $this->db->where('curso',$curso);
            
        }
        
        if($ordem != null){
            
            $this->db->order_by($ordem);
        }
        
        $retorno = $this->db->get();
        
        if($result){
            return $retorno->result();
        }
        
        else{
            return $retorno;
        }
        
    }
    
    public function setVinculo($array = array()){
        
        $retorno = $this->db->insert('tbl_vinculos',$array);
        
        return $retorno;
    }
    
    public function getTiposVinculos($id = null, $status = null,$ordem = null){
        
        $this->db->select('*');
        $this->db->from('tbl_vinculos_tipos');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
        if($ordem != null){
            
            $this->db->order_by('nome',$ordem);
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setTipoVinculo($array = array()){
        
        $retorno = $this->db->insert('tbl_vinculos_tipos',$array);
        
        return $retorno;
    }
    
    public function ativaDesativaTipoCurso($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_vinculos_tipos',$array);
    }
    
    public function ativaDesativaCurso($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_vinculos',$array);
    }
    
    public function editarTipoVinculo($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_vinculos_tipos',$array);
    }
    
    public function editarVinculo($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_vinculos',$array);
    }
}
?>
