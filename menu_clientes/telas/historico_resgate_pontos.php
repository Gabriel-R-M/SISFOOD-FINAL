<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_configuracoes_loja.php");
?>

<div class="col-md-6">
<div class="row">


		<div class="col-md-12">
			<div class="order-top">
				<h20>Pontos Ganhos</h20>							
			</div>
		</div>
			
		<div class="col-md-12 historico_pontos2" >
			
			<div class="card" >
					
				<div class="table-responsive">
						  <table class="table table-striped">
						    
						    <tr>
						        <th width="50">ID</th>
						        <th width="200">Data/Hora</th>
						        <th>R$ Gasto</th>
						        <th>Pontos Ganhos</th>
					     		<th></th>
						    </tr>	

						    <tbody>
						      <?php  
						         
							      $sel = $db->select("SELECT * FROM aguarda_venda 	      						      
							      WHERE finalizada='1' AND id_cliente='$id_cliente_venda' 
							      ORDER BY id DESC
							      ");

								if($db->rows($sel)){
									
									while($dados = $db->expand($sel)){

									$equivalencia_reais_pontos = $dados_configuracoes['valor_real_ponto'];
									$pontos_ganhos = ($dados['valor_final_venda']*$equivalencia_reais_pontos);	
									$pontos_ganhos = floor($pontos_ganhos); 
									if($pontos_ganhos<10){$pontos_ganhos='0'.$pontos_ganhos;}	



									//DATA LIMITE PARA EXPIRAR PONTOS//
									$dias_expira_pontos = $dados_configuracoes['dias_expira_pontos'];
									$data_pesquisa = date('Y-m-d',strtotime("-$dias_expira_pontos day")); 							

									if($dados['data_pedido']>=$data_pesquisa){
										$status = '<span class="bg-success tx-white pd-pd"><small>&nbsp;VÁLIDO&nbsp;</small></span>';	
									} else {
										$status = '<span class="bg-danger tx-white pd-pd"><small>&nbsp;EXPIRADO&nbsp;</small></span>';	
									}

									if($pontos_ganhos>0){
										
							  ?>
								      <tr class="thin upper">
								        <td>#<?php echo ($dados['id']); ?></td>
								        <td><?php echo data_mysql_para_user($dados['data_pedido']); ?> ás <?php echo substr($dados['pedido_inicio'],0,5);?>hs</td>
								        <td>R$ <?php echo number_format($dados['valor_final_venda'],2,".",","); ?></td>
								        <td><?php echo $pontos_ganhos; ?></td>								        
								        <td><?php echo $status; ?></td>								        
								      
								      </tr>
						      <?php

						  	}
						      	}
						      } else {
						      	echo '<tr><td colspan="10"><center>Nenhuma compra encontrada!</center></td></tr>';
						      }
						      ?>
						    </tbody>

						  </table>
						</div>

			</div>	

		</div>

</div>		
</div>




<div class="col-md-6 ">
<div class="row">


		<div class="col-md-12">
			<div class="order-top">
				<h20>Pontos Resgatados</h20>							
			</div>
		</div>
			
		<div class="col-md-12 historico_pontos">
			
			<div class="card" >
					
				<div class="table-responsive">
						  <table class="table table-striped">
						    
						    <tr>
						        <th width="50">ID</th>
						        <th width="200">Data/Hora</th>						        
						        <th>Pontos Resgatados</th>
						        <th>Desconto em R$</th>
					     		<th></th>
						    </tr>	

						    <tbody>
						      <?php      
							      $sel = $db->select("SELECT * FROM pontuacao_usada 	      						      
							      WHERE id_cliente='$id_cliente_venda' 
							      ORDER BY id DESC
							      ");
							     

								if($db->rows($sel)){
									
									while($dados = $db->expand($sel)){

									
									$pontos_resgatados = $dados['qtd_pontos'];
									if($pontos_resgatados<10){$pontos_resgatados='0'.$pontos_resgatados;}	

									$status = '<span class="bg-warning tx-white pd-pd"><small>&nbsp;RESGATADO&nbsp;</small></span>';	

									
									
							  ?>
								      <tr class="thin upper">
								        <td>#<?php echo ($dados['id']); ?></td>
								        <td><?php echo data_mysql_para_user($dados['data']); ?></td>
								        <td><?php echo $pontos_resgatados ?></td>
								        <td>R$ <?php echo number_format($dados['valor'],2,".",","); ?></td>								        
								        <td><?php echo $status; ?></td>								        
								      
								      </tr>
						      <?php
						      
						      	}
						      } else {
						      	echo '<tr><td colspan="10"><center>Nenhum resgate encontrado!</center></td></tr>';
						      }
						      ?>
						    </tbody>

						  </table>
						</div>

			</div>	

		</div>

</div>		
</div>




<script>	
	$(document).ready(function(){
		$('.historico_pontos, .historico_pontos2').perfectScrollbar();
	});	
	window.clearTimeout(atualiza_pedidos);	
</script>
