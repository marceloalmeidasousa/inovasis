
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
    <script>
    
    $(document).ready(function(){
    $('#lote').change(function(){
        $('#resultado').load('<?=base_url()?>relatorios/relatorio_bolsas_por_lote_resultado/'+$('#lote').val() );
    });

    });
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
               <h4>Relatórios - Bolsas por Lote</h4>
               <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Lote</span>
                        <select name="lote" id="lote" class="span3" style="width: auto;">
                            <option value="">Selecione o Lote</option>
                       
                            <?php foreach($lotes as $val){ ?>
                                
                                <option value="<?=$val->id?>"><?=$val->nome?></option>
                        <?php }?>
                        </select>
                        
                        
                    </div>
               
               <div id="resultado"></div>
          </div>
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
