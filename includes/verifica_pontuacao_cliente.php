<?php
include_once("../admin/class/class.db.php");
include_once("../admin/class/class.seguranca.php");
include_once("verifica_configuracoes_loja.php");

$pontuacao_cliente=0;
$desconto_reais = 0;
$pontuacao_usada = 0;
$pontuacao_expirada=0;
$pontos_ganhos=0;
$pontos_emdia=0;

$hoje = date("Y-m-d");
$dias_expira_pontos = $dados_configuracoes['dias_expira_pontos'];
$data_pesquisa = date('Y-m-d',strtotime("-$dias_expira_pontos day")); 					
 


$sel = $db->select("SELECT data_pedido, valor_final_venda FROM aguarda_venda WHERE finalizada='1' AND id_cliente='$id_cliente_venda' ORDER BY id DESC");
if($db->rows($sel)){
while($dados = $db->expand($sel)){

	//VALIDOS
	if($dados['data_pedido']>=$data_pesquisa){

		$equivalencia_reais_pontos = $dados_configuracoes['valor_real_ponto'];
		$pontos_aguarda = ($dados['valor_final_venda']*$equivalencia_reais_pontos);	
		$pontos_emdia = ($pontos_emdia+$pontos_aguarda);

	//EXPIRADOS	
	} else {

		$equivalencia_reais_pontos = $dados_configuracoes['valor_real_ponto'];
		$pontos_aguarda = ($dados['valor_final_venda']*$equivalencia_reais_pontos);	
		$pontuacao_expirada = ($pontuacao_expirada+$pontos_aguarda);

	}

	$equivalencia_reais_pontos = $dados_configuracoes['valor_real_ponto'];
	$pontos_aguarda = ($dados['valor_final_venda']*$equivalencia_reais_pontos);	
	$pontos_ganhos = ($pontos_ganhos+$pontos_aguarda);
	$pontos_ganhos = floor($pontos_ganhos); 
	

	$pontos_emdia = floor($pontos_emdia); 
	$pontuacao_expirada = floor($pontuacao_expirada); 


}
}



///USADOS///
$sel = $db->select("SELECT * FROM pontuacao_usada WHERE id_cliente='$id_cliente_venda' ORDER BY id DESC");
if($db->rows($sel)){
while($dados = $db->expand($sel)){
	$pontuacao_usada = ($pontuacao_usada+$dados['qtd_pontos']);
}
}

if($pontos_emdia>0){

	$final = ($pontos_ganhos-$pontuacao_usada);	

	if($final>$pontos_emdia){
		$final=$pontos_emdia;
	}

	
} else {
	$final = 0;
}

if($final<0){$final=0;}


if(!isset($return)){
	echo $final;
} 

