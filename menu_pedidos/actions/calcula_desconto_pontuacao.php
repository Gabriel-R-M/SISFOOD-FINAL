<?php 
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_configuracoes_loja.php");

$equivalencia_reais_pontos = $dados_configuracoes['valor_ponto_troca'];
$desconto = ($final*$equivalencia_reais_pontos);
echo number_format($desconto,2,".",",");				

?>