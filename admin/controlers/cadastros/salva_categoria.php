<?php
require("../../config.php");

//UPDATE
if($id!=0){
	$grava = $db->select("UPDATE categorias SET csosn_categoria='$csosn_categoria', ncm_categoria='$ncm_categoria', cst_categoria='$cst_categoria', cfop_categoria='$cfop_categoria', categoria='$categoria', ativo='$ativo', ordem='$ordem', meio_meio='$meio_meio', adicionais='$adicionais', impressao='$impressao', imprime_codigo='$imprime_codigo' WHERE id='$id' LIMIT 1");	

//INSERT
} else {
	$grava = $db->select("INSERT INTO categorias (ncm_categoria, cst_categoria, cfop_categoria, categoria, ativo, ordem, meio_meio, adicionais, impressao, imprime_codigo) VALUES ('$ncm_categoria', '$cst_categoria', '$cfop_categoria', '$categoria','$ativo', '$ordem', '$meio_meio', '$adicionais', '$impressao', '$imprime_codigo')");	
}

$update = $db->select("UPDATE sistema SET aviso_update_internet='1'");

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Categoria cadastrada com sucesso.';


//REDIRECIONA PARA A PÁGINA//
if(isset($retorno) && $retorno==1){
	header("Location: ".ADMIN_DIR."nova-categoria");
} else {
	header("Location: ".ADMIN_DIR."categorias");
}


?>