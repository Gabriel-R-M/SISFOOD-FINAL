<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");

$dt = date("Y-m-d");
$hora = date("H:i:s");

$abre = $db->select("INSERT INTO caixa (id_usuario, data_abertura, hora_abertura, valor_inicial) VALUES ('$id_usuario', '$dt', '$hora', '$valor_inicial')");
$sel= $db->select("SELECT id FROM caixa ORDER BY id DESC LIMIT 1");
$fd = $db->expand($sel);
$id_cx_original = $fd['id'];

//$update = $db->select("UPDATE usuarios SET online='0' WHERE id!='$id_usuario'");

echo 1;

?>