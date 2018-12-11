<?php
include_once("../admin/class/class.db.php");
include_once("../admin/class/class.seguranca.php");
include_once("verifica_configuracoes_loja.php");

$pontuacao_cliente=0;
$desconto_reais = 0;
$pontuacao_usada = 0;
$pontuacao_expirada=0;

$hoje = date("Y-m-d");
$dias_expira_pontos = $dados_configuracoes['dias_expira_pontos'];

//DATA LIMITE PARA EXPIRAR PONTOS//
$data_pesquisa = date('Y-m-d',strtotime("-$dias_expira_pontos day")); 


///PEGA O VALOR TOTAL DE VENDAS//
$selecionax = $db->select("SELECT SUM(valor_final_venda) AS total_gasto_cliente 
	FROM aguarda_venda 
	WHERE  finalizada='1' AND id_cliente='$id_cliente_venda'
	LIMIT 1");
if($db->rows($selecionax)){
	$dados_pontuacao_cliente = $db->expand($selecionax);
	$pontuacao_cliente = $dados_pontuacao_cliente['total_gasto_cliente'];
	if($pontuacao_cliente==''){
		$pontuacao_cliente=0;
	}
}


///PEGA PONTOS JÁ UTILIZADOS///
$selecionax = $db->select("SELECT SUM(qtd_pontos) AS qtd_pontos_final 
	FROM pontuacao_usada 
	WHERE id_cliente='$id_cliente_venda'
	");
if($db->rows($selecionax)){
	$dados_pontuacao_usada = $db->expand($selecionax);
	$pontuacao_usada = $dados_pontuacao_usada['qtd_pontos_final'];
	if($pontuacao_usada==''){
		$pontuacao_usada=0;
	}
}

$pontuacao_cliente = floor($pontuacao_cliente); 


//GANHA - UTILIZADA
$pontuacao_cliente = ($pontuacao_cliente-$pontuacao_usada);
if($pontuacao_cliente<0){$pontuacao_cliente=0;}



///PEGA PONTOS VÁLIDOS///
if($pontuacao_cliente>0){

	///PEGA O VALOR TOTAL DE VENDAS//
	$selecionax = $db->select("SELECT SUM(valor_final_venda) AS total_gasto_cliente 
		FROM aguarda_venda 
		WHERE data_pedido<='$data_pesquisa' AND finalizada='1' AND id_cliente='$id_cliente_venda'
		LIMIT 1");
	if($db->rows($selecionax)){
		$dados_pontuacao_cliente = $db->expand($selecionax);
		$pontuacao_expirada = $dados_pontuacao_cliente['total_gasto_cliente'];
		if($pontuacao_expirada==''){
			$pontuacao_expirada=0;
		}
	}

}



$pontuacao_cliente = ($pontuacao_cliente-$pontuacao_expirada);


if($pontuacao_cliente<0){
	$pontuacao_cliente=0;
} else {
	$pontuacao_cliente = floor($pontuacao_cliente); 
}



if($pontuacao_cliente>0){	
	$equivalencia_reais_pontos = $dados_configuracoes['valor_ponto_troca'];
	$desconto_reais = ($pontos_validos*$equivalencia_reais_pontos);
} 

if(isset($exibe_pontos)){
	if($pontuacao_cliente<10){$pontuacao_cliente = '0'.$pontuacao_cliente;}
	echo $pontuacao_cliente;
}
?>