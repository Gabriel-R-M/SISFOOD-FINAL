<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
?>

<div class="col-md-12 mesas-exibicao">	
<div class="row row-xs"> 	
	<?php

		    	
		$sql = $db->select("SELECT * FROM mesas LIMIT 1");
		$line = $db->expand($sql);												
		$conta = 1;
		

		while($conta<=$line['mesa']){

			$valor_mesa=0;
			$nome_cliente='Mesa vazia';
			$hora_pedido='-----';
			$id_pedido=0;
			$classe_mesa_ocupada='';			
			$classe_mesa_ocupada2 = 'color-black';
			
			$sol = $db->select("SELECT id, valor_final_venda, id_cliente, pedido_inicio, nome_cliente FROM aguarda_venda WHERE id_mesa='$conta' LIMIT 1");
			if($db->rows($sol)){
				$mesa_dados = $db->expand($sol);
				$valor_mesa= $mesa_dados['valor_final_venda'];		
				$classe_mesa_ocupada = 'mesa-ocupada';
				$classe_mesa_ocupada2 = 'color-vermelho';

				
				$hora_pedido=substr($mesa_dados['pedido_inicio'],0,5);

				$id_pedido=$mesa_dados['id'];

				$nome_cliente = $mesa_dados['nome_cliente'];
				
				if(empty($nome_cliente)){
					$id_cli = $mesa_dados['id_cliente'];
					$wow = $db->select("SELECT nome FROM clientes WHERE id='$id_cli' LIMIT 1");	
					$dados_cli = $db->expand($wow);
					$nome_cliente=$dados_cli['nome'];
				}

			} 
				
			

			echo '<div class="col-6 col-md-2 text-center bottom10" onclick="javascript:edita_pedido('.$id_pedido.','.$conta.');">';
				echo '<div class="card mesas">';
            		echo '<div class="card-body pd-b-0">';

						echo '<h6 class="slim-card-title"><span class="label-mesa '.$classe_mesa_ocupada.'">MESA '.$conta.'</span></h6>';  		
						
						echo '<h1 class="tx-lato '.$classe_mesa_ocupada2.' thin">';
							echo number_format($valor_mesa,2,",",".").'';  		
						echo '</h1>';	

						echo '<p class="upper corta_texto">';
							echo '<span>';
								echo $hora_pedido.'<br>';
							echo '</span>';
							echo $nome_cliente;  		
						echo '</p>';	
								

					echo '</div>';		
				echo '</div>';			

			echo '</div>';		





			$conta++;

		    	
		}		

	?>	
</div>
</div>


<script>	
	$(document).ready(function(){
		$('.mesas-exibicao').perfectScrollbar();
	});	
	window.clearTimeout(atualiza_pedidos);	
	var atualiza_pedidos = setInterval(function(){ atualiza_mesas_automatico() }, 60000);
	
</script>




