<?php
require("../../config.php");

//UPDATE
if($id!=0){
	$grava = $db->select("UPDATE entregadores SET nome='$nome', telefone='$telefone', ativo='$ativo' WHERE id='$id' LIMIT 1");	

//INSERT
} else {
	$grava = $db->select("INSERT INTO entregadores (nome, telefone, ativo) VALUES ('$nome', '$telefone', '$ativo')");
}

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Entregador cadastrado com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."entregadores");

?>