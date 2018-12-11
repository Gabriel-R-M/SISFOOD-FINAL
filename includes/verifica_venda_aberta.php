<?php
@session_start();

if(isset($_SESSION['id_venda_erp_sis'])){

	$id_venda = $_SESSION['id_venda_erp_sis'];

	$seleciona = $db->select("SELECT * FROM aguarda_venda 	
	WHERE id='$id_venda' 	
	LIMIT 1");

} else {
	
	$seleciona = $db->select("SELECT * FROM aguarda_venda 	
	WHERE id_usuario='$id_usuario' AND finalizada='0' 
	ORDER BY aguarda_venda.id DESC 
	LIMIT 1");

}


$dados_venda = $db->expand($seleciona);
$id_venda = $dados_venda['id'];
$id_cliente_venda = $dados_venda['id_cliente'];


//echo 'venda: '.$id_venda;

$valor_final_receber = $dados_venda['valor_final_venda'];
$total_recebido_venda=0;
$sel = $db->select("SELECT COALESCE(SUM(valor_caixa_real),0) AS total_recebido FROM pagamentos_vendas WHERE id_venda='$id_venda'");
if($db->rows($sel)){
	$dados_pgto = $db->expand($sel);
	$total_recebido_venda=$dados_pgto['total_recebido'];
	$valor_final_receber = ($dados_venda['valor_final_venda']-$total_recebido_venda);	
}

if($valor_final_receber<0){$valor_final_receber=0;}

?>