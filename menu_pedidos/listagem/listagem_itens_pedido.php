<div class="col-md-12 top15">
<?php
require_once("../../admin/class/class.db.php");
require_once("../../admin/class/class.seguranca.php");
require_once("../../includes/verifica_session.php");
require_once("../../includes/verifica_venda_aberta.php");
//require_once("../../includes/verifica_configuracoes_loja.php");

$total_item_final=0;
$total_final_pedido =0;
$total_adicionais = 0;
$total_opcoes = 0;
$qtd_itens_pedido=0;
$itens_nao_impressos=0;

$sql = $db->select("SELECT * FROM produtos_venda WHERE id_venda='$id_venda' ORDER BY id DESC");
$qtd_produtos_carrinho = $db->rows($sql);
if($db->rows($sql)){
	while($row = $db->expand($sql)){

		$qtd_itens_pedido = ($qtd_itens_pedido+$row['quantidade']);

		$nome_tamanho='';
		$id_produto = $row['id_produtos'];
		$id_controle = $row['id'];
		$id_tamanho = $row['tamanho'];

		//APENAS UM PRODUTO
		if(is_numeric($row['id_produtos'])){

			$pg = $db->select("SELECT produto, codigo, categoria FROM lanches WHERE id='$id_produto' LIMIT 1");
			$var = $db->expand($pg);
			$categoria_produto = $var['categoria'];
			$nome_produto= $var['produto'];

		//MEIO A MEIO	
		} else {	

			$nome_produto='';
			$prods = explode(',', $row['id_produtos']);	
			foreach($prods as $prod) {

		    	$id_produto = trim($prod);		    	

		    	$pg = $db->select("SELECT produto, codigo, categoria FROM lanches WHERE id='$id_produto' LIMIT 1");
				$var = $db->expand($pg);
				$categoria_produto = $var['categoria'];

				$nome_produto= $nome_produto.$var['produto'].'/';
			}
		}	

		//REMOVE A ULTIMA BARRA
		$final = substr($nome_produto, -1);
		if($final=='/'){
			$size = strlen($nome_produto);
			$nome_produto = substr($nome_produto,0, $size-1);
		}

		$sun = $db->select("SELECT categoria FROM categorias WHERE id='$categoria_produto' LIMIT 1");
        $type = $db->expand($sun);

        $nome_tamanho='';
        if($id_tamanho!=0){
        	$sun2 = $db->select("SELECT tamanho FROM tamanhos WHERE id='$id_tamanho' LIMIT 1");
        	$type2 = $db->expand($sun2);
        	$nome_tamanho='('.$type2['tamanho'].')';	
        }

        
        

		//POE O ZERO NA QUANTIDADE
		if($row['quantidade']<10){$row['quantidade']= '0'.$row['quantidade'];}

		//EXIBE		
		if(!empty($row['nome_cliente_divisao'])){

			$link_edita_nome='';
			if($dados_venda['finalizada']==0){
				$link_edita_nome='ondblclick="javascript:edita_nome_cliente_comanda('.$id_controle.');"';
			}

			echo '<span id="span_edita_nome'.$id_controle.'" '.$link_edita_nome.' class="upper exclui_cor">'.$row['nome_cliente_divisao'].'</span>';

			echo '<input type="text" data-id="'.$id_controle.'" id="campo_edita_nome'.$id_controle.'" value="'.$row['nome_cliente_divisao'].'" class="campo_edita_nome" >';

			 echo '<br>';
		}

		$link_edita_qtd='';
		if($dados_venda['finalizada']==0){
			$link_edita_qtd='ondblclick="javascript:edita_quantidade_item('.$id_controle.');"';
		}

		echo '<span  style="color:#333" '.$link_edita_qtd.'>';
			echo '<strong>QUANTIDADE: </strong><span id="span_edita_qtd'.$id_controle.'">'.$row['quantidade'].'</span>';
		echo '</span>';

		echo '<input type="text" data-id="'.$id_controle.'" id="campo_edita_qtd'.$id_controle.'" value="'.$row['quantidade'].'" onkeypress="return SomenteNumero(event)" class="campo_edita_qtd" >';


		if($dados_venda['finalizada']==0){
			echo '<a href="javascript:void(0);" onclick="javascript:exlcui_produto_pedido(0,'.$id_controle.');" class="exclui_cor top10 thin pull-right icone_deleta_item_pedido"><i class="icofont-ui-delete"></i></a>';
        }

        echo '<br>';
		echo '<small class="upper" style="color:#333">['.$type['categoria'].']</small>';

        echo '<br>';
        echo '<span class="name_produto_comanda upper">'.$nome_produto.'</span>';
        echo '<span class="pull-right text-right">R$ '.number_format($row['valor'],2,",",".").'</span>';
        echo '<br><small style="color:#333" class="upper">'.$nome_tamanho.'</small>';

        if(!empty($nome_tamanho)){
        	echo '<br>';
        }



        //OPCOES//
        $adc = $db->select("SELECT * FROM opcionais_produtos_venda2 WHERE id_controle='$id_controle' ORDER BY id DESC");
		if($db->rows($adc)){
					
			while($sib = $db->expand($adc)){

				$id_opc = $sib['id_opcional'];
				$adc2 = $db->select("SELECT opcional2 FROM opcionais2 WHERE id='$id_opc' LIMIT 1");		
				$sib2 = $db->expand($adc2);

				
							
				echo '<span class="thin upper mleft-opt">';
				
				//if($dados_venda['finalizada']==0){						
					//echo '<a href="javascript:void(0);" onclick="javascript:exclui_opcao_pedido('.$sib['id'].');" class="exclui_cor"><i class="icofont-ui-delete"></i></a>&nbsp;';
				//}

				echo '(<span class="qtd_opcionais'.$id_controle.' upper">'.$row['quantidade'].'</span>) '.$sib2['opcional2'];

				echo '<span class="pull-right">R$ '.number_format($sib['valor_opcional'],2,",",".").'</span>';
					

				echo '</span><br>';				

			}
				
		}  


        //ADICIONAIS//
        $contador_adicionais=0;      			    
        $adc = $db->select("SELECT * FROM opcionais_produtos_venda WHERE id_controle='$id_controle' ORDER BY id DESC");
		if($db->rows($adc)){
					
			while($sib = $db->expand($adc)){

				$id_opc = $sib['id_opcional'];
				$adc2 = $db->select("SELECT opcional FROM opcionais WHERE id='$id_opc' LIMIT 1");		
				$sib2 = $db->expand($adc2);

				
							
				echo '<span class="thin upper mleft-opt">';
				
				if($dados_venda['finalizada']==0){						
					echo '<a href="javascript:void(0);" onclick="javascript:exclui_adicional_pedido('.$sib['id'].');" class="exclui_cor"><i class="icofont-ui-delete"></i></a>&nbsp;';
				}

				echo '(<span class="qtd_opcionais'.$id_controle.'">'.$row['quantidade'].'</span>) '.$sib2['opcional'];

				echo '<span class="pull-right">R$ '.number_format($sib['valor_opcional'],2,",",".").'</span>';
					

				echo '</span><br>';				

			}
				
		} 



		


		if(!empty($row['observacoes'])){ 
			
			echo '<span class="thin upper mleft-opt exclui_cor" style="margin-left:0">';
				echo '*'.$row['observacoes'];
			echo '</span>';	
		}
		


		if($dados_venda['finalizada']==0){
			
			echo '<div class="row">';
			echo '<div class="col-md-12 top10">';
				echo '<a href="javascript:void(0);" onclick="javascript:exlcui_produto_pedido(0,'.$id_controle.');" class="exclui_cor thin">
						<button class="btn btn-md btn-primary btn-block icone_deleta_item_pedido_mobile">EXCLUIR</button>
				</a>';
			echo '</div>';
			echo '</div>';
        }


        echo '<hr style="margin-top:0; padding-top:0">';



        if($row['impresso']==0){
        	$itens_nao_impressos++;
        }



	}

	

} else {

	echo '<center>NENHUM ÍTEM NO PEDIDO.</center>';

}



?>


</div>

<input type="hidden" value="<?php echo $itens_nao_impressos; ?>" id="itens_nao_impressos">
<input type="hidden" value="<?php echo $qtd_itens_pedido; ?>" id="totais_itens_pedido">



<script>
$(document).ready(function(){
	$(".campo_edita_qtd").keypress(function(event) {
	    if (event.which == 13) {
	        event.preventDefault();
			var id_campo = $(this).attr("data-id"); 
			altera_quantidade_produto(id_campo);
	    }
	});

	$(".campo_edita_nome").keypress(function(event) {
	    if (event.which == 13) {
	        event.preventDefault();
			var id_campo = $(this).attr("data-id"); 
			altera_nome_cliente_comanda(id_campo);
	    }
	});
});	
</script>