<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_cliente_venda.php");
require("../../includes/verifica_caixa_aberto.php");
require("../../includes/verifica_configuracoes_loja.php");

$data = date("Y-m-d");
$hora = date("H:i");
$data_hora = date("Y-m-d H:i");

$troco_recebe = str_replace('R$', '', $troco_recebe);
$troco_recebe = trim($troco_recebe);	


$valor_caixa_real = $valor_recebe;
//VALOR REAL QUE ENTRA NO CAIXA
if($troco_recebe!='0.00'){
	$valor_caixa_real = $valor_final_receber;
}

$sql = $db->select("INSERT INTO pagamentos_vendas (id_venda, forma_pagamento, valor_pagamento, troco_passado, id_usuario, data, hora, id_caixa, valor_caixa_real) VALUES ('$id_venda', '$forma_pagamento', '$valor_recebe', '$troco_recebe', '$id_usuario', '$data', '$hora', '$id_caixa_aberto', '$valor_caixa_real')");	



//VE O QUE AINDA DEVE
$valor_final_receber = $dados_venda['valor_final_venda'];
$total_recebido_venda=0;
$sel = $db->select("SELECT COALESCE(SUM(valor_caixa_real),0) AS total_recebido FROM pagamentos_vendas WHERE id_venda='$id_venda'");
if($db->rows($sel)){
	$dados_pgto = $db->expand($sel);
	$total_recebido_venda= ($total_recebido_venda+$dados_pgto['total_recebido']);
	$valor_final_receber = ($dados_venda['valor_final_venda']-$dados_pgto['total_recebido']);	
}


if($valor_final_receber<0){$valor_final_receber=0;}



////MARCA NA CONTA DO CLIENTE////
if($forma_pagamento==3){
	$sql = $db->select("INSERT INTO contas_clientes (id_cliente, id_venda, valor, data_debito, id_caixa_recebe, id_usuario) VALUES ('$id_cliente_venda', '$id_venda', '$valor_caixa_real','$data_hora', '$id_caixa_aberto', '$id_usuario')");	
}
/////////////////////////////////



////BAIXA DE PONTOS CASO HOUVER////
if($dados_configuracoes['modulo_pontuacao']==1){
	if($utiliza_resgate_pontos==1){ 

		$equivalencia_ponto = $dados_configuracoes['valor_ponto_troca'];
		$valor_troca_pontos = ($pontos_validos_troca*$equivalencia_ponto);

		$sql = $db->select("INSERT INTO pontuacao_usada (data, valor, equivalencia_ponto, id_cliente, qtd_pontos, id_usuario, id_caixa, id_venda) VALUES ('$data', '$valor_troca_pontos', '$equivalencia_ponto',  '$id_cliente_venda', '$pontos_validos_troca', '$id_usuario', '$id_caixa_aberto', '$id_venda')");	
	}
}
/////////////////////////////////





//FINALIZA A VENDA//
if($valor_final_receber==0){	

	$id_mesa_ocupou=$dados_venda['id_mesa'];	

	$sql = $db->select("UPDATE aguarda_venda SET finalizada='1', id_mesa='0', aguarde='0', ocupou_mesa='$id_mesa_ocupou'  WHERE id='$id_venda' LIMIT 1");

	@session_start();
	unset($_SESSION['id_caixa_erp_sis'] );
	$_SESSION['id_venda_erp_sis']=$id_venda;


	////TRANSFERE A VENDA PARA CLIENTE AVULSO CASO O TELEFONE SEJA VAZIO////
	if($dados_cliente['telefone']=='' && $dados_cliente['nome']!='CLIENTE AVULSO'){

		$peg = $db->select("SELECT id FROM clientes WHERE nome='CLIENTE AVULSO' ORDER BY id DESC LIMIT 1");
		if($db->rows($peg)){
			$linha = $db->expand($peg);			
			$id_cliente = $linha['id'];
			$cadastra=0;
		} else {
			$cadastra=1;
		}


		if($cadastra==1){
			$query = $db->select("INSERT INTO clientes (nome) VALUES ('CLIENTE AVULSO')");
			
			$peg = $db->select("SELECT id FROM clientes ORDER BY id DESC LIMIT 1");
			$linha = $db->expand($peg);
			
			$id_cliente = $linha['id'];
		}


		$sql = $db->select("UPDATE aguarda_venda SET id_cliente='$id_cliente' WHERE id='$id_venda' LIMIT 1");


		//APAGA O CLIENTE QUE TINHA APENAS O NOME//
		$sql = $db->select("DELETE FROM clientes WHERE id='$id_cliente_venda' LIMIT 1");



	}
	////////////////////////////////////////////////////////////////////////

}
////////////////////////




////////////////DEVOLVE VALORES/////////////////

if($valor_final_receber<0){$valor_final_receber=0;}
echo $valor_final_receber.'&@&'.$total_recebido_venda;

	


?>