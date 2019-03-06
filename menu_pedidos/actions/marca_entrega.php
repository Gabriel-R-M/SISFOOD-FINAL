<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");

if($tipo==1){
	$hora = date("H:i");
} else {
	$hora = '00:00:00';
}


if($entrega_ok==1){
	
	$sql = $db->select("UPDATE aguarda_venda SET pedido_entregue='$hora' WHERE id='$pedido' LIMIT 1");	

} else {
	
	$sql = $db->select("UPDATE aguarda_venda SET pedido_entregue='00:00:00', entregador='$entregador', pedido_saiu_entrega='$hora' WHERE id='$pedido' LIMIT 1");


}

?>