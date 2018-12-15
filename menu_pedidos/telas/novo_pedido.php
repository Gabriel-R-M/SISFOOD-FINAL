<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_cliente_venda.php");
require("../../includes/verifica_configuracoes_loja.php");
require("../../diversos/funcoes_diversas.php");

$disabled='';
if($dados_venda['finalizada']==1){
	$disabled = 'hide';	
}

$hide_categorias='';
$classe_tamanho_exibicao_produtos = 'produtos_exibe_varias_categorias';

//SELECIONA A QUANTIDADE DE CATEGORIAS CADASTRADAS//
$select = $db->select("SELECT id FROM categorias");
$total_categorias = $db->rows($select);
if($total_categorias<2){
	$classe_tamanho_exibicao_produtos = 'produtos_exibe_uma_categoria';
	$hide_categorias='hide';
}
?>


<div class="col-md-4 thin" id="lateral-pedido">
	
	<div class="order-top">
		<h20>
			PEDIDO: <?php echo $id_venda; ?>
			<?php 
            	if($dados_venda['id_mesa']!=0){
            		echo '&nbsp;(MESA '.$dados_venda['id_mesa'].')';	            	
	            } else {
	            	if($dados_venda['ocupou_mesa']!=0){
	                 	echo '&nbsp;(MESA '.$dados_venda['ocupou_mesa'].')';
	                }
	            }
            ?>
		</h20>		
		<h20 class="pull-right">
			<?php echo data_mysql_para_user($dados_venda['data_pedido']); ?>
			(<?php echo substr($dados_venda['pedido_inicio'],0,5); ?>h)		
		</h20>			
	</div>

	<div class="card" id="resumo-pedido-comanda">
		<?php require("../listagem/listagem_itens_pedido.php"); ?>	
	</div>	

	<div class="text-right top10 thin color-black <?php if($dados_venda['finalizada']==1){ echo 'hide'; }?>">
		<small>SUBTOTAL:</small> <b>R$ <span id="valor_final_pedido_comanda"><?php require("../actions/salva_totais_pedido.php"); ?></span></b>
	</div>	
	
	<?php
	if($dados_venda['finalizada']==1){
	?>

		<button class="btn btn-danger top10 " id="botao_cancela_venda_pgto" style="font-weight: 300" onclick="javascript:cancela_venda(<?php echo $id_venda; ?>);">
			<i class="icofont-ui-close"></i>
			&nbsp;CANCELAR (F4)
		</button>	
 
		<button class="btn btn-danger top10 " style="font-weight: 300" id="botao_impressao_pedido" onclick="javascript:reimpressao_completa_pedido(<?php echo $id_venda; ?>);">
			<i class="icofont-printer"></i>
			&nbsp;REIIMPRIMIR (F3)
		</button>	

	<?php } else { ?>	


		<?php if($dados_venda['aguarde']==0) { ?>		

			<button class="btn btn-success btn-block top10 botao_pedido_grande" style="font-weight: 300;" onclick="javascript:finaliza_pedido();">
				<i class="icofont-calculator-alt-2"></i>
				FINALIZAR PEDIDO (F2)
			</button>	

		<?php } else { ?>			
			
			<div class="row row-xs">
				
				<div class="col-md-5">
					<button class="btn btn-primary btn-block top10 botao_pedido_grande" style="font-weight: 300;" onclick="javascript:apenas_salva_pedido();">
						
						SALVAR
					</button>
				</div>	

				<div class="col-md-7">
					<button class="btn btn-success btn-block top10 botao_pedido_grande" style="font-weight: 300;" onclick="javascript:finaliza_pedido();">						
						FINALIZAR (F2)
					</button>	
				</div>	

			</div>	

		<?php } ?>		


	<?php } ?>		
	

</div>	

<div class="col-md-8">
	

	<?php
	if($dados_venda['finalizada']==1){
		require("dados_pedido_finalizado.php");
	}
	?>
<input type="hidden" id="quantidadeproduto2" >
	<div class="row row-xs <?php echo $disabled; ?>">	
		
		<div class="col-md-5">
			


			<div class="botoes-insercao-itens-pedido">
				<div class="input-group ">
	                <input type="text" tabindex="-1" onkeypress='return SomenteNumero(event)' class="form-control" id="quantidade-produto" value="1">
	                <span class="input-group-btn">
	                  <button class="btn bd bd-l-0 btn-danger botao-adicao-produto" type="button" onclick="javascript:exibicao_adicionais_produto_selecionado();">
	                  	<i class="icofont-ui-add"></i> <br><span>(ADICIONAIS)</span>
	                  </button>
	                  <button id="botao_opcoes_combo" class="btn bd bd-l-0 btn-info botao-adicao-produto bt-adicao-produto2 hide" type="button" onclick="javascript:exibicao_opcoes_produto_selecionado();">
	                  	<i class="icofont-ui-add"></i> <br><span>(COMBO)</span>
	                  </button>
	                  <button class="btn bd bd-l-0 btn-success botao-adicao-produto bt-adicao-produto1" type="button" onclick="javascript:salva_item_pedido();">
	                  	<i class="icofont-ui-check" ></i> <br><span>(INSERIR)</span>
	                  </button>
	                </span>
	            </div>
        	</div>
            
		</div>

		<div class="col-md-7" id="input_busca_produto">
			
			<div id="campo_para_pesquisa_produto">
				<input type="text" class="form-control pull-right" placeholder="CÓDIGO OU PRODUTO (F10)" onkeyup="javascript:pesquisa_produtos_venda(this.value);" id="input_pesquisa_produto" tabindex="-1">
				<i class="icofont-barcode"></i>
			</div>

			<div id="campo_para_variacao_produto">
				<select class="form-control pull-right" id="tamanho" onchange="javascript:selecao_variacao(this.value)"></select>
				<i class="icofont-exclamation-tringle error-select-variacao"></i>
				<i class="icofont-verification-check ok-select-variacao"></i>
			</div>	

		</div>
	</div>
	
	

	<div class="top10" id="exibicao_adicionais_produto_selecionado"></div>	

	<div class="top10" id="exibicao_opcoes_produto_selecionado"></div>	


		
	<div class="top10 <?php echo $classe_tamanho_exibicao_produtos; ?>" id="exibicao_produtos_pedido">

		<div class="box-nome-cliente bottom10">
			<div class="row row-xs">	
				<div class="col-md-6">
					<input type="text" class="form-control input-block" placeholder="NOME DO CLIENTE" id="nome-cliente-produto">
					<i class="icofont-users-alt-4"></i>
			    </div>

			    <div class="col-md-6" >
					<input type="text" class="form-control input-block" placeholder="OBSERVAÇÕES" id="observacoes-produto">
					<i class="icofont-pencil-alt-1"></i>
			    </div>
			</div>    
		</div>

		<div id="exibe_pesquisa">
			
		</div>
		
		<div class="tab-content <?php echo $disabled; ?>" id="exibe_categorias" style="overflow-x: hidden;">

			<?php
		  	$sel = $db->select("SELECT * FROM categorias WHERE ativo='1' ORDER BY ordem");
		  	$class='';
		  	$contador=1;		  	
		  	while($row = $db->expand($sel)){
		  		
		  		if($contador==1){ $class='active'; }			
		  		 	 	  		

		  		echo '<div id="div'.$contador.'" class="tab-pane '.$class.'">';
		  		echo '<div class="row row-xs">';

		  			$id_categoria = $row['id'];
		  			$contador_produtos=1;
		  			$seleciona_produtos = $db->select("SELECT codigo, id, produto, preco_composto FROM lanches 
		  				WHERE ativo='1' AND categoria='$id_categoria' 
		  				ORDER BY $ordem_exibicao_produtos");

		  			if($db->rows($seleciona_produtos)) {
			  			while($line = $db->expand($seleciona_produtos)){

			  				$selected = '';
			  				if($contador_produtos==1){ $selected='selected'; }	


			  				if($contador_produtos==1){
				  					//echo '
				  					//<div class="col-md-3 hide">
				  					//<div class="card '.$classe.' produto-round navegacao'.$contador.' '.$selected.' " id="produtox0" >12
				  					//</div>
				  					//</div>';
				  					//$selected='';
								}	
			  				

			  				echo '<div class="col-md-3 bottom10 produtos_categoria_selecionada'.$contador.'" data-name="'.nomes_produtos_busca($line['produto']).' '.nomes_produtos_busca($line['codigo']).'" id="prod_name_div'.$line['id'].'">';

			  				if($row['meio_meio']!=0){
			  					$classe = 'pdr1';
			  					$classe2 = 'pdr1a';
			  					echo '<a tabindex="-1" href="javascript:void(0)" onclick="javascript: seleciona_produtos(1,'.$line['id'].','.$line['preco_composto'].','.$id_categoria.');" id="link_selecao'.$line['id'].'">';
				  			} else {
				  				echo '<a tabindex="-1" href="javascript:void(0)" onclick="javascript: seleciona_produtos(2,'.$line['id'].','.$line['preco_composto'].','.$id_categoria.');" id="link_selecao'.$line['id'].'">';
				  				$classe = 'pdr2';
				  				$classe2 = 'pdr2a';
				  			}

				  				
			  					echo '<div class="card '.$classe.' produto-round navegacao'.$contador.' '.$selected.'" data-id="'.$line['id'].'" id="produtox'.$line['id'].'">';
		
			  						echo '<div class="col-md-12 detalhes-produtos">';
			  							

				  								if($row['meio_meio']!=0){
				  									
				  									echo '<input tabindex="-1" name="produto" type="checkbox" class="radio-produtos2 marca-produtos prod-meio-meio" value="'.$line['id'].'" id="check'.$line['id'].'">';
				  								} else {				  									
				  									echo '<input tabindex="-1" name="produto" value="'.$line['id'].'" type="radio" class="radio-produtos2 marca-produtos prod-normais" id="check'.$line['id'].'">';
				  								}
				  							
			  						
			  						echo '<input tabindex="-1" type="text" id="foca_campo'.$line['id'].'" value="['.$row['categoria'].']" class="campo-focus upper '.$classe2.'" readonly>';

			  						if(!empty($line['codigo'])){	
			  							echo '<span class="destaca pull-right" id="destaca'.$line['id'].'">('.$line['codigo'].')</span>';
			  						}

			  						echo '<h2 id="prod_name'.$line['id'].'" class=" prod_name">'.$line['produto'].'</h2>';	
	

			  						echo '</div>';	
			  					echo '</div>';

			  					echo '</a>';

			  				echo '</div>';
			  				

			  				$contador_produtos++;

			  			}
		  			}	



		  		echo '</div>';
		  		echo '</div>';

		  		$class ='';
		  		$contador++;
		  	}
		  ?>
			
		  </div>

	</div>

		

		<div class="top20 <?php echo $disabled; ?> <?php echo $hide_categorias; ?>" id="exibicao_categorias_pedido" >
			<select id="categoria_selecionada" class="form-control select_pedido_grande upper thin text-center" style="height: 60px; border-radius: 0" onchange="javascript:exibe_produtos_categorias_pedido(this.value)">
				<?php
				  	$sel = $db->select("SELECT * FROM categorias WHERE ativo='1' ORDER BY ordem");				  	
				  	$contador=1;
				  	while($row = $db->expand($sel)){	
				  						  	
					  		echo '<option value="'.$contador.'">'.$row['categoria'].'</option>';				  			
					  		

					  	$contador++;

				  	}
				 ?>			
			</select>

		</div>	



<input type="hidden" id="impressao_item_avulso" value="<?php echo $dados_configuracoes['impressao_avulsa_item']; ?>">
<input type="hidden" id="tela-mobile" value="0">
<input type="hidden" id="pedido_aguarda_venda" value="<?php echo $dados_venda['aguarde']; ?>">
<input type="hidden" id="avanca-pedido-enter" value="1">

<script>
	$(document).ready(function(){
		
		$('#resumo-pedido-comanda, #exibicao_produtos_pedido, #exibicao_categorias_pedido, .listagem-pagamentos-recebidos').perfectScrollbar();
	});	
	window.clearTimeout(atualiza_pedidos);	
</script>

