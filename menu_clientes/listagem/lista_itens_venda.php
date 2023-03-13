<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
?>


<div class="table-responsive">
	<table class="table table-striped">
				    
	<tr>
		<th>Ítens do Pedido</th>				        
	</tr>	

	<tbody>

<?php

	$sql = $db->select("SELECT * FROM produtos_venda WHERE id_venda='$id' ORDER BY id DESC");
	if($db->rows($sql)){

	while($row = $db->expand($sql)){
		

		$id_produto = $row['id_produtos'];
		$id_controle = $row['id'];
		$id_tamanho = $row['tamanho'];

		//APENAS UM PRODUTO
		if(is_numeric($row['id_produtos'])){

			$pg = $db->select("SELECT produto, codigo, categoria, foto FROM lanches WHERE id='$id_produto' LIMIT 1");
			$var = $db->expand($pg);
			$categoria_produto = $var['categoria'];
			$nome_produto= $var['produto'];
			

		//MEIO A MEIO	
		} else {	

			$nome_produto='';
			$prods = explode(',', $row['id_produtos']);	
			foreach($prods as $prod) {

		    	$id_produto = trim($prod);		    	

		    	$pg = $db->select("SELECT produto, codigo, categoria, foto FROM lanches WHERE id='$id_produto' LIMIT 1");
				$var = $db->expand($pg);
				$categoria_produto = $var['categoria'];

				$nome_produto= $nome_produto.$var['produto'].'/';

			}

			$img = 'sem_foto.png';

		}	

		//REMOVE A ULTIMA VIRGULA
		$final = substr($nome_produto, -1);
		if($final=='/'){
			$size = strlen($nome_produto);
			$nome_produto = substr($nome_produto,0, $size-1);
		}
		
		$sun = $db->select("SELECT categoria FROM categorias WHERE id='$categoria_produto' LIMIT 1");
        $type = $db->expand($sun);

        $nome_tamanho='';
									        if($id_tamanho!=0){
									        	$sun2 = $db->select("SELECT tamanho FROM tamanhos WHERE id='$id_tamanho' LIMIT 1");
									        	$type2 = $db->expand($sun2);
									        	$nome_tamanho=' ('.$type2['tamanho'].')';	
									        }

?>


	<tr>
		<td>
			<?php echo $nome_produto.$nome_tamanho; ?> x <?php echo $row['quantidade']; ?>
			<?php
				$total_adicionais=0;
				$adc = $db->select("SELECT * FROM opcionais_produtos_venda WHERE id_controle='$id_controle' ORDER BY id DESC");
				if($db->rows($adc)){
					while($sib = $db->expand($adc)){

						$id_opc = $sib['id_opcional'];
						$adc2 = $db->select("SELECT opcional FROM opcionais WHERE id='$id_opc' LIMIT 1");		
						$sib2 = $db->expand($adc2);

						$total_adicionais = ($total_adicionais+($sib['valor_opcional']*$row['quantidade']));

							echo '<br>';
							echo '<h17>+ '.$sib2['opcional'].' - R$ '.number_format($sib['valor_opcional'],2,",",".").'</h17>';
						
					}
				}
			?>
		</td>	
	</tr>	



<?php	
	
	//FECHA O WHILE
	}

	
	} else {

		echo '<tr>';
			echo '<td><center>Nenhum ítem no pedido.</center></td>';	
		echo '</tr>';	

	}
?>

		</tbody>
	</table>
</div>
