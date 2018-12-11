
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


function imprime_ciencia_crediario(){	
	aviso_impressao_sistema();
	$("#ModalPerguntaImprime04").modal('hide');	
	$.post('menu_pedidos/impressao/prepara_impressao_crediario.php',{id:id_imprime_comp_crediario}, function(resposta){		
		$.post('menu_pedidos/impressao/imprime.php',{tipo:3}, function(resposta){			
			aviso_impressao_sistema(1);
		});
	});		
}

function imprime_comprovante_crediario(){
	aviso_impressao_sistema();
	$("#ModalPerguntaImprime03").modal('hide');	
		$.post('menu_pedidos/impressao/prepara_impressao_pagamento_crediario.php',{id:id_imprime_comp_crediario}, function(resposta){	
			$.post('menu_pedidos/impressao/imprime.php',{tipo:20}, function(resposta){	

				aviso_impressao_sistema(1);
			});
		});	
}


function impressao_picada(numero_arquivo,total){	
	var arquivo_impressao = 'pedido'+numero_arquivo+'.txt';
	
	$.post('menu_pedidos/impressao/limpa_impressora.php',{tipo:1}, function(resposta){	

		$.post('menu_pedidos/impressao/imprime.php',{tipo:12, arquivo_impressao:arquivo_impressao}, function(resposta){			
			
			proximo = (numero_arquivo+1);
			if(proximo<=total){
				setTimeout(function(){ impressao_picada(proximo,total);}, 2000);	
			} else {
				aviso_impressao_sistema(1);			
			}		
		});

	});	
}

function imprime_comanda01(){	
		
	$("#ModalPerguntaImprime01").modal('hide');
	
	$.post('menu_pedidos/impressao/verifica_primeira_impressao.php',{id:1}, function(resposta){

			if(resposta=='IGUAIS'){

					aviso_impressao_sistema();

					$.post('menu_pedidos/impressao/prepara_impressao_completa.php',{id:1}, function(resposta){	
						$.post('menu_pedidos/impressao/imprime.php',{tipo:1}, function(resposta){	

							aviso_impressao_sistema(1);

						});
					});	

			} else if(resposta=='PICADA'){

					aviso_impressao_sistema();

					$.post('menu_pedidos/impressao/prepara_impressao_completa.php',{id:1}, function(resposta){	
						$.post('menu_pedidos/impressao/imprime.php',{tipo:11}, function(resposta){	

							
							$.post('menu_pedidos/impressao/limpa_impressora.php',{tipo:1}, function(resposta){								

								$.post('menu_pedidos/impressao/prepara_impressao_picada.php',{id:1}, function(resposta){	

									setTimeout(function(){ 
										
										impressao_picada(0,resposta);

									}, 2000);	
									
								});
							});	


						});
					});	

			}

	});

}


function reimpressao_divisao_pedido(id){
	aviso_impressao_sistema();
	$("#ModalEscolheTipoImpressao").modal('hide');	

		$.post('menu_pedidos/impressao/prepara_impressao_divisao.php',{id:1}, function(resposta){	
			$.post('menu_pedidos/impressao/imprime.php',{tipo:5}, function(resposta){	

				aviso_impressao_sistema(1);
			});
		});	
}


function reimpressao_completa_pedido(id){	
	aviso_impressao_sistema();
	$("#ModalEscolheTipoImpressao").modal('hide');	
		$.post('menu_pedidos/impressao/prepara_impressao_completa.php',{id:1}, function(resposta){		
		
			$.post('menu_pedidos/impressao/imprime.php',{tipo:5}, function(resposta){	
				aviso_impressao_sistema(1);
			});
		});	
}


function imprime_comanda02(){
	aviso_impressao_sistema();		
	$("#ModalPerguntaImprime02").modal('hide');
	$.post('menu_pedidos/impressao/prepara_impressao_unico_item.php',{id:1}, function(resposta){
		resposta = $.trim(resposta);
		$.post('menu_pedidos/impressao/imprime.php',{tipo:2,categoria_produto:resposta}, function(resposta){
						
			aviso_impressao_sistema(1);		
					
		});
	});		
}




function imprime_recebimentos(){		
	aviso_impressao_sistema();
	$.post('menu_pedidos/impressao/prepara_impressao_recebimento.php',{id:1}, function(resposta){		
		$.post('menu_pedidos/impressao/imprime.php',{tipo:3}, function(resposta){			
			aviso_impressao_sistema(1);
		});
	});	
}


function imprime_fechamento_caixa(id){
	aviso_impressao_sistema();
	$.post('menu_caixa/impressao/prepara_fechamento_caixa.php',{id_caixa:id}, function(resposta){	
		
		$.post('menu_pedidos/impressao/imprime.php',{tipo:4}, function(resposta){			
			aviso_impressao_sistema(1);
		});
	});	
}



