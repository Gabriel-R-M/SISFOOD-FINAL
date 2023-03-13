function nova_submesa(){
	$(".ja_nome_mesa").hide();		
	$("#novo_nome_mesa").show();
	$("#nome_submesa_escrito").focus();	
}


function confere_pedido_mobile(){
	$(".botoes-insercao-itens-pedido").hide();
	$("#exibicao_produtos_pedido").hide();
	$("#lateral-pedido").show();
}


function exibe_produtos_atraves_categorias_mobile(categoria){

	if(categoria!=0){
	
		$(".exibe_lanches_categoria").hide();	
		$("#informacao_qtd_itens_pedido").hide();
		$("#sucesso_salva_pedido_mobile").hide();
		$(".exibe_lanches_categoria"+categoria).show();

	} else {		
		
		$(".exibe_lanches_categoria").hide();
		
		var qtd=0
		$(".prod-meio-meio").each(function () {
        	if($(this).is(':checked')){
        		var id_prd_selecionado = $(this).val();
        		$("#prod_name_div"+id_prd_selecionado).show();
        		qtd++;
        	}        	
    	});

		$(".prod-normais").each(function () {
        	if($(this).is(':checked')){
        		var id_prd_selecionado = $(this).val();
        		$("#prod_name_div"+id_prd_selecionado).show();
        		qtd++;
        	}        	
    	});

    	if(qtd==0){
    		$("#informacao_qtd_itens_pedido").show();
    	}


	}
}

function voltar_confere_pedido_mobile(){

	//DESMARCA TUDO Q É MEIO A MEIO//
	$(".prod-normais").prop( "checked", false);
	$(".pdr2").removeClass("produto-round_cor");		
	$(".pdr2a").css("color","#333");
	$(".prod-meio-meio").prop( "checked", false);		
	$(".pdr1").removeClass("produto-round_cor");
	$(".pdr2").removeClass("produto-round_cor");
	$(".pdr1a").css("color","#333");			
	$(".pdr2a").css("color","#333");	
	$(".destaca").css("color","#B92A25");

	//OCULTA TODOS OS PRODUTOS//
	//$(".produto-round").hide();

	//REMOVE A MARGEM DO TOPO DO CAMPO DE BUSCAS
	$("#exibicao_produtos_pedido").removeClass('margin30');

	$(".botoes-insercao-itens-pedido").hide();
	$("#lateral-pedido").hide();	
	$("#exibicao_produtos_pedido").show();	
}


function limpa_pesquisa_produtos_mobile(){
	pesquisa_produtos_venda('');
}