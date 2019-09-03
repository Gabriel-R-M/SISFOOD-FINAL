
<div class="table-responsive">
  <table class="table table-striped">
    
    <tr>
        <th width="30">ID</th>
        <th width="200">Data/Hora</th>
        <th>Cliente</th>
        <th>Atendente</th>
        <th>Total R$</th>
        <th>Tipo</th>        
    </tr>	

    <tbody>
      <?php      
	      $sel = $db->select("SELECT aguarda_venda.*, clientes.nome, usuarios.nome AS atendente FROM aguarda_venda 	      	
	      LEFT JOIN clientes ON aguarda_venda.id_cliente=clientes.id
	      LEFT JOIN usuarios ON aguarda_venda.id_usuario=usuarios.id
	      WHERE aguarda_venda.finalizada='1' AND aguarda_venda.id_caixa='$id_caixa_aberto' AND aguarda_venda.baixado='1'
	      ORDER BY aguarda_venda.pedido_inicio DESC
	      ");
		if($db->rows($sel)){
			
			while($dados = $db->expand($sel)){
			
			//ENTREGA	
			if($dados['entrega']!=0){
				$entrega = '<span class="label label-primary">ENTREGA</span>';

			//MESA	
			} else if($dados['ocupou_mesa']!=0){
				$entrega = '<span class="label label-info">MESA</span>';
			//RETIRA BALCÃO	
			} else {
				$entrega = '<span class="label label-warning">BALCÃO</span>';
			}

			if($dados['venda_fiscal']==1){
				$entrega .= '&nbsp;&nbsp;<span class="label label-danger">FISCAL</span>';
			}	


	  ?>
		      <tr class="cursor thin upper" onclick="javascript:edita_pedido(<?php echo ($dados['id']); ?>);">
		        <td><?php echo ($dados['id']); ?></td>
		        <td><?php echo data_mysql_para_user($dados['data_pedido']); ?> ás <?php echo substr($dados['pedido_inicio'],0,5);?>hs</td>
		        <td>
		        	<?php 
                        if(!empty($dados['nome_cliente'])){
                            echo $dados['nome_cliente'];
                        } else {
                             echo $dados['nome'];
                        }
                    ?>
                </td>
		        <td><?php echo ($dados['atendente']); ?></td>
		        <td>R$ <?php echo number_format($dados['valor_final_venda'],2,".",","); ?></td>
		        <td><?php echo $entrega; ?></td>
		        	
		        	
		        	
		        </td>
		        
		      </tr>
      <?php
      	}
      } else {
      	echo '<tr><td colspan="10"><center>Nenhum pedido encontrado!</center></td></tr>';
      }
      ?>
    </tbody>

  </table>
</div>