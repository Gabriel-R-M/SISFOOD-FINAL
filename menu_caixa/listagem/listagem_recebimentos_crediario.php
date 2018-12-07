<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_caixa_aberto.php");

$sel = $db->select("SELECT forma FROM formas_pagamento WHERE id='3' LIMIT 1");
$px = $db->expand($sel);
?>

<h19>Recebimentos de: <strong><?php echo $px['forma']; ?></strong></h19>
<br><br>


			<div class="table-responsive">
				  <table class="table table-striped">
				    
				    <tr>
				        <th width="40">ID</th>
				        <th width="200">Data/Hora</th>				        
				        <th>Atendente</th>
				        <th>Recebido R$</th>				        
				    </tr>	

				    <tbody>
				      <?php      
					      $sel = $db->select("SELECT contas_clientes.*, usuarios.nome FROM contas_clientes 	      	
					      LEFT JOIN usuarios ON contas_clientes.id_usuario=usuarios.id 
					      WHERE contas_clientes.id_caixa_recebe='$id_caixa_aberto' AND contas_clientes.tipo='1'
					      ORDER BY contas_clientes.id DESC, contas_clientes.data_pgto DESC
					      ");
						if($db->rows($sel)){
						
							while($dados = $db->expand($sel)){
								

					  ?>
						     
						      <tr class="cursor">
						        <td>#<?php echo ($dados['id']); ?></td>
						        <td>
						        	<?php echo data_mysql_para_user(substr($dados['data_pgto'],0,10)); ?> 
						        	ás 
						        	<?php echo substr($dados['data_pgto'],11,5);?>hs
						        </td>						        
						        <td class="upper"><?php echo ($dados['nome']); ?></td>
						        <td>R$ <?php echo number_format($dados['valor'],2,".",","); ?></td>
						        	
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

