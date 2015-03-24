<?php

    $id_vinculo = $this->uri->segment(3);
    $id_usuario = $this->uri->segment(4);
    
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
                <h4>Bolsas</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Autorização de Bolsas</a>
                    </li>
                    <li><a href="#">Status</a></li>
                </ul>
                
                <a href="<?=base_url()?>bolsas" class="btn">Voltar</a>
                <br><br>

                <div class="span7">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nome</th><td><?=$vinculo['0']->nome_usuario?></td>
                        </tr>
                        <tr>
                            <th>Disciplina</th><td><?=$vinculo['0']->nome_disciplina?></td>
                        </tr>
                        <tr>
                            <th>Curso</th><td><?=$vinculo['0']->nome_curso?></td>
                        </tr>
                        <tr>
                            <th>Polo</th><td><?=$vinculo['0']->nome_polo?></td>
                        </tr>
                    </table>
                </div>
                
                <?php if($lotes->num_rows() == 1){?>
                <table class="table table-bordered">
                    <tr>
                        <th>Bolsa</th><th>Status</th><th>Motivo</th><th>Ação</th>
                    </tr>
                    
                    <?php for($i = 1; $i <= $num_bolsas; $i++){ 
                    
                        $bolsa = $this->bolsas_model->getBolsasPorStatus($i,$id_vinculo); 
                        
                        if($bolsa->num_rows() == 0){
                    ?>
                     <form method="POST" action="<?=base_url()?>bolsas/autorizacao/<?=$id_vinculo?>/<?=$id_usuario?>">
                        <tr class="warning">
                            <td><?=$i."ª"?> Bolsa<input name="numero" type="hidden" value="<?=$i?>"></td>
                            <td>
                                <select name="status">
                                    <option value=""></option>
                                    <?php foreach($status as $val){?>
                                        <option value="<?=$val->id?>"><?=$val->nome?></option>
                                    <?php }?>
                                </select>
                            </td>
                            <td><textarea name="motivo"></textarea></td>
                            <td><input class="btn" type="submit" value="Salvar"></td>
                        </tr>
                        </form> 
                    <?php }
                    
                    else{ $bolsa = $bolsa->result();?>
                        
                        <tr class="<?php if($bolsa['0']->status == 1) echo "success"; else if($bolsa['0']->status == 2) echo "error";?>">
                            <td><?=$i."ª"?> Bolsa</td>
                            <td>

                                    <?php foreach($status as $val){
                                        
                                        if($val->id == $bolsa['0']->status)
                                            echo $val->nome;
                                    }?>
                            </td>
                            <td><?php if($bolsa['0']->status == 2){ echo $bolsa['0']->motivo;}?></td>
                            <td><input class="btn" type="submit" value="Editar"></td>
                        </tr>
                        
                    <?php }
                    
                    }?>
                </table>
                <?php } 
                
                else if($lotes->num_rows() == 0){ ?>
                    <div class="span12">
                    <div class="alert alert-block alert-error fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p><strong>Erro!</strong> Não existem lotes de pagamento em aberto.</p>
                    </div>
                    </div>
              <?php  }?>
                   
          </div>
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
