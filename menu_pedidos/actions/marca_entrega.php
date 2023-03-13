<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");

if($tipo==1){
	$hora = date("H:i");
} else {
	$hora = '00:00:00';
}


if($entrega_ok==1){
	
	$sql = $db->select("SELECT finalizada FROM aguarda_venda WHERE id='$pedido' LIMIT 1");	
	$pei = $db->expand($sql);

	if($pei['finalizada']==1){
		$baixado=1;
	} else {
		$baixado=0;
	}	

	$sql = $db->select("UPDATE aguarda_venda SET pedido_entregue='$hora', baixado='$baixado' WHERE id='$pedido' LIMIT 1");	

} else {
	
	$sql = $db->select("UPDATE aguarda_venda SET pedido_entregue='00:00:00', entregador='$entregador', pedido_saiu_entrega='$hora', baixado='0' WHERE id='$pedido' LIMIT 1");


}


echo $hora;

?>