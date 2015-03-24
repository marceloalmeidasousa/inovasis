<?php

class Bolsas_model extends CI_Model{
    
    function __construct() {
        
        parent::__construct();
        $this->load->database('default',TRUE);
    }
    
    public function getBolsas($id = null, $id_curso = null, $status = null,$ordem = null,$lote = null, $result = TRUE){
        
        $this->db->select('*');
        $this->db->from('tbl_bolsas b');
        $this->db->join('tbl_vinculos v', 'v.id = b.vinculo');
        $this->db->join('tbl_cursos c','c.id = v.curso');
        
        if($id != null){
            
            $this->db->where('b.id',$id);
        }
        
        if($id_curso != null){
            
            $this->db->where('v.curso',$id_curso);
        }
        
        if($status != null){
            
            $this->db->where('b.status',$status);
        }
        
        if($lote != null){
            $this->db->where('b.lote',$lote);
        }
        
        if($ordem != null){
            
            $this->db->order_by($ordem);
        }
        
        $retorno = $this->db->get();
        
        if($result){
            return $retorno->result();
        }
        
        else
            return $retorno;
    }
    
    public function getBolsasCompleto($lote){
    
          $sql = "SELECT tbl_usuarios.nome as usuario, tbl_cursos.nome as curso, tbl_polos.nome as polo,numero FROM tbl_bolsas 
JOIN tbl_vinculos ON 
tbl_vinculos.id = tbl_bolsas.vinculo 
JOIN tbl_usuarios ON 
tbl_usuarios.id = tbl_vinculos.usuario 
JOIN tbl_cursos ON 
tbl_cursos.id = tbl_vinculos.curso 
JOIN tbl_polos ON 
tbl_polos.id = tbl_vinculos.polo 
WHERE tbl_bolsas.status = 1 AND lote = $lote ORDER BY usuario ASC";
          
          $retorno = $this->db->query($sql);
          return $retorno;
          
    }
    
    public function getBolsasPorStatus($numero,$vinculo){
        
        $this->db->select('*');
        $this->db->from('tbl_bolsas');
        $this->db->where('numero',$numero);
        $this->db->where('vinculo',$vinculo);
        
        $retorno = $this->db->get();
        
        return $retorno;
    }

    public function getStatus($id = null,$status = null){
        
        $this->db->select('*');
        $this->db->from('tbl_bolsas_status');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
         $retorno = $this->db->get();
        
        return $retorno->result();
    }

    public function setBolsa($array = array()){
        
        $retorno = $this->db->insert('tbl_bolsas',$array);
        
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
    
    public function ativaDesativaTipoCurso($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_cursos_tipos',$array);
    }
    
    public function ativaDesativaCurso($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_cursos',$array);
    }
    
    public function editarTipoCurso($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_cursos_tipos',$array);
    }
    
    public function editarCurso($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_cursos',$array);
    }
}

?>
