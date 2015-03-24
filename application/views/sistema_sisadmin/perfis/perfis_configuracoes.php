
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
                <h4>Perfis</h4>
                <ul class="nav nav-tabs">
                    <li>
                      <a href="<?=base_url()?>perfis">Perfis</a>
                    </li>
                    <li  class="active">
                      <a href="<?=base_url()?>perfis/permissoes">Permissões</a>
                    </li>
                    
                </ul>
                
                <div class="span8" style="margin: 0px;">
                <?php if(!empty($busca)){ echo '<a class="btn" type="button" href="'.base_url().'perfis">Voltar</a>'; } ?>    
                
                <?php 
                    echo !empty($paginacao) ? $paginacao : '';
                ?>
                </div>
                
                <div class="span4" style="margin: 0px;">
                     <form method="POST" action="<?php echo base_url()?>perfis/buscar_perfil">
                        <div class="input-append">
                            <input placeholder="" class="span12" name="busca" id="busca" type="text" value="<?php echo !empty($busca) ? $busca : '';?>">
                            <button class="btn" type="submit">Buscar</button>
                      </div>
                     </form>
                </div>
                
                <table class="table table-bordered" style="font-size: 12px;">
                    <tr>
                        <th>#</th><th>Nome</th><th>Status</th><th>Ação</th>
                    </tr> 
                    <?php 
                        
                        foreach ($perfis as $val){ ?>
                          <tr>
                            <td><?php echo $val->id?></td>
                            <td><a href="<?php echo base_url()?>perfis/configurar/<?php echo $val->id?>"><?php echo $val->nome?></a></td>
                            <td><?php if($val->status == 1) echo "Ativo"; else echo "Inativo"; ?></td>
                            <td>
                                <a href="<?php echo base_url()?>perfis/configurar/<?php echo $val->id?>"><i title="Configurar" class="icon-wrench"></i></a>
                                    
                            </td>
                          </tr>
                    <?php }
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
