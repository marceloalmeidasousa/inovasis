
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
    
    <script language="Javascript"> 
        function confirmacao(id) { 
            var resposta = confirm("Deseja remover esse registro?");   
            if (resposta == true) { 
                window.location.href = "<?=base_url()?>cursos/excluir/"+id; 
            } 
        } 
    </script>
  </head>

  <body>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
        </div><!--/span-->
        <div class="span9">
          <div class="" style="margin-top: -35px;">
                <h4>Cursos</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Cursos</a>
                    </li>
                    <li>
                      <a href="<?=base_url()?>cursos/tipos">Tipos</a>
                    </li>
                </ul>
                
                
                 <?php 
                
                        @$result = $this->uri->segment(3);
                        
                        if($result == "true"){
                            
                            echo "<div class=\"alert alert-success\">
                                    Registro excluído com sucesso!
                                  </div>";
                        }
                        
                        else if($result == "false"){
                            
                             echo "<div class=\"alert alert-block alert-error fade in\">
                                    <strong>Erro!</strong> Não foi possível excluir registro!
                                  </div>";
                            
                        }
                        
                ?>
                
                <div class="span8" style="margin: 0px;">
                <a class="btn" type="button" href="<?=base_url()?>cursos">Voltar</a>   
                </div>
                
                <div class="span4" style="margin: 0px;">
                     <form method="POST" action="<?php echo base_url()?>cursos/buscar_inscritos">
                        <div class="input-append">
                            <input placeholder="" class="span12" name="busca" id="busca" type="text" value="<?php echo !empty($busca) ? $busca : '';?>">
                            <button class="btn" type="submit">Buscar</button>
                      </div>
                     </form>
                </div>
                
                <table class="table table-bordered" style="font-size: 12px;">
                    <tr>
                        <th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Pagamento</th>
                    </tr> 
                    <?php 
                        
                        foreach ($inscritos as $val){ ?>
                          <tr>
                            <td><?php echo $val->id?></td>
                            <td><?php echo $val->nome?></td>
                            <td><?php echo $val->email?></td>
                            <td><?php echo $val->telefone.' | '.$val->celular?></td>
                            <td>
                                <?php if($val->status == "PENDENTE"){?>
                                        <span class="label label-warning"><?=$val->status?></span>
                                <?php } else if($val->status == "APROVADO"){?>
                                        <span class="label label-success"><?=$val->status?></span>
                                    <?php }?>
                            </td>
                            
                            
                          </tr>
                    <?php }
                    ?>
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
