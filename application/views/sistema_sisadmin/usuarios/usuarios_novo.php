<?php

    $id_moodle = $this->uri->segment(3);
    
    if($id_moodle == ""){
        $this->site->location('usuarios');
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>

    <script src="<?=base_url()?>style/js/jquery.js"></script>
    <script src="<?=base_url()?>style/js/jquery.maskedinput.js"></script>
    <script>

        jQuery(function($){
          $("#cpf").mask("999.999.999-99");
       });

    </script>
    
  </head>

  <body>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
        </div><!--/span-->
        <div class="span9">
          <div class="" style="margin-top: -35px;">
                <h4>Usuários</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Usuários</a>
                    </li>
                </ul>
                <?php 
                    
                    @$result = $this->uri->segment(4);
                        
                    if($result == "true"){

                        echo "<div class=\"alert alert-success\">
                                   Registro cadastrado com sucesso.
                                </div>";
                    }
                    
                    else if($result == "erro"){
                        
                        echo "<div class=\"alert alert-error\">
                                   <strong>Erro!</strong> CPF ou Usuário já cadastro!
                                </div>";
                    }
                 ?>
                <form method="POST" action="<?php echo base_url()?>usuarios/novo/<?=$id_moodle?>">
                     <a href="<?php echo base_url()?>usuarios"><button class="btn" type="button">Voltar</button></a>
                     <input type="submit" class="btn btn-primary" type="button" value="Salvar">
                     <input name="id_moodle" type="hidden" value="<?=$id_moodle?>"/>
                     <input name="nome" type="hidden" value="<?php echo $usuario['0']->firstname.' '.$usuario['0']->lastname?>"/>
                     <input name="email" type="hidden" value="<?php echo $usuario['0']->email; ?>"/>
                     <input name="usuario" type="hidden" value="<?php echo $usuario['0']->username; ?>"/>
                     <input name="senha" type="hidden" value="<?php echo $usuario['0']->password; ?>"/>
                      <br><br><?php if(validation_errors()){ echo '<div class="alert alert-block alert-error fade in">'; echo validation_errors('<div class="alert-error">', '</div>'); echo "</div>"; }?>
                    
               
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">Nome</span>
                        <input disabled="" class="input-block-level" type="text" value="<?php echo $usuario['0']->firstname.' '.$usuario['0']->lastname?>">
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">CPF</span>
                        <input id="cpf" name="cpf" class="input-block-level" type="text" value="<?php echo set_value('cpf')?>">
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">E-mail</span>
                        <input disabled="" name="email" class="input-block-level" type="text" value="<?php echo $usuario['0']->email; ?>">
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">Usuário</span>
                        <input disabled="" name="usuario" class="input-block-level" type="text" value="<?php echo $usuario['0']->username; ?>">
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; text-align: right; font-weight: bold;">Perfil</span>
                        <select name="id_perfil" class="span3" style="width: auto;">
                            <option></option>
                            <?php
                            
                                foreach($perfis as $val){ ?>
                                    
                                <option value="<?=$val->id?>" <?php  echo set_select('id_perfil', $val->id); ?>><?=$val->nome?></option>
                                
                        <?php   }
                            ?>
                        </select>
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option></option>
                            <option value="1" <?php echo set_select('status', '1'); ?>>Ativo</option>
                            <option value="0" <?php echo set_select('status', '0'); ?>>Desativado</option>
                        </select>
                    </div><br/>
                    
                </form>
          </div>
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
