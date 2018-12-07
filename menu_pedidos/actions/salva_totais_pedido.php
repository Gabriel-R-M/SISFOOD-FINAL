<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");
include_once("../../includes/verifica_venda_aberta.php");

	$total_geral_produtos=0;
	$total_geral_adicionais=0;
	$total_geral_opcoes=0;

	$sql = $db->select("SELECT * FROM produtos_venda WHERE id_venda='$id_venda' ORDER BY id DESC");
	if($db->rows($sql)){

		while($row = $db->expand($sql)){
		
				$id_controle = $row['id'];

				$total_adicionais=0;
				$adc = $db->select("SELECT valor_opcional FROM opcionais_produtos_venda WHERE id_controle='$id_controle' ORDER BY id DESC");
				if($db->rows($adc)){
					while($sib = $db->expand($adc)){

						$total_adicionais = ($total_adicionais+($sib['valor_opcional']*$row['quantidade']));
						
					}
				}


				$total_opcoes=0;
				$adc = $db->select("SELECT valor_opcional FROM opcionais_produtos_venda2 WHERE id_controle='$id_controle' ORDER BY id DESC");
				if($db->rows($adc)){
					while($sib = $db->expand($adc)){

						$total_opcoes = ($total_opcoes+($sib['valor_opcional']*$row['quantidade']));
						
					}
				}

				$total_item = ($row['valor']*$row['quantidade']);
				
				$total_geral_produtos = ($total_geral_produtos+$total_item);
				$total_geral_opcoes = ($total_geral_opcoes+$total_opcoes);
				$total_geral_adicionais = ($total_geral_adicionais+$total_adicionais+$total_geral_opcoes);
				

		}
	}






	//PEGA VALOR ENTREGA
	$sql = $db->select("SELECT valor_desconto, valor_entrega FROM aguarda_venda  WHERE id='$id_venda' LIMIT 1");	
	$naq = $db->expand($sql);

	$valor_desconto = $naq['valor_desconto'];
	$valor_entrega = $naq['valor_entrega'];

	$total_pedido = ($total_geral_produtos+$total_geral_adicionais);
	$total_final = ((($total_geral_produtos+$total_geral_adicionais)-$valor_desconto)+$valor_entrega);

	$sql = $db->select("UPDATE aguarda_venda SET valor_total='$total_pedido', valor_produtos='$total_geral_produtos', valor_acrescimos='$total_geral_adicionais', valor_final_venda='$total_final' WHERE id='$id_venda' LIMIT 1");	


	echo number_format($total_final,2,",",".");


?>