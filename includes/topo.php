<?php
include("admin/class/class.db.php");
include("admin/class/class.seguranca.php");
include("includes/verifica_session.php");
include("includes/verifica_configuracoes_loja.php");
include("includes/verifica_dados_sistema.php");
include("includes/verifica_caixa_aberto.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>SIS E-FOOD v<?php echo $dados_sistema['versao']; ?></title>

<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
<link rel="shortcut icon" href="favicon.ico">     
    
<!-- Bootstrap 3.3.4 -->
<link href="admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="admin/lib/Ionicons/css/ionicons.css" rel="stylesheet">
<link href="css/icones/icones01/icofont.min.css" rel="stylesheet">
<link href="css/icones/icones02/css/pe-icon-set-food.min.css" rel="stylesheet">

<link href="admin/lib/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    
<!-- Slim CSS -->
<link rel="stylesheet" href="css/sistema/slim.css">
<link rel="stylesheet" href="css/sistema/custom.css">
<link rel="stylesheet" href="css/sistema/custom-mobile.css">


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

   <div class="is_mobile d-block d-sm-none"></div> 

	<?php include("includes/modais.php"); ?>
	
	



	<div class="slim-header with-sidebar" style="display: none;">
      <div class="container-fluid">
        <div class="slim-header-right">
          <h2 class="slim-logo"><a href="index.html">slim<span>.</span></a></h2>
          <a href="" id="slimSidebarMenu" class="slim-sidebar-menu"><span></span></a>          
        </div>
      </div>
  </div>


    <div class="slim-body " >

      <?php include("includes/menu.php"); ?>    
      <?php include("includes/menu_mobile.php"); ?>    


      <div class="slim-mainpanel " >


      <?php if($aviso_caixa_antigo==1){ ?>
        
          <div class="alert alert-danger d-none d-md-block" id="div_erro_caixa_dia">
            <div class="container" style="padding-top: 8px; padding-bottom: 8px;">
            <div class="col-md-12">
              <a href="javascript:void(0);" onclick="javascript:manutencao_caixa();">
              <strong>Atenção:</strong> Você está trabalhando com o caixa do dia <strong><?php echo data_mysql_para_user($dados_caixa['data_abertura']); ?></strong>.
              </a>
              <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            </div>
            </div>
          </div>
          
      <?php } ?> 


      <div class="container" id="tudo_conteudo">
      <div class="row row-xs" id="conteudo_geral"  >
        