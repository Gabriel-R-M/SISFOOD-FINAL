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



	////ITENS DO PEDIDO////
	$tot_itens = 0;


	
    $txt_itens_cabecalho = ajusta_caracteres_impressao('Qtd','F',4);
    $txt_itens_cabecalho .= ajusta_caracteres_impressao('CAT/Produto','F',$tamanho_campo_nome_produto);
    $txt_itens_cabecalho .= ajusta_caracteres_impressao('V. UN','I',7);
    $txt_itens_cabecalho .= ajusta_caracteres_impressao('Total','I',8). "\r\n";
    $txt_itens_cabecalho .= ajusta_caracteres_impressao('');	
	$cabs = $txt_itens_cabecalho;

	
		
		$total_itens_pedido=0;
		$sel = $db->select("SELECT * FROM produtos_venda WHERE id_venda='$id_venda' ORDER BY categoria_produto, id DESC");	
		
		if($db->rows($sel)){
						
			while($row = $db->expand($sel)){

				$total_itens_pedido = ($total_itens_pedido+$row['quantidade']);


				$id_selecionado = $row['id'];
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


				$name_divisao = ''.retira_acentos($row['nome_cliente_divisao']).'';
			
				$txt_itens[] = array($row['quantidade'], ''.($prod_cod).''.retira_acentos($nome_categoria).'', ''.number_format($row['valor'],2,",",".").'', ''.number_format($total_prod,2,",",".").'', ''.retira_acentos($nome_produto).'', ''.retira_acentos($nome_tamanho).'',$id_controle, ''.$row['observacoes'].'',$name_divisao);



				$pg = $db->select("UPDATE produtos_venda SET impresso='1' WHERE id='$id_selecionado' LIMIT 1");	
				

			}


			

		}



	


	foreach ($txt_itens as $item) {
       	
		//VEM NOME DO CLIENTE DA DIVISAO NA MESA
		if(!empty($item[8])){
			$itens[] .= ajusta_caracteres_impressao('('.$item[8].')', 'F')."\r\n";			    
		}

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



			//OBSERVACOES DO PRODUTO SE HOUVER
			if(!empty($item[7])){
				$itens[] .= "\r\n".ajusta_caracteres_impressao(' ', 'F', 4)
					. ajusta_caracteres_impressao('[ATENCAO]', 'F', -4);

				$itens[] .= ajusta_caracteres_impressao(' ', 'F', 4)
			    . ajusta_caracteres_impressao($item[7], 'F', -4);			    
			}	
			

        	$itens[] .= ajusta_caracteres_impressao('');
            
            
    }




    // SUBTOTAL //
    $aux_valor_total = 'SUBTOTAL';
	$aux_valor_total2 = 'R$ '.number_format(($dados_venda['valor_produtos']+$dados_venda['valor_acrescimos']),2,",",".");
	$txt_valor_total = ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
	$txt_valor_total .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2));
    // SUBTOTAL //
    

     // DESCONTO //
	$txt_valor_desconto ='';
    if($dados_venda['valor_desconto']!='0.00'){
	    $aux_valor_total = 'DESCONTO (-)';
		$aux_valor_total2 = 'R$ '.number_format($dados_venda['valor_desconto'],2,",",".");
		$txt_valor_desconto = ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
		$txt_valor_desconto .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2))."\r\n";	

		$aux_valor_total = 'TOTAL:';		
		$aux_valor_total2 = 'R$ '.number_format((($dados_venda['valor_produtos']+$dados_venda['valor_acrescimos'])-$dados_venda['valor_desconto']),2,",",".");		
		$txt_valor_desconto .= ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
		$txt_valor_desconto .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2));	

	}	
    // DESCONTO //


    // ENTREGA //
    $txt_valor_entrega='';
    if($dados_venda['entrega']!=0){
    	$aux_valor_total = 'TX DE ENTREGA (+)';
		$aux_valor_total2 = 'R$ '.number_format($dados_venda['valor_entrega'],2,",",".");
		$txt_valor_entrega .= ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
		$txt_valor_entrega .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2));			
	} 		
    // ENTREGA //


    // A RECEBER FINAL //    
    $aux_valor_total = 'TOTAL A RECEBER';
	$aux_valor_total2 = 'R$ '.number_format($dados_venda['valor_final_venda'],2,",",".");
	$txt_valor_final_receber .= ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
	$txt_valor_final_receber .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2));				
    // A RECEBER FINAL //


	$txt_pagamentos_recebidos='';
	$formas_pgto='';

    //FORMAS DE PAGAMENTO SE HOUVER//	
    $sel = $db->select("SELECT pagamentos_vendas.*, formas_pagamento.forma, usuarios.nome FROM pagamentos_vendas 
		LEFT JOIN formas_pagamento ON pagamentos_vendas.forma_pagamento=formas_pagamento.id
	    LEFT JOIN usuarios ON pagamentos_vendas.id_usuario=usuarios.id
	    WHERE pagamentos_vendas.id_venda='$id_venda'
	    ORDER BY pagamentos_vendas.id");
		
		if($db->rows($sel)){

			$txt_formas_pgto = array();
		    $txt_formas_pgto[] = "\r\n".ajusta_caracteres_impressao();
		    $txt_formas_pgto[] = ajusta_caracteres_impressao('PAGAMENTOS RECEBIDOS','M');         
		    $txt_formas_pgto[] = ajusta_caracteres_impressao();
		    $formas_pgto = $txt_formas_pgto;
		  
		    $txt_pgto_recebidos='';
		    $total_ja_recebido=0;

			while($dados_pgto = $db->expand($sel)){	

				$aux_valor_total = retira_acentos($dados_pgto['forma']);
				$aux_valor_total2 = 'R$ '.number_format($dados_pgto['valor_caixa_real'],2,",",".");
				$txt_pgto_recebidos .= ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
				$txt_pgto_recebidos .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2))."\r\n";	
					
				$total_ja_recebido = ($total_ja_recebido+$dados_pgto['valor_caixa_real']);

			}

			 $txt_pagamentos_recebidos =  "\r\n".$txt_pgto_recebidos;

			 $aux_valor_total = 'TOTAL RECEBIDO:';
			 $aux_valor_total2 = 'R$ '.number_format($total_ja_recebido,2,",",".");
			 
			 $falta_receber = ($dados_venda['valor_final_venda']-$total_ja_recebido);
			 if($falta_receber<0){$falta_receber=0;}

			 $txt_pagamentos_recebidos .= ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
			 $txt_pagamentos_recebidos .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2))."\r\n";	
			 

			 $aux_valor_total = 'FALTA A RECEBER:';
			 $aux_valor_total2 = 'R$ '.number_format($falta_receber,2,",",".");
			 $txt_pagamentos_recebidos .= ajusta_caracteres_impressao($aux_valor_total,'F',($numero_colunas/2));
			 $txt_pagamentos_recebidos .= ajusta_caracteres_impressao($aux_valor_total2,'I',($numero_colunas/2));				 

		}    
		//FORMAS DE PAGAMENTO SE HOUVER//



		//SE FOR ENTREGA EXIBE O ENDEREÇO E DADOS DO COMPRADOR//	
	if($dados_venda['entrega']!=0){

		$txt_dados_entrega = array();
		$txt_dados_entrega[] = "\r\n".ajusta_caracteres_impressao();
		$txt_dados_entrega[] = ajusta_caracteres_impressao('DADOS PARA ENTREGA','M');         
		$txt_dados_entrega[] = ajusta_caracteres_impressao();
		$txt_dados_entrega = $txt_dados_entrega;

		$id_cliente = $dados_venda['id_cliente'];
		$selectx = $db->select("SELECT * FROM clientes WHERE id='$id_cliente' LIMIT 1");
		$dados_cliente = $db->expand($selectx);

		$dados_entrega = "\r\n".ajusta_caracteres_impressao(retira_acentos($dados_cliente['nome']),'F')."\r\n";
		$dados_entrega .=  ajusta_caracteres_impressao('FONE: ('.$dados_cliente['ddd'].') '.$dados_cliente['telefone'],'F')."\r\n";
		$dados_entrega .=  ajusta_caracteres_impressao(retira_acentos($dados_cliente['endereco'].', '.$dados_cliente['numero']),'F')."\r\n";
		$dados_entrega .= ajusta_caracteres_impressao(retira_acentos($dados_cliente['bairro']),'F')."\r\n";
		if(!empty($dados_cliente['complemento'])){	
			$dados_entrega .= ajusta_caracteres_impressao(retira_acentos($dados_cliente['complemento']),'F')."\r\n";
		}
		

		$dados_entrega .= ajusta_caracteres_impressao()."\r\n";

		if($dados_venda['levar_maquina_cartao']!=0){
			$dados_entrega .= ajusta_caracteres_impressao('LEVAR A MAQUINA DE CARTAO','F')."\r\n";	
		}

		if($dados_venda['troco_para']!='0.00'){
			$dados_entrega .= ajusta_caracteres_impressao('*LEVAR TROCO PARA: R$ '.number_format($dados_venda['troco_para'],2,",","."),'F')."\r\n";	
			$dados_entrega .= ajusta_caracteres_impressao('TROCO DE: R$ '.number_format($dados_venda['levar_troco'],2,",","."),'F')."\r\n";	
		}

	}	else {
		
		$txt_dados_entrega = array();
		$txt_dados_entrega[] = "\r\n".ajusta_caracteres_impressao();
		$txt_dados_entrega[] = ajusta_caracteres_impressao('DADOS DO CLIENTE','M');         
		$txt_dados_entrega[] = ajusta_caracteres_impressao();
		$txt_dados_entrega = $txt_dados_entrega;

		if(!empty($dados_venda['nome_cliente'])){
			
			$id_cliente = $dados_venda['id_cliente'];
			$dados_entrega = "\r\n".ajusta_caracteres_impressao(retira_acentos($dados_venda['nome_cliente']),'F')."\r\n";	
			$selectx = $db->select("SELECT * FROM clientes WHERE id='$id_cliente' LIMIT 1");
			$dados_cliente = $db->expand($selectx);

			if(!empty($dados_cliente['telefone'])){					
				$dados_entrega .= ajusta_caracteres_impressao('FONE: ('.$dados_cliente['ddd'].') '.$dados_cliente['telefone'],'F')."\r\n";
			}

		} else {
			
			$id_cliente = $dados_venda['id_cliente'];
			$selectx = $db->select("SELECT * FROM clientes WHERE id='$id_cliente' LIMIT 1");
			$dados_cliente = $db->expand($selectx);
			$dados_entrega = "\r\n".ajusta_caracteres_impressao(retira_acentos($dados_cliente['nome']),'F')."\r\n";
			
			if(!empty($dados_cliente['telefone'])){					
				$dados_entrega .= ajusta_caracteres_impressao('FONE: ('.$dados_cliente['ddd'].') '.$dados_cliente['telefone'],'F')."\r\n";
			}

		}
		
		
	}
	//SE FOR ENTREGA EXIBE O ENDEREÇO E DADOS DO COMPRADOR//	

	//EMBALA VIAGEM//
	if($dados_venda['embala_viagem']==1){
		$dados_entrega .= ajusta_caracteres_impressao()."\r\n";
		$dados_entrega .= ajusta_caracteres_impressao('EMBALAR PARA VIAGEM','F')."\r\n";	
	}


	//IMPRIME O TOTAL DE ITENS DO PEDIDO//
	if($total_itens_pedido!=0){
		$dados_entrega .= ajusta_caracteres_impressao()."\r\n";
		$dados_entrega .= ajusta_caracteres_impressao('TOTAL DE ITENS DO PEDIDO: '.$total_itens_pedido, 'F')."\r\n";	
	}


	//IMPRIME AS CATEGORIAS DO PEDIDO//
	$dados_entrega .= ajusta_caracteres_impressao()."\r\n";
	$dados_entrega .= ajusta_caracteres_impressao('PEDIDO CONTENDO:','F')."\r\n";	

	$categorias_pedido_gerais='';
	$select = $db->select("SELECT produtos_venda.categoria_produto, categorias.categoria AS nome_categoria FROM produtos_venda
		LEFT JOIN categorias ON produtos_venda.categoria_produto=categorias.id
		WHERE produtos_venda.id_venda='$id_venda' 
		GROUP BY produtos_venda.categoria_produto");
	while($ln = $db->expand($select)){
		$categorias_pedido_gerais .= $ln['nome_categoria'].'/';	
	}
	
	//REMOVE A ULTIMA BARRA DO NOME DA CATEGORIA
	$final = substr($categorias_pedido_gerais, -1);
	if($final=='/'){
		$size = strlen($categorias_pedido_gerais);
		$categorias_pedido_gerais = substr($categorias_pedido_gerais,0, $size-1);
	}

	$dados_entrega .= ajusta_caracteres_impressao(retira_acentos($categorias_pedido_gerais),'F')."\r\n";


	//IMPRIME O NOME DO ATENDENTE NA COMANDA
	$dados_atendente = $dados_venda['id_usuario'];
	$dados_atendente = $db->select("SELECT nome FROM usuarios WHERE id='$dados_atendente' LIMIT 1");	
	$dados_atendente = $db->expand($dados_atendente);

	$dados_entrega .= ajusta_caracteres_impressao()."\r\n";
	$dados_entrega .= ajusta_caracteres_impressao(retira_acentos('ATENDENTE: '.$dados_atendente['nome']),'F')."\r\n";	



	///GERA O ARQUIVO	
	$txt = implode("\r\n", $cabecalho)
	. "\r\n"
	.$cabs
	. "\r\n"
	. implode("\r\n", $itens)
	. "\r\n"
	. $txt_valor_total;

	if(!empty($txt_valor_desconto)){
		$txt .= "\r\n"
		. $txt_valor_desconto;		
	}

	if(!empty($txt_valor_entrega)){
		$txt .= "\r\n"
		. $txt_valor_entrega;		
	}
	
	$txt .= "\r\n"
	. $txt_valor_final_receber;


	if(!empty($formas_pgto)){
		$txt .= implode("\r\n", $formas_pgto)
		.$txt_pagamentos_recebidos;	
	}
	
	$txt .= implode("\r\n", $txt_dados_entrega)
	.$dados_entrega;
	


   //CAMINHO DO TXT CRIADO
   $arquivo = 'pedido_'.$id_venda.'.txt';	
   $file = '../../pedidos_imprimir/pasta1/'.$arquivo;
   $_file  = fopen($file,"w"); fwrite($_file,$txt); fclose($_file);

   if(isset($primeira_impressao)){
   		$file2 = '../../pedidos_imprimir/pasta2/'.$arquivo;
        $file3 = '../../pedidos_imprimir/pasta3/'.$arquivo;
        $file4 = '../../pedidos_imprimir/pasta4/'.$arquivo;	

        $_file2  = fopen($file2,"w"); fwrite($_file2,$txt); fclose($_file2);
	    $_file3  = fopen($file3,"w"); fwrite($_file3,$txt); fclose($_file3);
	    $_file4  = fopen($file4,"w"); fwrite($_file4,$txt); fclose($_file4);
   }
   


   echo $arquivo;

?>