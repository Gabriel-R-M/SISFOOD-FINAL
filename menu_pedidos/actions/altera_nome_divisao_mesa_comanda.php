<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");

$samba = $db->select("UPDATE produtos_venda SET nome_cliente_divisao='$nome' WHERE id='$id' LIMIT 1");

?>