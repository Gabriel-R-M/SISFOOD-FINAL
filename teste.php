<?php

	$caminho='c:\ACBrMonitorPLUS';

	///ATIVA O ECF///
	$ecf = 'SAT.Inicializar';
	$fp = fopen("$caminho\ENT.txt", "w");
	$escreve = fwrite($fp, $ecf);
	fclose($fp); 			


	$x=1;
	while($x==1){						
		if(file_exists("$caminho\sai.txt")){
			$x=2;
			//LÊ O ARQUIVO DE RESPOSTA//
			$ponteiro = fopen ("$caminho\sai.txt","r");
			echo $linha = trim(fgets($ponteiro));		
			fclose($ponteiro);	
			unlink("$caminho\sai.txt");	
			exit();				
		} else {
			sleep(.2);			
		}			
	}				
	///ATIVA O ECF///
		

		
?>