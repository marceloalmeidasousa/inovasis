
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
            if (resposta == true) { window.location.href = "<?=  base_url()?>impressoras/excluir/"+id; 
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
                <h4>Impressoras</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Impressoras</a>
                    </li>
                    <li>
                      <a href="<?=base_url()?>impressoras/tonners">Tonners</a>
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
                <?php if(!empty($busca)){ echo '<a class="btn" type="button" href="'.base_url().'impressoras">Voltar</a>'; } ?>    
                <a href="<?php echo base_url()?>impressoras/novo"><button class="btn btn-primary" type="button">Novo</button></a>
                
                <?php 
                    echo !empty($paginacao) ? $paginacao : '';
                ?>
                </div>
                
                <div class="span4" style="margin: 0px;">
                     <form method="POST" action="<?php echo base_url()?>impressoras/buscar">
                        <div class="input-append">
                            <input placeholder="" class="span12" name="busca" id="busca" type="text" value="<?php echo !empty($busca) ? $busca : '';?>">
                            <button class="btn" type="submit">Buscar</button>
                      </div>
                     </form>
                </div>
                
                <table class="table table-bordered" style="font-size: 12px;">
                    <tr>
                        <th>#</th><th>Nome</th><th>Modelo</th><th>Status</th><th>Ação</th>
                    </tr> 
                    <?php 
                        
                        foreach ($impressoras as $val){ ?>
                          <tr <?php if($val->status == 0){ echo ' class="error"';}?>>
                            <td><?php echo $val->id?></td>
                            <td><?php echo $val->nome?></td>
                            <td><?php echo $val->modelo?></td>
                            <td><?php if($val->status == 1) echo "Ativo"; else echo "Inativo"; ?></td>
                            <td>
                                    <a title="Editar" class="icon-pencil" href="<?php echo base_url()?>impressoras/editar/<?php echo $val->id?>"></a>
                                <?php if($val->status == 1){?>
                                    <a title="Desativar" class="icon-ok" href="<?php echo base_url()?>impressoras/desativar/<?php echo $val->id?>"></a>
                                <?php }else{?>
                                    <a title="Ativar" class="icon-ban-circle" href="<?php echo base_url()?>impressoras/ativar/<?php echo $val->id?>"></a>
                                <?php }?>
                                    <a href="javascript:func()" onclick="confirmacao('<?=$val->id?>')" title="Excluir" class="icon-trash"></a>
                                
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

    
  </body>
</html>
