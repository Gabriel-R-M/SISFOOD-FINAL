<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");
include_once("../actions/totalizadores_caixa.php");
?>			


			<h19>Exibindo últimos 20 registros.</h19>

			<div class="table-responsive top15">
				  <table class="table table-striped">
				    
				    <tr>
				        <th width="60">ID</th>
				        <th width="200">Data/Hora Abertura</th>				        
				        <th width="200">Data/Hora Final</th>
				        <th>Responsável</th>
				        <th>Balanço Final R$</th>				        
				    </tr>	

				    <tbody>
				      <?php   

				      	  $busca = '';
				      	  if(isset($data) && !empty($data)){
				      	  	$busca = " AND data_abertura='$data'";
				      	  }		

					      $sel = $db->select("SELECT caixa.*, usuarios.nome FROM caixa
					      LEFT JOIN usuarios ON caixa.id_usuario=usuarios.id 
					      WHERE caixa.data_fechamento!='0000-00-00' $busca
					      ORDER BY caixa.data_abertura DESC, caixa.hora_abertura DESC
					      LIMIT 20
					      ");
						if($db->rows($sel)){						
							while($dados = $db->expand($sel)){	
							$id_caixa_aberto = $dados['id'];	
							
					  ?>
						     
						      <tr class="cursor" onclick="javascript:exibe_caixa_finalizado(<?php echo $id_caixa_aberto; ?>);">
						        <td>#<?php echo ($dados['id']); ?></td>
						        <td><?php echo data_mysql_para_user($dados['data_abertura']); ?> ás <?php echo substr($dados['hora_abertura'],0,5);?>hs</td>						        
						        <td><?php echo data_mysql_para_user($dados['data_fechamento']); ?> ás <?php echo substr($dados['hora_fechamento'],0,5);?>hs</td>						        
						        <td><?php echo ($dados['nome']); ?></td>
						        <td>R$ <?php echo number_format(devolve_final_caixa($id_caixa_aberto),2,".",","); ?></td>
						        	
						      </tr>
				      <?php
				      	}
				      } else {
				      	echo '<tr><td colspan="10"><center>Nenhum caixa encontrado!</center></td></tr>';
				      }
				      ?>
				    </tbody>

				</table>
			</div>