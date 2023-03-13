<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");


if(isset($verifica_senha)){

	$del = $db->select("SELECT id FROM configuracoes WHERE senha_cancelamento='$senha_cancelamento' LIMIT 1");	
	if(!$db->rows($del)){
		echo 0;
		exit();
	}

}





if(isset($id_venda_cancela)){
	$id_venda = $id_venda_cancela;
}
	

	///VOLTA PRODUTOS NO ESTOQUE////
	$sql_estoque = $db->select("SELECT id_produtos, quantidade FROM produtos_venda WHERE id_venda='$id_venda' ORDER BY id DESC");
	if($db->rows($sql_estoque)){
		while($estoque = $db->expand($sql_estoque)){

			$qtd_baixa = $estoque['quantidade'];
			$prod_baixa = $estoque['id_produtos'];

			if(is_numeric($prod_baixa)){
				$sql = $db->select("UPDATE lanches SET estoque=estoque+$qtd_baixa WHERE id='$prod_baixa' LIMIT 1");				
			}

		}
	}


$del = $db->select("DELETE FROM estoque_movimentacao WHERE id_venda='$id_venda'");
$del = $db->select("DELETE FROM produtos_venda WHERE id_venda='$id_venda'");
$del = $db->select("DELETE FROM opcionais_produtos_venda WHERE id_venda='$id_venda' ");
$del = $db->select("DELETE FROM opcionais_produtos_venda2 WHERE id_venda='$id_venda' ");
$del = $db->select("DELETE FROM pagamentos_vendas WHERE id_venda='$id_venda'");
$del = $db->select("DELETE FROM contas_clientes WHERE id_venda='$id_venda'");
$del = $db->select("DELETE FROM aguarda_venda WHERE id='$id_venda' LIMIT 1");

			
echo 1;
	
?>
