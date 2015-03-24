
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
                
                <a href="<?php echo base_url()?>polos/cursos"><button class="btn" type="button">Sair</button></a>
                <br><br>
                <h4>Polo: <?php echo $polo['0']->nome?></h4>
                <table class="table table-hover">
                    <tbody>
                    <tr><th>Nome</th><th>Ação</th></tr>
                    
                        <?php foreach($cursos as $val){ ?>
                        <tr>
                            <td><?php echo $val->nome?></td>
                            <td>
                                
                                <?php 
                                        
                                        $cp = $this->polos_model->getExisteCursoNoPolo($polo['0']->id,$val->id);
                                        
                                        if($cp){ ?>

                                                <a href="<?php echo base_url()?>polos/cursos_polo_remover/<?php echo $polo['0']->id?>/<?php echo $val->id?>">
                                    
                                                <img title="Remover Cursos" src="<?php echo base_url()?>style/img/img-delete.png"></a>

                                  <?php
                                  
                                        }
                                        
                                        else{ ?>
                                            
                                            <a href="<?php echo base_url()?>polos/cursos_polo_adicionar/<?php echo $polo['0']->id?>/<?php echo $val->id?>">
                                    
                                                <img title="Adicionar Curso" src="<?php echo base_url()?>style/img/img-add.png"></a>
  
                                <?php  
                                    }
                                ?>
                                 </td>
                        </tr>
                        <?php 
                            
                             }?>
                    </tbody>
                </table>
             
                <h4>Cursos do Polo</h4>
             <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Curso</th>
                  <th>Tipo</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach($cursos_polo as $cp){ ?>
                <tr class="success">
                  <td><?php echo $cp->id?></td>
                  <td><?php echo $cp->nome?></td>
                  <td><?php echo $cp->tipo?></td>
                </tr>
                
                <?php
                  }
                ?>
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
