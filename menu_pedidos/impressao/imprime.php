<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_configuracoes_loja.php");
require("../../includes/verifica_venda_aberta.php");




//IMPRESSÃO COMPLETA DO PEDIDO IGUAL NAS DUAS IMPRESSORAS
if($tipo==1){

	if(!empty($dados_configuracoes['impressora_principal'])){
		$printer_principal = $dados_configuracoes['impressora_principal'];
		if($ph = printer_open($printer_principal)){
	   		$fh = fopen("../../pedidos_imprimir/pedido.txt", "rb");
	   		$content = fread($fh, filesize("../../pedidos_imprimir/pedido$id_venda.txt"));
	   		fclose($fh);
	       
	   		printer_start_doc($ph, "IMPRESSAO"); // Name Document 
			printer_start_page($ph); // Start Logo
		       
		   		printer_set_option($ph, PRINTER_MODE, "RAW");
		   		printer_write($ph, $content);

		   	printer_end_page($ph);
			printer_end_doc($ph);
			//printer_abort($ph);

			printer_close($ph);
		}
	}


	if(!empty($dados_configuracoes['impressora_secundaria'])){
		$printer_principal = $dados_configuracoes['impressora_secundaria'];
		if($ph = printer_open($printer_principal)){
	   		$fh = fopen("../../pedidos_imprimir/pedido.txt", "rb");
	   		$content = fread($fh, filesize("../../pedidos_imprimir/pedido$id_venda.txt"));
	   		fclose($fh);
	       
	   		printer_start_doc($ph, "IMPRESSAO"); // Name Document 
			printer_start_page($ph); // Start Logo
		       
		   		printer_set_option($ph, PRINTER_MODE, "RAW");
		   		printer_write($ph, $content);

		   	printer_end_page($ph);
			printer_end_doc($ph);
			//printer_abort($ph);

			printer_close($ph);
		}
	}

}




//IMPRESSÃO COMPLETA DO PEDIDO APENAS NO CAIXA
if($tipo==11){

	if(!empty($dados_configuracoes['impressora_principal'])){
		$printer_principal = $dados_configuracoes['impressora_principal'];
		if($ph = printer_open($printer_principal)){
	   		$fh = fopen("../../pedidos_imprimir/pedido.txt", "rb");
	   		$content = fread($fh, filesize("../../pedidos_imprimir/pedido$id_venda.txt"));
	   		fclose($fh);
	       
	   		printer_start_doc($ph, "IMPRESSAO"); // Name Document 
			printer_start_page($ph); // Start Logo
		       
		   		printer_set_option($ph, PRINTER_MODE, "RAW");
		   		printer_write($ph, $content);

		   	printer_end_page($ph);
			printer_end_doc($ph);
			//printer_abort($ph);

			printer_close($ph);
		}
	}

}


//IMPRESSÃO PICADO DO PEDIDO APENAS NA COZINHA
if($tipo==12){

	if(!empty($dados_configuracoes['impressora_secundaria'])){
		$printer_principal = $dados_configuracoes['impressora_secundaria'];
		if(file_exists("../../pedidos_imprimir/cozinha/$arquivo_impressao")){
				
			if($ph = printer_open($printer_principal)){
				$fh = fopen("../../pedidos_imprimir/cozinha/$arquivo_impressao", "rb");
				$content = fread($fh, filesize("../../pedidos_imprimir/cozinha/$arquivo_impressao"));
				fclose($fh);
				       
				printer_start_doc($ph, "IMPRESSAO"); // Name Document 
				printer_start_page($ph); // Start Logo
					       
					printer_set_option($ph, PRINTER_MODE, "RAW");
					printer_write($ph, $content);

				printer_end_page($ph);
				printer_end_doc($ph); 
				//printer_abort($ph);

				printer_close($ph);
			}


		}
		 
	}

}




//IMPRESSÃO DE ÍTEM
if($tipo==2){

	$select = $db->select("SELECT impressao FROM categorias WHERE id='$categoria_produto' LIMIT 1");
	$imp = $db->expand($select);

	

	if(!empty($imp['impressao'])){

		if($imp['impressao']=='principal'){$impressora = $dados_configuracoes['impressora_principal'];}
		if($imp['impressao']=='secundaria'){$impressora = $dados_configuracoes['impressora_secundaria'];}
		
		if($ph = printer_open($impressora)){
			$fh = fopen("../../pedidos_imprimir/pedido.txt", "rb");
			$content = fread($fh, filesize("../../pedidos_imprimir/pedido.txt"));
			fclose($fh);
			       
			printer_start_doc($ph, "IMPRESSAO"); // Name Document 
			printer_start_page($ph); // Start Logo
		       
		   		printer_set_option($ph, PRINTER_MODE, "RAW");
		   		printer_write($ph, $content);

		   	printer_end_page($ph);
			printer_end_doc($ph);
			//printer_abort($ph);

			printer_close($ph);

		}
		


	}

}


//IMPRESSÃO RECEBIMENTOS
if($tipo==3){

	if(!empty($dados_configuracoes['impressora_principal'])){
		$printer_principal = $dados_configuracoes['impressora_principal'];
		if($ph = printer_open($printer_principal)){
		   	$fh = fopen("../../pedidos_imprimir/pedido.txt", "rb");
		   	$content = fread($fh, filesize("../../pedidos_imprimir/pedido.txt"));
		   	fclose($fh);
		       
		   	printer_start_doc($ph, "IMPRESSAO"); // Name Document 
			printer_start_page($ph); // Start Logo
		       
		   		printer_set_option($ph, PRINTER_MODE, "RAW");
		   		printer_write($ph, $content);

		   	printer_end_page($ph);
			printer_end_doc($ph);
			//printer_abort($ph);

			printer_close($ph);
		}
	}

}


//IMPRESSÃO FECHAMENTO CAIXA
if($tipo==4){
	
	if(!empty($dados_configuracoes['impressora_principal'])){
		$printer_principal = $dados_configuracoes['impressora_principal'];
		if($ph = printer_open($printer_principal)){
		   	$fh = fopen("../../pedidos_imprimir/pedido.txt", "rb");
		   	$content = fread($fh, filesize("../../pedidos_imprimir/pedido.txt"));
		   	fclose($fh);
		       
		   	printer_start_doc($ph, "IMPRESSAO"); // Name Document 
			printer_start_page($ph); // Start Logo
		       
		   		printer_set_option($ph, PRINTER_MODE, "RAW");
		   		printer_write($ph, $content);

		   	printer_end_page($ph);
			printer_end_doc($ph);
			//printer_abort($ph);

			printer_close($ph);
		}
	}

}



//REIMPRESSAO DO PEDIDO
if($tipo==5){
	
	if(!empty($dados_configuracoes['impressora_principal'])){
		$printer_principal = $dados_configuracoes['impressora_principal'];
		if($ph = printer_open($printer_principal)){
		   	$fh = fopen("../../pedidos_imprimir/pedido.txt", "rb");
		   	$content = fread($fh, filesize("../../pedidos_imprimir/pedido.txt"));
		   	fclose($fh);

		   	printer_start_doc($ph, "IMPRESSAO"); // Name Document 
			printer_start_page($ph); // Start Logo
		       
		   		printer_set_option($ph, PRINTER_MODE, "RAW");
		   		printer_write($ph, $content);

		   	printer_end_page($ph);
			printer_end_doc($ph);
			//printer_abort($ph);

		   	printer_close($ph);


		}
	}

}




//COMPROVANTE PAGAMENTO CREDIARIO
if($tipo==20){
	
	if(!empty($dados_configuracoes['impressora_principal'])){
		$printer_principal = $dados_configuracoes['impressora_principal'];
		if($ph = printer_open($printer_principal)){
		   	$fh = fopen("../../pedidos_imprimir/pedido.txt", "rb");
		   	$content = fread($fh, filesize("../../pedidos_imprimir/pedido.txt"));
		   	fclose($fh);

		   	printer_start_doc($ph, "IMPRESSAO"); // Name Document 
			printer_start_page($ph); // Start Logo
		       
		   		printer_set_option($ph, PRINTER_MODE, "RAW");
		   		printer_write($ph, $content);

		   	printer_end_page($ph);
			printer_end_doc($ph);
			//printer_abort($ph);

		   	printer_close($ph);


		}
	}

}

?>