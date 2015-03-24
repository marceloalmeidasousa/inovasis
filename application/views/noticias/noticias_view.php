
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
                <h4>Notícias</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Notícias</a>
                    </li>
                    <li><a href="<?php echo base_url()?>noticias/tipos">Tipos</a></li>
                    <li><a href="<?php echo base_url()?>noticias/disciplinas">Disciplinas</a></li>
                </ul>
                            
                <div class="span8" style="margin: 0px;">
                    <a href="<?php echo base_url()?>noticias/novo"><button class="btn btn-primary" type="button">Novo</button></a>
                     <?php echo !empty($paginacao) ? $paginacao : '';?>
                </div>
            
                <div class="span4" style="margin: 0px;">
                     <form method="POST" action="<?=base_url()?>noticias/buscar">
                        <div class="input-append">
                            <input placeholder="Digite nome do curso" class="span12" name="busca" id="busca" type="text" value="<?php echo !empty($busca) ? $busca : '';?>">
                            <button class="btn" type="submit">Buscar</button>
                      </div>
                     </form>
                </div>
                
                <table class="table table-hover" style="font-size: 12px;">
                    <tbody>
                    <tr><th>#</th><th>Nome</th><th>Status</th><th>Ação</th></tr>
                    
                        <?php foreach($noticias as $val){ ?>
                        <tr <?php if($val->status == 0){ echo ' class="error"';}?>>
                            <td><?php echo $val->id?></td>
                            <td><?php echo $val->titulo?></td>
                            <td><?php if($val->status == 1){ echo "Ativo"; } else{ echo "Inativo"; }?></td>
                            <td>
                                <a href="<?php echo base_url()?>noticias/editar/<?php echo $val->id?>"><i title="Editar" class="icon-pencil"></i></a>
                                <?php 
                                    if($val->status == 1){
                                ?>
                                    <a href="<?php echo base_url()?>noticias/desativar/<?php echo $val->id?>"><i title="Desativar" class="icon-ok"></i></a>
                                <?php 
                                    }
                                    else{
                                ?>
                                   <a href="<?php echo base_url()?>noticias/ativar/<?php echo $val->id?>"><i title="Ativar" class="icon-ban-circle"></i></a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php 
                            
                             }?>
                    </tbody>
                </table>
                <?php echo !empty($paginacao) ? $paginacao : '';?>
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
