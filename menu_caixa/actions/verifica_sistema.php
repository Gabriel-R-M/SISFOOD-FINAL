<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");

unset($_SESSION['id_caixa_erp_sis'] );

$sel = $db->select("SELECT id FROM caixa WHERE data_fechamento='0000-00-00' ORDER BY id DESC LIMIT 1");

$sel_mesas = $db->select("SELECT mesa FROM mesas LIMIT 1");
$dados_mesas = $db->expand($sel_mesas);

$sel_pedidos = $db->select("SELECT modulo_entregas_pedidos FROM configuracoes LIMIT 1");
$dados_pedidos = $db->expand($sel_pedidos);

if($db->rows($sel)){
	echo '1'.'&@&'.$dados_mesas['mesa'].'&@&'.$dados_pedidos['modulo_entregas_pedidos'];
} else {
	echo '0'.'&@&'.$dados_mesas['mesa'].'&@&'.$dados_pedidos['modulo_entregas_pedidos'];
}


?>