<?php
require_once("../../admin/class/class.db.php");
require_once("../../admin/class/class.seguranca.php");
require_once("../../includes/verifica_session.php");
require_once("../../includes/verifica_venda_aberta.php");
require_once("../../includes/verifica_cliente_venda.php");

	
$sql = $db->select("UPDATE aguarda_venda SET venda_fiscal='1' WHERE id='$id_venda' LIMIT 1");	



?>