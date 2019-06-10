<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_dados_loja.php");
require("../../includes/verifica_configuracoes_loja.php");
require("../../diversos/funcoes_impressao.php");;
require("../../diversos/funcoes_diversas.php");
	
	$tamanho_campo_nome_produto = $dados_configuracoes['colunas_produto'];

	//CABEÇALHO//	
		$txt_cabecalho = array();
        
        $txt_cabecalho[] = ajusta_caracteres_impressao($dados_loja['cabecalho_linha01']);         
        $txt_cabecalho[] = ajusta_caracteres_impressao($dados_loja['cabecalho_linha02']);         
		$txt_cabecalho[] = ajusta_caracteres_impressao($dados_loja['cabecalho_linha03']);     
		$txt_cabecalho[] = ajusta_caracteres_impressao('PEDIDO: #'.$id_venda);    
		$txt_cabecalho[] = ajusta_caracteres_impressao(data_mysql_para_user($dados_venda['data_pedido']).' AS '.substr($dados_venda['pedido_inicio'],0,5));
       	

       	$txt_cabecalho[] = ajusta_caracteres_impressao('');

		//ENTREGA
		if($dados_venda['entrega']!=0){
			$txt_cabecalho[] = ajusta_caracteres_impressao('ENTREGA');
		} 

		//MESA
		if($dados_venda['id_mesa']!=0){
			$txt_cabecalho[] = ajusta_caracteres_impressao('MESA '.$dados_venda['id_mesa']);
		} 

		//RETIRADA/BALCAO
		if($dados_venda['id_mesa']==0 && ($dados_venda['entrega']==0 || $dados_venda['entrega']=='')){
			$txt_cabecalho[] = ajusta_caracteres_impressao('RETIRA/BALCAO');
			
			//EMBALA PARA VIAGEM
			if($dados_venda['embala_viagem']==1){					
				$txt_cabecalho[] = ajusta_caracteres_impressao('(EMBALAR PARA VIAGEM)');
			}

		} 

		//PEDIDO DA INTERNET
		if($dados_venda['pedido_internet']!=0){
			$txt_cabecalho[] = ajusta_caracteres_impressao('--- PEDIDO VIA INTERNET ---');
		}  		
		
		$txt_cabecalho[] = ajusta_caracteres_impressao('');

		$cabecalho = $txt_cabecalho;		
	//CABEÇALHO



$total_itens_pedido=0;
$pesquisa_divisao = $db->select("SELECT nome_cliente_divisao FROM produtos_venda	      	
WHERE id_venda='$id_venda'
GROUP BY nome_cliente_divisao
ORDER BY nome_cliente_divisao
");
while($dados_divisao = $db->expand($pesquisa_divisao)){

		$soma_divisao_itens= 0;			

		if(empty($dados_divisao['nome_cliente_divisao'])){
			$name = 'AVULSO - SEM NOME';
			$name_procura ='';
		} else {
			$name = $dados_divisao['nome_cliente_divisao'];
			$name_procura = $dados_divisao['nome_cliente_divisao'];
		}

	////ITENS DO PEDIDO////
	$tot_itens = 0;
	


		
		$sel = $db->select("SELECT id, quantidade, id_produtos, valor FROM produtos_venda	      	
			      	WHERE id_venda='$id_venda' AND nome_cliente_divisao='$name_procura'
			      	ORDER BY id DESC");	
		
		if($db->rows($sel)){
			    		

    		$txt_itens[] = array('','','','','','','','','('.retira_acentos($name).')');    
		    

			while($row = $db->expand($sel)){

				$total_itens_pedido = ($total_itens_pedido+$row['quantidade']);

				$nome_tamanho='';
				$total_prod = 0;
				$id_produto	= $row['id_produtos'];
				$id_tamanho = $row['tamanho'];
				$id_controle = $row['id'];

				//APENAS UM PRODUTO
				if(is_numeric($row['id_produtos'])){

					$pg = $db->select("SELECT produto, categoria, codigo FROM lanches WHERE id='$id_produto' LIMIT 1");
					$var = $db->expand($pg);					
					$nome_produto= $var['produto'];
					$categoria_produto= $var['categoria'];
					$codigo_produto= $var['codigo'];

        			//VERIFICA SE É PRA IMPRIMIR O CODIGO DO PRODUTO//
        			$sun = $db->select("SELECT categoria, imprime_codigo FROM categorias WHERE id='$categoria_produto' LIMIT 1");
        			$type = $db->expand($sun);
        			$nome_categoria = $type['categoria'];

        			if($type['imprime_codigo']==1){        				
        				$prod_cod= '('.$codigo_produto.') - ';
	        		} else {
	        			$prod_cod= '';
	        		}

				//MEIO A MEIO	
				} else {	

					$nome_produto='';
					$prod_cod='';
					$prods = explode(',', $row['id_produtos']);	
					foreach($prods as $prod) {

				    	$id_produto = trim($prod);		    	

				    	$pg = $db->select("SELECT produto, categoria, codigo FROM lanches WHERE id='$id_produto' LIMIT 1");
						$var = $db->expand($pg);
						$nome_produto= $nome_produto.$var['produto'].'/';
						$categoria_produto= $var['categoria'];
						$codigo_produto= $var['codigo'];

						$prod_cod = $prod_cod.$codigo_produto.'/';


					}					

					//REMOVE A ULTIMA VIRGULA
					$final = substr($prod_cod, -1);
					if($final=='/'){
						$size = strlen($prod_cod);
						$prod_cod = substr($prod_cod,0, $size-1);
					}

					//VERIFICA SE É PRA IMPRIMIR O CODIGO DO PRODUTO//
					$sun = $db->select("SELECT categoria, imprime_codigo FROM categorias WHERE id='$categoria_produto' LIMIT 1");
        			$type = $db->expand($sun);
        			$nome_categoria = $type['categoria'];
        			
	        		if($type['imprime_codigo']==1){	        			
	        			$prod_cod= '('.$prod_cod.') - ';
	        		} else {
	        			$prod_cod= '';
	        		}

					//REMOVE A ULTIMA VIRGULA
					$final = substr($nome_produto, -1);
					if($final=='/'){
						$size = strlen($nome_produto);
						$nome_produto = substr($nome_produto,0, $size-1);
					}
					
				}	


				///NOME DO TAMANHO
				$nome_tamanho='';
			    if($id_tamanho!=0){
			    	$sun2 = $db->select("SELECT tamanho FROM tamanhos WHERE id='$id_tamanho' LIMIT 1");
			        $type2 = $db->expand($sun2);
			        $nome_tamanho=' ('.$type2['tamanho'].')';	
			    }

				$prod = retira_acentos($nome_produto.$nome_tamanho);
				$total_prod = ($row['quantidade']*$row['valor']);
				if($row['quantidade']<10){$row['quantidade'] = '0'.$row['quantidade'];}


			
				$txt_itens[] = array($row['quantidade'], ''.($prod_cod).''.retira_acentos($nome_categoria).'', ''.number_format($row['valor'],2,",",".").'', ''.number_format($total_prod,2,",",".").'', ''.retira_acentos($nome_produto).'', ''.retira_acentos($nome_tamanho).'',$id_controle, ''.$row['observacoes'].'','');
				

				$soma_divisao_itens = ($soma_divisao_itens+$total_prod);
				$total_opcional =0;


				//ADICIONAIS SE HOUVER//        						
				$peg = $db->select("SELECT valor_opcional FROM opcionais_produtos_venda				
				WHERE id_controle='$id_controle' ");
				if($db->rows($peg)){					
					while($ln = $db->expand($peg)){							
						$total_opcional = ($total_opcional+($row['quantidade']*$ln['valor_opcional']));					
					}
				} 
				//ADICIONAIS SE HOUVER//	

				$soma_divisao_itens = ($soma_divisao_itens+$total_opcional);	


			}



			$txt_itens[] = array('', '', '', '','','','','','TOTAL A PAGAR R$ '.number_format($soma_divisao_itens,2,",",".").'');

		}


}
	


	foreach ($txt_itens as $item) {


	
		if($item[8]!=''){
			
			$itens[] .= ajusta_caracteres_impressao($item[8], 'F')."\r\n";			
		
		} else { 

        $itens[] .= ajusta_caracteres_impressao($item[0], 'F', 4)
        	. ajusta_caracteres_impressao($item[1], 'F',$tamanho_campo_nome_produto)
        	. ajusta_caracteres_impressao($item[2], 'I',7)
            . ajusta_caracteres_impressao($item[3], 'I',8);        	
        	  

        	if($item[5]!=''){
        		$itens[] .= ajusta_caracteres_impressao(' ', 'F', 4)
        		.ajusta_caracteres_impressao($item[4], 'F', -4)."\r\n"
        		.ajusta_caracteres_impressao(' ', 'F', 4)
        		.ajusta_caracteres_impressao($item[5], 'F', -4);        		
        	} else {
        		$itens[] .= ajusta_caracteres_impressao(' ', 'F', 4)
        		.ajusta_caracteres_impressao($item[4], 'F', -4);
        	}


        	//OPCOES SE HOUVER//
        		$id_pesq_controle = $item[6];
				$peg = $db->select("SELECT opcionais_produtos_venda2.*, opcionais2.opcional2 FROM opcionais_produtos_venda2
				LEFT JOIN opcionais2 ON opcionais_produtos_venda2.id_opcional=opcionais2.id
				WHERE opcionais_produtos_venda2.id_controle='$id_pesq_controle' ORDER BY opcionais_produtos_venda2.id
				");
				if($db->rows($peg)){

					while($ln = $db->expand($peg)){
						
						$opcional = retira_acentos($ln['opcional2']);
						$val_opcional = $ln['valor_opcional'];
						$total_opcional = ($item[0]*$val_opcional);												

						$itens[] .= ajusta_caracteres_impressao('+', 'F', 4)
			        	. ajusta_caracteres_impressao($opcional, 'F', $tamanho_campo_nome_produto)
			        	. ajusta_caracteres_impressao(number_format($val_opcional,2,",","."), 'I',7)
			            . ajusta_caracteres_impressao(number_format($total_opcional,2,",","."),'I',8);    	    	
																		
					}
				}
			//OPCOES SE HOUVER//

        	//ADICIONAIS SE HOUVER//
        		$id_pesq_controle = $item[6];
				$peg = $db->select("SELECT opcionais_produtos_venda.*, opcionais.opcional FROM opcionais_produtos_venda
				LEFT JOIN opcionais ON opcionais_produtos_venda.id_opcional=opcionais.id
				WHERE opcionais_produtos_venda.id_controle='$id_pesq_controle' ORDER BY opcionais_produtos_venda.id
				");
				if($db->rows($peg)){

					$itens[] .= "\r\n".ajusta_caracteres_impressao(' ', 'F', 4)
					. ajusta_caracteres_impressao('[ADICIONAR]', 'F', -4);

					while($ln = $db->expand($peg)){
						
						$opcional = retira_acentos($ln['opcional']);
						$val_opcional = $ln['valor_opcional'];
						$total_opcional = ($item[0]*$val_opcional);												

						$itens[] .= ajusta_caracteres_impressao('+', 'F', 4)
			        	. ajusta_caracteres_impressao($opcional, 'F', $tamanho_campo_nome_produto)
			        	. ajusta_caracteres_impressao(number_format($val_opcional,2,",","."), 'I', 7)
			            . ajusta_caracteres_impressao(number_format($total_opcional,2,",","."), 'I', 8);       	
																		
					}
				} 
			//ADICIONAIS SE HOUVER//
			
			if(empty($item[8])){
        		$itens[] .= ajusta_caracteres_impressao('');
        	}

        }
            
            
    }

    


    // SUBTOTAL //
    $aux_valor_total = 'SUBTOTAL';
	$aux_valor_total2 = 'R$ '.number_format(($dados_venda['valor_produtos']+$dados_venda['valor_acrescimos']),2,",",".");
	$txt_valor_total = ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
	$txt_valor_total .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2));
    // SUBTOTAL //


	$dados_entrega='';
    //IMPRIME O TOTAL DE ITENS DO PEDIDO//
	if($total_itens_pedido!=0){
		$dados_entrega .= ajusta_caracteres_impressao()."\r\n";
		$dados_entrega .= ajusta_caracteres_impressao('TOTAL DE ITENS DO PEDIDO: '.$total_itens_pedido, 'F')."\r\n";	
	}


	//IMPRIME O NOME DO ATENDENTE NA COMANDA
	$dados_atendente = $dados_venda['id_usuario'];
	$dados_atendente = $db->select("SELECT nome FROM usuarios WHERE id='$dados_atendente' LIMIT 1");	
	$dados_atendente = $db->expand($dados_atendente);

	$dados_entrega .= ajusta_caracteres_impressao()."\r\n";
	$dados_entrega .= ajusta_caracteres_impressao(retira_acentos('ATENDENTE: '.$dados_atendente['nome']),'F')."\r\n";	



	///GERA O ARQUIVO	
	$txt = implode("\r\n", $cabecalho)
	. "\r\n"
	. implode("\r\n", $itens)
	. "\r\n"
	. $txt_valor_total // SubTotal	
	."\r\n"
	.$dados_entrega;

   //CAMINHO DO TXT CRIADO
   $arquivo = 'pedido_divisao_'.$id_venda.'.txt';	
   $file = '../../pedidos_imprimir/pasta1/'.$arquivo;

   // cria o arquivo
   $_file  = fopen($file,"w");
   fwrite($_file,$txt);
   fclose($_file);



?>