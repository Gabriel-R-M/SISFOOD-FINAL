<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");

if($tipo==1){
	$hora = date("H:i");
} else {
	$hora = '00:00:00';
}

$samba = $db->select("UPDATE aguarda_venda SET entregador='$entregador', pedido_entregue='$hora' WHERE id='$pedido' LIMIT 1");

?>