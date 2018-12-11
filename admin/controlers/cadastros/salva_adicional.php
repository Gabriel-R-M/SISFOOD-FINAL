<?php
require("../../config.php");

//UPDATE
if($id!=0){
	$grava = $db->select("UPDATE opcionais SET opcional='$opcional', valor='$preco', ativo='$ativo' WHERE id='$id' LIMIT 1");	

//INSERT
} else {
	$grava = $db->select("INSERT INTO opcionais (opcional, valor, ativo) VALUES ('$opcional', '$preco', '$ativo')");
}

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Adicional cadastrada com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."adicionais");

?>