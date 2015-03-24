
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
    <script src="<?=base_url()?>style/js/jquery.maskedinput.js"></script>
    <script>

        jQuery(function($){
          $("#data_devolucao").mask("99/99/9999");
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
                    <li  class="active">
                      <a href="<?php echo base_url()?>solicitacoes_tonners">Solicitações</a>
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
                
                <form enctype="multipart/form-data" method="POST" action="<?php echo base_url()?>solicitacoes_tonners/editar/<?php echo $solicitacao['0']->id?>">
                    <a href="<?php echo base_url()?>solicitacoes_tonners"><button class="btn" type="button">Sair</button></a>
                    <input type="submit" class="btn btn-primary" value="Salvar">
                    <br><br><?php if(validation_errors()){ echo '<div class="alert alert-block alert-error fade in">'; echo validation_errors('<div class="alert-error">', '</div>'); echo "</div>"; }?>
                    <input type="hidden" name="id" value="<?php echo $solicitacao['0']->id?>">
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; height: 20px; text-align: right; font-weight: bold;">Departamento</span>
                        <input  disabled="" class="input-block-level" type="text" value="<?php echo $solicitacao['0']->departamento?>">
                    </div><br/>
                    
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; height: 20px; text-align: right; font-weight: bold;">Tonner</span>
                        <input disabled="" class="input-block-level" type="text" value="<?php echo $solicitacao['0']->tonner?>">
                    </div><br/>
                   
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; height: 20px; text-align: right; font-weight: bold;">Quantidade</span>
                        <input  disabled="" class="input-block-level" type="text" value="<?php echo $solicitacao['0']->quantidade?>">
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; height: 20px; text-align: right; font-weight: bold;">Responsável Entrega</span>
                        <input  disabled="" class="input-block-level" type="text" value="<?php echo $solicitacao['0']->responsavel_entrega?>">
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; height: 20px; text-align: right; font-weight: bold;">Responsável Devolução</span>
                        <input  name="responsavel_devolucao" class="input-block-level" type="text" value="<?php echo $solicitacao['0']->responsavel_devolucao?>">
                    </div><br/>
                    
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; height: 20px; text-align: right; font-weight: bold;">Data Entrega</span>
                        <input  disabled="" class="input-block-level" type="text" value="<?php echo $solicitacao['0']->data_cadastro?>">
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; height: 20px; text-align: right; font-weight: bold;">Data Devolução</span>
                        <input  name="data_devolucao" id="data_devolucao" class="input-block-level" type="text" value="<?php if($solicitacao['0']->data_devolucao == '00/00/0000') echo ""; else echo $solicitacao['0']->data_devolucao;?>">
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; height: 20px; text-align: right; font-weight: bold;">E-mail</span>
                        <input  name="email" id="data_devolucao" class="input-block-level" type="text" value="<?php echo $solicitacao['0']->email?>">
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 170px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option value=""></option>
                            <?php
                                
                                foreach($status as $val){ ?>
                                    <option value="<?=$val->id?>" <?php if(set_select('status', $val->id)){ echo set_select('status', $val->id);} else if($solicitacao['0']->status == $val->nome) echo "selected";?> ><?=$val->nome?></option>';
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
