<?php
require ("../admin/class/class.db.php"); 
require ("../admin/class/class.seguranca.php");
require ("../includes/verifica_dados_sistema.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS E-FOOD v<?php echo $dados_sistema['versao']; ?></title>
    <link rel="shortcut icon" href="../favicon.ico">  
    <link rel="stylesheet" type="text/css" href="../css/index/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/index/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/index/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="../css/index/iofrm-theme3.css">
</head>
<body>
     <div class="form-body">
        <div class="website-logo">
            <a href="index.html">
                <div class="logo">
                    <img class="logo-size" src="images/logo-light.svg" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="img-holder">
                <div class="bg" style="background-image: url(../img/back.jpg);"></div>
                <div class="info-holder">
                        <img class="logo-size" src="../img/logo.png" alt="">
                </div>
            </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Ops!</h3>
                        <p>Encontramos um erro ao acessar o sistema.<br>Confira abaixo:</p>
                        <h4>
                            <?php 
                                echo erro_mensagem_servidor($dados_sistema['mensagem_retorno']); 
                            ?>
                        </h4>
                    </div>
                    <div class="form-sent">
                        <div class="tick-holder">
                            <div class="tick-icon"></div>
                        </div>
                        <h3>Password link sent</h3>
                        <p>Please check your inbox iofrm@iofrmtemplate.io</p>
                        <div class="info-holder">
                            <span>Unsure if that email address was correct?</span> <a href="#">We can help</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="../js/jquery.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
</body>
</html>