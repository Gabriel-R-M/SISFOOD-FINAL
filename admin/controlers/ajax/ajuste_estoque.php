<?php
include_once("../../config.php");

$hoje = date("Y-m-d");
$hora = date("H:i");

//SOMA
if($tipo==1){
	$sel = $db->select("UPDATE lanches SET estoque=estoque+$est WHERE id='$id' LIMIT 1");
//DIMINUI
} else {
	$sel = $db->select("UPDATE lanches SET estoque=estoque-$est WHERE id='$id' LIMIT 1");
}


$sel = $db->select("INSERT INTO estoque_movimentacao (id_produto, quantidade, data, hora, tipo) VALUES ('$id', '$est', '$hoje', '$hora', '$tipo')");


?>