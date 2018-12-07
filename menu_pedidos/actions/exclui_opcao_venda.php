<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");

if(isset($verifica_senha)){

	$del = $db->select("SELECT id FROM configuracoes WHERE senha_cancelamento='$senha_cancelamento_opcoes_pedido' LIMIT 1");	
	if(!$db->rows($del)){
		echo 0;
		exit();
	}
}

$del = $db->select("DELETE FROM opcionais_produtos_venda2 WHERE id='$id' LIMIT 1");

require("salva_totais_pedido.php");

?>