
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
                <h4>Ouvidoria</h4>
                <ul class="nav nav-tabs">
                    <li>
                      <a href="<?php echo base_url()?>ouvidoria">Assuntos</a>
                    </li>
                    <li  class="active">
                        <a href="">Configurações</a>
                    </li>
                </ul>
              
              <?php if (form_error('contato') || form_error('status')){?>
                    <div class="alert alert-block alert-error fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h4 class="alert-heading">Preencha corretamente os campos abaixo:</h4>
                        <p><?php echo form_error('contato')?></p>
                        <p><?php echo form_error('status')?></p>
                    </div>
                <?php } 
                        
                        
                        @$result = $this->uri->segment(3);
                        
                        if($result == "true"){
                            
                            echo "<div class=\"alert alert-success\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    Arquivo salvo com sucesso.
                                  </div>";
                        }
                          
                ?>
                
                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>ouvidoria/config">
                    <a href="<?php echo base_url()?>ouvidoria"><button class="btn" type="button">Sair</button></a>
                    <input type="submit" class="btn btn-primary" value="Salvar">
                    <br><br>
                    
                    <?php if ($contato == NULL){?>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Default</span>
                        <select name="contato" class="span3" style="width: auto;">
                            <option></option>
                            <?php 
                                
                                foreach($contatos as $val){ ?>
                                    
                                    <option <?php echo set_select('contato', $val->id); ?>value="<?php echo $val->id ?>"><?php echo $val->email ?></option>
                            <?php  }
                            ?>
                        </select>
                    </div>
                    <br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option></option>
                            <option value="1" <?php echo set_select('status', '1'); ?>>Ativo</option>
                            <option value="0" <?php echo set_select('status', '0'); ?>>Desativado</option>
                        </select>
                    </div>
                    
                    <?php } else{?>
                    <input name="id" type="hidden" value="<?php echo $contato['0']->id; ?>">
                       <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Default</span>
                        <select name="contato" class="span3" style="width: auto;">
                            <option></option>
                            <?php 
                                
                                foreach($contatos as $val){ ?>
                                    
                                    <option <?php if($contato['0']->contato == $val->id){ echo "selected"; } ?> value="<?php echo $val->id ?>"><?php echo $val->email ?></option>
                            <?php  }
                            ?>
                        </select>
                    </div>
                    <br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option></option>
                            <option value="1" <?php if($contato['0']->status == 1){ echo "selected"; }  ?>>Ativo</option>
                            <option value="0" <?php if($contato['0']->status == 0){ echo "selected"; }  ?>>Desativado</option>
                        </select>
                    </div>
                    
                    <?php }?>
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
