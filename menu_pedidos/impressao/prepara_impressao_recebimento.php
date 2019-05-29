<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_dados_loja.php");
require("../../diversos/funcoes_impressao.php");
	


	//CABEÇALHO//	
		$txt_cabecalho = array();
        
        $txt_cabecalho[] = $dados_loja['cabecalho_linha01'];         
        $txt_cabecalho[] = $dados_loja['cabecalho_linha02'];         
		$txt_cabecalho[] = $dados_loja['cabecalho_linha03'];     
		$txt_cabecalho[] = 'PEDIDO: #'.$id_venda;    		
        		
		$txt_cabecalho[] = '----------------------------------';

		$txt_cabecalho[] = 'COMPROVANTE DE RECEBIMENTO';

		$txt_cabecalho[] = '----------------------------------';
		 
		$cabecalho = array_map("centraliza", $txt_cabecalho);
	//CABEÇALHO

			

	//PAGAMENTOS//	
    $sel = $db->select("SELECT pagamentos_vendas.*, formas_pagamento.forma, usuarios.nome FROM pagamentos_vendas 
		LEFT JOIN formas_pagamento ON pagamentos_vendas.forma_pagamento=formas_pagamento.id
	    LEFT JOIN usuarios ON pagamentos_vendas.id_usuario=usuarios.id
	    WHERE pagamentos_vendas.id_venda='$id_venda'
	    ORDER BY pagamentos_vendas.id DESC LIMIT 1");
		
		  
		    $txt_pgto_recebidos='';
		    

			$dados_pgto = $db->expand($sel);
			$total_recebido_agora=$dados_pgto['valor_caixa_real'];

			$aux_valor_total = retira_acentos($dados_pgto['forma'].' RECEBIDO');
			$aux_valor_total2 = 'R$ '.number_format($dados_pgto['valor_pagamento'],2,",",".");
			$total_espacos = $n_colunas - strlen($aux_valor_total);
			$total_espacos = $total_espacos- strlen($aux_valor_total2);
			$espacos = ''; 
			for($i = 0; $i < $total_espacos; $i++){
				$espacos .= ' ';
			}			
			$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
			

			//TROCO SE HOUVER//	
			if($dados_pgto['troco_passado']!='0.00'){				
				$txt_pgto_recebidos .=	'----------------------------------'."\r\n";	
				$aux_valor_total = retira_acentos('TROCO');
				$aux_valor_total2 = 'R$ '.number_format($dados_pgto['troco_passado'],2,",",".");
				$total_espacos = $n_colunas - strlen($aux_valor_total);
				$total_espacos = $total_espacos- strlen($aux_valor_total2);
				$espacos = ''; 
				for($i = 0; $i < $total_espacos; $i++){
					$espacos .= ' ';
				}			
				$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
				$txt_pgto_recebidos .=	'----------------------------------';					
			} else {
				$txt_pgto_recebidos .=	'----------------------------------';		
			}	
			//TROCO SE HOUVER//
			 			  
	//PAGAMENTOS//


	//VALOR DEVIDO ANTES DE PAGAR//
	$txt_total_venda='';
	$total_pago =0;	
	$sel = $db->select("SELECT pagamentos_vendas.*, formas_pagamento.forma, usuarios.nome FROM pagamentos_vendas 
		LEFT JOIN formas_pagamento ON pagamentos_vendas.forma_pagamento=formas_pagamento.id
		LEFT JOIN usuarios ON pagamentos_vendas.id_usuario=usuarios.id
		WHERE pagamentos_vendas.id_venda='$id_venda'
		ORDER BY pagamentos_vendas.id DESC");
		while($soma_pgto = $db->expand($sel)){
			$total_pago = ($total_pago+$soma_pgto['valor_caixa_real']);
		}    

	$aux_valor_total = retira_acentos('VALOR DEVIDO');
	$aux_valor_total2 = 'R$ '.number_format(($dados_venda['valor_final_venda']-($total_pago-$total_recebido_agora)),2,",",".");
	$total_espacos = $n_colunas - strlen($aux_valor_total);
	$total_espacos = $total_espacos- strlen($aux_valor_total2);
	$espacos = ''; 
	for($i = 0; $i < $total_espacos; $i++){
		$espacos .= ' ';
	}			
	$txt_total_venda .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
	$txt_total_venda .=	'----------------------------------';			







	//VALOR QUE AINDA FALTA PAGAR//
	$txt_total_falta_pagar='';
	$sm = ($dados_venda['valor_final_venda']-$total_pago);
	if($sm>=0){		  
		$aux_valor_total = retira_acentos('RESTANTE A RECEBER');
		$aux_valor_total2 = 'R$ '.number_format(($dados_venda['valor_final_venda']-$total_pago),2,",",".");
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
		$espacos = ''; 
		for($i = 0; $i < $total_espacos; $i++){
			$espacos .= ' ';
		}			
		$txt_total_falta_pagar .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
		$txt_total_falta_pagar .=	'----------------------------------';					
	}



	//USUÁRIO RESPONSÁVEL//		
		$id_user = $dados_venda['id_usuario'];		
		$selx = $db->select("SELECT nome FROM usuarios WHERE id='$id_user' LIMIT 1");	
		$dados_user_venda = $db->expand($selx); 

		$txt_fim = array();        
        $txt_fim[] = 'RECEBIDO POR: '.retira_acentos($dados_user_venda['nome']);                  
		$txt_fim = array_map("centraliza", $txt_fim);		

		$txt_fim2 = array();
		$txt_fim2[] = ' EM '.data_mysql_para_user($dados_pgto['data']).' AS '.substr($dados_pgto['hora'],0,5).'hs';
		$txt_fim2 = array_map("centraliza", $txt_fim2);		
	//USUÁRIO RESPONSÁVEL//	


	///GERA O ARQUIVO	
	$txt = implode("\r\n", $cabecalho)
	. "\r\n"	
	.$txt_total_venda."\r\n"
	.$txt_pgto_recebidos."\r\n"
	.$txt_total_falta_pagar."\r\n"
	
	.implode("\r\n", $txt_fim)."\r\n"
	.implode("\r\n", $txt_fim2);

   //CAMINHO DO TXT CRIADO
   $arquivo = 'comp_recebimento_'.$id_venda.'.txt';	
   $file = '../../pedidos_imprimir/pasta1/'.$arquivo;

   // cria o arquivo
   $_file  = fopen($file,"w");
   fwrite($_file,$txt);
   fclose($_file);



?>