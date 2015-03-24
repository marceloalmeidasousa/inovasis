
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

    
    <script src="<?=base_url()?>style/js/jquery.js"></script>
     <script>
    
    $(document).ready(function(){
    $('#tipo').change(function(){
        $('#departamento').load('<?=base_url()?>solicitacoes_tonners/busca_departamento/'+$('#tipo').val() );
    });

    });
    

</script>


  </head>

  <body>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
        </div><!--/span-->
        <div class="span9">
          <div class="" style="margin-top: -35px;">
                <h4>Solicitações</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Solicitações</a>
                    </li>
                </ul>
                   
                <?php                         
                        @$result = $this->uri->segment(3);
                        
                        if($result == true){
                            
                            echo "<div class=\"alert alert-success\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    Registro cadastrado com sucesso!
                                  </div>";
                        }
                        
                ?>
                
                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>solicitacoes_tonners/novo">
                    <a href="<?php echo base_url()?>solicitacoes_tonners"><button class="btn" type="button">Sair</button></a>
                    <input type="submit" class="btn btn-primary" value="Salvar">
                    <br><br><?php if(validation_errors()){ echo '<div class="alert alert-block alert-error fade in">'; echo validation_errors('<div class="alert-error">', '</div>'); echo "</div>"; }?>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; text-align: right; font-weight: bold;">Tipo</span>
                        <select id="tipo" class="span3" style="width: auto;">
                            <option value="">Selecione Tipo de Departamento</option>
                            <?php
                                
                                foreach($tipos as $val){ ?>
                                    <option value="<?=$val->id?>" <?php echo set_select('tipo', $val->id); ?>><?=$val->nome?></option>';
                               <?php }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; text-align: right; font-weight: bold;">Departamento</span>
                        <select id="departamento" name="id_departamento" class="span3" style="width: auto;">
                        </select>
                    </div>
                    <br>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; text-align: right; font-weight: bold;">Tonner</span>
                        <select name="id_tonner" class="span3" style="width: auto;">
                            <option value=""></option>
                            <?php
                                
                                foreach($tonners as $val){ ?>
                                    <option value="<?=$val->id?>" <?php echo set_select('id_tonner', $val->id); ?>><?=$val->nome?></option>';
                               <?php }
                            ?>
                        </select>
                    </div>
                    <br>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; height: 20px; text-align: right; font-weight: bold;">Quantidade</span>
                        <input name="quantidade" class="input-block-level" type="text" value="<?php echo set_value('quantidade')?>">
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; height: 20px; text-align: right; font-weight: bold;">Responsável Entrega</span>
                        <input name="responsavel_entrega" class="input-block-level" type="text" value="<?php echo set_value('responsavel_entrega')?>">
                    </div><br/>

                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; height: 20px; text-align: right; font-weight: bold;">E-mail</span>
                        <input name="email" class="input-block-level" type="text" value="<?php echo set_value('email')?>">
                    </div><br/>
                                        
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option value=""></option>
                            <?php
                                
                                foreach($status as $val){ ?>
                                    <option value="<?=$val->id?>" <?php echo set_select('status', $val->id); ?>><?=$val->nome?></option>';
                               <?php }
                            ?>
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
