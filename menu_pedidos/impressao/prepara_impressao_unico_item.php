<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_dados_loja.php");
require("../../includes/verifica_configuracoes_loja.php");
require("../../diversos/funcoes_impressao.php");
	


	//CABEÇALHO//	
		$txt_cabecalho = array();
        
        $txt_cabecalho[] = $dados_loja['cabecalho_linha01'];         
        $txt_cabecalho[] = $dados_loja['cabecalho_linha02'];         
		$txt_cabecalho[] = $dados_loja['cabecalho_linha03'];     
		$txt_cabecalho[] = 'PEDIDO: #'.$id_venda;    
		$txt_cabecalho[] = data_mysql_para_user($dados_venda['data_pedido']).' AS '.substr($dados_venda['pedido_inicio'],0,5);
        		
		$txt_cabecalho[] = '----------------------------------------';

		//ENTREGA
		if($dados_venda['entrega']!=0){
			$txt_cabecalho[] = 'ENTREGA';
		} 

		//MESA
		if($dados_venda['id_mesa']!=0){
			$txt_cabecalho[] = 'MESA '.$dados_venda['id_mesa'];
		} 

		//RETIRADA/BALCAO
		if($dados_venda['id_mesa']==0 && ($dados_venda['entrega']==0 || $dados_venda['entrega']=='')){
			$txt_cabecalho[] = 'RETIRA/BALCAO';
			
			//EMBALA PARA VIAGEM
			if($dados_venda['embala_viagem']==1){					
				$txt_cabecalho[] = '(EMBALAR PARA VIAGEM)';
			}

		} 
	
	

		$cabecalho = array_map("centraliza", $txt_cabecalho);
	//CABEÇALHO



//FAZ O TOTAL DE ITENS DO PEDIDO//
$total_itens_pedido =0;
$sel_total_itens = $db->select("SELECT SUM(quantidade) AS total_itens_pedido FROM produtos_venda WHERE id_venda='$id_venda'");	
if($db->rows($sel_total_itens)){
	$tot = $db->expand($sel_total_itens);
	$total_itens_pedido = $tot['total_itens_pedido'];
}


	////ITENS DO PEDIDO////
	$tot_itens = 0;


	$txt_itens_cabecalho[] = array('----', '------------------------------', '-------', '-------');
    $txt_itens_cabecalho[] = array('Qtd ', 'COD/Produto', 'V. UN', 'Total');
	$txt_itens_cabecalho[] = array('----', '------------------------------', '-------', '-------');	

		

		//VERIFICA COMO QUE É PRA IMPRIMIR ITEM A ITEM OU TODOS OS QUE AINDA NAO FORAM IMPRESSOS
		if($dados_configuracoes['impressao_avulsa_item']=='JUNTO APENAS UMA VEZ'){
			
			$group = "AND impresso='0' GROUP BY categoria_produto ORDER BY id DESC ";	
			$tipo_query = "AND impresso='0' ORDER BY id DESC";

		} else {

			$group = "ORDER BY id DESC LIMIT 1";	
			$tipo_query = 'ORDER BY id DESC LIMIT 1';			
		}
		
		
		$query_item='';	
		if(isset($item) && $item!=0 && $item!=''){
			$query_item=" AND id='$item'";
			$group = "ORDER BY id DESC LIMIT 1";
			$tipo_query = 'ORDER BY id DESC LIMIT 1';		
		}


$sel_group = $db->select("SELECT categoria_produto FROM produtos_venda WHERE id_venda='$id_venda' $query_item $group");	
if($db->rows($sel_group)){
while($cat_pesq = $db->expand($sel_group)){

	$categoria_pesquisa = $cat_pesq['categoria_produto'];

	$sel = $db->select("SELECT * FROM produtos_venda WHERE id_venda='$id_venda' AND categoria_produto='$categoria_pesquisa' $query_item $tipo_query");	

		if($db->rows($sel)){
			while($row = $db->expand($sel)){

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


				$txt_itens[] = array($row['quantidade'], ''.($prod_cod).''.retira_acentos($nome_categoria).'', ''.number_format($row['valor'],2,",",".").'', ''.number_format($total_prod,2,",",".").'', ''.retira_acentos($nome_produto).'', ''.retira_acentos($nome_tamanho).'', $id_controle, ''.$row['observacoes'].'',''.retira_acentos($row['nome_cliente_divisao']).'');


				$pg = $db->select("UPDATE produtos_venda SET impresso='1' WHERE id='$id_selecionado' LIMIT 1");

			}			


	}



	foreach ($txt_itens as $item) {

		//VEM NOME DO CLIENTE DA DIVISAO NA MESA
		if(!empty($item[8])){
			$itens[] .= addEspacos('('.$item[8].')', 40, 'F')."\r\n";			    
		}
       
        $itens[] .= addEspacos($item[0], 4, 'F')
        	. addEspacos($item[1], 22, 'F')
        	. addEspacos($item[2], 7, 'I')
            . addEspacos($item[3], 7, 'I');        	
        	  

        	if($item[5]!=''){
        		$itens[] .= addEspacos('', 4, 'F')
        		.addEspacos($item[5], 36, 'F')
        		."\r\n".addEspacos('', 4, 'F')
        		.addEspacos($item[4], 36, 'F');        		
        	} else {
        		$itens[] .= addEspacos('', 4, 'F')
        		.addEspacos($item[4], 36, 'F');
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

						$itens[] .= addEspacos('+', 4, 'F')
			        	. addEspacos($opcional, 22, 'F')
			        	. addEspacos(number_format($val_opcional,2,",","."), 7, 'I')
			            . addEspacos(number_format($total_opcional,2,",","."), 7, 'I');    	
																		
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

					$itens[] .= addEspacos('', 4, 'F')
					. addEspacos('[ADICIONAR AO ITEM]', 22, 'F');

					while($ln = $db->expand($peg)){
						
						$opcional = retira_acentos($ln['opcional']);
						$val_opcional = $ln['valor_opcional'];
						$total_opcional = ($item[0]*$val_opcional);												

						$itens[] .= addEspacos('+', 4, 'F')
			        	. addEspacos($opcional, 22, 'F')
			        	. addEspacos(number_format($val_opcional,2,",","."), 7, 'I')
			            . addEspacos(number_format($total_opcional,2,",","."), 7, 'I');    	
																		
					}
				}
			//ADICIONAIS SE HOUVER//


			//OBSERVACOES DO PRODUTO SE HOUVER
			if(!empty($item[7])){
				$itens[] .= addEspacos('', 4, 'F')
					. addEspacos('[ATENCAO]', 22, 'F');

				$itens[] .= addEspacos('', 4, 'F')
			    . addEspacos($item[7], 36, 'F');			    
			}

        	$itens[] .= addEspacos('------------------------------------------------------------------', 40, 'F');
            
            
    }

    foreach ($txt_itens_cabecalho as $cab) {
       
        $cabs[] = addEspacos($cab[0], 4, 'F')
        	. addEspacos($cab[1], 22, 'F')           
            . addEspacos($cab[2], 7, 'I')
            . addEspacos($cab[3], 7, 'I');
            
    }



    //VERIFICA SE É PRA EXIBIR ENDERECO NA COZINHA    
	if($dados_configuracoes['imprimir_endereco_entrega_cozinha']==1){


		    //SE FOR ENTREGA EXIBE O ENDEREÇO E DADOS DO COMPRADOR//	
			if($dados_venda['entrega']!=0){

				$txt_dados_entrega = array();		
				$txt_dados_entrega[] = 'DADOS PARA ENTREGA';         
				$txt_dados_entrega[] = '----------------------------------------';
				$txt_dados_entrega = array_map("centraliza", $txt_dados_entrega);

				$id_cliente = $dados_venda['id_cliente'];
				$selectx = $db->select("SELECT * FROM clientes WHERE id='$id_cliente' LIMIT 1");
				$dados_cliente = $db->expand($selectx);

				$dados_entrega = "\r\n".retira_acentos($dados_cliente['nome'])."\r\n";
				$dados_entrega .= 'FONE: ('.$dados_cliente['ddd'].') '.$dados_cliente['telefone']."\r\n";
				$dados_entrega .= retira_acentos($dados_cliente['endereco'].', '.$dados_cliente['numero'])."\r\n";
				$dados_entrega .= retira_acentos($dados_cliente['bairro'])."\r\n";
				if(!empty($dados_cliente['complemento'])){	
					$dados_entrega .= retira_acentos($dados_cliente['complemento'])."\r\n";
				}
				$dados_entrega .= '----------------------------------------';


			}	else {
				
				$txt_dados_entrega = array();
				$txt_dados_entrega[] = '----------------------------------------';
				$txt_dados_entrega[] = 'DADOS DO CLIENTE';         
				$txt_dados_entrega[] = '----------------------------------------';
				$txt_dados_entrega = array_map("centraliza", $txt_dados_entrega);

				if(!empty($dados_venda['nome_cliente'])){
					
					$dados_entrega = "\r\n".retira_acentos($dados_venda['nome_cliente'])."\r\n";	

				} else {
					
					$id_cliente = $dados_venda['id_cliente'];
					$selectx = $db->select("SELECT * FROM clientes WHERE id='$id_cliente' LIMIT 1");
					$dados_cliente = $db->expand($selectx);
					$dados_entrega = "\r\n".retira_acentos($dados_cliente['nome'])."\r\n";
					
					if(!empty($dados_cliente['telefone'])){					
						$dados_entrega .= 'FONE: ('.$dados_cliente['ddd'].') '.$dados_cliente['telefone']."\r\n";
					}

				}		
				
				
			}
			//SE FOR ENTREGA EXIBE O ENDEREÇO E DADOS DO COMPRADOR//	

	}


				//IMPRIME O TOTAL DE ITENS DO PEDIDO//
				if($total_itens_pedido!=0){
					$dados_entrega .= '----------------------------------------'."\r\n";
					$dados_entrega .= 'TOTAL DE ITENS DO PEDIDO: '.$total_itens_pedido."\r\n";	
				}


				//IMPRIME AS CATEGORIAS DO PEDIDO//
				$dados_entrega .= '----------------------------------------'."\r\n";
				$dados_entrega .= 'PEDIDO CONTENDO:'."\r\n";	

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

				$dados_entrega .= retira_acentos($categorias_pedido_gerais)."\r\n";	


				//IMPRIME O NOME DO ATENDENTE NA COMANDA
				$dados_atendente = $dados_venda['id_usuario'];
				$dados_atendente = $db->select("SELECT nome FROM usuarios WHERE id='$dados_atendente' LIMIT 1");	
				$dados_atendente = $db->expand($dados_atendente);

				$dados_entrega .= '----------------------------------------'."\r\n";
				$dados_entrega .= retira_acentos('ATENDENTE: '.$dados_atendente['nome'])."\r\n";	



	///GERA O ARQUIVO	
	$txt = implode("\r\n", $cabecalho)
	. "\r\n"
	.implode("\r\n", $cabs)
	. "\r\n"
	. implode("\r\n", $itens)
	. "\r\n"
	.implode("\r\n", $txt_dados_entrega)
	.$dados_entrega;

   //CAMINHO DO TXT CRIADO


   $select_pen = $db->select("SELECT impressao FROM categorias WHERE id='$categoria_produto' LIMIT 1");
   $imp = $db->expand($select_pen);	

   if($imp['impressao']=='principal'){

   		$arquivo = 'pedido_unico_item_'.md5((time()+rand(0,1987))).'.txt';	
   		$file = '../../pedidos_imprimir/'.$arquivo;

   } else if($imp['impressao']=='secundaria'){

   		$arquivo = 'coz_'.md5((time()+rand(0,1987))).'.txt';	
   		$file = '../../pedidos_imprimir/'.$arquivo;

   }
	
   

   // cria o arquivo
   $_file  = fopen($file,"w");
   fwrite($_file,$txt);
   fclose($_file);

   unset($itens);
   unset($txt_itens); 
   unset($txt_itens_cabecalho); 
   $dados_entrega='';
   $txt_dados_entrega='';
   

}
}	


if($dados_configuracoes['impressao_avulsa_item']=='JUNTO APENAS UMA VEZ'){
	echo 1;
} else {
	echo 0;
}



	


   		

?>