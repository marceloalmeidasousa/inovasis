<?php $id_perfil = $this->uri->segment(3);?>
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
                
                <form method="POST" action="<?=base_url()?>perfis/adiciona_permissao/<?=$id_perfil?>">
                <a class="btn" href="<?=base_url()?>perfis/permissoes">Voltar</button></a>
                <input type="submit" value="Salvar" class="btn btn-primary"/>
                <br><br>
                
                <table class="table table-bordered" style="font-size: 14px;">
                    <tr>
                        <td>
                            <strong>Perfil: </strong><?=$perfil['0']->nome?>
                        </td>
                    </tr>
               </table>
                
                <?php 
                
                    //print_r($classes);
                    foreach($classes as $val){
                 ?>
                    <div class="accordion-group">
                    <div class="accordion-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?=$val->classe?>">
                        <?=$val->nome?>
                      </a>
                    </div>
                    <div id="<?=$val->classe?>" class="accordion-body collapse">
                      <div class="accordion-inner">
                        <?php 
                        
                            $metodos = $this->perfis_model->getMetodos($val->classe);
                            
                            foreach($metodos as $m){ 
                                
                                $existe = $this->perfis_model->getExistePermissao($m->id,$id_perfil);
                                ?>
  
                                  <label class="checkbox">
                                    <input <?php if($existe == 1) echo "checked"?> value="<?=$m->id?>" name="id_metodo_<?=$m->id?>" type="checkbox"><?=$m->descricao?>
                                  </label>
                            
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                
                <?php } ?>
                
                </div>
            
                </form>
          </div>
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
