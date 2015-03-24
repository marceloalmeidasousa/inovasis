<?php

class Pagamento_model extends CI_Model{
    
    function __construct() {
        
        parent::__construct();
        //$this->load->database('default',TRUE);
    }
    
    public function setLotePagamento($array){
        
        $retorno = $this->db->insert('tbl_lotes',$array);
        
        return $retorno;
    }
    
    public function getLotes($id = null, $status = null, $hora = null, $ordem = null, $result = TRUE){
        
         $this->db->select('*');
         $this->db->from('tbl_lotes');
         
         if($id != null){
            $this->db->where('id',$id);
         }
         
         if($status != null){
            $this->db->where('status',$status);
         }
         
         if($hora != null){
            $this->db->where('data_abertura <=',$hora);
            $this->db->where('data_fechamento >=',$hora);
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
    
    public function editarLote($id,$array){
        
        $this->db->where('id',$id);
        
        $this->db->update('tbl_lotes',$array);
    }
}

?>
