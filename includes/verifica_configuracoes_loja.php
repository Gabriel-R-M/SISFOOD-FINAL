<?php

////QTD DE MESAS///
$selecionax = $db->select("SELECT mesa FROM mesas LIMIT 1");
$dados_mesas = $db->expand($selecionax);


$selecionax = $db->select("SELECT * FROM configuracoes LIMIT 1");
$dados_configuracoes = $db->expand($selecionax);


///////ORDEM DE EXIBIÇÃO DE PRODUTOS/////////
$ordem_exibicao_produtos = "codigo";
if($dados_configuracoes['ordem_exibicao_produtos']=='' || $dados_configuracoes['ordem_exibicao_produtos']=='codigo'){
	$ordem_exibicao_produtos = "codigo";
} else if($dados_configuracoes['ordem_exibicao_produtos']=='nome'){
	$ordem_exibicao_produtos = "produto";
}





?>