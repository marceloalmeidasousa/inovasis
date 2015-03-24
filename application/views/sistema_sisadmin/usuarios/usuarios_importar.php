
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
                window.location.href = "<?=base_url()?>usuarios/excluir/"+id; 
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
                <h4>Usuários</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Usuários</a>
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
                <?php if(!empty($busca)){ echo '<a class="btn" type="button" href="'.base_url().'usuarios/importar">Voltar</a>'; } else{?>    
                <a href="<?php echo base_url()?>usuarios"><button class="btn" type="button">Voltar</button></a> <?php } ?>
                
                <?php 
                    echo !empty($paginacao) ? $paginacao : '';
                ?>
                </div>
                
                <div class="span4" style="margin: 0px;">
                     <form method="POST" action="<?php echo base_url()?>usuarios/buscar_usuario_moodle">
                        <div class="input-append">
                            <input placeholder="" class="span12" name="busca" id="busca" type="text" value="<?php echo !empty($busca) ? $busca : '';?>">
                            <button class="btn" type="submit">Buscar</button>
                      </div>
                     </form>
                </div>
                
                <table class="table table-bordered" style="font-size: 12px;">
                    <tr>
                        <th>#</th><th>Nome</th><th>Usuário</th><th>E-mail</th><th>Status</th><th>Ação</th>
                    </tr> 
                    <?php 
                        
                        foreach ($usuarios as $val){ ?>
                          <tr <?php if($val->suspended == 1){ echo ' class="error"';}?>>
                            <td><?php echo $val->id?></td>
                            <td><?php echo $val->firstname." ".$val->lastname?></td>
                            <td><?php echo $val->username?></td>
                            <td><?php echo $val->email?></td>
                            <td><?php if($val->suspended == 0) echo "Ativo"; else echo "Inativo"; ?></td>
                            <td>
                                <a href="<?php echo base_url()?>usuarios/novo/<?php echo $val->id?>"><i title="Importar" class="icon-resize-small"></i></a>
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
