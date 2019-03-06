<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_caixa_aberto.php");
require("../actions/totalizadores_caixa.php");
?>

<div class="col-md-12">
			
			<div class="order-top">
				<h20>Manutenção de Caixa</h20>			
			</div>

			<div class="col-md-12 card">
				<div class="row row-xs top15 bottom15">

				<div class="col-md-4">
					<ul class="list-group">        
			            <li class="list-group-item">
			            	<span class="thin">CAIXA ABERTO:</span>
			            	<span class="pull-right"><?php echo data_mysql_para_user($dados_caixa_aberto['data_abertura']).' ás '.substr($dados_caixa_aberto['hora_abertura'],0,5).'hs'; ?></span>
			            </li>	
			        </ul>    	
				</div>

				<div class="col-md-4">
					<ul class="list-group">        
			            <li class="list-group-item">
			            	<span class="thin">RESPONSÁVEL:</span>
			            	<span class="pull-right upper"><?php echo $nome_responsavel_caixa_aberto ?></span>
			            </li>	
			        </ul>    	
				</div>

				<div class="col-md-4">
					<?php 
						if($dados_caixa_aberto['data_fechamento']!='0000-00-00'){
							echo '
								<ul class="list-group">        
						            <li class="list-group-item">
						            	<span><strong>Finalizado em:</strong></span>
						            	<span class="pull-right">'.data_mysql_para_user($dados_caixa_aberto['data_fechamento']).' ás '.substr($dados_caixa_aberto['hora_fechamento'],0,5).'hs'.'</span>
						            </li>	
						        </ul>
							';
						} else {
							echo '<button class="btn btn-danger pull-right" style="height: 43px" onclick="javascript:nova_saida_caixa(0);">NOVA RETIRADA</button> ';
						} 
					?>
					  	
				</div>

			</div>
			</div>


		<ul class="list-group bottom5" >
        
            <li class="list-group-item" style="border-bottom: 0; border-top: 0">
            	<a tabindex="-1" href="javascript:void(0)" onclick="javascript:vizualiza_vendas(1);">RECEBIMENTOS EM DINHEIRO:</a>
            	<span class="pull-right">R$ <?php echo number_format(devolve_valores_caixa($id_caixa_aberto,1),2,".",","); ?> +</span>
            </li>

             <li class="list-group-item" style="border-bottom: 0">
            	<a tabindex="-1" href="javascript:void(0)" onclick="javascript:vizualiza_vendas(2);">RECEBIMENTOS NO CARTÃO:</a>
            	<span class="pull-right">R$ <?php echo number_format(devolve_valores_caixa($id_caixa_aberto,2),2,".",","); ?> +</span>
            </li>
           
             <li class="list-group-item" style="border-bottom: 0">
            	<a tabindex="-1" href="javascript:void(0)" onclick="javascript:vizualiza_recebimentos_crediario();">RECEBIMENTOS DE CREDIÁRIO:</a>
            	<span class="pull-right">R$ <?php echo number_format(devolve_valores_caixa($id_caixa_aberto,3),2,".",","); ?> +</span>
            </li>

            <li class="list-group-item active" style="border-bottom: 0">
            	<span>SUBTOTAL:</span>
            	<span class="pull-right" id="val_subtotal">R$ <?php echo number_format(devolve_valores_caixa($id_caixa_aberto,0),2,".",","); ?> =</span>
            </li>
            
           
             <li class="list-group-item" style="border-bottom: 0"> 
            	<span>TROCO INICIAL:</span>
            	<span class="pull-right">R$ <?php echo number_format(devolve_troco_caixa($id_caixa_aberto),2,".",","); ?> +</span>
            </li>

             <li class="list-group-item">             	
            	<a tabindex="-1" href="javascript:void(0)" onclick="javascript:vizualiza_saidas_caixa(0);">SAÍDAS DE CAIXA:</a>
            	<span class="pull-right">R$ <?php echo number_format(devolve_saidas_caixa($id_caixa_aberto),2,".",","); ?> -</span>
            </li>

            <li class="list-group-item active" style="border-bottom: 0">
            	<span>TOTAL EM CAIXA:</span>
            	<span class="pull-right" id="val_final">R$ <?php echo number_format(devolve_final_caixa($id_caixa_aberto),2,".",","); ?> =</span>
            </li>

            
            
          </ul>  



          <div class="col-md-12 card">
				<div class="row row-xs top15  bottom15">

				<div class="col-md-2">
					<ul class="list-group">        
			            <li class="list-group-item">
			            	<a tabindex="-1" href="javascript:void(0)" onclick="javascript:vizualiza_entregas_caixa(0);">QTD ENTREGAS:</A>
			            	<span class="pull-right"><?php echo totais_entregas_caixa($id_caixa_aberto); ?></span>
			            </li>	
			        </ul>    	
				</div>
	

				<div class="col-md-5">
					<ul class="list-group">        
			            <li class="list-group-item">
			            	<span class="thin">TOTAL VENDAS BALCÃO/RETIRADA:</span>
			            	<span class="pull-right">R$ <?php echo number_format(totais_caixa_separado_entrega_balcao($id_caixa_aberto,0),2,".",",");; ?></span>
			            </li>	
			        </ul>    	
				</div>

				<div class="col-md-5">
					<ul class="list-group">        
			            <li class="list-group-item">
			            	<span class="thin">TOTAL VENDAS ENTREGAS:</span>
			            	<span class="pull-right upper">R$ <?php echo number_format(totais_caixa_separado_entrega_balcao($id_caixa_aberto,1),2,".",",");; ?></span>
			            </li>	
			        </ul>    	
				</div>

	
			</div>
			</div>


</div>	
	
	<?php 
	if($dados_caixa_aberto['data_fechamento']=='0000-00-00'){	
			$disabled='';
			$sel = $db->select("SELECT id FROM aguarda_venda WHERE id_caixa='$id_caixa_aberto' AND finalizada='0' AND aguarde='1' LIMIT 1");
			if($db->rows($sel)){
				$disabled='disabled';
			}

	?>
		<div class="col-md-12 top5">
			
				<button <?php echo $disabled; ?>  onclick="javascript:confirma_fecha_caixa();" class="btn btn-danger ">FINALIZAR CAIXA</button>   	
			
		</div>
	<?php 	

		if($db->rows($sel)){
			echo '<div class="col-md-12 top10">';
				echo '<div class="alert alert-danger">';
					echo 'NÃO É POSSÍVEL FINALIZAR O CAIXA, POIS EXISTEM VENDAS EM ABERTO. FINALIZE-AS PARA CONTINUAR.';
				echo '</div>';
			echo '</div>';	
		}

	}
	?>	
		

	


<script type="text/javascript">     
	$(".valores").maskMoney({
		symbol:'', // Simbolo
		decimal:'.', // Separador do decimal
		precision:2, // Precisão
		thousands:'', // Separador para os milhares
		allowZero:true, // Permite que o digito 0 seja o primeiro caractere
		showSymbol:false // Exibe/Oculta o símbolo
	});	
</script>

<script>		
	window.clearTimeout(atualiza_pedidos);	
</script>
