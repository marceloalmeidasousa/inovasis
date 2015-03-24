<?php 
       
       $id_impressora = $this->uri->segment(3);
        
       if($id_impressora == ""){
           
           $this->site->location("impressoras/tonners");
       } 
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

    <script language="Javascript"> 
        function confirmacao(id) { 
            var resposta = confirm("Deseja remover esse registro?");   
            if (resposta == true) { window.location.href = "<?=  base_url()?>impressoras/excluir_tonner_impressora/"+id+"/<?=$id_impressora?>"; 
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
                <h4>Impressoras</h4>
                <ul class="nav nav-tabs">
                    <li>
                      <a href="<?=base_url()?>impressoras">Impressoras</a>
                    </li>
                    <li  class="active">
                      <a href="<?=base_url()?>impressoras/tonners">Tonners</a>
                    </li>
                </ul>
                <a class="btn" href="<?=base_url()?>impressoras/tonners">Voltar</a>
               <br><br>
                
               <table class="table table-bordered" style="font-size: 12px;">
                    <tr>
                        <td>
                            <strong>Impressora: </strong><?php echo $impressora['0']->nome?> | <strong>Modelo: </strong><?php echo $impressora['0']->modelo?>
                        </td>
                    </tr>
               </table>

               <?php 
                    
                    
                    if(validation_errors()){
                        
                        echo '<div class="alert alert-block alert-error fade in">'; echo validation_errors('<div class="alert-error">', '</div>'); echo "</div>"; 
                    }
                    
                    else if($num_rows == 0){
                        
                        echo '<div class="alert"><strong>AVISO!</strong> Não existem tonners cadatrados para essa impressora!</div>';
                    }
                       
                     @$result = $this->uri->segment(4);
                        
                        if($result == true){
                            
                            echo "<div class=\"alert alert-success\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    Alteração de registro efetuada com sucesso!
                                  </div>";
                        }

                    ?>
                    
                    <form method="POST" action="<?=base_url()?>impressoras/config/<?=$id_impressora?>">
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Adicionar</span>
                        <select name="id_tonner" class="span3" style="width: auto;">
                            <option></option>
                            <?php foreach($tonners as $val){
                                
                                  //Verifica se o tonner já estiver cadastrado
                                  $this->db->where('id_tonner',$val->id);
                                  $this->db->where('id_impressora',$id_impressora);
                                  $num = $this->db->get('tbl_impressoras_tonners')->num_rows();
                                  
                                  if($num == 0){
                            ?>
                                <option value="<?php echo $val->id;?>" <?php echo set_select('status', '1'); ?>><?php echo $val->nome;?></option>
                            <?php }} ?>
                        </select>
                    </div><input style="margin: -10px 7px 0;" type="submit" class="btn btn-primary" value="Adicionar">
                    
                    </form>   
               
                        <table class="table table-bordered" style="font-size: 12px;">
                            <tr><th>#</th><th>Tonner</th><th>Ações</th></tr>
                        <?php foreach($it as $val){ ?>
                        
                                <tr>
                                    <td><?=$val->id?></td>
                                    <td><?=$val->tonner?></td>
                                    <td>    
                                        <a href="javascript:func()" onclick="confirmacao('<?=$val->id?>')" title="Excluir" class="icon-trash"></a>
                                    </td>
                                </tr>
                        
                        <?php } ?>
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
