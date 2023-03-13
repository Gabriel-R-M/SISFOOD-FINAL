<?php
require("../../config.php");
$dt = date("Y-m-d");
$numero_cartao=0;

//UPDATE
if($id!=0){
	$query = $db->select("UPDATE clientes SET cartao='$numero_cartao', nome='$nome', ddd='$ddd', telefone='$numero_telefone', celular='$celular', endereco='$endereco', numero='$numero', complemento='$complemento', bairro='$bairro', cidade='$cidade' WHERE id='$id' LIMIT 1");

//INSERT
} else {
	$query = $db->select("INSERT INTO clientes (data_cadastro, cartao, nome, ddd, telefone, celular, endereco, numero, complemento, bairro, cidade) VALUES ('$dt', '$numero_cartao', '$nome', '$ddd', '$numero_telefone', '$celular', '$endereco', '$numero', '$complemento', '$bairro', '$cidade')");
}

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Cliente cadastrado com sucesso.';

//REDIRECIONA PARA A PÁGINA//
if(isset($retorno) && $retorno==1){
	header("Location: ".ADMIN_DIR."novo-cliente");
} else {
	header("Location: ".ADMIN_DIR."clientes");
}

?>