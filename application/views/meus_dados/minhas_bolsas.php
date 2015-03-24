
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
                <h4>Minhas Bolsas</h4>

                <table class="table table-bordered">
                    <tr>
                        <th>Nº Bolsas</th><th>Vínculo</th><th>Curso</th><th>Polo</th><th>Disciplina</th>
                    </tr>
                    <?php $id_vinculo = $vinculo['0']->id;
                    
                        foreach($vinculo as $val){ ?>
                        <tr class="<?php if($val->status == 1) echo "success"; else echo "error";?>">
                            <td><?=$num_bolsas?></td><td><?=$val->vinculo?></td><td><?=$val->nome_curso?></td><td><?=$val->nome_polo?></td><td><?=$val->nome_disciplina?></td>
                        </tr>
                    <?php }?>
                </table>
                
                <table class="table table-bordered">
                    <tr>
                        <th>Bolsa</th><th>Previsão</th><th>Status</th><th>Obs.</th>
                    </tr>
                    <?php for($i = 1; $i <= $num_bolsas; $i++){ 

                        $bolsa = $this->bolsas_model->getBolsasPorStatus($i,$id_vinculo);
                      
                        if($bolsa->num_rows() == 0){
                    ?>
                        <tr class="warning">
                            <td><?=$i."ª"?> Bolsa</td><td> ------ </td><td>Aguardando</td><td> ------ </td>
                        </tr>
                    <?php }
                    
                        else{ $bolsa = $bolsa->result();?>
                            
                            <tr class="<?php if($bolsa['0']->status == 1) echo "success"; else if($bolsa['0']->status == 2) echo "error";?>">
                                <td><?=$i."ª"?> Bolsa</td>
                                <td> ------ </td>
                                <td><?php foreach($status as $val){
                                        
                                        if($val->id == $bolsa['0']->status)
                                            echo $val->nome;
                                    }?></td>
                                <td><?php if($bolsa['0']->status == 2){ echo $bolsa['0']->motivo;}?></td>
                            </tr>
                    <?php }
                    
                    }?>
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
