<?php 
       
       $id = $this->uri->segment(3);
        
       if($id == ""){
           
           $this->site->location("fornecedores/tonners");
       } 
?>
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

    <script language="Javascript"> 
        function confirmacao(id) { 
            var resposta = confirm("Deseja remover esse registro?");   
            if (resposta == true) { window.location.href = "<?=  base_url()?>fornecedores/excluir_tonner_fornecedor/"+id+"/<?=$id_fornecedor?>"; 
            } 
        } 
    </script>
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
                <h4>Fornecedores</h4>
                <ul class="nav nav-tabs">
                    <li>
                      <a href="<?=base_url()?>fornecedores">Fornecedores</a>
                    </li>
                    <li  class="active">
                      <a href="<?=base_url()?>fornecedores/tonners">Tonners</a>
                    </li>
                </ul>
                <a class="btn" href="<?=base_url()?>fornecedores/creditos/<?=$id?>">Voltar</a>
               <br><br>
                
               <table class="table table-bordered" style="font-size: 14px;">
                    <tr>
                        <td>
                            <strong>Fornecedor: </strong><?php echo $fornecedor['0']->nome?> | <strong>Tonner: </strong><?php echo $tonner['0']->tonner?>
                        </td>
                    </tr>
               </table>
       
               
               <form method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>fornecedores/adicionar_saldo/<?=$id?>">
                    <?php if(validation_errors()){ echo '<div class="alert alert-block alert-error fade in">'; echo validation_errors('<div class="alert-error">', '</div>'); echo "</div>"; }?>
                    <input type="hidden" name="id_tonner_fornecedor" value="<?=$id?>">
                    <div class="input-prepend">
                        <span class="add-on" style="width: 130px; height: 20px; text-align: right; font-weight: bold;">Crédito</span>
                        <input name="credito" class="input-block-level" type="text" value="<?php echo set_value('credito')?>">
                    </div><br/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 130px; text-align: right; font-weight: bold;">Ordem de Compra</span>
                        <select name="id_ordem_compra" class="span3" style="width: auto;">
                            <option></option>
                           
                            <?php 
                            
                                foreach($ordens as $val){ ?>
                                    <option <?php echo set_select('id_ordem_compra', $val->id); ?> value="<?=$val->id?>"><?=$val->nome?></option>
                          <?php }
                            ?>
                        </select>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Adicionar">
                    
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
