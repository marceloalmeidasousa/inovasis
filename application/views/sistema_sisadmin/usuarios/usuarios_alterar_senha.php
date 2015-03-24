<?php

    $id = $this->uri->segment(3);
    
    if($id == ""){
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
                                Registro editado com sucesso.
                                </div>";
                    }
                    
                    else if($result == "erro"){
                        
                        echo "<div class=\"alert alert-error\">
                                   <strong>Erro!</strong> CPF ou Usuário já cadastro!
                                </div>";
                    }
                ?>
                <form method="POST" action="<?php echo base_url()?>usuarios/alterar_senha/<?=$id?>">
                    
                      <a href="<?php echo base_url()?>usuarios"><button class="btn" type="button">Sair</button></a>
                      <input type="submit" class="btn btn-primary" value="Salvar">
                      <br><br><?php if(validation_errors()){ echo '<div class="alert alert-block alert-error fade in">'; echo validation_errors('<div class="alert-error">', '</div>'); echo "</div>"; }?>
                    
                      <input name="id" type="hidden" value="<?php echo $usuario['0']->id?>" />
                      <input name="id_moodle" type="hidden" value="<?php echo $usuario['0']->id_moodle?>" />
                        <div class="input-prepend">
                           <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">Nome</span>
                           <input  class="input-block-level" type="text" value="<?php echo $usuario['0']->nome?>" disabled="disabled">
                       </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">E-mail</span>
                        <input disabled="disabled" class="input-block-level" type="text" value="<?php echo $usuario['0']->email?>">
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">Usuário</span>
                        <input disabled="disabled" class="input-block-level" type="text" value="<?php echo $usuario['0']->usuario?>">
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">Nova Senha</span>
                        <input name="senha" class="input-block-level" type="password" >
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
