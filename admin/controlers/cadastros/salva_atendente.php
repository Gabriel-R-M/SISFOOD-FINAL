<?php
require("../../config.php");

//UPDATE
if($id!=0){
	$insert = $db->select("UPDATE usuarios SET nome='$nome', usuario='$usuario', senha='$senha', nivel='$nivel', ativo='$ativo' WHERE id='$id' LIMIT 1");

//INSERT
} else {
	$insert = $db->select("INSERT INTO usuarios (nome, usuario, senha, nivel, ativo) VALUES ('$nome', '$usuario', '$senha', '$nivel', '$ativo')");
}

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Atendente cadastrado com sucesso.';


//REDIRECIONA PARA A PÁGINA//
if(isset($retorno) && $retorno==1){
	header("Location: ".ADMIN_DIR."novo-atendente");
} else {
	header("Location: ".ADMIN_DIR."atendentes");
}



?>