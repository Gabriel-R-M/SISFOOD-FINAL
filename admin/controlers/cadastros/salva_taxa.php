<?php
require("../../config.php");

//UPDATE
if($id!=0){
	$insert = $db->select("UPDATE tipos_entrega SET entrega='$entrega', valor='$preco', ativo='$ativo' WHERE id='$id' LIMIT 1");

//INSERT
} else {
	$insert = $db->select("INSERT INTO tipos_entrega (entrega, valor, ativo) VALUES ('$entrega', '$preco', '$ativo')");
}

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Taxa cadastrada com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."taxas");

?>