
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
    
    <script type="text/javascript">
      
      function Formatadata(Campo, teclapres)
			{
				var tecla = teclapres.keyCode;
				var vr = new String(Campo.value);
				vr = vr.replace("/", "");
				vr = vr.replace("/", "");
				vr = vr.replace("/", "");
				tam = vr.length + 1;
				if (tecla != 8 && tecla != 8)
				{
					if (tam > 0 && tam < 2)
						Campo.value = vr.substr(0, 2) ;
					if (tam > 2 && tam < 4)
						Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2);
					if (tam > 4 && tam < 7)
						Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/' + vr.substr(4, 7);
				}
			}
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
                <h4>Banners</h4>
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="">Banners</a>
                    </li>
                </ul>
                
                <?php if (form_error('titulo') || form_error('status') || form_error('data_inicio')|| form_error('data_fim')){?>
                    <div class="alert alert-block alert-error fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h4 class="alert-heading">Preencha corretamente os campos abaixo:</h4>
                        <p><?php echo form_error('titulo')?></p>
                        <p><?php echo form_error('data_inicio')?></p>
                        <p><?php echo form_error('data_fim')?></p>
                        <p><?php echo form_error('status')?></p>
                    </div>
                <?php } 
                        
                        
                        @$result = $this->uri->segment(4);
                        
                        if($result == "true"){
                            
                            echo "<div class=\"alert alert-success\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    Banner editado com sucesso.
                                  </div>";
                        }
                        
                        if($result == "erro"){
                            
                            echo "<div class=\"alert alert-block alert-error fade in\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    <p></p><p>Erro ao carregar imagem! <b>Tente novamente!</b></p><p></p>
                                </div>";
                        }
                        
                ?>
                
                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>banners/editar">
                    <a href="<?php echo base_url()?>banners"><button class="btn" type="button">Sair</button></a>
                    <input type="submit" class="btn btn-primary" value="Salvar">
                    <br><br>
                    
                    <input type="hidden" name="id" value="<?php echo $banner['0']->id; ?>"/>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Título</span>
                        <input name="titulo" class="input-block-level" type="text" value="<?php if(set_value('titulo') != "") echo set_value('titulo'); else echo $banner['0']->titulo; ?>">
                    </div><br/>

                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Imagem</span>
                        <input name="imagem" type="file" /> 
                        <img style="margin-left: 10px; margin-top: -10px;" class="img-polaroid" width="10%" src="<?php echo base_url()?>uploads/banners/<?php echo $banner['0']->imagem; ?>" alt="">
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Link</span>
                        <input name="link" class="input-block-level" type="text" value="<?php if(set_value('link') != "") echo set_value('link'); else echo $banner['0']->link; ?>">
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Data Início</span>
                        <input value="<?php if(set_value('data_inicio') != ""){ echo set_value('data_inicio'); } else { echo date("d/m/Y", strtotime($banner['0']->data_inicio)); } ?>" name="data_inicio" class="input-block-level" type="text" onkeyup="Formatadata(this,event)" maxlength="10" />
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; height: 20px; text-align: right; font-weight: bold;">Data Término</span>
                        <input value="<?php if(set_value('data_fim') != ""){ echo set_value('data_fim'); } else { echo date("d/m/Y", strtotime($banner['0']->data_fim)); } ?>" name="data_fim" class="input-block-level" type="text" onkeyup="Formatadata(this,event)" maxlength="10" />
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Ordem</span>
                        <select name="ordem" class="span3" style="width: auto;">
                            <option></option>
                            <?php 
                                $cont = 1;
                                foreach ($ordem as $val){ ?>
                                    
                                    <option value="<?php echo $cont?>" <?php if($cont == $banner['0']->ordem){ echo "selected=\"selected\" "; } ?>><?php echo $cont?></option>
                                    
                          <?php  $cont++;    }
                            ?>
                        </select>
                    </div><br/>
                    
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Status</span>
                        <select name="status" class="span3" style="width: auto;">
                            <option></option>
                            <option value="1" <?php if($banner['0']->status == 1){ echo "selected"; } ?> >Ativo</option>
                            <option value="0" <?php if($banner['0']->status == 0){ echo "selected"; } ?>>Desativado</option>
                        </select>
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
