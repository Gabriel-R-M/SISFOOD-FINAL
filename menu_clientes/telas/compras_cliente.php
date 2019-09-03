<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");

$sql = $db->select("SELECT * FROM clientes WHERE id='$id' LIMIT 1");
$dados = $db->expand($sql);
?>


<div class="col-md-7">
			
	<div class="order-top">
		<h20>Compras Efetuadas</h20>			
	</div>

	<div class="card" id="rolagem">
	<div class="top15">
				
		<div class="col-md-12">	
			<h19 class="upper"><?php echo $dados['nome']; ?></h19>
		</div>	
			
			<div class="table-responsive top15" >

						  <table class="table table-striped">
						    
						    <tr>
						        <th width="60">ID</th>
						        <th width="200">Data/Hora</th>		
						        <th>Atendente</th>				        		        				        
						        <th>Valor</th>	

						        <th width="20"></th>	
						        <th width="20"></th>				        
						    </tr>	

						    <tbody>
						      <?php        	

							      $sel = $db->select("SELECT aguarda_venda.*, usuarios.nome FROM aguarda_venda
							      LEFT JOIN usuarios ON aguarda_venda.id_usuario=usuarios.id 
							      WHERE aguarda_venda.id_cliente='$id'
							      ORDER BY aguarda_venda.data_pedido DESC, aguarda_venda.pedido_inicio DESC				      
							      ");
								if($db->rows($sel)){						
									while($dados = $db->expand($sel)){								
									
							  ?>
								     
								      <tr  >
								        <td>#<?php echo ($dados['id']); ?></td>
								        <td><?php echo data_mysql_para_user($dados['data_pedido']); ?> ás <?php echo substr($dados['pedido_inicio'],0,5);?>hs</td>						        						       
								        <td class="upper"><?php echo ($dados['nome']); ?></td>
								        <td>R$ <?php echo number_format($dados['valor_final_venda'],2,".",","); ?></td>
								        
								        <td class="upper">
								        	<a href="javascript:void(0)" onclick="javascript:edita_pedido(<?php echo $dados['id']; ?>);">
								        		<i class="icofont-edit"></i>	
								        	</a>	
								        </td>
								        <td class="upper">
									        <a href="javascript:void(0)" onclick="javascript:reimpressao_completa_pedido(<?php echo $dados['id']; ?>);">	
									        	<i class="icofont-printer"></i>	
									        </a>	
								        </td>

								      </tr>
						      <?php
						      	}
						      } else {
						      	echo '<tr><td colspan="10"><center>Nenhuma venda encontrada para este cliente!</center></td></tr>';
						      }
						      ?>
						    </tbody>

						</table>
						
					</div>	
		</div>



	</div>		

</div>



<div class="col-md-5">
			
	<div class="order-top">
		<h20>Crediário do Cliente</h20>			
	</div>

	<div class="card" id="rolagem_contas_cliente">
	<div>	
		<div class="table-responsive" >

						  <table class="table table-striped">
						    
						    <tr>
						        <th width="40">ID</th>
						        <th width="200">Data/Hora</th>		
						        <th>Atendente</th>				        		        				        
						        <th>Tipo</th>				        	
						        <th>Valor</th>				        
						    </tr>	

						    <tbody>
						      <?php        	

						      	  $valor_debito = 0;
						      	  $valor_credito = 0;	
						      	  $valor_devido=0;

							      $sel = $db->select("SELECT contas_clientes.*, usuarios.nome FROM contas_clientes
							      LEFT JOIN usuarios ON contas_clientes.id_usuario=usuarios.id 
							      WHERE contas_clientes.id_cliente='$id'
							      ORDER BY contas_clientes.id DESC				      
							      ");
								if($db->rows($sel)){						
									while($dados = $db->expand($sel)){								
										
										//COMP DE PAGAMENTO
										if($dados['tipo']==1){
											$link = 'javascript:pergunta_imprime_comprovante_pagamento_crediario('.$dados['id'].');';

										//COMP DE COMPRA	
										} else {
											$link = 'javascript:pergunta_imprime_debito_crediario('.$dados['id'].');';
										}	

							  ?>
								     
								      <tr class="cursor" onclick="<?php echo $link; ?>">
								        <td>#<?php echo ($dados['id']); ?></td>

								        <?php
								        	//DEBITO//
								        	if($dados['tipo']==0){
								        		$valor_debito = ($valor_debito+$dados['valor']);
								        		echo '<td>'.data_mysql_para_user(substr($dados['data_debito'],0,10)).' ás '.substr($dados['data_debito'],11,5).'hs</td>';	
								        	}
								        ?>

								        <?php
								        	//CREDITO//
								        	if($dados['tipo']==1){
								        		$valor_credito = ($valor_credito+$dados['valor']);
								        		echo '<td>'.data_mysql_para_user(substr($dados['data_pgto'],0,10)).' ás '.substr($dados['data_pgto'],11,5).'hs</td>';	
								        	}
								        ?>

								        		       
								        <td class="upper"><?php echo ($dados['nome']); ?></td>
								        
								        <?php
								        	//DEBITO//
								        	if($dados['tipo']==0){
								        		echo '<td><span class="bg-danger tx-white pd-pd"><small>COMPRA</small></span></td>';	
								        	}

								        	//CREDITO//
								        	if($dados['tipo']==1){
								        		echo '<td><span class="bg-success tx-white pd-pd"><small>RECEBIDO</small></span></td>';	
								        	}
								        ?>

								        <td>R$ <?php echo number_format($dados['valor'],2,".",","); ?></td>
								        	
								      </tr>
						      <?php
						      	}
						      } else {
						      	echo '<tr><td colspan="10"><center>Nenhuma informação de crediário encontrada!</center></td></tr>';
						      }
						      ?>
						    </tbody>

						</table>
						
					</div>	
		</div>
	</div>	

	





	<div class="card card-connection top10">
              
       <?php
        $disabled='';
       	$valor_devido = ($valor_debito-$valor_credito);
       	if ($valor_devido<0 || $valor_devido==0){
       		$valor_devido=0;
       		$disabled = 'disabled="disabled"';
       	}
       ?>

       <input type="hidden" value="<?php echo $valor_devido; ?>" id="restante_receber">
       <input type="hidden" value="<?php echo $id; ?>" id="id_cliente_crediario">

        <div class="row row-xs">
        	<div class="col-5">
            	VALOR DEVIDO <br>
                <a href="javascript:void(0)">A RECEBER</a>
            </div>
        	<div class="col-7 tx-danger"><small>R$</small> 
        		<span id="val_final"><?php echo number_format($valor_devido,2,".",","); ?></span>
        	</div>            
        </div>

        <hr>

        <div class="row">
	        <div class="col-md-12"> 
		        <div class="input-group input-group-lg">		              
		        	<div class="input-group-append">
		            	<span class="input-group-text" style="border-right:0" >
		            		<i class="icofont-ui-check color-verde" id="icon-ok-val-recebe"></i>	
		            		<i class="icofont-exclamation-tringle color-vermelho hide" id="icon-erro-val-recebe"></i>	            		
		            	</span>
		            </div>  
		                  
				    <input style="border-radius: 0" type="text" class="form-control valores" placeholder="0.00" id="valor_recebe" onkeyup="javascript:faz_troco_cliente(this.value);" <?php echo $disabled; ?>>		              	
				</div>
			</div>

			<div class="col-md-12"> 
		        <div class="input-group input-group-lg" style="border-top: 0">		              
		        	<div class="input-group-append" style="border-top: 0">
		            	<span class="input-group-text" style="border-right:0"><i class="icofont-ui-reply"></i></span>
		            </div>  
		                  
				    <input style="border-radius: 0" type="text" class="form-control valores" placeholder="0.00" id="troco_recebe" readonly="readonly">            	
				</div>
			</div>
		</div>


		<select <?php echo $disabled; ?> class="form-control top5" id="forma_pagamento" style="border-radius: 0; text-transform: uppercase;">
			<option value="0">-- FORMA DE PAGAMENTO --</option>
			<?php							
				$sql = $db->select("SELECT * FROM formas_pagamento WHERE ativo='1' AND id!='3' ORDER BY id");
				while($row = $db->expand($sql)){
					echo '<option value="'.$row['id'].'">'.$row['forma'].'</option>';
				}
			?>	
		</select>
       
          
		<button class="btn btn-success btn-block top10" id="btn_realiza_pagamento" <?php echo $disabled; ?>  onclick="javascript:realiza_recebimento_crediario();" type="button" style="height: 42px">
			<i class="fa fa-calculator fa-fw" aria-hidden="true"></i> <span id="escrito_btn_recebimento">RECEBER</span>
		</button>
              
    </div>






</div>


<script>	
	$(document).ready(function(){
		$('#rolagem, #rolagem_contas_cliente').perfectScrollbar();
	});		
	$(".valores").maskMoney({
		symbol:'', // Simbolo
		decimal:'.', // Separador do decimal
		precision:2, // Precisão
		thousands:'', // Separador para os milhares
		allowZero:true, // Permite que o digito 0 seja o primeiro caractere
		showSymbol:false // Exibe/Oculta o símbolo
	});	
	window.clearTimeout(atualiza_pedidos);	
</script>

