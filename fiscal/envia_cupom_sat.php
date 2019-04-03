<?php
require("../admin/class/class.db.php");
require("../admin/class/class.seguranca.php");
require("../includes/verifica_dados_loja.php");
require("../includes/verifica_dados_fiscais.php");
	

	function pega_linha($arq,$linha){
		$arquivo = file($arq);
		$y = $linha - 1;
		$x  = $arquivo[$y];	
		return $x;
	}

	$caminho_acbr=$dados_fiscais['caminho_acbr'];
	@unlink("$caminho_acbr\sai.txt");

	///ATIVA O ECF///
	$ecf = 'SAT.CriarEnviarCFe("'.$caminho_acbr.'\cupom.ini")';
	$fp = fopen("$caminho_acbr\ENT.txt", "w");
	$escreve = fwrite($fp, $ecf);
	fclose($fp); 			


	$x=1;
	while($x==1){						
		if(file_exists("$caminho_acbr\sai.txt")){
			$x=2;

			$retorno = pega_linha("$caminho_acbr\sai.txt",4);

			$pattern = '/' . 'CodigoDeRetorno' . '/';//Padrão a ser encontrado na string $tags
			if(preg_match($pattern, $retorno)) {
				  
				$ex = explode('=', $retorno);

				//ERRO
				if($ex[1]==6010){

					$erro = pega_linha("$caminho_acbr\sai.txt",6);
					$ex = explode('Resultado=', $erro);		
					$result = str_replace('0', '', $ex[1]);
					$result = str_replace('1', '', $result);
					$result = str_replace('2', '', $result);
					$result = str_replace('3', '', $result);
					$result = str_replace('4', '', $result);
					$result = str_replace('5', '', $result);
					$result = str_replace('6', '', $result);
					$result = str_replace('7', '', $result);
					$result = str_replace('8', '', $result);
					$result = str_replace('9', '', $result);
					$result = str_replace('|', '', $result);

					echo '0'.'&@&'.$result;

				///SUCESSO	
				} else if($ex[1]==6000){

					$sucesso = pega_linha("$caminho_acbr\sai.txt",3);
					$ex = explode('Arquivo=', $sucesso);	
					echo '1'.'&@&'.$ex[1];	

				//OUTRO RETORNO QUALQUER	
				} else {

					$erro = pega_linha("$caminho_acbr\sai.txt",6);
					echo '0'.'&@&'.$erro;

				}


			} else {
			 echo '0'.'&@&'.'Erro: ao enviar comando. Confira o log no ACBR.';
			}
			
			

			@unlink("$caminho_acbr\sai.txt");	
			exit();				

		} else {
			sleep(.2);			
		}			
	}				
	///ATIVA O ECF///
		

		
?>