
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
                <h4>Processos Seletivos</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Processos Seletivos</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url()?>processos_seletivos/tipos">Tipos</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url()?>processos_seletivos/arquivos">Arquivos</a>
                    </li>
                </ul>

                <?php if (form_error('nome') || form_error('status')){?>
                    <div class="alert alert-block alert-error fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h4 class="alert-heading">Preencha corretamente os campos abaixo:</h4>
                        <p><?php echo form_error('nome')?></p>
                        <p><?php echo form_error('tipo')?></p>
                        <p><?php echo form_error('status')?></p>
                    </div>
                <?php } 
                        
                        
                        @$result = $this->uri->segment(4);
                        
                        if($result == true){
                            
                            echo "<div class=\"alert alert-success\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    Processo Seletivo editado com sucesso.
                                  </div>";
                        }
                        
                ?>
                
                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>processos_seletivos/editar/<?php echo $processo['0']->id?>">
                    <a href="<?php echo base_url()?>processos_seletivos"><button class="btn" type="button">Sair</button></a>
                    <input type="submit" class="btn btn-primary" value="Salvar">
                    <br><br>
                    
                    <input type="hidden" name="id" value="<?php echo $processo['0']->id?>"/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Nome</span>
                        <input name="nome" class="input-block-level" type="text" value="<?php echo $processo['0']->nome?>">
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Link</span>
                        <input name="link" class="input-block-level" type="text" value="<?php echo $processo['0']->link?>">
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Tipo</span>
                        <select name="tipo" class="span3" style="width: auto;">
                            <option></option>
                            <?php 
                                
                                foreach($tipos as $val){ ?>
                                    
                                    <option <?php if($val->id == $processo['0']->tipo){ echo "selected"; } ?> value="<?php echo $val->id?>"><?php echo $val->nome?></option>
                        <?php }
                            ?>
                        </select>
                    </div><br>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option></option>
                            <option value="1" <?php if($processo['0']->status == 1) echo "selected"; ?>>Ativo</option>
                            <option value="0" <?php if($processo['0']->status == 0) echo "selected";  ?>>Desativado</option>
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
