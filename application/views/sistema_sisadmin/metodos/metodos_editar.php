
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

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
  </head>

  <body>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
        </div><!--/span-->
        <div class="span9">
          <div class="" style="margin-top: -35px;">
                <h4>Métodos</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Métodos</a>
                    </li>
                </ul>
                <?php 
                
                    $msg = $this->uri->segment(4);
                    
                    if($msg == "true"){ 
                        
                        echo '<div class="alert alert-success">
                                Registro editado com sucesso!
                             </div>';
                        
                    }
                ?>
                <form method="POST" action="<?php echo base_url()?>metodos/editar/<?=$metodo[0]->id?>">
                    <a href="<?php echo base_url()?>metodos"><button class="btn" type="button">Voltar</button></a>
                     <input type="submit" class="btn btn-primary" type="button" value="Salvar">
                    <br><br><?php if(validation_errors()){ echo '<div class="alert alert-block alert-error fade in">'; echo validation_errors('<div class="alert-error">', '</div>'); echo "</div>"; }?>
                    <input type="hidden" name="id" value="<?php echo $metodo['0']->id?>">
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">Nome</span>
                        <input name="nome" class="input-block-level" type="text" value="<?php if(set_value('nome')) echo set_value('nome'); else echo $metodo[0]->nome;?>">
                    </div><br/>

                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">Descrição</span>
                        <input name="descricao" class="input-block-level" type="text" value="<?php if(set_value('descricao')) echo set_value('descricao'); else echo $metodo[0]->descricao;?>">
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">Classe</span>
                        <input disabled="" class="input-block-level" type="text" value="<?php if(set_value('classe')) echo set_value('classe'); else echo $metodo[0]->classe;?>">
                    </div><br/>
                    
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">Método</span>
                        <input disabled="" class="input-block-level" type="text" value="<?php if(set_value('metodo')) echo set_value('metodo'); else echo $metodo[0]->metodo;?>">
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">URL</span>
                        <input disabled="" class="input-block-level" type="text" value="<?php if(set_value('apelido')) echo set_value('apelido'); else echo $metodo[0]->apelido;?>">
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
