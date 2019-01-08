<?php
require("../../config.php");

//UPDATE
if($id!=0){
	$grava = $db->select("UPDATE categorias_despesas SET categoria='$categoria'  WHERE id='$id' LIMIT 1");	

//INSERT
} else {
	$grava = $db->select("INSERT INTO categorias_despesas (categoria) VALUES ('$categoria')");	
}

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Categoria cadastrada com sucesso.';



//REDIRECIONA PARA A PÁGINA//
if(isset($retorno) && $retorno==1){
	header("Location: ".ADMIN_DIR."despesas-categorias-nova");
} else {
	header("Location: ".ADMIN_DIR."despesas-categorias");
}



?>