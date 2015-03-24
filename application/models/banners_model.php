<?php

class Banners_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    
    public function getBanners($id = null, $status = null){
        
        $this->db->select('*');
        $this->db->from('tbl_banners');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->where('status',$status);
        }
        
        $this->db->order_by('id','DESC');
        $retorno = $this->db->get();
        
        return $retorno->result();
    }
    
    public function setBanner($array){
        
        $retorno = $this->db->insert('tbl_banners',$array);
        
        return $retorno;
    }
    
    public function ativaDesativaBanner($id,$array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_banners',$array);
    }
    
    public function editarBanner($id,$array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_banners',$array);
    }

    public function getOrdem($data){
        
        $sql = "SELECT ordem FROM tbl_banners WHERE (data_inicio <= '$data' AND data_fim >= '$data') AND status = 1 ORDER BY ordem ASC";
        $retorno = $this->db->query($sql);
        
        return $retorno;
        
    }
}

?>
