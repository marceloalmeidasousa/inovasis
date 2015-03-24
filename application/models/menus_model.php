<?php

class Menus_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function getMenus($id = null, $status = null,$ordem = null,$limite = null, $offset = null){
        
        $this->db->select('*');
        $this->db->from('tbl_menus');
        
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
        $this->db->from('tbl_menus');
        
        if($nome != null){
            
            $this->db->where('nome LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function buscar_item($nome = null){
        
        $this->db->select('tbl_menus_itens.id,tbl_menus_itens.nome,tbl_menus_itens.status,tbl_menus_itens.id_menu,tbl_menus_itens.id_metodo, tbl_menus.nome as menu');
        $this->db->from('tbl_menus_itens');
        $this->db->join('tbl_menus','tbl_menus.id = tbl_menus_itens.id_menu');
        
        if($nome != null){
            
            $this->db->where('tbl_menus_itens.nome LIKE','%'.$nome.'%');
            $this->db->or_where('tbl_menus.nome LIKE','%'.$nome.'%');
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    
    public function setMenu($array){
        
        return $this->db->insert('tbl_menus',$array);
    }
    
    public function editarMenu($id,$array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_menus',$array);
    }
    
    public function getItens($id = null, $status = null, $menu = null,$limite = null, $offset = null){
        
        $this->db->select('tbl_menus_itens.id,tbl_menus_itens.nome,tbl_menus_itens.status,tbl_menus_itens.id_menu,tbl_menus_itens.id_metodo, tbl_menus.nome as menu');
        $this->db->from('tbl_menus_itens');
        $this->db->join('tbl_menus','tbl_menus.id = tbl_menus_itens.id_menu');
        
        if ($id != null) {
            $this->db->where('tbl_menus_itens.id', $id);
        }

        if ($status != null) {
            $this->db->where('tbl_menus_itens.status', $status);
        }

        if ($menu != null) {
            $this->db->where('id_menu', $menu);
        }
        
        if($limite != null){
            
            $this->db->limit($limite,$offset);
        }

        $retorno = $this->db->get();
        
        return $retorno->result();
        
    }
    
    public function getMetodos($id = null,$status = null, $ordem = null){
        
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

        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setItemMenu($array){
        
        return $this->db->insert('tbl_menus_itens',$array);
        
    }
    
    public function editarItemMenu($id,$array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_menus_itens',$array);
    }
    
    public function getItensMenuPerfil($perfil = 0,$menu = null,$ordem = null){
        
        $sql = "SELECT im.nome,m.apelido FROM tbl_menus_itens im
                JOIN tbl_permissoes p ON
                p.id_metodo = im.id_metodo
                JOIN tbl_metodos m ON
                m.id = p.id_metodo
                WHERE p.id_perfil = $perfil AND im.status = 1 AND im.id_menu = $menu ORDER BY $ordem";
        
        $retorno = $this->db->query($sql);
        
        return $retorno;
    }
    
    public function excluirMenu($id = null){
        
        $this->db->where('id',$id);
        $retorno = $this->db->delete('tbl_menus');

         return $retorno;
    }
    
    public function excluirItemMenu($id = null){
        
        $this->db->where('id',$id);
        $retorno = $this->db->delete('tbl_menus_itens');

         return $retorno;
    }
}

