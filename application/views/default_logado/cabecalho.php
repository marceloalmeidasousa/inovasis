<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SISADMIN - Secretaria de Educação de Montes Claros</title>
        <link href="<?php echo base_url()?>style/css/bootstrap.css" rel="stylesheet">
         <link href="<?php echo base_url()?>style/css/bootstrap-responsive.css" rel="stylesheet">
    </head>
    <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">

                <a class="brand" href="<?php echo base_url()?>">SISADMIN</a>
              
                
                
              <div style="float: right;">
                    <ul class="nav">
                      <li class="dropdown">
                           <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php $nome = $this->session->userdata('usuario'); echo $nome;?>
                            <b class="caret"></b>
                          </a>
                        <ul class="dropdown-menu">
                            <!--li><a href="#">Meu Perfil</a></li-->
                            <li><a href="#myModal" data-toggle="modal">Alterar Senha</a></li>
                        </ul>
                      </li>
                  </ul>
                  
                   <a class="btn btn-danger" href="<?php echo base_url()?>home/logout">Sair</a>
            </div>
               
            <ul class="nav">
              <li class="active"><a href="<?php echo base_url();?>home">Início</a></li>
              <li><a href="#">Sobre</a></li>
              <li><a href="#">Contato</a></li>
            </ul>
          </div><!--/.nav-collapse -->
          
        </div>
      </div>
    </div>
    </body>
</html>
