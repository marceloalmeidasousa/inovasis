
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
                <h4>Processos Seletivos</h4>
                <ul class="nav nav-tabs">
                    <li>
                      <a href="<?php echo base_url()?>processos_seletivos">Processos Seletivos</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url()?>processos_seletivos/tipos">Tipos</a>
                    </li>
                    <li  class="active"><a href="<?php echo base_url()?>processos_seletivos/arquivos">Arquivos</a></li>
                </ul>
               <h4><?php $idprocesso =  $processo['0']->id; echo $processo['0']->nome?></h4>
               
                <a href="<?php echo base_url()?>processos_seletivos/arquivos"><button class="btn" type="button">Sair</button></a>
                <a href="<?php echo base_url()?>processos_seletivos/arquivos_novo/<?php echo $processo['0']->id?>"><button class="btn btn-primary" type="button">Novo Arquivo</button></a>
                
               <br><br>
                <table class="table table-hover">
                    <tbody>
                    <tr><th>#</th><th>Nome</th><th>Status</th><th>Ação</th></tr>
                    
                        <?php foreach($arquivos as $val){ ?>
                        <tr>
                            <td><?php echo $val->id?></td>
                            <td><?php echo $val->nome?></td>
                            <td><?php if($val->status == 1){ echo "Ativo"; } else{ echo "Inativo"; }?></td>
                            <td>
                                <a href="<?php echo base_url()?>processos_seletivos/arquivos_editar/<?php echo $idprocesso?>/<?php echo $val->id?>"><img title="Editar" src="<?php echo base_url()?>style/img/icon-lapis.jpg"></a>
                                <?php 
                                    if($val->status == 1){
                                ?>
                                    <a href="<?php echo base_url()?>processos_seletivos/arquivo_desativar/<?php echo $idprocesso?>/<?php echo $val->id?>"><img title="Desativar" src="<?php echo base_url()?>style/img/icon-ativo.jpg"></a>
                                <?php 
                                    }
                                    else{
                                ?>
                                   <a href="<?php echo base_url()?>processos_seletivos/arquivo_ativar/<?php echo $idprocesso?>/<?php echo $val->id?>"><img title="Ativar" src="<?php echo base_url()?>style/img/icon-desativo.jpg"></a>
                                <?php }?>
                                   
                                   <a target="blank" href="<?php echo base_url()?>uploads/processos_seletivos/<?php echo $val->arquivo?>" title="Ver Arquivo"><img  src="<?php echo base_url()?>style/img/pdf.png"/></a>
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
