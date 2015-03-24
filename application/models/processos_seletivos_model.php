<?php

class Processos_seletivos_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
     public function getProcessosSeletivos($id = null,$status = null){
         
         $this->db->select('*');
         $this->db->from('tbl_processos_seletivos');
         
         if($id != null){
            $this->db->where('id',$id);
         }
         
         if($status != null){
            $this->db->where('status',$status);
         }
         
         $retorno = $this->db->get();
       
         return $retorno->result();
      }
      
      public function setProcessoSeletivo($array = array()){
          
          $retorno = $this->db->insert('tbl_processos_seletivos',$array);
          
          return $retorno;
      }
      
      public function getTiposProcessosSeletivos($id = null,$status = null){
         
         $this->db->select('*');
         $this->db->from('tbl_processos_seletivos_tipos');
         
         if($id != null){
            $this->db->where('id',$id);
         }
         
         if($status != null){
            $this->db->where('status',$status);
         }
         
         $retorno = $this->db->get();
       
         return $retorno->result();
      }
      
      public function setTipoProcessoSeletivo($array = array()){
          
          $retorno = $this->db->insert('tbl_processos_seletivos_tipos',$array);
          
          return $retorno;
      }
     
      public function editarTipoProcessoSeletivo($id = null,$array = array()){
          
          $this->db->where('id',$id);
          $this->db->update('tbl_processos_seletivos_tipos',$array);
      }
      
      public function editarProcessoSeletivo($id = null,$array = array()){
          
          $this->db->where('id',$id);
          $this->db->update('tbl_processos_seletivos',$array);
      }
      
      public function getArquivos($id){
          
          $sql = "SELECT tbl_arquivos.id,tbl_arquivos.nome,tbl_arquivos.arquivo,tbl_arquivos.status FROM tbl_arquivos 
                    JOIN tbl_processos_seletivos_arquivos
                    ON tbl_processos_seletivos_arquivos.idarquivo = tbl_arquivos.id
                    WHERE tbl_processos_seletivos_arquivos.idprocesso = $id";
          
          $retorno = $this->db->query($sql);
          
          return $retorno->result();
      }
      
      public function setArquivo($array = array()){
          
          $retorno = $this->db->insert('tbl_arquivos',$array);
          
          return $retorno;
      }
      
      public function getIdNomeArquivo($nome){
          
          $this->db->select('*');
          $this->db->from('tbl_arquivos');
          $this->db->where('arquivo',$nome);
      
          $retorno = $this->db->get();
          
          return $retorno->result();
      }
      
      public function setArquivoProcessoSeletivo($array){
          
          $this->db->insert('tbl_processos_seletivos_arquivos',$array);
      }
      
      public function editarArquivo($id,$array){
          
          $this->db->where('id',$id);
          $this->db->update('tbl_arquivos',$array);
      }
      
      public function getArquivo($idarquivo){
          
          $this->db->select('*');
          $this->db->from('tbl_arquivos');
          $this->db->where('id',$idarquivo);
          
          $retorno = $this->db->get();
          
          return $retorno->result();
      }
}

?>