
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
                <h4>Dados Pessoais</h4>
                <div class="span6">
                <table class="table table-bordered">
                    <tr>
                        <th>Nome</th><td><?=$usuario['0']->nome?></td>
                    </tr>
                    <tr>
                        <th>CPF</th><td><?=$usuario['0']->cpf?></td>
                    </tr>
                    <tr>
                        <th>E-mail</th><td><?=$usuario['0']->email?></td>
                    </tr>
               </table>
              </div>      
          </div>
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
