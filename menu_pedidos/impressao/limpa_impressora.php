<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_configuracoes_loja.php");





//LIMPA IMPRESSORA 01

	if(!empty($dados_configuracoes['impressora_principal'])){
		$printer_principal = $dados_configuracoes['impressora_principal'];
		$ph = printer_open($printer_principal);
		printer_abort($ph);	
		printer_close($ph);	
	}

//LIMPA IMPRESSORA 02
	if(!empty($dados_configuracoes['impressora_secundaria'])){
		$printer_principal = $dados_configuracoes['impressora_secundaria'];
		$ph = printer_open($printer_principal);
		printer_abort($ph);
		printer_close($ph);	
	}


	



?>