<?php

    session_start();
       
    $c = new Config();
    
    @$registro = $_SESSION['registro'];
    @$limite = $_SESSION['limite'];
    
    if(empty($_SESSION['logado'])){
        
        $base_url = $c->url."/login";
        echo '<script language= "javascript">
                                location.href="'. $base_url .'"
                              </script>';
    }
    
    else{
        
        if($registro){
            $segundos = time() - $registro;
        }
        
        if($segundos > $limite){
         session_destroy();
         $base_url = $c->url."/login?erro=timeout";
         
         echo '<script language= "javascript">
                location.href="'. $base_url .'"
              </script>';

        }
        
        else{
            $_SESSION['registro'] = time();
        }
        
    }