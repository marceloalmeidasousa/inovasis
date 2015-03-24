
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
            if (resposta == true) { 
                window.location.href = "<?=base_url()?>solicitacoes_tonners/excluir/"+id; 
            } 
        } 
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
                      <a href="<?=base_url()?>solicitacoes_tonners">Solicitações</a>
                    </li>
                    <li>
                      <a href="<?=base_url()?>solicitacoes_tonners/status">Status</a>
                    </li>
                </ul>
                
                <?php 
                
                        @$result = $this->uri->segment(3);
                        
                        if($result == "true"){
                            
                            echo "<div class=\"alert alert-success\">
                                    Registro excluído com sucesso!
                                  </div>";
                        }
                        
                ?>
                
                <div class="span8" style="margin: 0px;">
                <?php if(!empty($busca)){ echo '<a class="btn" type="button" href="'.base_url().'solicitacoes_tonners">Voltar</a>'; } ?>    
                <a href="<?php echo base_url()?>solicitacoes_tonners/novo"><button class="btn btn-primary" type="button">Novo</button></a>
                
                <?php 
                    echo !empty($paginacao) ? $paginacao : '';
                ?>
                </div>
                
                <div class="span4" style="margin: 0px;">
                     <form method="POST" action="<?php echo base_url()?>solicitacoes_tonners/buscar">
                         <div class="input-append">
                            <input placeholder="" class="span12" name="busca" id="busca" type="text" value="<?php echo !empty($busca) ? $busca : '';?>">
                            <button class="btn" type="submit">Buscar</button>
                      </div>
                     </form>
                </div>
                <table class="table table-bordered" style="font-size: 12px;">
                    <tr>
                        <th>#</th><th>Modelo</th><th>Departamento</th><th>Responsável Entrega</th><th>Data Entrega</th><th>Status</th><th>Ação</th>
                    </tr> 
                    <?php 
                        
                        foreach ($solicitacoes as $val){ ?>
                          <tr>
                            <td><?php echo $val->id?></td>
                            <td><?php echo $val->tonner?></td>
                            <td><?php echo $val->departamento?></td>
                            <td><?php echo $val->responsavel_entrega?></td>
                            <td><?php echo $val->data_cadastro?></td>
                            <td><span class="<?php echo $val->css?>"><?php echo $val->status?></span></td>
                            <td>
                                <a href="<?php echo base_url()?>solicitacoes_tonners/editar/<?php echo $val->id?>"><i title="Editar" class="icon-pencil"></i></a>
                                <a href="javascript:func()" onclick="confirmacao('<?=$val->id?>')" title="Excluir" class="icon-trash"></a>
                                <a href="#" title="Imprimir" class="icon-print"></a>    
                            </td>
                          </tr>
                    <?php }
                    ?>
                </table>
               <?php echo !empty($paginacao) ? $paginacao : '';?>
          </div>
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
