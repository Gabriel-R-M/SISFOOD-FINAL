<?php 
ob_start();
@session_start();
include("class/class.db.php"); 
include("class/class.seguranca.php"); 
require('class/class.upload.php'); 
include("../includes/verifica_dados_sistema.php");
include("../includes/verifica_dados_loja.php");
if(isset($_SESSION['user_sisconnection_adm'])){
	header("Location: home");		
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>RETAGUARDA SIS E-FOOD v<?php echo $dados_sistema['versao']; ?></title>

    <!-- Vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <!-- Slim CSS -->
    <link rel="stylesheet" href="css/slim.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="shortcut icon" href="favicon.ico">	

  </head>
  <body class="fundo-index" style="background-image: url(img/fundo.jpg);">


  	<div class="alert alert-danger text-center alerta-index_erro msg_erro thin upper">
  		Usuário ou senha inválidos!
    </div>

    <div class="alert alert-success text-center alerta-index msg_sucesso thin upper" <?php if(isset($logout)){echo 'style="display:block;"';} ?>>
        Logout efetuado com sucesso!
    </div>	


<form class="form-signin" id="FormLoginRetaguarda" action="controlers/login/login.php">
    <div class="signin-wrapper">

    	
      <div class="signin-box">
        <h2 class="slim-logo text-center"><img src="img/logo_sis.png"></a></h2>
        <h2 class="signin-title-primary text-center">SIS E-Food <small>v<?php echo $dados_sistema['versao']; ?></small></h2>
        <h3 class="signin-title-secondary text-center">RETAGUARDA ADMINISTRATIVA</h3>

        <div class="form-group">
          <input type="text" class="form-control" name="usuario" required autofocus placeholder="Informe o usuário">
        </div><!-- form-group -->
        <div class="form-group ">
          <input type="password" class="form-control" name="senha" required placeholder="Informe a senha">
        </div><!-- form-group -->
        <button type="submit" id="botao_login" class="btn btn-primary btn-block btn-signin">ACESSAR</button>
        <p class="mg-b-0 text-center">Licenciado para <strong><?php echo $dados_loja['razao']; ?></strong></p>
      </div><!-- signin-box -->

    </div><!-- signin-wrapper -->

</form>    

    <script src="lib/jquery/js/jquery.js"></script>
    <script src="lib/popper.js/js/popper.js"></script>
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script src="lib/youtube/jquery.youtubebackground.js"></script>
    <script src="js/mascara_money.js"></script>
    <script src="js/slim.js"></script>
    <script src="javascript/funcoes.js"></script>
    <script src="javascript/login.js"></script>

    <script>

        jQuery(function () {
            /* Initialize the player */
            //var myPlayer = jQuery(".player").YTPlayer();
        });

    </script>
    
    

  </body>
</html>
