<?php
require("../../config.php");

	$grava = $db->select("UPDATE configuracoes SET  modulo_internet='$modulo_internet'");



	//REMOVE A ULTIMA BARRA
	$final = substr($url_servidor_pedidos, -1);
	if($final=='/'){
		$size = strlen($url_servidor_pedidos);
		$url_servidor_pedidos = substr($url_servidor_pedidos,0, $size-1);
	}

	$grava = $db->select("UPDATE sistema  SET  url_servidor_pedidos='$url_servidor_pedidos'");	

   

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Módulo WEB atualizado com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."modulos-internet");

?>