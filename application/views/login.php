<?php if (isset($_GET['erro'])){ $erro = $_GET['erro']; if($erro == 'timeout') $erro = 'Sessão do Usuário Expirada';}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Faculdades Santo Agostinho - Educação a Distância</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url()?>style/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url()?>style/css/bootstrap-responsive.css" rel="stylesheet">

    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>

  </head>

  <body>

    <div class="container">
       
      <form class="form-signin" method="POST" action="<?php echo base_url()?>home/dologin">
          <div class="span3" style="padding: 0 30px 25px 25px;"><img class="img-rounded" src="<?php echo base_url()?>style/img/logo_default.png" /></div>
        <?php if(isset($erro)){?><b style="color: #660000"><?php echo $erro;}?></b>
        <input name="usuario" type="text" class="input-block-level" placeholder="Usuário">
        <input name="senha" type="password" class="input-block-level" placeholder="Senha">
        <button class="btn btn-large btn-primary" type="submit">Entrar</button>
      </form>

    </div>

    </body>
</html>
