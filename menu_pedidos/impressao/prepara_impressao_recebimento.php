<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_dados_loja.php");
require("../../includes/verifica_configuracoes_loja.php");
require("../../diversos/funcoes_impressao.php");
require("../../diversos/funcoes_diversas.php");

	
	$tamanho_campo_nome_produto = $dados_configuracoes['colunas_produto'];
	


	//CABEÇALHO//	
		$txt_cabecalho = array();
        
        $txt_cabecalho[] = ajusta_caracteres_impressao($dados_loja['cabecalho_linha01']);         
        $txt_cabecalho[] = ajusta_caracteres_impressao($dados_loja['cabecalho_linha02']);         
		$txt_cabecalho[] = ajusta_caracteres_impressao($dados_loja['cabecalho_linha03']);     
		$txt_cabecalho[] = ajusta_caracteres_impressao('PEDIDO: #'.$id_venda);   
		$txt_cabecalho[] = ajusta_caracteres_impressao('');
		$txt_cabecalho[] = ajusta_caracteres_impressao('COMPROVANTE DE RECEBIMENTO');
		$txt_cabecalho[] = ajusta_caracteres_impressao('');
		$cabecalho = $txt_cabecalho;	
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
			$txt_pgto_recebidos = ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
			$txt_pgto_recebidos .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2))."\r\n";
			

			//TROCO SE HOUVER//	
			if($dados_pgto['troco_passado']!='0.00'){				
				$txt_pgto_recebidos .=	ajusta_caracteres_impressao('')."\r\n";	
				$aux_valor_total = retira_acentos('TROCO');
				$aux_valor_total2 = 'R$ '.number_format($dados_pgto['troco_passado'],2,",",".");
				$txt_pgto_recebidos .= ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
				$txt_pgto_recebidos .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2))."\r\n";
				$txt_pgto_recebidos .=	ajusta_caracteres_impressao('');					

			} else {
				$txt_pgto_recebidos .=	ajusta_caracteres_impressao('');					
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
	
	$txt_total_venda .= ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
	$txt_total_venda .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2))."\r\n";
	$txt_total_venda .=	ajusta_caracteres_impressao('');



	//VALOR QUE AINDA FALTA PAGAR//
	$txt_total_falta_pagar='';
	$sm = ($dados_venda['valor_final_venda']-$total_pago);
	if($sm>=0){		  
		$aux_valor_total = retira_acentos('RESTANTE A RECEBER');
		$aux_valor_total2 = 'R$ '.number_format(($dados_venda['valor_final_venda']-$total_pago),2,",",".");
		

		$txt_total_falta_pagar .= ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
		$txt_total_falta_pagar .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2))."\r\n";
		$txt_total_falta_pagar .=	ajusta_caracteres_impressao('');
				
	}



	//USUÁRIO RESPONSÁVEL//		
		$id_user = $dados_venda['id_usuario'];		
		$selx = $db->select("SELECT nome FROM usuarios WHERE id='$id_user' LIMIT 1");	
		$dados_user_venda = $db->expand($selx); 

		$txt_fim .=	ajusta_caracteres_impressao('RECEBIDO POR: '.retira_acentos($dados_user_venda['nome']),'M');
		$txt_fim2 .=	ajusta_caracteres_impressao(' EM '.data_mysql_para_user($dados_pgto['data']).' AS '.substr($dados_pgto['hora'],0,5).'hs','M');
		
	//USUÁRIO RESPONSÁVEL//	


	///GERA O ARQUIVO	
	$txt = implode("\r\n", $cabecalho)
	. "\r\n"	
	.$txt_total_venda."\r\n"
	.$txt_pgto_recebidos."\r\n"
	.$txt_total_falta_pagar."\r\n"
	.$txt_fim."\r\n"
	.$txt_fim2."\r\n";


   //CAMINHO DO TXT CRIADO
   $arquivo = 'comp_recebimento_'.$id_venda.'.txt';	
   $file = '../../pedidos_imprimir/pasta1/'.$arquivo;

   // cria o arquivo
   $_file  = fopen($file,"w");
   fwrite($_file,$txt);
   fclose($_file);



?>