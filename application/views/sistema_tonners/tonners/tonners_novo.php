
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
                <h4>Tonners</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Tonners</a>
                    </li>
                </ul>
                   
                <?php                         
                        @$result = $this->uri->segment(3);
                        
                        if($result == true){
                            
                            echo "<div class=\"alert alert-success\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    Tonner cadastrado com sucesso.
                                  </div>";
                        }
                        
                ?>
                
                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>tonners/novo">
                    <a href="<?php echo base_url()?>tonners"><button class="btn" type="button">Sair</button></a>
                    <input type="submit" class="btn btn-primary" value="Salvar">
                    <br><br><?php if(validation_errors()){ echo '<div class="alert alert-block alert-error fade in">'; echo validation_errors('<div class="alert-error">', '</div>'); echo "</div>"; }?>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Nome</span>
                        <input name="nome" class="input-block-level" type="text" value="<?php echo set_value('nome')?>">
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option></option>
                            <option value="1" <?php echo set_select('status', '1'); ?>>Ativo</option>
                            <option value="0" <?php echo set_select('status', '0'); ?>>Desativado</option>
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
