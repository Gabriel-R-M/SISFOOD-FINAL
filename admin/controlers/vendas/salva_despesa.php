<?php
require("../../config.php");

//UPDATE
if($id!=0){
	$grava = $db->select("UPDATE despesas SET descricao='$descricao', categoria='$categoria', data='$data', hora='$hora', usuario='$usuario', valor='$gasto' WHERE id='$id' LIMIT 1");	

//INSERT
} else {
	$grava = $db->select("INSERT INTO despesas (descricao, categoria, data, hora, usuario, valor) VALUES ('$descricao', '$categoria', '$data', '$hora', '$id_usuario_logado', '$gasto')");
}

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Despesa cadastrada com sucesso.';


//REDIRECIONA PARA A PÁGINA//
if(isset($retorno) && $retorno==1){
	header("Location: ".ADMIN_DIR."despesas-nova");
} else {
	header("Location: ".ADMIN_DIR."despesas-relatorio");
}



?>