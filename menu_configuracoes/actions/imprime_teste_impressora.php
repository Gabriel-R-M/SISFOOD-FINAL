<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_configuracoes_loja.php");


if($impressora==1){

	if(!empty($dados_configuracoes['impressora_principal'])){

		$file = '../teste_impressora.txt';
		$_file  = fopen($file,"w");
		fwrite($_file,'TESTE IMPRESSORA PRINCIPAL - OK');
		fclose($_file);

		$printer_principal = $dados_configuracoes['impressora_principal'];
		if($ph = printer_open($printer_principal)){
	   		$fh = fopen("../teste_impressora.txt", "rb");
	   		$content = fread($fh, filesize("../teste_impressora.txt"));
	   		fclose($fh);
	       
	   		printer_start_doc($ph, "IMPRESSAO"); // Name Document 
			printer_start_page($ph); // Start Logo
		       
		   		printer_set_option($ph, PRINTER_MODE, "RAW");
		   		printer_write($ph, $content);

		   	printer_end_page($ph);
			printer_end_doc($ph);
			printer_abort($ph);

			printer_close($ph);
		}
	}


	

}



if($impressora==2){
	
	if(!empty($dados_configuracoes['impressora_secundaria'])){

			$file = '../teste_impressora.txt';
			$_file  = fopen($file,"w");
			fwrite($_file,'TESTE IMPRESSORA SECUNDARIA - OK');
			fclose($_file);

			$printer_principal = $dados_configuracoes['impressora_secundaria'];
			if($ph = printer_open($printer_principal)){
		   		$fh = fopen("../teste_impressora.txt", "rb");
		   		$content = fread($fh, filesize("../teste_impressora.txt"));
		   		fclose($fh);
		       
		   		printer_start_doc($ph, "IMPRESSAO"); // Name Document 
				printer_start_page($ph); // Start Logo
			       
			   		printer_set_option($ph, PRINTER_MODE, "RAW");
			   		printer_write($ph, $content);

			   	printer_end_page($ph);
				printer_end_doc($ph);
				printer_abort($ph);

				printer_close($ph);
			}
	}

}


?>