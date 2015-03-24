<?php

class Polos_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database('default', TRUE);
    }
    
    public function getPolos($id = null,$status = null,$ordem = null){
        
        $this->db->select('*');
        $this->db->from('tbl_polos');
        
        if($id != null)
            $this->db->where('id',$id);
        
        if($status != null)
            $this->db->where('status',$status);
        
        if($ordem != null)
            $this->db->order_by('nome',$ordem);
            
        $retorno = $this->db->get();
        
        return $retorno->result();
    }

    public function setPolo($array = array()){
        
        $retorno = $this->db->insert('tbl_polos',$array);
        
        return $retorno;
    }
    
    public function setTipoPolo($array = array()){
        
        $retorno = $this->db->insert('tbl_polos_tipos',$array);
        
        return $retorno;
    }
     
    public function getTipoPolos($id = null, $status = null,$ordem = null){
        
        $this->db->select('*');
        $this->db->from('tbl_polos_tipos');
        
        if($id != null)
           $this->db->where('id',$id);
        
        if($status != null)
           $this->db->where('status',$status);
        
        if($ordem != null)
            $this->db->order_by($ordem);
            
        $retorno = $this->db->get();

        return $retorno->result();
    }
    
    public function ativarDesativarPolo($id = null ,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_polos',$array);
        
    }
    
    public function ativarDesativarTipoPolo($id = null ,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_polos_tipos',$array);
        
    }
    
    public function editarTiposPolos($id = null ,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_polos_tipos',$array);
        
    }
    
    public function getExisteCursoNoPolo($idpolo = null,$idcurso = null){
        
        $this->db->select('*');
        $this->db->from('tbl_polos_cursos');
        
        $this->db->where('idpolo',$idpolo);
        $this->db->where('idcurso',$idcurso);
        $retorno = $this->db->get();
        
        if($retorno->num_rows() == 0){
            
            return false;
        }
        
        else if($retorno->num_rows() == 1){
            
            return true;
        }

    }
    
    public function setCursoPolo($array = null){
        
        $retorno = $this->db->insert('tbl_polos_cursos',$array);
        
        return $retorno;
    }
    
    public function removerCursoPolo($idpolo, $idcurso){
        
        $sql = "DELETE FROM tbl_polos_cursos WHERE idpolo = $idpolo AND idcurso = $idcurso";
        
        $retorno = $this->db->query($sql);
 
        return $retorno;
    }
    
    public function getCursosPolo($idpolo){
        
        $sql = "SELECT  tbl_cursos.id,tbl_cursos.nome,tbl_cursos_tipos.nome as tipo FROM tbl_polos_cursos
                JOIN tbl_cursos ON
                tbl_cursos.id = tbl_polos_cursos.idcurso
                JOIN tbl_cursos_tipos ON
                tbl_cursos_tipos.id = tbl_cursos.tipo
                WHERE idpolo = $idpolo";
        
        $retorno = $this->db->query($sql);
        
        return $retorno->result();
        
    }
    
    public function editarPolo($id = null ,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_polos',$array);
        
    }
}

?>


