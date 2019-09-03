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
		$txt_cabecalho[] = ajusta_caracteres_impressao('');
		$txt_cabecalho[] = ajusta_caracteres_impressao('CIENCIA DE DIVIDA');
		$txt_cabecalho[] = ajusta_caracteres_impressao('');
		$cabecalho = $txt_cabecalho;	
	//CABEÇALHO



	$where = '';	
	if(isset($id) && $id!=0){
		$where = " WHERE contas_clientes.id='$id'";
	}		

	//VALOR DEVIDO ANTES DE PAGAR//
	$txt_total_venda='';
	$total_pago =0;	
	$sel = $db->select("SELECT contas_clientes.*, clientes.nome FROM contas_clientes
		LEFT JOIN clientes ON contas_clientes.id_cliente=clientes.id
		$where
		ORDER BY contas_clientes.id DESC LIMIT 1");
		$dados_pgto = $db->expand($sel);
		$total_recebido_agora = $dados_pgto['valor'];	 

	$aux_valor_total = retira_acentos('VALOR DA COMPRA');
	$aux_valor_total2 = 'R$ '.number_format($total_recebido_agora,2,",",".");
	

	$txt_total_venda .= ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
	$txt_total_venda .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2))."\r\n";
	$txt_total_venda .=	ajusta_caracteres_impressao('');
	//VALOR DEVIDO ANTES DE PAGAR//


	//VALOR TOTAL DA DIVIDA DO CLIENTE//
	$txt_total_falta_pagar='';
	$total_divida=0;
	$total_debito=0;
	$total_pgtos = 0;
	$sel = $db->select("SELECT * FROM contas_clientes 
		WHERE id_cliente='$id_cliente_venda'
		ORDER BY id DESC");
		while($soma_pgto = $db->expand($sel)){
	
			if($soma_pgto['tipo']==0){
				$total_debito = ($total_debito+$soma_pgto['valor']);
			} else {
				$total_pgtos = ($total_pgtos+$soma_pgto['valor']);
			}
			
		}  

	$total_divida = ($total_debito-$total_pgtos);	
	
		$aux_valor_total = retira_acentos('DIVIDA TOTAL');
		$aux_valor_total2 = 'R$ '.number_format($total_pgtos,2,",",".");
		
		$txt_total_falta_pagar .= ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
		$txt_total_falta_pagar .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2))."\r\n";
		$txt_total_falta_pagar .=	ajusta_caracteres_impressao('')."\r\n";	
	//VALOR TOTAL DA DIVIDA DO CLIENTE//


	//NOME DO CLIENTE//	
		$txt_nome_cliente =	ajusta_caracteres_impressao('ESTOU CIENTE SOBRE A DIVIDA ACIMA','M')."\r\n";	
		$txt_nome_cliente .= ajusta_caracteres_impressao(retira_acentos($dados_pgto['nome']),'M')."\r\n"."\r\n";				
		$txt_nome_cliente .=ajusta_caracteres_impressao();	
		
	//NOME DO CLIENTE//		


	//USUÁRIO RESPONSÁVEL//		
		$id_user = $dados_venda['id_usuario'];		
		$selx = $db->select("SELECT nome FROM usuarios WHERE id='$id_user' LIMIT 1");	
		$dados_user_venda = $db->expand($selx); 

		$txt_fim =	ajusta_caracteres_impressao('RESPONSAVEL: '.retira_acentos($dados_user_venda['nome']),'M');
		$txt_fim2 =	ajusta_caracteres_impressao(' EM '.data_mysql_para_user(substr($dados_pgto['data_debito'],0,10)).' AS '.substr($dados_pgto['data_debito'],11,5).'hs','M');
	
	//USUÁRIO RESPONSÁVEL//	


	///GERA O ARQUIVO	
	$txt = implode("\r\n", $cabecalho)
	. "\r\n"		
	.$txt_total_venda."\r\n"
	//.$txt_total_falta_pagar."\r\n"	
	.$txt_nome_cliente."\r\n"
	.$txt_fim."\r\n"
	.$txt_fim2;
	//.$txt_fim2;

   //CAMINHO DO TXT CRIADO
   $arquivo = 'crediario_'.md5(time()).'.txt';	
   $file = '../../pedidos_imprimir/pasta1/'.$arquivo;

   // cria o arquivo
   $_file  = fopen($file,"w");
   fwrite($_file,$txt);
   fclose($_file);

   echo $arquivo;


?>