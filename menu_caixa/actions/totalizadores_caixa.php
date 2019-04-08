<?php


function retorna_data_abertura_caixa($id_caixa_aberto){


	$sel = $db->select("SELECT data_abertura FROM caixa WHERE id='$id_caixa_aberto' LIMIT 1");

	$row = $db->expand($sel);

	return $row['data_abertura'];
}


function totais_entregas_caixa($id_caixa_aberto){

	$db=new DB();
	$totais_entregas=0;
	

	$sel = $db->select("SELECT COUNT(*) AS total_entregas FROM aguarda_venda WHERE id_caixa='$id_caixa_aberto' AND entrega!='0' ORDER BY id DESC");
	if($db->rows($sel)){

		$row = $db->expand($sel);
		$totais_entregas = $row['total_entregas'];
	}

	if($totais_entregas>0 && $totais_entregas<10){
		$totais_entregas = '0'.$totais_entregas;
	}

	return $totais_entregas;
}

function devolve_valores_caixa($id_caixa_aberto,$tipo){

	$db=new DB();
	$totais_dinheiro=0;
	$totais_cartao=0;
	$totais_recebimento_convenio=0;

	//DINHEIRO OU CARTAO	
		$sel = $db->select("SELECT id FROM aguarda_venda WHERE id_caixa='$id_caixa_aberto' AND finalizada='1' ORDER BY id DESC");
		if($db->rows($sel)){
			while($row = $db->expand($sel)){

				$id_ven_procura = $row['id'];
				$sel2 = $db->select("SELECT valor_caixa_real, forma_pagamento FROM pagamentos_vendas WHERE id_venda='$id_ven_procura' ORDER BY id DESC");
				while($row2 = $db->expand($sel2)){

						//DINHEIRO
						if($row2['forma_pagamento']==1){
							$totais_dinheiro = ($totais_dinheiro+$row2['valor_caixa_real']);
						}

						//CARTÃO
						if($row2['forma_pagamento']==2){
							$totais_cartao = ($totais_cartao+$row2['valor_caixa_real']);
						}

				}

			}

		}	


	//CONVENIO	
		$sel = $db->select("SELECT valor FROM contas_clientes WHERE id_caixa_recebe='$id_caixa_aberto' AND tipo='1'");
		if($db->rows($sel)){
			while($row = $db->expand($sel)){
					$totais_recebimento_convenio = ($totais_recebimento_convenio+$row['valor']);
			}
		}


		//DINHEIRO
		if($tipo==1){
			return $totais_dinheiro;
		}

		//CARTAO
		if($tipo==2){
			return $totais_cartao;
		}

		//CONVENIO
		if($tipo==3){
			return $totais_recebimento_convenio;
		}

		//TOTAIS
		if($tipo==0){
			$subtotal_vendas = ($totais_dinheiro+$totais_cartao+$totais_recebimento_convenio);
			return $subtotal_vendas;
		}
}





function totais_caixa_separado_entrega_balcao($id_caixa_aberto,$tipo){

	$db=new DB();
	$totais=0;
	$busca='';

	//BALCAO E RETIRADA
	if($tipo==0){
		$busca = "AND entrega='0'";
	}

	//ENTREGAS
	if($tipo==1){
		$busca = "AND entrega!='0'";
	}

	//DINHEIRO OU CARTAO	
		$sel = $db->select("SELECT id FROM aguarda_venda WHERE id_caixa='$id_caixa_aberto' AND finalizada='1' $busca ORDER BY id DESC");
		if($db->rows($sel)){
			while($row = $db->expand($sel)){

				$id_ven_procura = $row['id'];
				$sel2 = $db->select("SELECT valor_caixa_real, forma_pagamento FROM pagamentos_vendas WHERE id_venda='$id_ven_procura' ORDER BY id DESC");
				while($row2 = $db->expand($sel2)){

						
						$totais = ($totais+$row2['valor_caixa_real']);
						

				}

			}

		}	


	
		return $totais;
		
}


///SAIDAS DE CAIXA
function devolve_saidas_caixa($id_caixa_aberto){

	$db=new DB();
	$totais_saidas_caixa=0;

	$sel = $db->select("SELECT valor_saida FROM saidas_caixa WHERE id_caixa='$id_caixa_aberto' ORDER BY id DESC");
	if($db->rows($sel)){
		while($row = $db->expand($sel)){
			$totais_saidas_caixa = ($totais_saidas_caixa+$row['valor_saida']);	
		}
	}
		
	return $totais_saidas_caixa;
	
}



///TROCO DE CAIXA
function devolve_troco_caixa($id_caixa_aberto){

	$db=new DB();
	$totais_troco_caixa=0;

	$sel = $db->select("SELECT valor_inicial FROM caixa WHERE id='$id_caixa_aberto' ORDER BY id DESC");
	$row = $db->expand($sel);
	$totais_troco_caixa = $row['valor_inicial'];	
		
	return $totais_troco_caixa;
	
}


///FINAL GERAL (VENDAS + TROCO - SAIDAS)
function devolve_final_caixa($id_caixa_aberto){

	$totais_final_geral=0;

	$subtotal_vendas = devolve_valores_caixa($id_caixa_aberto,0);
	$totais_troco_caixa = devolve_troco_caixa($id_caixa_aberto);
	$totais_saidas_caixa = devolve_saidas_caixa($id_caixa_aberto);

	$totais_final_geral = (($subtotal_vendas+$totais_troco_caixa)-$totais_saidas_caixa);

	return $totais_final_geral;
	
}








?>