function confere_pedido_mobile(){
	$(".botoes-insercao-itens-pedido").hide();
	$("#exibicao_produtos_pedido").hide();
	$("#lateral-pedido").show();
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