<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Site {
    
    private $ci;   
            public function __construct(){
            $this->ci = &get_instance();       
    }

    public function location($pagina = null){
        
        //A função header() substituida por causa do servidor da UAI
        //header("Location: ../pagina");

        //Redirecionamento da página com javascript que substitui o header(Location: );
        
        if($pagina != null){
            
            echo '<script language= "javascript">
                    location.href="'.  base_url() .''.$pagina.'"
                  </script>';
        }
        
        else{
            
            echo '<script language= "javascript">
                    location.href="'.  base_url().'"
                  </script>';
        }
    }
    
    
    public function getData($data_hora = TRUE){
            
            date_default_timezone_set('America/Sao_Paulo');
            
            if($data_hora){
                return date('Y-m-d H:i:s');
            }
            else{
                return date('Y-m-d');
            }
        }
    
   public function hash($length = 4){
            
            $salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $len = strlen($salt);
            $pass = '';
            mt_srand(10000000*(double)microtime());
            
            for ($i = 0; $i < $length; $i++)
            {
              $pass .= $salt[mt_rand(0,$len - 1)];
            }
            
            return $pass;
            
    }
 

    public function converterDataMysql($data){
        
        return implode("-",array_reverse(explode("/",$data)));

    }
    
    public function converterDataPhp($data){
        
        return implode("/",array_reverse(explode("-",$data)));

    }

    public function log($usuario,$acao){
        
        $this->CI =& get_instance();
        $ip = getenv("REMOTE_ADDR");
        $array = array('usuario' => $usuario, 'acao' => $acao, 'ip' => $ip);
        $this->CI->db->insert('tbl_log',$array);

    }
    
    public function editorTexto($nome = null, $id = null, $altura = null){
        
        $editor[$nome] = array
        ( 
            'id'   => $id,
            'path' => '/plugins/ckeditor/',
            'config' => array('toolbar' => "Full",'height'  => $altura));
        
        return $editor;
    }
    
    public function url($variavel = null){

        $variavel_limpa = strtolower( @ereg_replace("[^a-zA-Z0-9-]", "-", strtr(utf8_decode(trim($variavel)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),"aaaaeeiooouuncAAAAEEIOOOUUNC-")) );

        return $variavel_limpa;
    }

}