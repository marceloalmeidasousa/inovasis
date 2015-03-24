
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
                <h4>Banners</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Banners</a>
                    </li>
                </ul>
                <a href="<?php echo base_url()?>banners/novo"><button class="btn btn-primary" type="button">Novo</button></a>
                                <br><br>   
                <table class="table table-hover">
                    <tbody>
                    <tr><th>#</th><th>Título</th><th>Ordem</th><th>Status</th><th>Ação</th></tr>
                    
                        <?php foreach($banners as $val){ ?>
                        <tr>
                            <td><?php echo $val->id?></td>
                            <td><?php echo $val->titulo?></td>
                            <td><?php echo $val->ordem?></td>
                            <td><?php if($val->status == 1){ echo "Ativo"; } else{ echo "Inativo"; }
                                       
                            $data = $this->site->getData();
                                       
                            if($data > $val->data_fim){
                                
                                echo " <b>(DATA EXPIRADA)</b>";
                            }
                            ?></td>
                            <td>
                                <a href="<?php echo base_url()?>banners/editar/<?php echo $val->id?>"><img title="Editar" src="<?php echo base_url()?>style/img/icon-lapis.jpg"></a>
                                <?php 
                                    if($val->status == 1){
                                ?>
                                    <a href="<?php echo base_url()?>banners/desativar/<?php echo $val->id?>"><img title="Desativar" src="<?php echo base_url()?>style/img/icon-ativo.jpg"></a>
                                <?php 
                                    }
                                    else{
                                ?>
                                   <a href="<?php echo base_url()?>banners/ativar/<?php echo $val->id?>"><img title="Ativar" src="<?php echo base_url()?>style/img/icon-desativo.jpg"></a>
                                <?php }?>
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
