<?php
require("../admin/class/class.db.php");
require("../admin/class/class.seguranca.php");
require("../includes/verifica_dados_fiscais.php");


	$caminho_acbr=$dados_fiscais['caminho_acbr'];
	@unlink("$caminho_acbr\sai.txt");	

	////REIMPRESSAO DE CUPOM/////
	if(isset($venda_pesquisa) && $venda_pesquisa!=0){
		require("../includes/verifica_venda_aberta.php");		
		$arquivo_imprimir = $dados_venda['xml_fiscal'];
	}
	

	if(!empty($dados_fiscais['impressora_fiscal'])){
		$ecf = 'SAT.ImprimirExtratoVenda("'.$arquivo_imprimir.'", "'.$dados_fiscais['impressora_fiscal'].'")';
	} else {
		$ecf = 'SAT.ImprimirExtratoVenda("'.$arquivo_imprimir.'")';	
	}

	
	 
	$fp = fopen("$caminho_acbr\ENT.txt", "w");
	$escreve = fwrite($fp, $ecf);
	fclose($fp); 			


	$x=1;
	while($x==1){						
		if(file_exists("$caminho_acbr\sai.txt")){
			$x=2;
			//LÊ O ARQUIVO DE RESPOSTA//
			$ponteiro = fopen ("$caminho_acbr\sai.txt","r");
			$linha = trim(fgets($ponteiro));		

	

			fclose($ponteiro);	
			@unlink("$caminho_acbr\sai.txt");	
			exit();				
		} else {
			sleep(.2);			
		}			
	}				
	///INICIALIZA O SAT///
		

		
?>