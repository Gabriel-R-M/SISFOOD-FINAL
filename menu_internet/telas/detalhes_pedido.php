<?php
require ("../../admin/class/class.db.php"); 
require ("../../admin/class/class.seguranca.php");
require ("../../includes/verifica_dados_sistema.php");
?>



<?php
$curl = curl_init();                                                                      
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $dados_sistema['url_servidor_pedidos'].'/resgata-pedidos?id_pedido='.$id,
	    CURLOPT_USERAGENT => 'Request'
	));

	$return = curl_exec($curl);

	if($return){	    

	    $json_decoded = json_decode($return, TRUE);  	    	    
	    
	    echo '
	    	<div class="table-responsive">
				<table class="table table-striped">
			    
			 
			    <tbody>
	    ';


	   foreach ($json_decoded["pedidos"]["pedido"] as $valor){	    	

	   $x=1;
	   $conta_adicionais=1;
	   while($x<=$valor['total_produtos']){    

	    		$id_produto = $valor['id_produto'.$x];
	    		$id_controle = $valor['id_controle_produto'.$x];

	    		//APENAS UM PRODUTO
				if(is_numeric($id_produto)){

					$pg = $db->select("SELECT produto, codigo, categoria FROM lanches WHERE id='$id_produto' LIMIT 1");
					$var = $db->expand($pg);
					$categoria_produto = $var['categoria'];
					$nome_produto= $var['produto'];

				//MEIO A MEIO	
				} else {	

					$nome_produto='';
					$prods = explode(',', $id_produto);	
					foreach($prods as $prod) {

				    	$id_produto = trim($prod);		    	

				    	$pg = $db->select("SELECT produto, codigo, categoria FROM lanches WHERE id='$id_produto' LIMIT 1");
						$var = $db->expand($pg);
						$categoria_produto = $var['categoria'];

						$nome_produto= $nome_produto.$var['produto'].'/';
					}
				}	

				//REMOVE A ULTIMA BARRA
				$final = substr($nome_produto, -1);
				if($final=='/'){
					$size = strlen($nome_produto);
					$nome_produto = substr($nome_produto,0, $size-1);
				}

				//CATEGORIA
				$sun = $db->select("SELECT categoria FROM categorias WHERE id='$categoria_produto' LIMIT 1");
        		$type = $db->expand($sun);

        		//NOME DO TAMANHO
        		$nome_tamanho='';
        		$id_tamanho = $valor['tamanho_produto'.$x];
		        if($id_tamanho!=0){
		        	$sun2 = $db->select("SELECT tamanho FROM tamanhos WHERE id='$id_tamanho' LIMIT 1");
		        	$type2 = $db->expand($sun2);
		        	$nome_tamanho='<br><small>('.$type2['tamanho'].')</small>';	
		        }

        		if($valor['quantidade_produto'.$x]<10){$valor['quantidade_produto'.$x] = '0'.$valor['quantidade_produto'.$x];}

				echo '<tr>';
					echo '<td class="upper">
						<small class="upper"><b>['.$type['categoria'].']</b></small>
						<br>'.$valor['quantidade_produto'.$x].' x '.$nome_produto.'
						<span class="pull-right">R$ '.number_format(($valor['quantidade_produto'.$x]*$valor['valor_produto'.$x]),2,",",".").'</span> 
						'.$nome_tamanho.'
						';

						//ADICIONAIS CASO HOUVER//
						if($valor['possui_adicionais_produto'.$x]>0){	    				
	    					$v=1;
							while($v<=$valor['possui_adicionais_produto'.$x]){	

								$id_opicional = $valor['id_opcional'.$conta_adicionais];	
	    						$adc2 = $db->select("SELECT opcional FROM opcionais WHERE id='$id_opicional' LIMIT 1");	  

	    						if($db->rows($adc2)){
									$sib2 = $db->expand($adc2);    							
									echo '<br>';
	    							echo '<small class="upper">+ '.$valor['quantidade_produto'.$x].' x '.$sib2['opcional'].'
	    								<span class="pull-right">R$ '.number_format(($valor['quantidade_produto'.$x]*$valor['valor_opcional'.$conta_adicionais]),2,",",".").'</span> 
	    								</small>';	    							
								}	    						
		    					$v++;
		    					$conta_adicionais++;
		    				}
	    				}


					echo '</td>';
					
				echo '</tr>';
	    	
	    	$x++;		
		
		}

	}
		

		echo '
				</tbody>
			  </table>
			</div>
		';
	
	} else {
		echo '<center><br>ERRO AO CONECTAR COM O SEVIDOR.<br><br></center>';
	}

	
	curl_close($curl); 


?>




