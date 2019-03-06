$(document).ready(function(){

	$('#ModalBaixaPedidosRapido').on('hidden.bs.modal', function (){
	  	$("#tipo_baixa_pedidos").val($("#tipo_baixa_pedidos option:first").val());
	});

});	



function exibe_mensagem_baixa_pedidos(tipo){
	$("#erro_baixa_varios_pedidos").hide();
	if(tipo==1){
		$("#tipo_pgto_baixa_varios_pedidos").show();
		$("#exibe_mensagem_baixa_pedidos").html('Os pedidos marcados serão recebidos em:');		
	} else {
		$("#tipo_pgto_baixa_varios_pedidos").hide();
		$("#exibe_mensagem_baixa_pedidos").html('Os pedidos marcados serão <br><b class="tx-danger"><h4>CANCELADOS</h4></b>');
	}

	$("#ModalBaixaPedidosRapido").modal();
}




function marca_recebe_cancela_pedidos(){
	$("#erro_baixa_varios_pedidos").hide();

	var pedidos = new Array();
		
	$(".marca_pedidos_entrega").each(function () {
        if($(this).is(':checked')){
        	pedidos.push($(this).val());
        }        	
    });

    var tipo = $("#tipo_baixa_pedidos").val();
    var forma_pagamento_baixa_varios_pedidos = $("#forma_pagamento_baixa_varios_pedidos").val();
	
	//OBG O TIPO DE PGTO QUANDO O FOR 1
	if(tipo==1){
		if(forma_pagamento_baixa_varios_pedidos==0){
			$("#erro_baixa_varios_pedidos").show();
			return;	
		}
	}
		

	$("#ModalBaixaPedidosRapido").modal('hide');
	$("#tipo_baixa_pedidos").val($("#tipo_baixa_pedidos option:first").val());
	$(".botoes_rodape").hide();
	carregando();
	

    $.post('menu_pedidos/actions/salva_recebimento_cancelamento_varios_pedidos.php?pedidos='+pedidos,{tipo:tipo, forma_pagamento_baixa_varios_pedidos:forma_pagamento_baixa_varios_pedidos}, function(resposta){				
		entregas_comandas(0);
	});
}




function marca_pedidos_entrega(){
	var marcado=0;
	$(".marca_pedidos_entrega").each(function () {
        if($(this).is(':checked')){
        	marcado++;
        }        	
    });

	if(marcado>0){
		
		if($('.is_mobile').is(":visible") == false) {
			$(".botoes_rodape").show();
		}

	} else {
		$(".botoes_rodape").hide();
		$("#tipo_baixa_pedidos").val($("#tipo_baixa_pedidos option:first").val());
	}
}



function marca_pedido_entregue(entregador, pedido, tipo, entrega_ok=0){


	$.post('menu_pedidos/actions/marca_entrega.php',{entregador:entregador, pedido:pedido, tipo:tipo, entrega_ok:entrega_ok}, function(resposta){		
			location.reload();		
	});
}