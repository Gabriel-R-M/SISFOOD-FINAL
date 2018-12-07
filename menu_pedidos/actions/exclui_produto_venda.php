<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");


if($pedido_aguarda_venda==1){

	$del = $db->select("SELECT id FROM configuracoes WHERE senha_cancelamento='$senha_cancelamento_item_pedido' LIMIT 1");	
	if(!$db->rows($del)){
		echo 0;
		exit();
	}

}

$delete = $db->select("DELETE FROM produtos_venda WHERE id='$id_prod_venda_cancelamento' LIMIT 1");	
$del = $db->select("DELETE FROM opcionais_produtos_venda WHERE id_controle='$id_prod_venda_cancelamento'");
$del = $db->select("DELETE FROM opcionais_produtos_venda2 WHERE id_controle='$id_prod_venda_cancelamento'");

require("salva_totais_pedido.php");

echo 1;
	
?>


