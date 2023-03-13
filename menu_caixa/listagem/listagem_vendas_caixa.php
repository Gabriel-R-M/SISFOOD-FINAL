<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_caixa_aberto.php");

$sel = $db->select("SELECT forma FROM formas_pagamento WHERE id='$tipo' LIMIT 1");
$px = $db->expand($sel);
?>

<h19>Pagamentos recebidos no: <strong><?php echo $px['forma']; ?></strong></h19>
<br><br>


			<div class="table-responsive">
				  <table class="table table-striped">
				    
				    <tr>
				        <th width="40">Venda</th>
				        <th width="200">Data/Hora</th>				        
				        <th>Atendente</th>
				        <th>Recebido R$</th>				        
				    </tr>	

				    <tbody>
				      <?php      
					      $sel = $db->select("SELECT pagamentos_vendas.*, usuarios.nome FROM pagamentos_vendas 	      	
					      LEFT JOIN usuarios ON pagamentos_vendas.id_usuario=usuarios.id 
					      WHERE pagamentos_vendas.id_caixa='$id_caixa_aberto' AND pagamentos_vendas.forma_pagamento='$tipo'
					      ORDER BY pagamentos_vendas.id_venda DESC, pagamentos_vendas.data DESC, pagamentos_vendas.hora DESC
					      ");
						if($db->rows($sel)){
						
							while($dados = $db->expand($sel)){
								

					  ?>
						     
						      <tr class="cursor" onclick="javascript:edita_pedido(<?php echo ($dados['id_venda']); ?>);">
						        <td>#<?php echo ($dados['id_venda']); ?></td>
						        <td><?php echo data_mysql_para_user($dados['data']); ?> ás <?php echo substr($dados['hora'],0,5);?>hs</td>						        
						        <td><?php echo ($dados['nome']); ?></td>
						        <td>R$ <?php echo number_format($dados['valor_caixa_real'],2,".",","); ?></td>
						        	
						      </tr>
				      <?php
				      	}
				      } else {
				      	echo '<tr><td colspan="10"><center>Nenhum pagamento deste tipo encontrado!</center></td></tr>';
				      }
				      ?>
				    </tbody>

				</table>
			</div>

