
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




function reimpressao_completa_pedido(id,remonta=1){	
	aviso_impressao_sistema();
	$("#ModalEscolheTipoImpressao").modal('hide');	

		if(remonta==1){
			
			$.post('menu_pedidos/impressao/prepara_impressao_completa.php',{id:1}, function(resposta){							
				$.post('menu_pedidos/impressao/imprime.php',{imprime:1, tipo:1}, function(resposta){							
					if(resposta==0){
						setTimeout(function(){ reimpressao_completa_pedido(1,0);}, 3000);	
					} else {
						aviso_impressao_sistema(1);	
					}					
				});			
			});		
		
		} else {

			$.post('menu_pedidos/impressao/imprime.php',{imprime:1, tipo:1}, function(resposta){							
				if(resposta==0){
					setTimeout(function(){ reimpressao_completa_pedido(1,0);}, 3000);	
				} else {
					aviso_impressao_sistema(1);	
				}				
			});

		}
		
}


function imprime_comprovante_crediario(remonta=1){
	aviso_impressao_sistema();
	$("#ModalPerguntaImprime03").modal('hide');	

	if(remonta==1){
		$.post('menu_pedidos/impressao/prepara_impressao_pagamento_crediario.php',{id:id_imprime_comp_crediario}, function(resposta){	
			$.post('menu_pedidos/impressao/imprime.php',{imprime:1, tipo:1}, function(resposta){	
				if(resposta==0){
					setTimeout(function(){ imprime_comprovante_crediario(0);}, 3000);	
				} else {
					aviso_impressao_sistema(1);	
				}
			});
		});	
	} else {
		$.post('menu_pedidos/impressao/imprime.php',{imprime:1, tipo:1}, function(resposta){	
			if(resposta==0){
				setTimeout(function(){ imprime_comprovante_crediario(0);}, 3000);	
			} else {
				aviso_impressao_sistema(1);	
			}
		});	
	}

}


function imprime_ciencia_crediario(remonta=1){	
	aviso_impressao_sistema();
	$("#ModalPerguntaImprime04").modal('hide');	

	if(remonta==1){
		$.post('menu_pedidos/impressao/prepara_impressao_crediario.php',{id:id_imprime_comp_crediario}, function(resposta){		
			$.post('menu_pedidos/impressao/imprime.php',{tipo:1, imprime:1}, function(resposta){			
				if(resposta==0){
					setTimeout(function(){ imprime_ciencia_crediario(0);}, 3000);	
				} else {
					aviso_impressao_sistema(1);	
				}
			});
		});		
	} else {
		$.post('menu_pedidos/impressao/imprime.php',{tipo:1, imprime:1}, function(resposta){			
			if(resposta==0){
				setTimeout(function(){ imprime_ciencia_crediario(0);}, 3000);	
			} else {
				aviso_impressao_sistema(1);	
			}
		});
	}
	
}




function imprime_comanda01(remonta=1){	
		
	$("#ModalPerguntaImprime01").modal('hide');
	
	$.post('menu_pedidos/impressao/verifica_primeira_impressao.php',{id:1}, function(resposta){

			if(resposta=='IGUAIS'){

					aviso_impressao_sistema();

					if(remonta==1){

						$.post('menu_pedidos/impressao/prepara_impressao_completa.php',{id:1}, function(resposta){	
							$.post('menu_pedidos/impressao/imprime.php',{tipo:2}, function(resposta2){	

								if(resposta==0){
									setTimeout(function(){imprime_comanda01(0);}, 3000);
								} else {
									aviso_impressao_sistema(1);	
								}
								
							});
						});	

					} else {

						$.post('menu_pedidos/impressao/imprime.php',{tipo:2}, function(resposta2){	

							if(resposta==0){
								setTimeout(function(){imprime_comanda01(0);}, 3000);
							} else {
								aviso_impressao_sistema(1);	
							}
								
						});

					}

					

					

			} else if(resposta=='PICADA'){

					aviso_impressao_sistema();

					if(remonta==1){


						$.post('menu_pedidos/impressao/prepara_impressao_completa.php',{id:1}, function(resposta){

							$.post('menu_pedidos/impressao/prepara_impressao_picada.php',{id:1}, function(resposta){

								$.post('menu_pedidos/impressao/imprime.php',{tipo:3}, function(resposta){	

									if(resposta==0){
										setTimeout(function(){imprime_comanda01(0);}, 3000);
									} else {
										aviso_impressao_sistema(1);	
									}
									
								});	

							});
						});	


					} else {

						$.post('menu_pedidos/impressao/imprime.php',{tipo:3}, function(resposta){	

									if(resposta==0){
										setTimeout(function(){imprime_comanda01(0);}, 3000);
									} else {
										aviso_impressao_sistema(1);	
									}
									
						});

					}

					

			}

	});

}



function reimpressao_divisao_pedido(id, remonta=1){
	aviso_impressao_sistema();
	$("#ModalEscolheTipoImpressao").modal('hide');	

	if(remonta==1){
		$.post('menu_pedidos/impressao/prepara_impressao_divisao.php',{id:1}, function(resposta){	
			$.post('menu_pedidos/impressao/imprime.php',{tipo:1}, function(resposta){	
				if(resposta==0){
					setTimeout(function(){ reimpressao_divisao_pedido(0);}, 3000);	
				} else {
					aviso_impressao_sistema(1);	
				}
			});
		});	
	} else {
		$.post('menu_pedidos/impressao/imprime.php',{tipo:1}, function(resposta){	
			if(resposta==0){
				setTimeout(function(){ reimpressao_divisao_pedido(0);}, 3000);	
			} else {
				aviso_impressao_sistema(1);	
			}
		});
	}
}



function imprime_recebimentos(remonta=1){		
	aviso_impressao_sistema();
	if(remonta==1){
		$.post('menu_pedidos/impressao/prepara_impressao_recebimento.php',{id:1}, function(resposta){		
			$.post('menu_pedidos/impressao/imprime.php',{tipo:1}, function(resposta){			
				if(resposta==0){
					setTimeout(function(){ imprime_recebimentos(0);}, 3000);	
				} else {
					aviso_impressao_sistema(1);	
				}
			});
		});	
	} else {
			$.post('menu_pedidos/impressao/imprime.php',{tipo:1}, function(resposta){			
				if(resposta==0){
					setTimeout(function(){ imprime_recebimentos(0);}, 3000);	
				} else {
					aviso_impressao_sistema(1);	
				}
			});
	}
}




function imprime_fechamento_caixa(id, remonta=1){
	aviso_impressao_sistema();
	if(remonta==1){
		$.post('menu_caixa/impressao/prepara_fechamento_caixa.php',{id_caixa:id}, function(resposta){				
			$.post('menu_pedidos/impressao/imprime.php',{tipo:1}, function(resposta){			
				if(resposta==0){
					setTimeout(function(){ imprime_fechamento_caixa(0);}, 3000);	
				} else {
					aviso_impressao_sistema(1);	
				}
			});
		});	
	} else {
		$.post('menu_pedidos/impressao/imprime.php',{tipo:1}, function(resposta){			
			if(resposta==0){
				setTimeout(function(){ imprime_fechamento_caixa(0);}, 3000);	
			} else {
				aviso_impressao_sistema(1);	
			}
		});
	}
}




//function imprime_comanda02(contador=0,item=0, remonta=1){
function imprime_comanda02(remonta=1, item=0){	
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

	if(remonta==1){

		$.post('menu_pedidos/impressao/prepara_impressao_unico_item.php',{id:1, item:item}, function(resposta){	

			if(resposta==1){
				$(".botao_imprime_item").removeClass("btn-primary");
				$(".botao_imprime_item").addClass("btn-success");
			}

			$.post('menu_pedidos/impressao/imprime.php',{tipo:3}, function(resposta){			
				if(resposta==0){
					setTimeout(function(){ imprime_comanda02(0);}, 3000);	
				} else {
					aviso_impressao_sistema(1);	
				}
			});			
		
		});		

	} else {

		$.post('menu_pedidos/impressao/imprime.php',{tipo:3}, function(resposta){			
			if(resposta==0){
				setTimeout(function(){ imprime_comanda02(0);}, 3000);	
			} else {
				aviso_impressao_sistema(1);	
			}
		});	

	}

	
}











