<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testes extends CI_Controller {
    
        function __construct() {
            // Call the Controller constructor
            parent::__construct();

            $this->load->model('usuarios_model');
            
        }
        
        function index(){
            
            $usuarios = $this->usuarios_model->getUsuariosMoodle();
            
            foreach ($usuarios as $val){
                
                $num = strlen($val->username);
                
                if(is_numeric($val->username)){
                    if($num == 6){

                        echo $val->username." - ".$val->firstname." ".$val->lastname." <br>";
                        
                        $dados = $this->usuarios_model->getDadosAluno($val->id,8,FALSE);
                        
                        if($dados->num_rows() == 0){
                            
                            $id_curso = substr($val->username, 0, 2);
                            echo "VAI INSERIR: $id_curso<br><br>";
                            $array = array('fieldid' => '8','userid' => $val->id,'data' => $id_curso);
                            $this->usuarios_model->setDadosAluno($array);
                            
                        }
                        
                        else{
                            
                             echo "JÁ INSERIDO ID CURSO<br>";
                        }
                        
                        $retorno = $this->usuarios_model->getDadosAluno($val->id,9,FALSE);
                            
                        if($retorno->num_rows() == 0){
                            $id = substr($val->username, 0, 2);
                            $this->db->where('codigo',$id);
                            $curso = $this->db->get('tbl_disciplinas_portugues')->result();
                           
                            if(isset($curso['0']->curso)){
                                $array = array('fieldid' => '9','userid' => $val->id,'data' => $curso['0']->curso);

                                //print_r($array);
                                $this->usuarios_model->setDadosAluno($array);
                            }
                        }
                        
                        else{
                            
                            echo "JÁ INSERIDO NOME DO CURSO<br><br>";
                        }

                    }
                }
            }
            
        }
        
        function time(){
            
            $time = '1426702986';
         
            echo date('d-m-Y',$time);
        }
}
