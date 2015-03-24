
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
                <a href="<?=base_url()?>pagamento/novo"><button class="btn btn-primary" type="button">Novo</button></a>
                <br><br>
                <table class="table">
                    <tr>
                        <th>#</th><th>Nome</th><th>Data Abertura</th><th>Data Fechamento</th><th>Status</th><th>Ação</th>
                    </tr>
                    
                    <?php 
                    
                        foreach($lotes as $val){ ?>
                            
                            <tr>
                                <td><?=$val->id?></td><td><?=$val->nome?></td><td><?=$this->site->converterDataPhp($val->data_abertura);?></td><td><?=$this->site->converterDataPhp($val->data_fechamento);?></td>
                                <td><?php if($val->status == 1) echo "Ativo"; else echo "Inativo"?></td>
                                <td>
                                    <a href="<?=base_url()?>pagamento/editar/<?=$val->id?>"><i title="Editar" class="icon-pencil"></i></a>
                                    
                                    <?php if($val->status == 1){?>
                                        <a href="<?=base_url()?>pagamento/desativar/<?=$val->id?>"><i title="Desativar" class="icon-ok"></i></a>
                                    <?php }else{?>
                                        <a href="<?=base_url()?>pagamento/ativar/<?=$val->id?>"><i title="Ativar" class="icon-ban-circle"></i></a>
                                    <?php }?>
                                </td>
                            </tr>
                            
                 <?php  }
                        
                    ?>
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
