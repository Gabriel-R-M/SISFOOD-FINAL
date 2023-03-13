<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");

$sql = $db->select("UPDATE produtos_venda SET impresso='2' WHERE id_venda='$id_venda' AND impresso='0'");

?>