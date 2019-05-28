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
        		
		$txt_cabecalho[] = '----------------------------------------';

		$txt_cabecalho[] = 'CIENCIA DE DIVIDA';

		$txt_cabecalho[] = '----------------------------------------';
		 
		$cabecalho = array_map("centraliza", $txt_cabecalho);
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
	$total_espacos = $n_colunas - strlen($aux_valor_total);
	$total_espacos = $total_espacos- strlen($aux_valor_total2);
	$espacos = ''; 
	for($i = 0; $i < $total_espacos; $i++){
		$espacos .= ' ';
	}			
	$txt_total_venda .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
	$txt_total_venda .=	'----------------------------------------';	
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
		$aux_valor_total2 = 'R$ '.number_format($total_divida,2,",",".");
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
		$espacos = ''; 
		for($i = 0; $i < $total_espacos; $i++){
			$espacos .= ' ';
		}			
		$txt_total_falta_pagar .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
		$txt_total_falta_pagar .=	'----------------------------------------';						
	//VALOR TOTAL DA DIVIDA DO CLIENTE//


	//NOME DO CLIENTE//	
		$txt_nome_cliente=retira_acentos('ESTOU CIENTE QUE PAGAREI A DIVIDA ACIMA')."\r\n";
		$txt_nome_cliente.=retira_acentos($dados_pgto['nome'])."\r\n";
		$txt_nome_cliente.=	'----------------------------------------';					
	//NOME DO CLIENTE//		


	//USUÁRIO RESPONSÁVEL//		
		$id_user = $dados_venda['id_usuario'];		
		$selx = $db->select("SELECT nome FROM usuarios WHERE id='$id_user' LIMIT 1");	
		$dados_user_venda = $db->expand($selx); 

		$txt_fim = array();        
        $txt_fim[] = 'RESPONSAVEL: '.retira_acentos($dados_user_venda['nome'])."\r\n";                  
		$txt_fim = array_map("centraliza", $txt_fim);		

		$txt_fim2 = array();
		$txt_fim2[] = data_mysql_para_user(substr($dados_pgto['data_debito'],0,10)).' AS '.substr($dados_pgto['data_debito'],11,5).'hs'."\r\n";
		$txt_fim2 = array_map("centraliza", $txt_fim2);		
	//USUÁRIO RESPONSÁVEL//	


	///GERA O ARQUIVO	
	$txt = implode("\r\n", $cabecalho)
	. "\r\n"		
	.$txt_total_venda."\r\n"
	.$txt_total_falta_pagar."\r\n"	
	.$txt_nome_cliente."\r\n"
	.implode("\r\n", $txt_fim)
	.implode("\r\n", $txt_fim2);
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