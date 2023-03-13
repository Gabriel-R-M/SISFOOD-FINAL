<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
?>

<div class="table-responsive">
  <table class="table thin">
    


    <tbody>
      <?php
	      $sel = $db->select("SELECT nome_cliente_divisao FROM produtos_venda	      	
	      	WHERE id_venda='$id_venda'
	      	GROUP BY nome_cliente_divisao
	      	ORDER BY nome_cliente_divisao
	      	");
		if($db->rows($sel)){
		while($dados = $db->expand($sel)){

				$soma_cliente = 0;
				$total_adicionais=0;

				if(empty($dados['nome_cliente_divisao'])){
					$name = 'AVULSO - SEM NOME';
					$name_procura ='';
				} else {
					$name = $dados['nome_cliente_divisao'];
					$name_procura = $dados['nome_cliente_divisao'];
				}
	  ?>

			  <tr bgcolor="#F5F5F5">
			  	<td colspan="6" class="upper"><?php echo $name;  ?></td>
			  </tr>	

			  	<?php
			  		$sel2 = $db->select("SELECT id, quantidade, id_produtos, valor FROM produtos_venda	      	
			      	WHERE id_venda='$id_venda' AND nome_cliente_divisao='$name_procura'
			      	ORDER BY id DESC
			      	");

			  		while($dados2 = $db->expand($sel2)){

			  			$id_produto = $dados2['id_produtos'];
			  			$id_controle = $dados2['id'];

			  			if($dados2['quantidade']<10){
			  				$dados2['quantidade'] = '0'.$dados2['quantidade'];
			  			}

			  			//APENAS UM PRODUTO
						if(is_numeric($dados2['id_produtos'])){

							$pg = $db->select("SELECT produto FROM lanches WHERE id='$id_produto' LIMIT 1");
							$var = $db->expand($pg);							
							$nome_produto= $var['produto'];

						//MEIO A MEIO	
						} else {	

							$nome_produto='';
							$prods = explode(',', $dados2['id_produtos']);	
							foreach($prods as $prod) {

						    	$id_produto = trim($prod);		    	

						    	$pg = $db->select("SELECT produto FROM lanches WHERE id='$id_produto' LIMIT 1");
								$var = $db->expand($pg);								
								$nome_produto= $nome_produto.$var['produto'].'/';

							}

						}

						$final = substr($nome_produto, -1);
						if($final=='/'){
							$size = strlen($nome_produto);
							$nome_produto = substr($nome_produto,0, $size-1);
						}	

						$soma_cliente = ($soma_cliente+($dados2['quantidade']*$dados2['valor']));

			    ?> 	

		      <tr >		        
		      	<td class="uper" width="10"><?php echo $dados2['quantidade']; ?></td>		        
		      	<td class="uper"><?php echo $nome_produto; ?></td>		        
		        <td>R$ <?php echo number_format(($dados2['valor']*$dados2['quantidade']),2,",","."); ?></td>		        
		      </tr>


		      <?php
								
				$adc = $db->select("SELECT * FROM opcionais_produtos_venda WHERE id_controle='$id_controle' ORDER BY id DESC");
				if($db->rows($adc)){
					while($sib = $db->expand($adc)){

						$id_opc = $sib['id_opcional'];
						$adc2 = $db->select("SELECT opcional FROM opcionais WHERE id='$id_opc' LIMIT 1");		
						$sib2 = $db->expand($adc2);

						$total_adicionais = ($total_adicionais+($sib['valor_opcional']*$dados2['quantidade']));

						echo '<tr>';
							echo '<td class="uper" width="10"></td>';
							echo '<td class="uper">+ '.$dados2['quantidade'].' x '.$sib2['opcional'].' <small>(ADICIONAL)</small></td>';
							echo '<td>R$ '.number_format(($sib['valor_opcional']*$dados2['quantidade']),2,",",".").'</td>';						
						echo '</tr>';

						$contador_adicionais++;
					}
				}


				$adc = $db->select("SELECT * FROM opcionais_produtos_venda2 WHERE id_controle='$id_controle' ORDER BY id DESC");
				if($db->rows($adc)){
					while($sib = $db->expand($adc)){

						$id_opc = $sib['id_opcional'];
						$adc2 = $db->select("SELECT opcional2 FROM opcionais2 WHERE id='$id_opc' LIMIT 1");		
						$sib2 = $db->expand($adc2);

						$total_adicionais = ($total_adicionais+($sib['valor_opcional']*$dados2['quantidade']));

						echo '<tr>';
							echo '<td class="uper" width="10"></td>';
							echo '<td class="uper">+ '.$dados2['quantidade'].' x '.$sib2['opcional2'].' <small>(OPÇÃO)</small></td>';
							echo '<td>R$ '.number_format(($sib['valor_opcional']*$dados2['quantidade']),2,",",".").'</td>';						
						echo '</tr>';

						$contador_adicionais++;
					}
				}
			?>

		<?php
			}

			
			echo '<tr>';
				echo '<td></td>';		        		      			     
				echo '<td></td>';		        		      			     
		        echo '<td><h4 style="margin:0; padding:0">R$ '.number_format(($soma_cliente+$total_adicionais),2,",",".").'</h4></td>';		        
		    echo '</tr>';


			echo '<tr><td height="8" style="border:0"></td></tr>';
      	}
      	?>      


      <?php
      	}
      ?>
    </tbody>

  </table>
</div>