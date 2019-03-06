<?php

	$caminho='c:\ACBrMonitorPLUS';
	@unlink("$caminho\sai.txt");

	///ATIVA O ECF///
	$ecf = 'SAT.CriarEnviarCFe("'.$caminho.'\Cupom.INI")';
	$fp = fopen("$caminho\ENT.txt", "w");
	$escreve = fwrite($fp, $ecf);
	fclose($fp); 			


	$x=1;
	while($x==1){						
		if(file_exists("$caminho\sai.txt")){
			$x=2;
			//LÊ O ARQUIVO DE RESPOSTA//
			//$ponteiro = fopen ("$caminho\sai.txt","r");
			//echo $linha = trim(fgets($ponteiro));		
			//fclose($ponteiro);	
			$arquivo = fopen ("$caminho\sai.txt", 'r');	
			while(!feof($arquivo)){
				$linha = fgets($arquivo, 1024);
				echo $linha.'<br />';
			}
			fclose($arquivo);	

			unlink("$caminho\sai.txt");	
			exit();				
		} else {
			sleep(.2);			
		}			
	}				
	///ATIVA O ECF///
		

		
?>