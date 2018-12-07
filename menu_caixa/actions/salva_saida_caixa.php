<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_caixa_aberto.php");

$dt = date("Y-m-d");
$hora = date("H:i:s");

$abre = $db->select("INSERT INTO saidas_caixa (id_caixa, valor_saida, motivo, id_usuario, data, hora) VALUES ('$id_caixa_aberto', '$valor_saida_caixa', '$motivo_saida_caixa', '$id_usuario', '$dt', '$hora')");

echo 1;

?>