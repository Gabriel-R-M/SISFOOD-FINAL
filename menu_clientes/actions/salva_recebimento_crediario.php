<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_caixa_aberto.php");

$data_hora = date("Y-m-d H:i");

$troco_recebe = str_replace('R$', '', $troco_recebe);
$troco_recebe = trim($troco_recebe);	

if($valor_recebe>$restante_receber){
	$recebido = $restante_receber;
} else {
	$recebido = $valor_recebe;
}

$sql = $db->select("INSERT INTO contas_clientes (id_cliente, valor, data_pgto, id_caixa_recebe, id_usuario, tipo, valor_recebe, troco_passado, forma_pagamento) VALUES ('$id_cliente_crediario', '$recebido','$data_hora', '$id_caixa_aberto', '$id_usuario', '1', '$valor_recebe', '$troco_recebe', '$forma_pagamento')");	


echo $ultimo_id = $db->last_id($sql);
?>