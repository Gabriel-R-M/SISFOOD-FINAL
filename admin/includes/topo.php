<?php 
require(dirname(__FILE__)."/../config.php");
$MensagensSistema = new MensagensDesenvolvedorSistema();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   
    <title>RETAGUARDA SIS E-FOOD v<?php echo $dados_sistema['versao']; ?></title>

    <!-- vendor css -->
    <link href="<?php echo ADMIN_DIR; ?>lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo ADMIN_DIR; ?>lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="<?php echo ADMIN_DIR; ?>lib/chartist/css/chartist.css" rel="stylesheet">
    <link href="<?php echo ADMIN_DIR; ?>lib/rickshaw/css/rickshaw.min.css" rel="stylesheet">
    <link href="<?php echo SISTEMA_DIR; ?>css/icones/icones01/icofont.min.css" rel="stylesheet">

    <!-- Slim CSS -->
    <link rel="stylesheet" href="<?php echo ADMIN_DIR; ?>css/slim.css">
    <link rel="stylesheet" href="<?php echo ADMIN_DIR; ?>css/custom.css">

    <link rel="shortcut icon" href="<?php echo ADMIN_DIR; ?>favicon.ico">
	<base href="<?php echo ADMIN_DIR; ?>">

  </head>
  <body>

    <?php require("menu.php"); ?>


    <div class="slim-mainpanel">
      <div class="container">
        

