<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_cliente_venda.php");

$disabled='';
if($total_recebido_venda!=0){
	$disabled='disabled';	
}
?>



<input type="hidden" id="soma_entrega" value="<?php echo $dados_venda['valor_entrega']; ?>">
<input type="hidden" id="soma_pedido" value="<?php echo $dados_venda['valor_total']; ?>">
<input type="hidden" id="soma_final" value="<?php echo $dados_venda['valor_final_venda']; ?>">
<input type="hidden" id="soma_desconto" value="<?php echo $dados_venda['valor_desconto']; ?>">
<input type="hidden" id="tipo_desconto" value="<?php echo $dados_venda['tipo_desc']; ?>">
<input type="hidden" id="restante_receber" value="<?php echo $valor_final_receber; ?>">
<input type="hidden" id="val_recebido" value="<?php echo $total_recebido_venda; ?>">

<div  id="rola_mobile">	


<div class="col-12" >
<div class="row">	

	<div class="col-md-12 order-top">
		<h20>Cliente/Mesa</h20>			
	</div>
    
    <div class="card" style="border-top: 0">
    <div class="row row-xs">

    		<?php 
    			$nome_cliente='';
    			if($dados_venda['nome_cliente']!=''){
    				$nome_cliente = $dados_venda['nome_cliente'];

    			} else if($dados_cliente['nome']!='CLIENTE AVULSO' && $dados_cliente['nome']!=''){
    				$nome_cliente = $dados_cliente['nome'];
    			}	
    				

    		?>

    		<div class="col-12 top10">
        	<div class="col-12">	
        		<a href="javascript:void(0)" class="qdx">NOME CLIENTE</a><br>
        			<input class="form-control top2" id="nome_cliente_mobile" value="<?php echo $nome_cliente; ?>">																
        	</div>    
        	</div>	
        
        	<div class="col-12 top10 bottom15">
        	<div class="col-12">	
        		
        		<a href="javascript:void(0)" class="qdx">INFORME A MESA UTILIZADA</a><br>
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

        	<div class="col-12 bottom15">
        	<div class="col-12">	
        		<a href="javascript:void(0)" class="qdx">EMBALAR PEDIDO PARA VIAGEM</a><br>
        			<select class="form-control top2" id="embala_viagem">										
						<?php
							if($dados_venda['embala_viagem']==1){
								echo '<option value="1" selected>SIM</option>';								
								echo '<option value="0">NÃO</option>';									
							} else {
								echo '<option value="0" selected>NÃO</option>';									
								echo '<option value="1">SIM</option>';								
							}
																						
						?>	
					</select>
        	</div>    
        	</div>

    </div>
    </div>   


</div>	   
</div>    	




<div class="col-12 top10 hide" >
	    <div class="card card-connection">
	              
	        <div class="row row-xs">
	        	<div class="col-5">
	            	SUBTOTAL <br>
	                <a href="javascript:void(0)">A RECEBER</a>
	            </div>
	        	<div class="col-7 tx-black tx-big"><small>R$</small> 
	        		<?php echo number_format(($dados_venda['valor_produtos']+$dados_venda['valor_acrescimos']),2,".",","); ?>
	        	</div>            
	        </div>        
	              
	    </div>
	</div>



<div class="row row-xs top10" >

	        	<div class="col-12">
	        		<button class="btn btn-block btn-success btn-lg"  onclick="javascript:finaliza_pedido2();" type="button">
	        			<i class="icofont-save"></i>&nbsp;&nbsp;SALVAR 
	        		</button>
	        	</div>

	        	
	        	<div class="col-12 top10">
	        		<button class="btn btn-info btn-block btn-lg"  onclick="javascript:mais_item_pedido();" type="button">
	        			<i class="icofont-plus"></i> ÍTENS 
	        		</button>
	        	</div>	


	        			

</div>	




</div>

<input type="hidden" id="tela-mobile" value="1">
<input type="hidden" id="pedido_aguarda_venda" value="<?php echo $dados_venda['aguarde']; ?>">
<input type="hidden" id="tela_finaliza-pedido-enter" value="1">



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

	$(document).ready(function(){
		//$('#rola_mobile').perfectScrollbar();
	});	
	window.clearTimeout(atualiza_pedidos);	
</script>


