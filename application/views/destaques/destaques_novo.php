
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
                <h4>Destaques</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Destaques</a>
                    </li>
                </ul>
                
                <?php if (form_error('titulo') || form_error('texto') || form_error('pre_texto') || form_error('status')){?>
                    <div class="alert alert-block alert-error fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h4 class="alert-heading">Preencha corretamente os campos abaixo:</h4>
                        <p><?php echo form_error('titulo')?></p>
                        <p><?php echo form_error('texto')?></p>
                        <p><?php echo form_error('pre_texto')?></p>
                        <p><?php echo form_error('status')?></p>
                    </div>
                <?php } 
                
                
                        @$result = $this->uri->segment(3);
                        
                        if($result == true){
                            
                            echo "<div class=\"alert alert-success\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    Destaque cadastrado com sucesso.
                                  </div>";
                        }
                        
                        ?>
                
                <form action="<?php echo base_url()?>destaques/novo" enctype="multipart/form-data" method="post">
                      <a href="<?php echo base_url()?>destaques"><button class="btn" type="button">Sair</button></a>
                      <input type="submit" class="btn btn-primary" value="Salvar">
                      <br><br>
                      
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">Título</span>
                    <input name="titulo" class="input-block-level" type="text" value="<?php echo set_value('titulo')?>">
                    </div><br>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; text-align: right; font-weight: bold;">Imagem</span>
                        <input type="file" name="imagem_destaque" />
                    </div><br>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option></option>
                            <option value="1" <?php echo set_select('status', '1'); ?> >Ativo</option>
                            <option value="0" <?php echo set_select('status', '0'); ?>  >Desativado</option>
                        </select>
                      </div><br>
                      
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; text-align: right; font-weight: bold;">Pré-Texto</span>
                        <textarea maxlength="500" name="pre_texto" rows="8" style="width: 270px;"><?php echo set_value('pre_texto')?></textarea>
                    </div><br>
                    <?php echo display_ckeditor($editor_pre_texto); ?>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; text-align: right; font-weight: bold;">Texto</span>
                        <textarea name="texto" rows="8" style="width: 270px;"><?php echo set_value('texto')?></textarea>
                    </div>
                    <?php echo display_ckeditor($editor_texto); ?>
                  
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
