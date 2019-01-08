<?php include("includes/topo.php"); ?>

<?php
	error_reporting(0);
	ini_set('display_errors', 0 );
	
	//CRIA CAMPOS//
	$sql = $db->select("ALTER TABLE configuracoes ADD modulo_entregas INT(1) NOT NULL");
	$sql = $db->select("ALTER TABLE configuracoes ADD modulo_pontuacao INT(1) NOT NULL");
	$sql = $db->select("ALTER TABLE configuracoes ADD valor_real_ponto DOUBLE(10,2) NOT NULL");
	$sql = $db->select("ALTER TABLE configuracoes ADD valor_ponto_troca DOUBLE(10,2) NOT NULL");
	$sql = $db->select("ALTER TABLE configuracoes ADD dias_expira_pontos INT(10) NOT NULL");
	$sql = $db->select("ALTER TABLE configuracoes ADD escolhe_motoqueiro INT(10) NOT NULL");
	$sql = $db->select("ALTER TABLE configuracoes ADD impressao_avulsa_item VARCHAR(99) NOT NULL");
	$sql = $db->select("ALTER TABLE configuracoes ADD ordem_exibicao_produtos VARCHAR(20) NOT NULL");
	$sql = $db->select("ALTER TABLE aguarda_venda ADD nome_cliente VARCHAR(100) NOT NULL");
	$sql = $db->select("ALTER TABLE aguarda_venda ADD pedido_entregue TIME NOT NULL");
	$sql = $db->select("ALTER TABLE produtos_venda ADD impresso INT(10) NOT NULL");
	$sql = $db->select("ALTER TABLE aguarda_venda ADD ocupou_mesa INT(10) NOT NULL");
	$sql = $db->select("ALTER TABLE tamanhos ADD opcao_obrigatoria INT(1) NOT NULL");
	$sql = $db->select("UPDATE produtos_venda SET impresso='1'");
	$sql = $db->select("UPDATE configuracoes SET ordem_exibicao_produtos='codigo'");

	$sql = $db->select("ALTER TABLE lanches CHANGE codigo codigo VARCHAR(90) NOT NULL;");
	$sql = $db->select("ALTER TABLE dados_loja ADD inscricao_estadual VARCHAR(99) NOT NULL");


	
	

	//RODA O SCRIPT//
	$nome_do_arquivo = "atualizacoes/atualizacoes.sql"; 
	if(file_exists($nome_do_arquivo)){	
		$arquivo = Array();
		$arquivo = file($nome_do_arquivo);  
		$prepara = "";  
		foreach($arquivo as $v)$prepara.=$v; 
		echo $sql = explode(";",$prepara); 
		foreach($sql as $v) $db->select($v);
		
		//RENOMEIA PARA NAO FAZER DENOVO//
		//$renomeia = 'atualizacoes/ANTIGO_'.date('d-m-y').'_atualizacoes.sql';
		//rename($nome_do_arquivo, $renomeia);
	}
	

	

	echo '<br><center><h1>SISTEMA ATUALIZADO</h1></center>';


?>	


	
<?php include("includes/rodape.php"); ?>