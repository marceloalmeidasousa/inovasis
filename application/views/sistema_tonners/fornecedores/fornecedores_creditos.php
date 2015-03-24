<?php 
       
       $id_fornecedor = $this->uri->segment(3);
        
       if($id_fornecedor == ""){
           
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
                <a class="btn" href="<?=base_url()?>fornecedores/config/<?php echo $tonner['0']->id_fornecedor?>">Voltar</a>
                <a class="btn btn btn-primary" href="<?=base_url()?>fornecedores/adicionar_saldo/<?php echo $tonner['0']->id?>">Adicionar</a>
               <br><br>
                
               <?php                         
                        @$result = $this->uri->segment(4);
                        
                        if($result == "true"){
                            
                            echo "<div class=\"alert alert-success\">
                                    Registro inserido com sucesso!
                                  </div>";
                        }
                        
                        else if($result == "erro"){
                            
                            echo "<div class=\"alert alert-error\">
                                    <strong>Ops!</strong> Esse registro já está cadastrado com essa Ordem de Compra!
                                  </div>";
                            
                        }
                        
                ?>
               
               <table class="table table-bordered" style="font-size: 14px;">
                    <tr>
                        <td>
                            <strong>Fornecedor: </strong><?php echo $fornecedor['0']->nome?> | <strong>Tonner: </strong><?php echo $tonner['0']->tonner?>
                        </td>
                    </tr>
               </table>
       
               
                <table class="table table-bordered" style="font-size: 12px;">
                    <tr><th>#</th><th>Crédito</th><th>Saldo</th></th><th>Ordem de Compra</th><th>Ações</th></tr>
                        <?php 
                        
                        //Inicia variáveis que vão receber TOTAL DE SALDO E DE CRÉDITO
                        $total_saldo = 0;
                        $total_credito = 0;  
                        
                        foreach($saldo as $val){ 
                                //Soma total de creditos e saldos
                                $total_saldo = $total_saldo + $val->saldo;
                                $total_credito = $total_credito + $val->credito;
                                ?>
                        
                                <tr>
                                    <td><?=$val->id?></td>
                                    <td><?=$val->credito?></td>
                                    <td><?=$val->saldo?></td>
                                    <td><?=$val->ordem_compra?></td>
                                    <td>  
                                        <a href="#" title="Listar" class="icon-list"></a>
                                        <a href="#" title="Excluir" class="icon-trash"></a>
                                    </td>
                                </tr>
                        
                        <?php } ?>
                                <tr><th>Total</th><th><?=$total_credito?></th><th><?=$total_saldo?></th><td></td><td></td><tr>
                </table>

          </div>
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
