
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
                <h4>Lotes de Pagamento</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Lotes</a>
                    </li>
                </ul>
                
                   
                <?php if (form_error('nome') || form_error('status')){?>
                    <div class="alert alert-block alert-error fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h4 class="alert-heading">Preencha corretamente os campos abaixo:</h4>
                        <p><?php echo form_error('nome')?></p>
                        <p><?php echo form_error('data_abertura')?></p>
                        <p><?php echo form_error('data_fechamento')?></p>
                        <p><?php echo form_error('status')?></p>
                    </div>
                <?php } 
                        
                        
                        @$result = $this->uri->segment(4);
                        
                        if($result == true){
                            
                            echo "<div class=\"alert alert-success\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    Lote editado com sucesso.
                                  </div>";
                        }
                  

                ?>
                
                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>pagamento/editar/<?=$this->uri->segment(3)?>">
                    <a href="<?php echo base_url()?>pagamento"><button class="btn" type="button">Sair</button></a>
                    <input type="submit" class="btn btn-primary" value="Salvar">
                    <br><br>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Nome</span>
                        <input name="nome" class="input-block-level" type="text" value="<?php if(set_value('nome')){ echo set_value('nome');} else echo $lote['0']->nome;?>">
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Abertura</span>
                        <input name="data_abertura" class="input-block-level" type="text" value="<?php if(set_value('data_abertura')) echo set_value('data_abertura'); else echo $this->site->converterDataPhp($lote['0']->data_abertura);?>">
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Fechamento</span>
                        <input name="data_fechamento" class="input-block-level" type="text" value="<?php if(set_value('data_fechamento')) echo set_value('data_fechamento'); else echo $this->site->converterDataPhp($lote['0']->data_fechamento);?>">
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option></option>
                            <option value="1" <?php if(set_select('status', '1')) echo set_select('status', '1'); else if($lote['0']->status == 1) echo "selected"; ; ?>>Ativo</option>
                            <option value="0" <?php if(set_select('status', '0')) echo set_select('status', '0'); else if($lote['0']->status == 0) echo "selected"; ; ?>>Desativado</option>
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
