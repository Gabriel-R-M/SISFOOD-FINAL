<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_dados_loja.php");
require("../../diversos/funcoes_impressao.php");
require("../../menu_caixa/actions/totalizadores_caixa.php");
	

	//CABEÇALHO//	
		$txt_cabecalho = array();
        
        $txt_cabecalho[] = $dados_loja['cabecalho_linha01'];         
        $txt_cabecalho[] = $dados_loja['cabecalho_linha02'];         
		$txt_cabecalho[] = $dados_loja['cabecalho_linha03'];     		
        		
		$txt_cabecalho[] = '----------------------------------';

		$txt_cabecalho[] = 'FECHAMENTO DE CAIXA';
		//.data_mysql_para_user(retorna_data_abertura_caixa($id_caixa))

		$txt_cabecalho[] = '----------------------------------';
		 
		$cabecalho = array_map("centraliza", $txt_cabecalho);
	//CABEÇALHO


		//DADOS DO CAIXA//
		$aux_valor_total = 'DINHEIRO:';
		$aux_valor_total2 = 'R$ '.number_format(devolve_valores_caixa($id_caixa,1),2,".",",").' (+)';
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
		$espacos = ''; 
		for($i = 0; $i < $total_espacos; $i++){
			$espacos .= ' ';
		}			
		$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
		$txt_pgto_recebidos .=	'----------------------------------'."\r\n";	

		$aux_valor_total = 'CARTAO:';
		$aux_valor_total2 = 'R$ '.number_format(devolve_valores_caixa($id_caixa,2),2,".",",").' (+)';
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
		$espacos = ''; 
		for($i = 0; $i < $total_espacos; $i++){
			$espacos .= ' ';
		}			
		$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
		$txt_pgto_recebidos .=	'----------------------------------'."\r\n";


		$aux_valor_total = 'CONVENIO:';
		$aux_valor_total2 = 'R$ '.number_format(devolve_valores_caixa($id_caixa,3),2,".",",").' (+)';
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
		$espacos = ''; 
		for($i = 0; $i < $total_espacos; $i++){
			$espacos .= ' ';
		}			
		$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
		$txt_pgto_recebidos .=	'----------------------------------'."\r\n";	


		$aux_valor_total = 'SUBTOTAL:';
		$aux_valor_total2 = 'R$ '.number_format(devolve_valores_caixa($id_caixa,0),2,".",",");
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
		$espacos = ''; 
		for($i = 0; $i < $total_espacos; $i++){
			$espacos .= ' ';
		}			
		$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
		$txt_pgto_recebidos .=	'----------------------------------'."\r\n";	


		$aux_valor_total = 'TROCO INICIAL:';
		$aux_valor_total2 = 'R$ '.number_format(devolve_troco_caixa($id_caixa),2,".",",").' (+)';
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
		$espacos = ''; 
		for($i = 0; $i < $total_espacos; $i++){
			$espacos .= ' ';
		}			
		$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
		$txt_pgto_recebidos .=	'----------------------------------'."\r\n";


		$aux_valor_total = 'SAIDAS DE CAIXA:';
		$aux_valor_total2 = 'R$ '.number_format(devolve_saidas_caixa($id_caixa),2,".",",").' (-)';
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
		$espacos = ''; 
		for($i = 0; $i < $total_espacos; $i++){
			$espacos .= ' ';
		}			
		$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
		$txt_pgto_recebidos .=	'----------------------------------'."\r\n";	


		$aux_valor_total = 'TOTAL DO CAIXA:';
		$aux_valor_total2 = 'R$ '.number_format(devolve_final_caixa($id_caixa),2,".",",").' (=)';
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
		$espacos = ''; 
		for($i = 0; $i < $total_espacos; $i++){
			$espacos .= ' ';
		}			
		$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
		$txt_pgto_recebidos .=	'----------------------------------'."\r\n";	


		$aux_valor_total = 'QTD ENTREGAS:';
		$aux_valor_total2 = totais_entregas_caixa($id_caixa);
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
		$espacos = ''; 
		for($i = 0; $i < $total_espacos; $i++){
			$espacos .= ' ';
		}			
		$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
		$txt_pgto_recebidos .=	'----------------------------------'."\r\n";	
	//DADOS DO CAIXA//	


		

	///GERA O ARQUIVO	
	$txt = implode("\r\n", $cabecalho)."\r\n"
	.$txt_pgto_recebidos;	

   //CAMINHO DO TXT CRIADO
   $arquivo = 'fechamento_caixa_'.md5(time()).'.txt';	
   $file = '../../pedidos_imprimir/pasta1/'.$arquivo;

   // cria o arquivo
   $_file  = fopen($file,"w");
   fwrite($_file,$txt);
   fclose($_file);



?>