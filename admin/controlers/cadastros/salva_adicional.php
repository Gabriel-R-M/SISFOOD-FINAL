<?php
require("../../config.php");

//UPDATE
if($id!=0){
	$grava = $db->select("UPDATE opcionais SET opcional='$opcional', valor='$preco', ativo='$ativo' WHERE id='$id' LIMIT 1");	

//INSERT
} else {
	$grava = $db->select("INSERT INTO opcionais (opcional, valor, ativo) VALUES ('$opcional', '$preco', '$ativo')");
	$id = $db->last_id($grava);
}


//CATEGORIAS//
$grava = $db->select("DELETE FROM opcionais_categorias_relacao WHERE id_opcional='$id'");
$categorias = $_POST['categorias']; 
foreach($categorias as $k => $v){ 
	$categoria = $v; 
	$grava = $db->select("INSERT INTO opcionais_categorias_relacao (id_opcional, id_categoria) VALUES ('$id', '$categoria')");
}



$update = $db->select("UPDATE sistema SET aviso_update_internet='1'");

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