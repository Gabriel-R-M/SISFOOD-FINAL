<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_cliente_venda.php");

$valores_recebidos=0;
$sel = $db->select("SELECT valor_pagamento FROM pagamentos_vendas WHERE id_venda='$id_venda'");
while($x = $db->expand($sel)){
	$valores_recebidos = ($valores_recebidos+$x['valor_caixa_real']);	
}


$troco_levar=0;
if(!empty($troco_leva_maquina)){

	$troco_levar = ($troco_leva_maquina-($final_venda-$valores_recebidos));

}

if($troco_levar<0){
	$troco_levar = 0;
}
	
$sql = $db->select("UPDATE aguarda_venda SET  libera_taxa_garcom='$remove_taxa', valor_garcom='$soma_garcom', embala_viagem='$embala_viagem', pre_tipo_pagamento='$pre_tipo_pagamento', levar_troco='$troco_levar', levar_maquina_cartao='$levar_maquina_cartao', entregador='$entregador', troco_para='$troco_leva_maquina', id_mesa='$mesa', entrega='$entrega', valor_final_venda='$final_venda', aguarde='1', valor_entrega='$taxa_entrega', tipo_desc='$tipo_desconto', val_desc='$val_desc', valor_desconto='$desconto' WHERE id='$id_venda' LIMIT 1");	


//NOME DO CLIENTE NA VENDA//
if($dados_venda['nome_cliente']=='' || ($dados_venda['nome_cliente'] != $nome_cliente_mobile)){
	
	if(isset($nome_cliente_mobile) && !empty($nome_cliente_mobile) && $nome_cliente_mobile!='CLIENTE AVULSO'){		
		
		$sql = $db->select("UPDATE aguarda_venda SET nome_cliente='$nome_cliente_mobile' WHERE id='$id_venda' LIMIT 1");	
	
	} else {

		if($dados_cliente['nome']!='CLIENTE AVULSO'){
			$name = $dados_cliente['nome'];
			$sql = $db->select("UPDATE aguarda_venda SET nome_cliente='$name' WHERE id='$id_venda' LIMIT 1");
		}

	}


}

 


?>