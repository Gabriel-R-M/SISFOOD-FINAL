<?php
include_once ("../../admin/class/class.db.php"); 
include_once ("../../admin/class/class.seguranca.php");
include_once ("../../includes/verifica_configuracoes_loja.php");
include_once ("../../includes/verifica_dados_sistema.php");
include_once ("../../includes/verifica_session.php");

unset($_SESSION['id_caixa_erp_sis'] );
include_once("../../includes/verifica_caixa_aberto.php");

$data_cadastro = date("Y-m-d");
	
	$post = [
    'status' => $status,
    'motivo_erro_internet' => $motivo_erro_internet,
    'id'   => $id,
	];

	$curl = curl_init();                                                                      
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $dados_sistema['url_servidor_pedidos'].'/aceita-rejeita-pedido',
	    CURLOPT_USERAGENT => 'Request',
	    CURLOPT_POSTFIELDS =>  $post
	));

	$return = curl_exec($curl);


	if($return){	

		//ACEITA O PEDIDO E COLOCA NA TABELA DO SISTEMA//
		if($status==2){

				$post_pedidos = [
			    'id_pedido' => $id			    
				];

				$curl_pedidos = curl_init();                                                                      
				curl_setopt_array($curl_pedidos, array(
				    CURLOPT_RETURNTRANSFER => 1,
				    CURLOPT_URL => $dados_sistema['url_servidor_pedidos'].'/resgata-pedidos',
				    CURLOPT_USERAGENT => 'Request',
				    CURLOPT_POSTFIELDS =>  $post_pedidos
				));

				$return_pedidos = curl_exec($curl_pedidos);

				if($return_pedidos){	    

	    			$json_decoded = json_decode($return_pedidos, TRUE); 

	    			foreach ($json_decoded["pedidos"]["pedido"] as $valor){	  

	    			
	    					$id_internet  = $valor['id_internet'];	    					
							$id_cliente = $valor['id_cliente'];	    					
							$valor_produtos = $valor['valor_produtos'];	    					
							$valor_acrescimos = $valor['valor_acrescimos'];	    					
							$valor_total = $valor['valor_total'];	    					
							$valor_entrega = $valor['valor_entrega'];	    					
							$valor_final_venda .= $valor['valor_final_venda'];	    					
							$entrega = $valor['entrega'];	    					
							$valor_desconto = $valor['valor_desconto'];	    					
							$pedido_inicio = $valor['pedido_inicio'];	    					
							$data_pedido = $valor['data_pedido'];	    					
							$levar_troco = $valor['levar_troco'];	    					
							$troco_para = $valor['troco_para'];	    					
							$levar_maquina_cartao = $valor['levar_maquina_cartao'];	    					
							$pre_tipo_pagamento = $valor['pre_tipo_pagamento'];	    					
							$embala_viagem = $valor['embala_viagem'];	    					
							$nome_cliente = $valor['nome_cliente'];	    					
							$hash_cliente = $valor['hash_cliente'];	 

							$endereco_cliente = $valor['endereco_cliente'];	 
							$numero_cliente = $valor['numero_cliente'];	 
							$complemento_cliente = $valor['complemento_cliente'];	 
							$bairro_cliente = $valor['bairro_cliente'];	 
							$ddd_cliente = $valor['ddd_cliente'];	 
							$telefone_cliente = $valor['telefone_cliente'];	 

							
							/////PESQUISA SE O CLIENTE EXISTE NO SISTEMA, SENAO CADASTRA//////
							$query = $db->select("SELECT id FROM clientes WHERE ddd='$ddd_cliente' AND telefone='$telefone_cliente' LIMIT 1");
							if($db->rows($query)){
								$lines = $db->expand($query);
								$id_cliente_sistema_local = $lines['id']; 
								$update = $db->select("UPDATE clientes SET endereco='$endereco_cliente', numero='$numero_cliente', complemento='$complemento_cliente', bairro='$bairro_cliente' WHERE id='$id_cliente_sistema_local' LIMIT 1");
							} else {
								$insert = $db->select("INSERT INTO clientes (nome, ddd, telefone, endereco, numero, complemento, bairro, data_cadastro, internet, hash) VALUES ('$nome_cliente', '$ddd_cliente', '$telefone_cliente', '$endereco_cliente', '$numero_cliente', '$complemento_cliente', '$bairro_cliente', '$data_cadastro', '1', '$hash_cliente')");
								$id_cliente_sistema_local = $db->last_id($insert);
							}

							

							////SALVA A VENDA NO SISTEMA////
							$insert = $db->select("INSERT INTO aguarda_venda (valor_final_venda, aguarde, id_usuario, id_cliente, id_caixa, valor_produtos, valor_acrescimos, valor_total, valor_entrega, entrega, valor_desconto, pedido_inicio, data_pedido, levar_troco, troco_para, levar_maquina_cartao, pre_tipo_pagamento, embala_viagem, nome_cliente, pedido_internet, cliente_internet) VALUES ('$valor_final_venda', '1', '$id_usuario', '$id_cliente_sistema_local', '$id_caixa_aberto', '$valor_produtos', '$valor_acrescimos', '$valor_total', '$valor_entrega', '$entrega', '$valor_desconto', '$pedido_inicio', '$data_pedido', '$levar_troco', '$troco_para', '$levar_maquina_cartao', '$pre_tipo_pagamento', '$embala_viagem', '$nome_cliente', '$id_internet', '$id_cliente')");

							 $id_venda_sistema = $db->last_id($insert);

							 @session_start();
							 $_SESSION['id_venda_erp_sis'] = $id_venda_sistema;


							///INSERE OS PRODUTOS NA VENDA////
							$total_produtos = $valor['total_produtos'];
							$x=1;
				    		$conta_adicionais=1;
				    		while($x<=$total_produtos){

				    			$id_controle_produto = $valor['id_controle_produto'.$x];
				    			$id_produto = $valor['id_produto'.$x];
				    			$quantidade_produto = $valor['quantidade_produto'.$x];
				    			$observacoes_produto = $valor['observacoes_produto'.$x];
				    			$tamanho_produto = $valor['tamanho_produto'.$x];
				    			$categoria_produto = $valor['categoria_produto'.$x];
				    			$valor_produto_unico = $valor['valor_produto'.$x];

				    			
				    			$insere_produto = $db->select("INSERT INTO produtos_venda (id_venda, id_produtos, valor, observacoes, quantidade, tamanho, categoria_produto) VALUES ('$id_venda_sistema', '$id_produto', '$valor_produto_unico','$observacoes_produto', '$quantidade_produto', '$tamanho_produto', '$categoria_produto')");
				    			$id_produto_sistema = $db->last_id($insere_produto);


				    			if($valor['possui_adicionais_produto'.$x]>0){				    				
				    				$v=1;
									while($v<=$valor['possui_adicionais_produto'.$x]){	    				
					    				
					    				$id_produto_adicional = $valor['id_produto_adicional'.$conta_adicionais];
					    				$id_opcional = $valor['id_opcional'.$conta_adicionais];
					    				$controle_opcional = $valor['controle_opcional'.$conta_adicionais];
					    				$valor_opcional = $valor['valor_opcional'.$conta_adicionais];

					    				$insere_produto = $db->select("INSERT INTO opcionais_produtos_venda (id_venda, id_produto, id_opcional, valor_opcional, id_controle) VALUES ('$id_venda_sistema', '$id_produto_adicional', '$id_opcional', '$valor_opcional', '$id_produto_sistema')");

				    					$v++;
				    					$conta_adicionais++;
				    				}
				    			}
				    			
				    			$x++;

				    		}



	    			}


	    		}


		}


	}
	

	curl_close($curl); 
	

?>