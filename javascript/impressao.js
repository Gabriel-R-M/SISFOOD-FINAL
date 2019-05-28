
function aviso_impressao_sistema(tipo=0){

	var mobile = $("#tela-mobile").val();	
	if(mobile==null){
		mobile=0;
	}

	//ACENDE AVISO//
	if(tipo==0){		
		if(mobile==0){
			$("#logo_icone_menu").hide();
			$("#impressao_menu").show();
		} else {
			$("#logo_icone_menu_mobile").hide();
			$("#impressao_menu_mobile").show();
		}
	}

	//APAGA AVISO//
	if(tipo==1){
		if(mobile==0){			
			$("#impressao_menu").hide();
			$("#logo_icone_menu").show();
		} else {			
			$("#impressao_menu_mobile").hide();
			$("#logo_icone_menu_mobile").show();
		}
	}
}




function reimpressao_completa_pedido(){	
	$("#ModalEscolheTipoImpressao").modal('hide');	
	aviso_impressao_sistema();
	$.post('menu_pedidos/impressao/prepara_impressao_completa.php',{id:1}, function(){
		aviso_impressao_sistema(1);		
	});		

}


function imprime_comprovante_crediario(){
	$("#ModalPerguntaImprime03").modal('hide');	
	aviso_impressao_sistema();
	$.post('menu_pedidos/impressao/prepara_impressao_pagamento_crediario.php',{id:id_imprime_comp_crediario}, function(){
		aviso_impressao_sistema(1);		
	});		
}


function imprime_ciencia_crediario(){	
	aviso_impressao_sistema();
	$("#ModalPerguntaImprime04").modal('hide');	
	$.post('menu_pedidos/impressao/prepara_impressao_crediario.php',{id:id_imprime_comp_crediario}, function(){
		aviso_impressao_sistema(1);			
	});
}



function imprime_recebimentos(){		
	aviso_impressao_sistema();
	$.post('menu_pedidos/impressao/prepara_impressao_recebimento.php',{id:1}, function(){
		aviso_impressao_sistema(1);			
	});
}



function reimpressao_divisao_pedido(id){
	aviso_impressao_sistema();
	$("#ModalEscolheTipoImpressao").modal('hide');	
	$.post('menu_pedidos/impressao/prepara_impressao_divisao.php',{id:1}, function(){
		aviso_impressao_sistema(1);			
	});
}


function reimprime_item_avulso(id){	
	aviso_impressao_sistema();
	$("#ModalPerguntaImprime05").modal('hide');	
	$.post('menu_pedidos/impressao/prepara_impressao_unico_item.php',{item:sim_reimprime_item_pedido}, function(){
		aviso_impressao_sistema(1);			
		sim_reimprime_item_pedido=0;
	});
}


function imprime_fechamento_caixa(id){	
	aviso_impressao_sistema();
	$.post('menu_caixa/impressao/prepara_fechamento_caixa.php',{id_caixa:id}, function(a){		
		aviso_impressao_sistema(1);					
	});
}




function imprime_comanda01(){	
	aviso_impressao_sistema();		
	$("#ModalPerguntaImprime01").modal('hide');
	
	$.post('menu_pedidos/impressao/verifica_primeira_impressao.php',{id:1}, function(resposta){

			if(resposta=='IGUAIS'){

					$.post('menu_pedidos/impressao/prepara_impressao_completa.php',{id:1, primeira_impressao:1}, function(){
						aviso_impressao_sistema(1);			
					});

					
			} else if(resposta=='PICADA'){

					$.post('menu_pedidos/impressao/prepara_impressao_completa.php',{id:1}, function(){
						$.post('menu_pedidos/impressao/prepara_impressao_picada.php',{id:1}, function(){							
							aviso_impressao_sistema(1);			
						});								
					});

			}

	});

}



function imprime_comanda02(item=0){	
	aviso_impressao_sistema();		
	$("#ModalPerguntaImprime02").modal('hide');

	if(item!=0){
		$("#botao_item"+item).removeClass("btn-primary");
		$("#botao_item"+item).addClass("btn-success");
	} else {
		$(".botao_imprime_item:first").removeClass("btn-primary");
		$(".botao_imprime_item:first").addClass("btn-success");
	}

	//VERIFICA SE IMPRIME APENAS O ULTIMO ITEM, OU TODOS QUE NAO FORAM IMPRESSOS AINDA DO PEDIDO
	var tipo_impressao_item_avulso = $('#impressao_item_avulso').val();

	$.post('menu_pedidos/impressao/prepara_impressao_unico_item.php',{id:1, item:item}, function(resposta){	
		aviso_impressao_sistema(1);		

		if(resposta==1){
			$(".botao_imprime_item").removeClass("btn-primary");
			$(".botao_imprime_item").addClass("btn-success");
		}

	});
	

}





