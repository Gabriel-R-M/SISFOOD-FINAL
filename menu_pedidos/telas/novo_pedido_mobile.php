<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_cliente_venda.php");
require("../../includes/verifica_configuracoes_loja.php");
require("../../diversos/funcoes_diversas.php");
?>





<div class="col-md-4 thin" id="lateral-pedido">
		
		<div class="order-top">
			<h20>PEDIDO: <?php echo $id_venda; ?></h20>		
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

			<button class="btn btn-danger top10" id="botao_cancela_venda_pgto" style="font-weight: 300" onclick="javascript:cancela_venda(<?php echo $id_venda; ?>);">
				<i class="icofont-ui-close"></i>
				&nbsp;CANCELAR (F4)
			</button>	
	 
			<button class="btn btn-danger top10" style="font-weight: 300" id="botao_impressao_pedido" onclick="javascript:reimpressao_completa_pedido(<?php echo $id_venda; ?>);">
				<i class="icofont-printer"></i>
				&nbsp;REIIMPRIMIR (F3)
			</button>	

		<?php } else { ?>	

			<div class="row row-xs">
				
				<div class="col-6">
					<button class="btn btn-danger btn-block top10 bottom10" style="font-weight: 300;" onclick="javascript:voltar_confere_pedido_mobile();">
						<i class="icofont-simple-left"></i>
						VOLTAR
					</button>	
				</div>	

				<div class="col-6">
					<button class="btn btn-success btn-block top10 bottom10" style="font-weight: 300;" onclick="javascript:finaliza_pedido();">
						<i class="icofont-verification-check"></i>
						SALVAR PEDIDO
					</button>	
				</div>	

			</div>			
			

		<?php } ?>		
	
</div>	





		<div class="botoes-insercao-itens-pedido">
			
			<div class="col-md-12">				
				<button class="btn bd bd-l-0 btn-danger botao-adicao-produto metade_tamanho" type="button" onclick="javascript:exibicao_adicionais_produto_selecionado();">
					<i class="icofont-ui-add"></i> <br><span>(ADICIONAIS)</span>
				</button>
				        
				<button id="botao_opcoes_combo" class="btn bd bd-l-0 hide btn-info botao-adicao-produto bt-adicao-produto2" type="button" onclick="javascript:exibicao_opcoes_produto_selecionado();">
					<i class="icofont-ui-add"></i> <br><span>(COMBO)</span>
				</button>
				        
				<button class="btn bd bd-l-0 btn-success botao-adicao-produto bt-adicao-produto1 metade_tamanho" type="button" onclick="javascript:salva_item_pedido();">
					<i class="icofont-ui-check" ></i> <br><span>(INSERIR)</span>
				</button>

				<div id="campo_para_variacao_produto">
					<input type="tel" placeholder="QTD" onkeypress='return SomenteNumero(event)' class="form-control pull-left" id="quantidade-produto">
							
					<select class="form-control pull-right upper" id="tamanho" onchange="javascript:selecao_variacao(this.value)"></select>
						<i class="icofont-exclamation-tringle error-select-variacao"></i>
						<i class="icofont-verification-check ok-select-variacao"></i>
				</div>				
			</div>

			<div class="col-12 box-nome-cliente">
				
				<input type="text" class="form-control input-block campo-6 pull-left" placeholder="NOME CLIENTE" id="nome-cliente-produto">				

				<input type="text" class="form-control input-block campo-6 pull-right" placeholder="OBSERVAÇÕES" id="observacoes-produto">				
								
			</div>

		</div>



<div class="margin30" id="exibicao_adicionais_produto_selecionado"></div>	
<div class="margin30" id="exibicao_opcoes_produto_selecionado"></div>	

	
<div class="col-12 exibicao_produtos_pedido" id="exibicao_produtos_pedido">
		
	
	<div class="row row-xs">	

		<div class="col-12" id="input_busca_produto">
			
			<div id="campo_para_pesquisa_produto" >
				<input type="text" class="form-control input-lg pull-left" placeholder="CÓDIGO OU PRODUTO" onkeyup="javascript:pesquisa_produtos_venda(this.value);" id="input_pesquisa_produto">						
			</div>

			<button class="btn bd bd-l-0 btn-warning btn-confere pull-right" type="button" onclick="javascript:confere_pedido_mobile();">
				CONFERIR
			</button>

			<?php if($dados_configuracoes['categorias_mobile']==1){ ?>

			<select id="categoria_selecionada_mobile" class="form-control upper thin text-center" onchange="javascript:exibe_produtos_atraves_categorias_mobile(this.value)" style="margin-bottom: 20px">
				<option value="0">ESCOLHA A CATEGORIA</option>
				<?php
				  	$sel = $db->select("SELECT * FROM categorias WHERE ativo='1' ORDER BY ordem");				  	
				  	while($row = $db->expand($sel)){	
				  						  	
					  	echo '<option value="'.$row['id'].'">'.$row['categoria'].'</option>';				  			
					  		
				  	}
				 ?>			
			</select>

			<?php } ?>

		</div>
	
	</div>

	
	<div class="col-md-12 text-center" id="informacao_qtd_itens_pedido" >
		<br><br>
		<span class="qtd_itens_grande"><?php echo $qtd_itens_pedido; ?></span><br>
		<span class="texto_itens_grande">ÍTEN(S) NO PEDIDO</span><br>
		<span class="texto_peq_itens_grande">PED Nº: <?php echo $id_venda; ?></span>
	</div>

	<div class="col-md-12 text-center top15 upper hide" id="sucesso_salva_pedido_mobile">
		<div  class="alert alert-success thin">
			<i class="icofont-ui-check"></i>  Pedido atualizado com sucesso.
		</div>	
	</div>

	


	<?php 
		$hide_aviso='hide';
		if($dados_configuracoes['impressao_avulsa_item']=='JUNTO APENAS UMA VEZ'){
			if($itens_nao_impressos>0){
				$hide_aviso='';	
			}
		} 
	?>

	<div class="col-md-12 text-center <?php echo $hide_aviso; ?> top15" id="aviso_salvar_pedido">
		<div  class="alert alert-danger thin upper">
			  EXISTEM ÍTENS PARA IMPRESSÃO
			<br>
			<button onclick="javascript:apenas_salva_pedido();" class="btn btn-primary btn-block top10"><i class="icofont-print"></i> IMPRIMIR AGORA</button>
		</div>	
		
	</div>


	
	<div class="row row-xs">

			<?php
		  	$sel = $db->select("SELECT * FROM categorias WHERE ativo='1' ORDER BY ordem");		  
		  	$contador=1;
		  	while($row = $db->expand($sel)){
				  	
		  			$id_categoria = $row['id'];
		  			$contador_produtos=1;
		  			$seleciona_produtos = $db->select("SELECT codigo, id, produto, preco_composto FROM lanches 
		  				WHERE ativo='1' AND categoria='$id_categoria' 
		  				ORDER BY ABS($ordem_exibicao_produtos)");

		  			if($db->rows($seleciona_produtos)) {
			  			while($line = $db->expand($seleciona_produtos)){

			  				

			  				echo '<div class="col-6 col-md-3 hide bottom10 exibe_lanches_categoria'.$id_categoria.'  exibe_lanches_categoria" data-name="'.nomes_produtos_busca($line['produto']).' '.nomes_produtos_busca($line['codigo']).'" id="prod_name_div'.$line['id'].'">';

			  				if($row['meio_meio']!=0){
			  					$classe = 'pdr1';
			  					$classe2 = 'pdr1a';
			  					echo '<a href="javascript:void(0)" onclick="javascript: seleciona_produtos(1,'.$line['id'].','.$line['preco_composto'].','.$id_categoria.');">';
				  			} else {
				  				echo '<a href="javascript:void(0)" onclick="javascript: seleciona_produtos(2,'.$line['id'].','.$line['preco_composto'].','.$id_categoria.');">';
				  				$classe = 'pdr2';
				  				$classe2 = 'pdr2a';
				  			}


			  					echo '<div class="card '.$classe.' produto-round" id="produtox'.$line['id'].'">';
		
			  						echo '<div class="col-md-12 detalhes-produtos">';
			  							

				  								if($row['meio_meio']!=0){
				  									
				  									echo '<input name="produto" type="checkbox" class="radio-produtos2 marca-produtos prod-meio-meio" value="'.$line['id'].'" id="check'.$line['id'].'">';
				  								} else {				  									
				  									echo '<input name="produto" value="'.$line['id'].'" type="radio" class="radio-produtos2 marca-produtos prod-normais" id="check'.$line['id'].'">';
				  								}
				  					

				  					if(!empty($line['codigo'])){	
			  							echo '<span class="destaca" id="destaca'.$line['id'].'">('.$line['codigo'].')</span>';
			  						}		
			  						
			  						echo '<span id="foca_campo'.$line['id'].'" class="campo-focus upper '.$classe2.' pull-right text-right">['.$row['categoria'].']</span>';

			  						

			  						echo '<h2 id="prod_name'.$line['id'].'" class=" prod_name">'.($line['produto']).'</h2>';	
	

			  						echo '</div>';	
			  					echo '</div>';

			  					echo '</a>';

			  				echo '</div>';
			  				

			  				$contador_produtos++;

			  			}
		  			}	

		  	}
		  ?>
	</div>



</div>




<input type="hidden" id="pdv" value="0">

<input type="hidden" id="impressoras_instaladas" value="<?php echo $dados_configuracoes['impressora_principal'].' '.$dados_configuracoes['impressora_secundaria']; ?>">

<input type="hidden" id="impressao_item_avulso" value="<?php echo $dados_configuracoes['impressao_avulsa_item']; ?>">
<input type="hidden" id="tela-mobile" value="1">
<input type="hidden" id="pedido_aguarda_venda" value="<?php echo $dados_venda['aguarde']; ?>">
<input type="hidden" id="avanca-pedido-enter" value="1">

<script>
	window.clearTimeout(atualiza_pedidos);	
</script>

