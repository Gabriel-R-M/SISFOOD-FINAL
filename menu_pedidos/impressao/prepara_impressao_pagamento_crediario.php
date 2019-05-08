<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_dados_loja.php");
require("../../diversos/funcoes_impressao.php");
	


	//CABEÇALHO//	
		$txt_cabecalho = array();
        
        $txt_cabecalho[] = $dados_loja['cabecalho_linha01'];         
        $txt_cabecalho[] = $dados_loja['cabecalho_linha02'];         
		$txt_cabecalho[] = $dados_loja['cabecalho_linha03'];     		
        		
		$txt_cabecalho[] = '----------------------------------------';

		$txt_cabecalho[] = 'COMPROVANTE DE PAGAMENTO';

		$txt_cabecalho[] = '----------------------------------------';
		 
		$cabecalho = array_map("centraliza", $txt_cabecalho);
	//CABEÇALHO

			

	//PAGAMENTOS//	
    $sel = $db->select("SELECT contas_clientes.*, formas_pagamento.forma, usuarios.nome, clientes.nome AS nome_cliente 
    	FROM contas_clientes 
		LEFT JOIN formas_pagamento ON contas_clientes.forma_pagamento=formas_pagamento.id
	    LEFT JOIN usuarios ON contas_clientes.id_usuario=usuarios.id
	    LEFT JOIN clientes ON contas_clientes.id_cliente=clientes.id
	    WHERE contas_clientes.id='$id'
	    LIMIT 1");
		  
		    $txt_pgto_recebidos='';
		   
			$dados_pgto = $db->expand($sel);
			$id_cliente = $dados_pgto['id_cliente'];
			$total_recebido_agora=$dados_pgto['valor'];

			$aux_valor_total = retira_acentos($dados_pgto['forma'].' RECEBIDO');
			$aux_valor_total2 = 'R$ '.number_format($dados_pgto['valor_recebe'],2,",",".");
			$total_espacos = $n_colunas - strlen($aux_valor_total);
			$total_espacos = $total_espacos- strlen($aux_valor_total2);
			$espacos = ''; 
			for($i = 0; $i < $total_espacos; $i++){
				$espacos .= ' ';
			}			
			$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
			

			//TROCO SE HOUVER//	
			if($dados_pgto['troco_passado']!='0.00'){				
				$txt_pgto_recebidos .=	'----------------------------------------'."\r\n";	
				$aux_valor_total = retira_acentos('TROCO');
				$aux_valor_total2 = 'R$ '.number_format($dados_pgto['troco_passado'],2,",",".");
				$total_espacos = $n_colunas - strlen($aux_valor_total);
				$total_espacos = $total_espacos- strlen($aux_valor_total2);
				$espacos = ''; 
				for($i = 0; $i < $total_espacos; $i++){
					$espacos .= ' ';
				}			
				$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
				$txt_pgto_recebidos .=	'----------------------------------------';					
			} else {
				$txt_pgto_recebidos .=	'----------------------------------------';		
			}	
			//TROCO SE HOUVER//
			 			  
	//PAGAMENTOS//


	//VALOR DEVIDO ANTES DE PAGAR//
	$txt_total_venda='';
	$total_pago =0;	
	$total_debito=0;
	$total_pgtos=0;
	$sel = $db->select("SELECT contas_clientes.*, formas_pagamento.forma, usuarios.nome FROM contas_clientes 
		LEFT JOIN formas_pagamento ON contas_clientes.forma_pagamento=formas_pagamento.id
		LEFT JOIN usuarios ON contas_clientes.id_usuario=usuarios.id
		
		WHERE contas_clientes.id_cliente='$id_cliente' AND contas_clientes.id!='$id'
		ORDER BY contas_clientes.id DESC");
		while($soma_pgto = $db->expand($sel)){
			if($soma_pgto['tipo']==0){
				$total_debito = ($total_debito+$soma_pgto['valor']);
			} else {
				$total_pgtos = ($total_pgtos+$soma_pgto['valor']);
			}
			
		}    

	$total_devido = ($total_debito-$total_pgtos);	
	if($$total_devido<0){$total_devido=0;}
	$aux_valor_total = retira_acentos('VALOR DEVIDO');
	$aux_valor_total2 = 'R$ '.number_format((($total_devido)),2,",",".");
	$total_espacos = $n_colunas - strlen($aux_valor_total);
	$total_espacos = $total_espacos- strlen($aux_valor_total2);
	$espacos = ''; 
	for($i = 0; $i < $total_espacos; $i++){
		$espacos .= ' ';
	}			
	$txt_total_venda .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
	$txt_total_venda .=	'----------------------------------------';			



	//VALOR QUE AINDA FALTA PAGAR//
	$txt_total_falta_pagar='';
	$sm = ($total_devido - $dados_pgto['valor']);	
	if($sm>=0){		  
		$aux_valor_total = retira_acentos('RESTANTE A RECEBER');
		$aux_valor_total2 = 'R$ '.number_format(($sm),2,",",".");
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
		$espacos = ''; 
		for($i = 0; $i < $total_espacos; $i++){
			$espacos .= ' ';
		}			
		$txt_total_falta_pagar .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
		$txt_total_falta_pagar .=	'----------------------------------------';					
	}


	//NOME DO CLIENTE//	
		$txt_nome_cliente=retira_acentos($dados_pgto['nome_cliente'])."\r\n";
		$txt_nome_cliente.=	'----------------------------------------';					
	//NOME DO CLIENTE//	


	//USUÁRIO RESPONSÁVEL//		
		$id_user = $dados_pgto['id_usuario'];		
		$selx = $db->select("SELECT nome FROM usuarios WHERE id='$id_user' LIMIT 1");	
		$dados_user_venda = $db->expand($selx); 

		$txt_fim = array();        
        $txt_fim[] = 'RECEBIDO POR: '.retira_acentos($dados_user_venda['nome'])."\r\n";                  
		$txt_fim = array_map("centraliza", $txt_fim);	

		$txt_fim2 = array();
		$txt_fim2[] = data_mysql_para_user(substr($dados_pgto['data_pgto'],0,10)).' AS '.substr($dados_pgto['data_pgto'],11,5).'hs'."\r\n";
		$txt_fim2 = array_map("centraliza", $txt_fim2);					
	//USUÁRIO RESPONSÁVEL//	


	///GERA O ARQUIVO	
	$txt = implode("\r\n", $cabecalho)
	. "\r\n"	
	//.$txt_total_venda."\r\n"
	.$txt_pgto_recebidos."\r\n"
	.$txt_total_falta_pagar."\r\n"
	.$txt_nome_cliente."\r\n"
	.implode("\r\n", $txt_fim)
	.implode("\r\n", $txt_fim2);

   //CAMINHO DO TXT CRIADO
   $arquivo = 'comp_pag_crediario_'.md5(time()).'.txt';	
   $file = '../../pedidos_imprimir/'.$arquivo;

   // cria o arquivo
   $_file  = fopen($file,"w");
   fwrite($_file,$txt);
   fclose($_file);



?>