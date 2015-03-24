<?php

class Usuarios_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function setUsuario($array = null){
        
        $retorno = $this->db->insert('tbl_usuarios',$array);
        
        return $retorno;
    }
    
    public function getUsuarios($id = null, $status = null, $perfil = null,$ordem = null,$limite = null,$offset = null){
        
        $this->db->select('*');
        $this->db->from('tbl_usuarios');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->db->where('status',$status);
        }
        
        if($perfil != null){
                
              $this->db->where('id_perfil',$perfil);
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

    public function getUsuariosMoodle($id = null, $ordem = null,$limite = null,$offset = null){
        
         $DB1 = $this->load->database('banco_2', TRUE);
        
         $DB1->select('*');
         $DB1->from('mdl_user');
        
        if($id != null){
            
            $DB1->where('id',$id);
        }
        
        if($ordem != null){
            
            $DB1->order_by('nome',$ordem);
        }
        
        if($limite != null){
            
            $DB1->limit($limite,$offset);
        }
        
        
        $retorno = $DB1->get();
        
        return $retorno->result();
    }
    
    public function editarUsuario($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_usuarios',$array);
        
    }
    
    public function editarUsuarioMoodle($id_moodle = null,$array = null){
        
        $DB1 = $this->load->database('banco_2', TRUE);
        $DB1->where('id',$id_moodle);
        $DB1->update('mdl_user',$array);
        
    }

    public function ativarDesativarUsuario($id = null,$array = null){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_usuarios',$array);
        
    }
    
    public function excluirUsuario($id = null){
        
        $this->db->where('id',$id);
        $retorno = $this->db->delete('tbl_usuarios');

         return $retorno;
    }
    
    public function buscar($nome = null){
        
        $this->db->select('*');
        $this->db->from('tbl_usuarios');
        
        if($nome != null){
            
            $this->db->where('nome LIKE','%'.$nome.'%');
            $this->db->or_where('cpf LIKE','%'.$nome.'%');
            $this->db->or_where('usuario LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function buscarUsuarioMoodle($nome = null){
        
         $DB1 = $this->load->database('banco_2', TRUE);
        
         $DB1->select('*');
         $DB1->from('mdl_user');
        
        if($nome != null){
            
            $DB1->where('firstname LIKE','%'.$nome.'%');
            $DB1->or_where('lastname LIKE','%'.$nome.'%');
            $DB1->or_where('email LIKE','%'.$nome.'%');
            $DB1->or_where('username LIKE','%'.$nome.'%');
        }
        
        $retorno = $DB1->get();
        
        return $retorno->result();
    }
    
    public function getDadosAluno($userid = null, $fieldid = null, $return = TRUE){
        
         $DB1 = $this->load->database('banco_2', TRUE);
        
         $DB1->select('*');
         $DB1->from('mdl_user_info_data');
      
         if($userid != null){
             
             $DB1->where('userid',$userid);
         }

         if($fieldid != null){
             
             $DB1->where('fieldid',$fieldid);
         }
         
         
         $retorno = $DB1->get();
        
         if($return){
            return $retorno-result();
         }
         
         else{
             
             return $retorno;
         }
    }
    
    public function setDadosAluno($array = null){
        
         $DB1 = $this->load->database('banco_2', TRUE);
        
         $DB1->insert('mdl_user_info_data',$array);
         
    }
    
}

?>
