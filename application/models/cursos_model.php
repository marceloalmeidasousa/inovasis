<?php

class Cursos_model extends CI_Model{
    
    function __construct() {
        
        parent::__construct();
        $this->load->database('default',TRUE);
    }
    
    public function getCursos($id = null, $status = null,$ordem = null,$limite = null,$offset = null){
        
        $this->db->select("*");
        $this->db->from('tbl_cursos');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
        if($ordem != null){
            
            $this->db->order_by('nome',$ordem);
        }
        
        if($limite != null){
            
            $this->db->limit($limite,$offset);
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
        
    }
    
    public function getInscritos($id = null, $idcurso = null, $status = null, $order = null, $result = TRUE){
        
        $this->db->select("tbl_cursos_inscricoes.id, tbl_cursos_inscricoes.cript,tbl_cursos_inscricoes.id_cadastro, tbl_cursos_inscricoes.id_curso, tbl_cursos_inscricoes.tipo,
tbl_cursos_inscricoes.status, tbl_cursos_inscricoes.data_cadastro,upper(tbl_cadastros.nome) as nome,tbl_cadastros.email,
tbl_cadastros.telefone,tbl_cadastros.celular,tbl_cadastros.endereco,tbl_cadastros.cidade,tbl_cadastros.estado");
        $this->db->from('tbl_cursos_inscricoes');
        $this->db->join('tbl_cadastros','tbl_cadastros.id = tbl_cursos_inscricoes.id_cadastro');
        
        if($id != null){
            
            $this->db->where('tbl_cursos_inscricoes.id',$id);
            
        }
        
        if($idcurso != null){
            
            $this->db->where('tbl_cursos_inscricoes.id_curso',$idcurso);
            
        }
        
        if($status != null){
            
            $this->db->where('tbl_cursos_inscricoes.status',$status);
            
        }
        
        if($order != null){
            
            $this->db->order_by($order);
        }
        
        $retorno = $this->db->get();
        
        if($result){
            
            return $retorno->result();
        }
        
        else{
            
            return $retorno;
        }
        
    }

    public function excluirTipo($id = null){
        
        $this->db->where('id',$id);
        $retorno = $this->db->delete('tbl_cursos_tipos');

         return $retorno;
    }
    
     public function excluirCurso($id = null){
        
        $this->db->where('id',$id);
        $retorno = $this->db->delete('tbl_cursos');

         return $retorno;
    }
    
    public function buscar($nome = null){
        
        $this->db->select('*');
        $this->db->from('tbl_cursos');
        
        if($nome != null){
            
            $this->db->where('nome LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function buscarInscritos($nome = null){
        
        $sql = "SELECT tbl_cursos_inscricoes.id, tbl_cursos_inscricoes.id_cadastro, tbl_cursos_inscricoes.id_curso, tbl_cursos_inscricoes.tipo,
                tbl_cursos_inscricoes.status, tbl_cursos_inscricoes.data_cadastro,upper(tbl_cadastros.nome) as nome,tbl_cadastros.email,
                tbl_cadastros.telefone,tbl_cadastros.celular,tbl_cadastros.endereco,tbl_cadastros.cidade,tbl_cadastros.estado
                FROM tbl_cursos_inscricoes
                JOIN tbl_cadastros ON
                tbl_cadastros.id = tbl_cursos_inscricoes.id_cadastro 
                WHERE status LIKE '%$nome%' OR nome LIKE '%$nome%'";
     
        $retorno = $this->db->query($sql);
        
        return $retorno->result();
    }
    
    public function setCurso($array = array()){
        
        $retorno = $this->db->insert('tbl_cursos',$array);
        
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
    
    public function editarInscricao($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_cursos_inscricoes',$array);
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
