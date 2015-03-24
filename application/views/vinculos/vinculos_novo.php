
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
                <h4>Vínculos</h4>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="">Vínculos</a></li>
                    <li><a href="<?=base_url()?>vinculos/tipos">Tipos</a></li>
                </ul>
                
                <?php if (form_error('nome') || form_error('status')){?>
                    <div class="alert alert-block alert-error fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h4 class="alert-heading">Preencha corretamente os campos abaixo:</h4>
                        <p><?php echo form_error('usuario')?></p>
                        <p><?php echo form_error('polo')?></p>
                        <p><?php echo form_error('disciplina')?></p>
                        <p><?php echo form_error('curso')?></p>
                        <p><?php echo form_error('tipo')?></p>
                        <p><?php echo form_error('status')?></p>
                    </div>
                <?php } 
                        
                        
                        @$result = $this->uri->segment(3);
                        
                        if($result == "true"){
                            
                            echo "<div class=\"alert alert-success\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    Vínculo cadastrado com sucesso.
                                  </div>";
                        }
                        
                        else if($result == "erro"){
                            
                            echo "<div class=\"alert alert-block alert-error fade in\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    <p><strong>Erro!</strong> Já existe um vínculo ativo para esse usuário.</p>
                                  </div>";
                        }
                        
                ?>
                
                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>vinculos/novo">
                    <a href="<?php echo base_url()?>vinculos"><button class="btn" type="button">Sair</button></a>
                    <input type="submit" class="btn btn-primary" value="Salvar">
                    <br><br>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Bolsista</span>
                        <select name="usuario" class="span3" style="width: auto;">
                            <option></option>
                            <?php 
                                
                                foreach($usuarios as $val){ ?>
                                    
                                    <option <?php echo set_select('usuario', $val->id); ?> value="<?php echo $val->id?>"><?php echo $val->nome?></option>
                        <?php }
                            ?>
                        </select>
                    </div><br>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Polo</span>
                        <select name="polo" class="span3" style="width: auto;">
                            <option></option>
                            <?php 
                                
                                foreach($polos as $val){ ?>
                                    
                                    <option <?php echo set_select('polo', $val->id); ?> value="<?php echo $val->id?>"><?php echo $val->nome?></option>
                        <?php }
                            ?>
                        </select>
                    </div><br>

                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Curso</span>
                        <select name="curso" class="span3" style="width: auto;">
                            <option></option>
                            <?php 
                                
                                foreach($cursos as $val){ ?>
                                    
                                    <option <?php echo set_select('curso', $val->id); ?> value="<?php echo $val->id?>"><?php echo $val->nome?></option>
                        <?php }
                            ?>
                        </select>
                    </div><br>
                    
                                        
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Disciplina</span>
                        <select name="disciplina" class="span3" style="width: auto;">
                            <option></option>
                            <?php 
                                
                                foreach($disciplinas as $val){ ?>
                                    
                                    <option <?php echo set_select('disciplina', $val->id); ?> value="<?php echo $val->id?>"><?php echo $val->nome?></option>
                        <?php }
                            ?>
                        </select>
                    </div><br>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Tipo</span>
                        <select name="tipo" class="span3" style="width: auto;">
                            <option></option>
                            <?php 
                                
                                foreach($tipos as $val){ ?>
                                    
                                    <option <?php echo set_select('tipo', $val->id); ?> value="<?php echo $val->id?>"><?php echo $val->nome?></option>
                        <?php }
                            ?>
                        </select>
                    </div><br>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option></option>
                            <option value="1" <?php echo set_select('status', '1'); ?>>Ativo</option>
                            <option value="0" <?php echo set_select('status', '0'); ?>>Desativado</option>
                        </select>
                    </div>
                </form>
                
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
