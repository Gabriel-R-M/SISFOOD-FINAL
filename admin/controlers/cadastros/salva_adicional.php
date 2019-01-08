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
$_SESSION['avisos-admin-sis-frase'] = 'Adicional cadastrado com sucesso.';


//REDIRECIONA PARA A PÁGINA//
if(isset($retorno) && $retorno==1){
	header("Location: ".ADMIN_DIR."novo-adicional");
} else {
	header("Location: ".ADMIN_DIR."adicionais");
}


?>