<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");
?>			
			
			<?php   

				 $busca = '';				 
				 if(isset($nome) && !empty($nome)){
				 	$busca = " AND (nome LIKE '%$nome%' OR telefone LIKE '%$nome%')";
				 }

				 if(isset($cartao) && !empty($cartao)){
				 	$busca = " AND (cartao = '$cartao')";
				 }		

				$sel = $db->select("SELECT * FROM clientes					      
					      WHERE id!='0' AND nome!='CLIENTE AVULSO' AND nome!='' AND telefone!=''  $busca
					      ORDER BY id DESC
					      LIMIT 40
					      ");
				
							
			?>


			<div class="table-responsive" style="border-top: 0">
				  <table class="table table-striped">
				    
				    <tr>
				        <th width="60">ID</th>				        
				        <th>Nome</th>
				        <th>Telefones</th>				        
				        			        
				    </tr>	

				    <tbody>
				      <?php   

				      	 
						if($db->rows($sel)){						
							while($dados = $db->expand($sel)){								
							
					  ?>
						     
						      <tr class="cursor thin" onclick="javascript:exibe_ficha_cliente(<?php echo $dados['id']; ?>);">
						        <td>#<?php echo ($dados['id']); ?></td>						        					       
						        <td><?php echo ($dados['nome']); ?></td>
						        <td>(<?php echo ($dados['ddd']); ?>) <?php echo ($dados['telefone']); ?></td>
						        
						        	
						      </tr>
				      <?php
				      	}
				      } else {
				      	echo '<tr><td colspan="10" class="thin"><center>NENHUM CLIENTE ENCONTRADO!</center></td></tr>';
				      }
				      ?>
				    </tbody>

				</table>
			</div>