<?php

class Videos_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function getVideos($id = null, $status = null){
        
        $this->db->select('*');
        $this->db->from('tbl_videos');
        
        if($id != null){
            
            $this->db->where('id',$id);
        }
        
        if($status != null){
            
            $this->where('status',$status);
        }
        
        $retorno = $this->db->get();
        
        return $retorno->result();
    }

    public function setVideo($array){
        
        $retorno = $this->db->insert('tbl_videos',$array);
        
        return $retorno;
    }
    
    public function editarVideo($id, $array){
        
        $this->db->where('id',$id);
        $this->db->update('tbl_videos',$array);
        
    }
}

?>
