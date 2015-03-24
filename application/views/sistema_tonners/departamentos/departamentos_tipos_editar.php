
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

   
  </head>

  <body>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
        </div><!--/span-->
        <div class="span9">
          <div class="" style="margin-top: -35px;">
                <h4>Departamentos</h4>
                <ul class="nav nav-tabs">
                    <li>
                      <a href="<?php echo base_url()?>departamentos">Departamentos</a>
                    </li>
                    
                    <li  class="active">
                      <a href="<?php echo base_url()?>departamentos/tipos">Tipos</a>
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
                
                <form enctype="multipart/form-data" method="POST" action="<?php echo base_url()?>departamentos/editar_tipo/<?php echo $tipo['0']->id?>">
                    <a href="<?php echo base_url()?>departamentos/tipos"><button class="btn" type="button">Sair</button></a>
                    <input type="submit" class="btn btn-primary" value="Salvar">
                    <br><br><?php if(validation_errors()){ echo '<div class="alert alert-block alert-error fade in">'; echo validation_errors('<div class="alert-error">', '</div>'); echo "</div>"; }?>
                    <input type="hidden" name="id" value="<?php echo $tipo['0']->id?>">
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Nome</span>
                        <input name="nome" class="input-block-level" type="text" value="<?php echo $tipo['0']->nome?>">
                    </div><br/>
                   
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option></option>
                            <option value="1" <?php if($tipo['0']->status == 1){ echo "selected" ;} ?>>Ativo</option>
                            <option value="0" <?php if($tipo['0']->status == 0){ echo "selected" ;} ?>>Desativado</option>
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
