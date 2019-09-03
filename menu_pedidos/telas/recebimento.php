<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_cliente_venda.php");
require("../../includes/verifica_configuracoes_loja.php");

$disabled='';
if($total_recebido_venda!=0){
	$disabled='disabled';	
}


@session_start();
if(isset($_SESSION['id_mesa_erp_sis'])){
	//echo 'ID MESA: '.$_SESSION['id_mesa_erp_sis'];
} else {
	//echo 'NAO VEM ID MESA';
}


?>



<div class="col-lg-4">

	
	<input type="hidden" id="porcentagem_garcom" value="<?php echo $dados_configuracoes['porcentagem_garcom']; ?>">
	<input type="hidden" id="soma_entrega" value="<?php echo $dados_venda['valor_entrega']; ?>">
	<input type="hidden" id="soma_pedido" value="<?php echo $dados_venda['valor_total']; ?>">
	<input type="hidden" id="soma_final" value="<?php echo $dados_venda['valor_final_venda']; ?>">
	<input type="hidden" id="soma_desconto" value="<?php echo $dados_venda['valor_desconto']; ?>">
	<input type="hidden" id="tipo_desconto" value="<?php echo $dados_venda['tipo_desc']; ?>">
	<input type="hidden" id="restante_receber" value="<?php echo $valor_final_receber; ?>">
	<input type="hidden" id="val_recebido" value="<?php echo $total_recebido_venda; ?>">
	<input type="hidden" id="soma_garcom" value="<?php echo $dados_venda['valor_garcom']; ?>">

	<div class="order-top">
		<h20>Dados do Cliente</h20>			
	</div>

	<div class="card" style="border-top: 0; min-height: 114px; padding-bottom: 15px">
		<div class="col-12 top15">
			<div id="reload_dados_cliente_tela_pagamento">
				<?php require("../listagem/exibe_dados_cliente_tela_pagamento.php"); ?>
			</div>
		</div>	
	</div>	

		
	        <div class="row row-xs top15">

	        	<?php if($dados_configuracoes['modulo_entregas_pedidos']==1 || $dados_mesas['mesa']>0){ ?>
		        	<div class="col-6 bottom10">
		        		<button class="btn btn-block btn-success"  onclick="javascript:finaliza_pedido2();" type="button">
		        			<i class="icofont-save"></i>&nbsp;&nbsp;SALVAR (F2)
		        		</button>
		        	</div>
	        	<?php } ?>

	        	<div class="col-6 bottom10">
	        		<button class="btn btn-block btn-danger" id="botao_cancela_venda_pgto"  onclick="javascript:cancela_venda(<?php echo $id_venda; ?>);" type="button">
	        			<i class="icofont-ui-close"></i> CANCELAR (F4)
	        		</button>	        		
	        	</div>
	        	

	        	<?php
				if($dados_venda['aguarde']==1){
				?>
	        	<div class="col-6 bottom10">
	        		<button class="btn btn-danger btn-block" id="botao_impressao_pedido" style="font-weight: 300" onclick="javascript:finaliza_pedido2(<?php echo $id_venda; ?>, 1);">
						<i class="icofont-printer"></i>
						&nbsp;IMP. CONTA (F3)
					</button>	
	        	</div>	
	        <?php } ?>

	        	<?php	
	        	if($dados_venda['aguarde']==1){
					$analiza = $db->select("SELECT id FROM produtos_venda WHERE id_venda='$id_venda' AND nome_cliente_divisao!='' LIMIT 1");			
					if($db->rows($analiza)){
				?>

				<div class="col-6 bottom10">
					<button class="btn btn-md btn-teal btn-block " id="botao_impressao_pedido_divisao"  onclick="javascript:reimpressao_divisao_pedido(<?php echo $id_venda; ?>);" type="button">
						<i class="fa fa-print fa-fw" aria-hidden="true"></i> IMP. DIVISÃO (F6)
					</button>
				</div>	

				<?php }} ?>


				<div class="col-6 bottom10">
	        		<button class="btn btn-info btn-block"  onclick="javascript:mais_item_pedido();" type="button">
	        			<i class="icofont-plus"></i> ÍTENS (F8)
	        		</button>
	        	</div>	

	        </div>	


    	
		


		<?php							
			$oculta='hide';
			if($total_recebido_venda!=0){$oculta = '';}
		?>
		
		<a tabindex="-1" href="javascript:void(0)"  onclick="javascript:ve_pagamentos_recebidos();">	
		<div id="aviso_pagamentos_existentes" class="alert alert-warning thin top15 <?php echo $oculta; ?>" style="margin-bottom: 0">
			<i class="icofont-exclamation-tringle"></i> Existem valores recebidos para essa venda.
			<span class="pull-right">[ver detalhes]</span>			
		</div>
		</a>
			


		<?php	
			$analiza = $db->select("SELECT id FROM produtos_venda WHERE id_venda='$id_venda' AND nome_cliente_divisao!='' LIMIT 1");			
			if($db->rows($analiza)){
		?>
			
			<a tabindex="-1" href="javascript:void(0)" onclick="javascript:ve_compartilhamento_mesa();">
			<div class="alert alert-danger thin top15" style="margin-bottom: 0;">
				<i class="icofont-exclamation-tringle"></i> Mesa compartilhada entre pessoas.
				<span class="pull-right">[ver detalhes]</span>						
			</div>
			</a>
			
				
		<?php		
			}
		?>


		<?php
			$display_pontos_utiliza='none;';
				
		?>		
        
		<div class="alert alert-warning thin top15" style="margin-bottom: 0; padding: 7px; display: <?php echo $display_pontos_utiliza; ?>;" id="avisa_troca_pontos">
			<i class="icofont-exclamation-tringle"></i> Utilizado resgate de pontos.	

		</div>
		
		

	

</div>


<?php if($dados_configuracoes['modulo_entregas_pedidos']==1 || $dados_mesas['mesa']>0){ ?>
<div class="col-lg-4">

		
	<?php if($dados_configuracoes['modulo_entregas_pedidos']==1){ ?>
	<div class="order-top">
			<h20>Entrega/Retirada</h20>			
		</div>
    
    <div class="card bottom10" style="border-top: 0">
    <div class="row row-xs">	

    		<div class="col-12 top15">
        	<div class="col-12">
        		ENTREGA/RETIRADA: <br>
        		<a tabindex="-1" href="javascript:void(0)" class="qdx">ESCOLHA ENTREGA OU RETIRADA</a><br>
        			<select class="form-control top2 upper" id="taxa_entrega" onchange="javascript:escolhe_taxa_entrega(this.value);">
						
						<?php
							if($dados_venda['entrega']!=0){								
								$id_taxa_procura=$dados_venda['entrega'];
								$sql = $db->select("SELECT * FROM tipos_entrega WHERE id='$id_taxa_procura' LIMIT 1");
								$row = $db->expand($sql);

								echo '<option value="'.$row['id'].'" selected>'.$row['entrega'].' - R$ '.number_format($row['valor'],2,",",".").'</option>';																
												
							} else {

								if($dados_venda['aguarde']==0){
									echo '<option value="" selected>--------------------</option>';
									echo '<option value="0" >RETIRA NO BALCÃO</option>';	
								} else {

									if($dados_venda['id_mesa']==0){
										echo '<option value="0" selected>RETIRA NO BALCÃO</option>';	
										echo '<option value="">--------------------</option>';	

									} else {
										echo '<option value="" selected>--------------------</option>';	
										echo '<option value="0" >RETIRA NO BALCÃO</option>';	
										
									}
									
								}
								
								$id_taxa_procura=0;	
							}
										
							$sql = $db->select("SELECT * FROM tipos_entrega WHERE ativo='1' AND id!='$id_taxa_procura' ORDER BY valor");
							while($row = $db->expand($sql)){
								echo '<option value="'.$row['id'].'">'.$row['entrega'].' - R$ '.number_format($row['valor'],2,",",".").'</option>';
							}

							if($dados_venda['entrega']!=0){		
								echo '<option value="0">RETIRA NO BALCÃO</option>';	
								echo '<option value="">--------------------</option>';
							}

						?>

						
					</select>
        	</div>
        	</div>


        	<div class="col-12 top15 " >
        	<div class="col-12">	
        		TROCO/MÁQUINA CARTÃO: <br>
        		<a tabindex="-1" href="javascript:void(0)" class="qdx">ESCOLHA EM CASO DE ENTREGA</a><br>
        			<div class="input-group">
							      <div class="input-group-btn">
							        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdownMenuButton" style="height: 42px"> 
							        	<span id="tipo_escolha_pgto">
							        		<?php	
							        			if($dados_venda['levar_maquina_cartao']==1){
							        				echo 'CARTÃO';
							        				$disabled='disabled="disabled"';
							        				$val_troco = 'placeholder="LEVAR MÁQUINA"';
							        			} else if($dados_venda['troco_para']!='0.00' || $dados_venda['pre_tipo_pagamento']==1){
							        				echo 'TROCO PARA:';
							        				$disabled='';
							        				$val = '';
							        				$val_troco = 'value="'.$dados_venda['troco_para'].'"';
							        			} else {
							        				echo 'ESCOLHA';
							        				$disabled='disabled="disabled"';
							        				$val = '';
							        				$val_troco = 'placeholder=""';
							        			}
							        		?>
							        	</span> 
							        	<span class="caret"></span>
							        </button>

							         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									    <a tabindex="-1"  class="dropdown-item" href="javascript:void(0);" onclick="javascript:defini_tipo_troco_cartao_entrega(1);"><i class="icofont-dollar"></i> DINHEIRO</a>
									    <a tabindex="-1"  class="dropdown-item" href="javascript:void(0);" onclick="javascript:defini_tipo_troco_cartao_entrega(2);"><i class="icofont-credit-card"></i> CARTÃO</a>									    
									  </div>
							        
							      </div><!-- /btn-group -->
							      <input type="text"  class="form-control valores" <?php echo $disabled; ?>  <?php echo $val_troco; ?> id="troco_leva_maquina">							      
						</div><!-- /input-group -->				
						

						<input type="hidden" class="form-control" id="levar_maquina_cartao" value="<?php echo $dados_venda['levar_maquina_cartao']; ?>">

						<input type="hidden" class="form-control" id="pre_tipo_pagamento" value="<?php echo $dados_venda['pre_tipo_pagamento']; ?>">
        	</div>    
        	</div>


        	<div class="col-12 top15 <?php if($dados_configuracoes['escolhe_motoqueiro']==1 || $dados_configuracoes['escolhe_motoqueiro']==0){echo 'hide';} ?>">
        	<div class="col-12">	
        		ENTREGADOR: <br>
        		<a tabindex="-1" href="javascript:void(0)" class="qdx">ESCOLHA O ENTREGADOR</a><br>
        			<select class="form-control top2 upper" id="entregador">
						<option value="0">-- ESCOLHA --</option>
						<?php
							if($dados_venda['entregador']!=0){
								$id_entregador=$dados_venda['entregador'];
								$sql = $db->select("SELECT * FROM entregadores WHERE id='$id_entregador' LIMIT 1");
								$row = $db->expand($sql);
								echo '<option value="'.$row['id'].'" selected>'.$row['nome'].'</option>';
											
							} else {
								$id_entregador=0;	
							}
									
							$sql = $db->select("SELECT * FROM entregadores WHERE ativo='1' AND id!='$id_entregador' ORDER BY nome");
							while($row = $db->expand($sql)){
								echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
							}
						?>	
					</select>
        	</div>    
        	</div>


        	<div class="col-12 top15 bottom25">
        	<div class="col-12">	
        		EMBALAR P/ VIAGEM: <br>
        		<a tabindex="-1" href="javascript:void(0)" class="qdx">EMBALAR PEDIDO PARA VIAGEM</a><br>
        			<select class="form-control top2" id="embala_viagem">										
						<?php
							if($dados_venda['embala_viagem']==1){
								echo '<option value="1" selected>SIM</option>';								
								echo '<option value="0">NÃO</option>';									
							} else {

								if($dados_venda['entrega']!=0){
									echo '<option value="0">NÃO</option>';									
									echo '<option value="1" selected>SIM</option>';									
								} else {
									echo '<option value="0" selected>NÃO</option>';									
									echo '<option value="1">SIM</option>';									
								}
								
							}
																						
						?>	
					</select>
        	</div>    
        	</div>

    </div>  
    </div>
	<?php } else { ?>

		<input type="hidden" id="embala_viagem" value="0">
		<input type="hidden" id="entregador" value="0">
		<input type="hidden" id="levar_maquina_cartao" value="">
		<input type="hidden" id="pre_tipo_pagamento" value="0">
		<input type="hidden" id="troco_leva_maquina" value="0">
		<input type="hidden" id="taxa_entrega" value="0">

	<?php }  ?>	

    <?php
    if($dados_mesas['mesa']>0){
    ?>
    <div class="order-top">
			<h20>Mesa</h20>			
		</div>
    
    <div class="card" style="border-top: 0">
    <div class="row row-xs">	
        
        	<div class="col-12 top15 bottom15">
        	<div class="col-12">	
        		MESAS: <br>
        		<a tabindex="-1" href="javascript:void(0)" class="qdx">INFORME A MESA UTILIZADA</a><br>
        			<select class="form-control top2" id="mesa" onchange="javascript:escolhe_mesa(this.value);">
					<option value="0">--- ESCOLHA A MESA ---</option>
					<?php
						@session_start();

						if($dados_venda['id_mesa']!=0){
						
							$id_mesa_procura=$dados_venda['id_mesa'];
							echo '<option value="'.$id_mesa_procura.'" selected>MESA '.$id_mesa_procura.'</option>';	
						
						} elseif (isset($_SESSION['id_mesa_erp_sis'])) {
							
							$id_mesa_procura=$_SESSION['id_mesa_erp_sis'];
							echo '<option value="'.$id_mesa_procura.'" selected>MESA '.$id_mesa_procura.'</option>';
						
						}

						$sql = $db->select("SELECT * FROM mesas LIMIT 1");
						$line = $db->expand($sql);												
						$conta = 1;
						while($conta<=$line['mesa']){
							
								$sol = $db->select("SELECT id FROM aguarda_venda WHERE id_mesa='$conta' LIMIT 1");
								if($db->rows($sol)){									
								} else {
									echo '<option value="'.$conta.'">MESA '.$conta.'</option>';
								}

							

							$conta++;
						}
					?>		
				</select>
        	</div>    
        	</div>
    </div>
    </div>
    <?php
    } else {
    ?>
    	<input type="hidden" id="mesa" value="0">
    <?php
    } 
    ?>    	 


</div>   
<?php } else { ?>

	<input type="hidden" id="mesa" value="0">
	<input type="hidden" id="embala_viagem" value="0">
	<input type="hidden" id="entregador" value="0">
	<input type="hidden" id="levar_maquina_cartao" value="">
	<input type="hidden" id="pre_tipo_pagamento" value="0">
	<input type="hidden" id="troco_leva_maquina" value="0">
	<input type="hidden" id="taxa_entrega" value="0">
	
<?php } ?>


<?php
$disabled='';
if($total_recebido_venda!=0){
	$disabled='disabled';	
}
?>


<div class="col-lg-4">

    <div class="card card-connection" style="padding: 20px">
              
        <div class="row row-xs">
        	<div class="col-5">
            	SUBTOTAL <br>
                <a tabindex="-1" href="javascript:void(0)">SUBTOTAL DA COMPRA</a>
            </div>
        	<div class="col-7 tx-black tx-medium"><small>R$</small> 
        		<?php echo number_format(($dados_venda['valor_produtos']+$dados_venda['valor_acrescimos']),2,".",","); ?>
        	</div>            
        </div>
        <hr>

        	<div class="input-group">
                    <div class="input-group-append">
                  		<span class="input-group-text" style="border-right:0">
	                  		DESCONTO:                	
	                    	<?php
	                    		if(empty($dados_venda['tipo_desc'])){
	                    			echo '';
	                    		} else if($dados_venda['tipo_desc']=='dinheiro'){
	                    			echo 'R$';
	                    		} else if($dados_venda['tipo_desc']=='porcentagem'){
	                    			echo '%';
	                    		}	
	                    	?>
                    	</span>
                	</div>

                    <input <?php echo $disabled; ?> class="form-control valores" id="val_desconto" placeholder="0.00" value="<?php echo $dados_venda['val_desc']; ?>">         
                               
                    <span class="input-group-btn">
                    	
                    	<button  id="btn_desconto1" <?php echo $disabled; ?> style="height: 42px; border-right:1px;"  class="btn btn-primary" type="button" onclick="javascript:fazdesconto(1);">
                    		%
                    	</button>

                        <button id="btn_desconto2" <?php echo $disabled; ?> style="border-left:1px;  height: 42px; border-left:1px solid #85201D; margin-left: -3px" class="btn btn-primary" type="button" onclick="javascript:fazdesconto(2);">
                            R$
                        </button>

                        <button <?php echo $disabled; ?> style="border-left:1px solid #85201D; height: 42px; border-right:1px solid #85201D; margin-left: -3px" class="btn btn-primary" type="button" onclick="javascript:fazdesconto(3);">
                        	-
                        </button>

                    </span>

                    
            </div>
        	

        <div class="row row-xs" style="display: none;">
        	<div class="col-5">
            	SUBTOTAL <br>
                <a tabindex="-1" href="javascript:void(0)">DEVIDO PARCIAL</a>
            </div>
        	<div class="col-7 tx-primary"><small>R$</small> 
        		<span id="val_subtotal"><?php echo number_format(($dados_venda['valor_total']-$dados_venda['valor_desconto']),2,".",","); ?></span>
        	</div>            
        </div>
        <hr>

        <div class="row row-xs">
        	<div class="col-5">
            	TAXA DE ENTREGA <br>
                <a tabindex="-1"  href="javascript:void(0)">SOMADO AO SUBTOTAL</a>
            </div>
        	<div class="col-7 tx-black tx-medium"><small>R$</small> 
        		<span id="val_taxa_entrega"><?php echo $dados_venda['valor_entrega']; ?></div></span>            
        </div>
        <hr>


        <?php if($dados_configuracoes['porcentagem_garcom']!='0.00') { ?>

	        <div class="row row-xs">
	        	<div class="col-5">
	            	TAXA DE ATENDIMENTO <br>
	                <input type="checkbox" id="remove_taxa" onclick="javascript:remove_taxa_garcom();"  <?php if($dados_venda['libera_taxa_garcom']==0 && ($dados_venda['id_mesa']!=0 OR isset($_SESSION['id_mesa_erp_sis']))){echo 'checked';} ?> <?php echo $disabled; ?>>
	                <a tabindex="-1" style="cursor: pointer;"  href="javascript:void(0)">&nbsp;<?php echo $dados_configuracoes['porcentagem_garcom']; ?>% GARÇOM</a>
	            </div>
	        	<div class="col-7 tx-danger"><small>R$</small> 
	        		<span id="val_final_garcom">
	        			<?php 
		        			if($dados_venda['libera_taxa_garcom']==0 && ($dados_venda['id_mesa']!=0 OR isset($_SESSION['id_mesa_erp_sis']))){
		        				echo number_format($dados_venda['valor_garcom'],2,".",",");	        				
		        			} else {
		        				echo number_format($dados_venda['valor_garcom'],2,".",","); 	        				
		        			}
	        			?>	        				
	        			
	        		</span>
	        	</div>            
	        </div>

        <hr>
    	<?php } else { ?>

    			<input type="checkbox" id="remove_taxa" style="display: none;">

    	<?php }  ?>	

        <div class="row row-xs">
        	<div class="col-5">
            	RECEBIDO <br>
                <a tabindex="-1"  href="javascript:void(0)" onclick="javascript:ve_pagamentos_recebidos();">VALORES RECEBIDOS</a>
            </div>
        	<div class="col-7 tx-black tx-medium"><small>R$</small> 
        		<span id="val_recebido_texto"><?php echo number_format($total_recebido_venda,2,".",","); ?></span>
        	</div>            
        </div>
        <hr>

        


        <div class="row row-xs">
        	<div class="col-5">
            	RESTA A RECEBER <br>
                <a tabindex="-1" href="javascript:void(0)">FINAL A RECEBER</a>
            </div>
        	<div class="col-7 tx-danger"><small>R$</small> 
        		<span id="val_final"><?php echo number_format($valor_final_receber,2,".",","); ?></span>
        	</div>            
        </div>

        <hr>


        <div class="row row-xs">
	        <div class="col-md-6"> 
		        <div class="input-group input-group-lg">		              
		        	<div class="input-group-append">
		            	<span class="input-group-text" style="border-right:0" >
		            		<i class="icofont-ui-check color-verde" id="icon-ok-val-recebe"></i>	
		            		<i class="icofont-exclamation-tringle color-vermelho hide" id="icon-erro-val-recebe"></i>	            		
		            	</span>
		            </div>  
		                  
				    <input style="border-radius: 0" type="text" class="form-control valores" placeholder="0.00" id="valor_recebe" onkeyup="javascript:faz_saldo_restante(this.value);" <?php if($valor_final_receber==0){echo 'readonly';} ?>>	

				    <?php if($dados_configuracoes['modulo_fiscal']==1){ ?>
					    <div class="input-group-append">
			            	<span class="input-group-text" style="border-radius:0" >
			            		<input type="checkbox" value="1" id="venda_fiscal" <?php	if($total_recebido_venda!=0){echo 'disabled="disabled"'; } else { if($dados_configuracoes['fiscal_sempre_ativo']==1){echo 'checked="checked"';}  }?>>            		
			            	</span>
			            </div> 
		        	<?php } ?>

				</div>
			</div>

			<div class="col-md-6"> 
		        <div class="input-group input-group-lg" style="border-top: 0">		              
		        	<div class="input-group-append" style="border-top: 0">
		            	<span class="input-group-text" style="border-right:0"><i class="icofont-ui-reply"></i></span>
		            </div>  
		                  
				    <input style="border-radius: 0" type="text" class="form-control valores" placeholder="0.00" id="troco_recebe" readonly="readonly">            	
				</div>
			</div>
		</div>


	<div class="row row-xs">	
		<div class="col-md-12"> 
			<select class="form-control top10" id="forma_pagamento" style="border-radius: 0; text-transform: uppercase;" <?php if($valor_final_receber==0) {echo 'disabled';} ?>>
				<option value="0">-- PAGAMENTO --</option>
				<?php							
					$sql = $db->select("SELECT * FROM formas_pagamento WHERE ativo='1' ORDER BY id");
					while($row = $db->expand($sql)){
						echo '<option value="'.$row['id'].'">'.$row['forma'].'</option>';
					}
				?>	
			</select>
		</div>
       
       <div class="col-md-12"> 
        <?php if($valor_final_receber==0){ ?>

        	<button class="btn btn-success btn-block top10" id="btn_realiza_pagamento"  onclick="javascript:apenas_encerra_venda();" type="button" style="height: 42px">
				<i class="fa fa-check fa-fw" aria-hidden="true"></i> <span id="escrito_btn_recebimento">ENCERRAR VENDA</span>
			</button>

        <?php } else { ?>  

			<button class="btn btn-success btn-block top10" id="btn_realiza_pagamento"  onclick="javascript:realiza_pagamento();" type="button" style="height: 42px">
				<i class="fa fa-calculator fa-fw" aria-hidden="true"></i> <span id="escrito_btn_recebimento">RECEBER (F10)</span>
			</button>

	    <?php } ?>  
		</div>
	</div>	

              
    </div>
</div>


<input type="hidden" id="modulo_entregas_pedidos" value="<?php echo $dados_configuracoes['modulo_entregas_pedidos']; ?>">
<input type="hidden" id="qtd_mesas_totais" value="<?php echo $dados_mesas['mesa']; ?>">

<input type="hidden" id="utiliza_resgate_pontos" value="0">	
<input type="hidden" id="tela-mobile" value="0">
<input type="hidden" id="pedido_aguarda_venda" value="<?php echo $dados_venda['aguarde']; ?>">
<input type="hidden" id="tela_finaliza-pedido-enter" value="1">
<input type="hidden" id="nome_cliente_mobile">


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


