<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_cliente_venda.php");


	
	$sql = $db->select("UPDATE aguarda_venda SET baixado='1', aguarde='0'  WHERE id='$id_venda' LIMIT 1");
	



?>