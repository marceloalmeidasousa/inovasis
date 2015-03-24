
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
                <h4>Menus</h4>
                <ul class="nav nav-tabs">
                    <li>
                      <a href="">Menus</a>
                    </li>
                    <li  class="active">
                      <a href="<?=base_url()?>menus/itens">Itens do Menu</a>
                    </li>
                </ul>
                <?php if (form_error('nome') || form_error('status')|| form_error('id_menu')|| form_error('id_metodo')){?>
                    <div class="alert alert-block alert-error fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h4 class="alert-heading">Preencha corretamente os campos abaixo:</h4>
                        <p><?php echo form_error('nome')?></p>
                        <p><?php echo form_error('id_menu')?></p>
                        <p><?php echo form_error('id_metodo')?></p>
                        <p><?php echo form_error('status')?></p>
                    </div>
                <?php } 
                
                    $msg = $this->uri->segment(3);
                    
                    if($msg == "true"){ 
                        
                        echo '<div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                Item do Menu cadastrado com sucesso!
                             </div>';
                        
                    }
                ?>
                <form method="POST" action="<?php echo base_url()?>menus/itens_novo">
                    <a href="<?php echo base_url()?>menus/itens"><button class="btn" type="button">Voltar</button></a>
                     <input type="submit" class="btn btn-primary" type="button" value="Salvar">
                     <br><br>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; height: 20px; text-align: right; font-weight: bold;">Nome</span>
                        <input name="nome" class="input-block-level" type="text" value="<?php echo set_value('nome')?>">
                    </div><br/>
                    
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; text-align: right; font-weight: bold;">Menu</span>
                        <select name="id_menu" class="span3" style="width: auto;">
                            <option></option>
                            <?php 
                            
                                foreach($menus as $val){ ?>
                               
                                    <option value="<?=$val->id?>"><?=$val->nome?></option>
                                    
                          <?php   }
                            ?>
                        </select>
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 80px; text-align: right; font-weight: bold;">Destino</span>
                        <select name="id_metodo" class="span3" style="width: auto;">
                            <option></option>
                            <?php 
                            
                                foreach($metodos as $val){ ?>
                                    
                                        <option value="<?=$val->id?>"><?=$val->apelido?></option>
                              <?php  }
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
