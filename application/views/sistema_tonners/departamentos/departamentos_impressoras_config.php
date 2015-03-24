<?php 
       
       $id_departamento = $this->uri->segment(3);
        
       if($id_departamento == ""){
           
           $this->site->location("departamentos/impressoras");
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
            if (resposta == true) { window.location.href = "<?=  base_url()?>departamentos/excluir_impressora_departamento/"+id+"/<?=$id_departamento?>"; 
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
                <h4>Departamentos</h4>
                <ul class="nav nav-tabs">
                    <li>
                      <a href="<?=base_url()?>departamentos">Departamentos</a>
                    </li>
                    <li  class="active">
                      <a href="<?=base_url()?>departamentos/impressoras">Impressoras</a>
                    </li>
                </ul>
                <a class="btn" href="<?=base_url()?>departamentos/impressoras">Voltar</a>
               <br><br>
                
               <table class="table table-bordered" style="font-size: 14px;">
                    <tr>
                        <td>
                            <strong>Departamento: </strong><?php echo $departamento['0']->nome?>
                        </td>
                    </tr>
               </table>

               <?php 
                    
                    
                    if(validation_errors()){
                        
                        echo '<div class="alert alert-block alert-error fade in">'; echo validation_errors('<div class="alert-error">', '</div>'); echo "</div>"; 
                    }
                    
                    else if($num_rows == 0){
                        
                        echo '<div class="alert"><strong>AVISO!</strong> Não existem impressoras cadatrados para esse Departamento!</div>';
                    }
                       
                     @$result = $this->uri->segment(4);
                        
                        if($result == true){
                            
                            echo "<div class=\"alert alert-success\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                                    Alteração de registro efetuada com sucesso!
                                  </div>";
                        }

                    ?>
                    
                    <form method="POST" action="<?=base_url()?>departamentos/config/<?=$id_departamento?>">
                    <div class="input-prepend">
                        <span class="add-on" style="width: 100px; text-align: right; font-weight: bold;">Adicionar</span>
                        <select name="id_impressora" class="span3" style="width: auto;">
                            <option></option>
                            <?php foreach($impressoras as $val){
                                
                                  //Verifica se o tonner já estiver cadastrado
                                  $this->db->where('id_impressora',$val->id);
                                  $this->db->where('id_departamento',$id_departamento);
                                  $num = $this->db->get('tbl_departamentos_impressoras')->num_rows();
                                  
                                  if($num == 0){
                            ?>
                                <option value="<?php echo $val->id;?>" <?php echo set_select('status', '1'); ?>><?php echo $val->nome;?></option>
                            <?php }} ?>
                        </select>
                    </div><input style="margin: -10px 7px 0;" type="submit" class="btn btn-primary" value="Adicionar">
                    
                    </form>   
               
                        <table class="table table-bordered" style="font-size: 12px;">
                            <tr><th>#</th><th>Impressora</th><th>Ações</th></tr>
                        <?php foreach($di as $val){ ?>
                        
                                <tr>
                                    <td><?=$val->id?></td>
                                    <td><?=$val->impressora?></td>
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
