<?php
require("../../config.php");

//UPDATE
if($id!=0){
	$grava = $db->select("UPDATE tamanhos SET tamanho='$tamanho', id_categoria='$id_categoria', opcao_obrigatoria='$opcao_obrigatoria' WHERE id='$id' LIMIT 1");

//INSERT
} else {
	$grava = $db->select("INSERT INTO tamanhos (tamanho, id_categoria, opcao_obrigatoria) VALUES ('$tamanho', '$id_categoria', '$opcao_obrigatoria')");	
}

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Variação cadastrada com sucesso.';


//REDIRECIONA PARA A PÁGINA//
if(isset($retorno) && $retorno==1){
	header("Location: ".ADMIN_DIR."nova-variacao");
} else {
	header("Location: ".ADMIN_DIR."variacoes");
}


?>