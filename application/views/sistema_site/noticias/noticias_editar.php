
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="<?=base_url()?>style/js/jquery.js"></script>
    <script src="<?=base_url()?>style/js/jquery.maskedinput.js"></script>
    <script>

        jQuery(function($){
          $("#data_inicio").mask("99/99/9999");
          $("#data_fim").mask("99/99/9999");
       });

    </script>
    
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
                <h4>Notícias</h4>
                <ul class="nav nav-tabs">
                    <li  class="active">
                      <a href="<?php echo base_url()?>noticias">Notícias</a>
                    </li>
                    
                </ul>
                
                <?php 
                
                        @$result = $this->uri->segment(4);
                        
                        if($result == true){
                            
                            echo "<div class=\"alert alert-success\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    Registro editado com sucesso.
                                  </div>";
                        }
                        
                ?>
                
                <form enctype="multipart/form-data" method="POST" action="<?php echo base_url()?>noticias/editar/<?php echo $noticia['0']->id?>">
                    <a href="<?php echo base_url()?>noticias"><button class="btn" type="button">Sair</button></a>
                    <input type="submit" class="btn btn-primary" value="Salvar">
                    <br><br><?php if(validation_errors()){ echo '<div class="alert alert-block alert-error fade in">'; echo validation_errors('<div class="alert-error">', '</div>'); echo "</div>"; } if($error != ""){ echo "<div class=\"alert alert-block alert-error fade in\"><div class=\"alert-error\"><strong>Ops!</strong> $error</div></div>";}?>
                    <input type="hidden" name="id" value="<?php echo $noticia['0']->id?>">
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Título</span>
                        <input name="titulo" class="input-block-level" type="text" value="<?php echo $noticia['0']->titulo?>">
                    </div><br/>
                    
                     <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Pré-Texto</span>
                        <textarea name="pre_texto" ><?php echo $noticia['0']->pre_texto?></textarea>
                   </div>
                   <?php echo display_ckeditor($pre_texto); ?>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Texto</span>
                        <textarea name="texto" rows="6"><?php echo $noticia['0']->texto?></textarea>
                   </div>
                   <?php echo display_ckeditor($texto); ?>
                   <br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option></option>
                            <option value="1" <?php if($noticia['0']->status == 1){ echo "selected" ;} ?>>Ativo</option>
                            <option value="0" <?php if($noticia['0']->status == 0){ echo "selected" ;} ?>>Desativado</option>
                        </select>
                    </div>
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
