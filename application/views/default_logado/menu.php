<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div class="span2">
        
        <?php 
        
            $perfil = $this->session->userdata('perfil'); 
            $menus = $this->menus_model->getMenus(null,1,'nome ASC');
            
            if(empty($perfil)){
                
                $perfil = 0 ;
            }
            
        foreach($menus as $val){

            $itens = $this->menus_model->getItensMenuPerfil($perfil,$val->id,'nome ASC');
            
            if($itens->num_rows > 0){
                
                $itens = $itens->result();
        ?>
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header"><?=$val->nome?></li>
              <?php foreach($itens as $i){ ?>
                  
                    <li><a href="<?=base_url()."".$i->apelido?>"><?=$i->nome?></a></li>
                    
              <?php }?>
              </ul>
          </div><!--/.well -->
        
        
        <?php } } ?>
        
        </div>
    </body>
</html>
