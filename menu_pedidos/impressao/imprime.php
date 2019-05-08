<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_configuracoes_loja.php");
require("../../includes/verifica_venda_aberta.php");


function impressao_tipo1($arquivo){

	$db = new DB();	
	$selecionax = $db->select("SELECT * FROM configuracoes LIMIT 1");
	$dados_configuracoes = $db->expand($selecionax);


	//////////IMPRESSORA PRINCIPAL//////////
	if(!empty($dados_configuracoes['impressora_principal'])){

		$fh = fopen("../../pedidos_imprimir/".$arquivo, "rb");
		$content = fread($fh, filesize("../../pedidos_imprimir/".$arquivo));
		fclose($fh);

		if(!empty($content)){

			$printer_principal = $dados_configuracoes['impressora_principal'];
			if($ph = printer_open($printer_principal)){
	   			   			

				   		printer_start_doc($ph, "IMPRESSAO"); // Name Document 
						printer_start_page($ph); // Start Logo
					       
					   		printer_set_option($ph, PRINTER_MODE, "RAW");
					   		printer_write($ph, $content);	
		
					   	
					   	printer_end_page($ph);
						printer_end_doc($ph);

						printer_close($ph);

						unlink("../../pedidos_imprimir/".$arquivo);	
						sleep(2);

			}				

		}

	}
	////////////////////////////////
}



function impressao_tipo2($arquivo){


	$db = new DB();	
	$selecionax = $db->select("SELECT * FROM configuracoes LIMIT 1");
	$dados_configuracoes = $db->expand($selecionax);


	//////////IMPRESSORA PRINCIPAL//////////
	if(!empty($dados_configuracoes['impressora_principal'])){

		$fh = fopen("../../pedidos_imprimir/".$arquivo, "rb");
		$content = fread($fh, filesize("../../pedidos_imprimir/".$arquivo));
		fclose($fh);

		if(!empty($content)){

			$printer_principal = $dados_configuracoes['impressora_principal'];
			if($ph = printer_open($printer_principal)){
	   			   			

				   		printer_start_doc($ph, "IMPRESSAO"); // Name Document 
						printer_start_page($ph); // Start Logo
					       
					   		printer_set_option($ph, PRINTER_MODE, "RAW");
					   		printer_write($ph, $content);	
		
					   	
					   	printer_end_page($ph);
						printer_end_doc($ph);

						printer_close($ph);
						
						sleep(2);

			}				

		}

	}
	////////////////////////////////


	//////////IMPRESSORA SECUNDARIA//////////
	if(!empty($dados_configuracoes['impressora_secundaria'])){

		$fh = fopen("../../pedidos_imprimir/".$arquivo, "rb");
		$content = fread($fh, filesize("../../pedidos_imprimir/".$arquivo));
		fclose($fh);

		if(!empty($content)){

			$printer_principal = $dados_configuracoes['impressora_secundaria'];
			if($ph = printer_open($printer_principal)){
	   			   			

				   		printer_start_doc($ph, "IMPRESSAOSECUNDARIA"); // Name Document 
						printer_start_page($ph); // Start Logo
					       
					   		printer_set_option($ph, PRINTER_MODE, "RAW");
					   		printer_write($ph, $content);	
		
					   	
					   	printer_end_page($ph);
						printer_end_doc($ph);

						printer_close($ph);

						unlink("../../pedidos_imprimir/".$arquivo);	
						sleep(2);

			}				

		}

	} else {
		unlink("../../pedidos_imprimir/".$arquivo);		
	}
	////////////////////////////////

	
}





function impressao_tipo3($arquivo){


	$db = new DB();	
	$selecionax = $db->select("SELECT * FROM configuracoes LIMIT 1");
	$dados_configuracoes = $db->expand($selecionax);

	$prisn = substr($arquivo,0,4);

if($prisn!='coz_'){
	//////////IMPRESSORA PRINCIPAL//////////
	if(!empty($dados_configuracoes['impressora_principal'])){

		$fh = fopen("../../pedidos_imprimir/".$arquivo, "rb");
		$content = fread($fh, filesize("../../pedidos_imprimir/".$arquivo));
		fclose($fh);

		if(!empty($content)){

			$printer_principal = $dados_configuracoes['impressora_principal'];
			if($ph = printer_open($printer_principal)){
	   			   			

				   		printer_start_doc($ph, "IMPRESSAO"); // Name Document 
						printer_start_page($ph); // Start Logo
					       
					   		printer_set_option($ph, PRINTER_MODE, "RAW");
					   		printer_write($ph, $content);	
		
					   	
					   	printer_end_page($ph);
						printer_end_doc($ph);

						printer_close($ph);
						
						unlink("../../pedidos_imprimir/".$arquivo);	
						sleep(2);

			}				

		}

	}
}
	////////////////////////////////

if($prisn=='coz_'){
	//////////IMPRESSORA SECUNDARIA//////////
	if(!empty($dados_configuracoes['impressora_secundaria'])){

		$fh = fopen("../../pedidos_imprimir/".$arquivo, "rb");
		$content = fread($fh, filesize("../../pedidos_imprimir/".$arquivo));
		fclose($fh);

		if(!empty($content)){

			$printer_principal = $dados_configuracoes['impressora_secundaria'];
			if($ph = printer_open($printer_principal)){
	   			   			

				   		printer_start_doc($ph, "IMPRESSAOSECUNDARIA"); // Name Document 
						printer_start_page($ph); // Start Logo
					       
					   		printer_set_option($ph, PRINTER_MODE, "RAW");
					   		printer_write($ph, $content);	
		
					   	
					   	printer_end_page($ph);
						printer_end_doc($ph);

						printer_close($ph);

						unlink("../../pedidos_imprimir/".$arquivo);	
						sleep(2);

			}				

		}

	} else {
		unlink("../../pedidos_imprimir/".$arquivo);		
	}
	////////////////////////////////
}

	
}







$sel = $db->select("SELECT usando FROM arquivos_imprimir LIMIT 1");
if(!$db->rows($sel)){	

$insert = $db->select("INSERT INTO arquivos_imprimir (usando) VALUES ('1')");

$path = "../../pedidos_imprimir/";
$diretorio = dir($path);
 
while($arquivo = $diretorio -> read() ){
	if($arquivo!='..' && $arquivo!='.' && $arquivo!='cozinha'){		
		
		
		if($tipo==1){impressao_tipo1($arquivo);}
		if($tipo==2){impressao_tipo2($arquivo);}
		if($tipo==3){impressao_tipo3($arquivo);}
		///if($tipo==4){impressao_tipo4($arquivo);}
	
		
		ob_flush();
        flush();		
	}
}
$diretorio -> close();
$del = $db->select("DELETE FROM arquivos_imprimir");

echo 1;

} else {

	echo 0;
}



?>