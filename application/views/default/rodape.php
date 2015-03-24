<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        
     <div class="container-fluid">

      <hr>

      <footer>
        <p>&copy; Faculdades Santo Agostinho - Núcleo de Educação a Distância - 2014</p>
        <p>Suporte: (38) 3224 - 7923</p>
      </footer>

    </div>
    
<form name="form1" method="POST" action="<?php echo base_url()?>home/alterar_senha">
<!-- Modal Alterar Senha -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Alterar Senha</h3>
  </div>
  <div class="modal-body">
      
        <table id="table">
            <tr>
                <td style="float: right; margin-top: 5px;"><strong>Nova Senha</strong></td>
                <td><input type="password" name="senha"></td>
            </tr>
        </table>
      
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Sair</button>
  </div>
</div>
</form>    
            
    <script src="<?php echo base_url()?>style/js/jquery.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-transition.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-alert.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-modal.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-tab.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-popover.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-button.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-collapse.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-carousel.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-typeahead.js"></script>
    <script src="<?php echo base_url()?>style/js/bootstrap-affix.js"></script>


    <script src="<?php echo base_url()?>style/js/application.js"></script>
    </body>

</html>
