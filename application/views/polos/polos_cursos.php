
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
                <h4>Polos</h4>
                <ul class="nav nav-tabs">
                    <li>
                      <a href="<?php echo base_url()?>polos">Polos</a>
                    </li>
                    <li><a href="<?php echo base_url()?>polos/tipos">Tipos</a></li>
                    <li  class="active"><a href="">Cursos</a></li>
                </ul>
                
                <a href="<?php echo base_url()?>polos"><button class="btn" type="button">Sair</button></a>
                <br><br>   
                <table class="table table-hover">
                    <tbody>
                    <tr><th>#</th><th>Nome</th><th>Ação</th></tr>
                    
                        <?php foreach($polos as $val){ ?>
                        <tr>
                            <td><?php echo $val->id?></td>
                            <td><a href="<?php echo base_url()?>polos/cursos_polo/<?php echo $val->id?>" title="Configurar Cursos"><?php echo $val->nome?></a></td>
                            <td>
                                <a href="<?php echo base_url()?>polos/cursos_polo/<?php echo $val->id?>"><img title="Configurar Cursos" src="<?php echo base_url()?>style/img/icon-config.png"></a>
                            </td>
                        </tr>
                        <?php 
                            
                             }?>
                    </tbody>
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
