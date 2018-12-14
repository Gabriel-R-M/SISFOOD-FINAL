$(document).ready(function(){

	focus_campo_variacao=0;
	var_global=0;
	sim_novo_pedido = 0;
	sim_imprime_pedido_completo = 0;
	sim_imprime_item_pedido = 0;
	sim_reimprime_item_pedido=0;


	$("body").keydown(function(e) {
		
		var keyCode = e.keyCode || e.which;

		//TECLA F2//
		if(keyCode == 113) {
			
			//PARA FINALIZAR A MONTAGEM DO PEDIDO
			if($('#avanca-pedido-enter').val()){    			
    			if(var_global==0){
    				finaliza_pedido();				
    			}    				    		    			   			
    		}

    		//PARA SALVAR O PEDIDO NA TELA DE RECEBIMENTO
    		if($('#tela_finaliza-pedido-enter').val()){    			    			
    			finaliza_pedido2();				    				    				    		    			
    		}

    		//PARA SALVAR A EDICAO DO CLIENTE
    		if($('#tela-clientes-cadastros').val()){    			    			
    			salva_edicao_cliente();				    				    				    		    			
    		}

		}

		//TECLA F3//
		if(keyCode == 114) {
			//IMPRIMIR PEDIDO NA TELA DE RECEBIMENTO
			if($('#tela_finaliza-pedido-enter').val()){				
				$("#botao_impressao_pedido").click(); 			  				
			}

			//IMPRIMIR PEDIDO NA TELA DE MONTAGEM APÓS O PEDIDO FINALIZADO
			if($('#avanca-pedido-enter').val()){
				$("#botao_impressao_pedido").click();		  				
			}
		}

		//TECLA F4//
		if(keyCode == 115) {			
			//CANCELA PEDIDO NA TELA DE MONTAGEM DO PEDIDO
			if($('#avanca-pedido-enter').val()){
				$("#botao_cancela_venda_pgto").click();				
			}

			//CANCELA PEDIDO NA TELA DE RECEBIMENTO
			if($('#tela_finaliza-pedido-enter').val()){
				$("#botao_cancela_venda_pgto").click();				
			}
	

			//CANCELA A EDICAO DO CLIENTE
			if($('#tela-clientes-cadastros').val()){
				cancela_cadastro_cliente();    			  				
			}
		}

		//TECLA F6//
		if(keyCode == 117) {
			//IMPRIMIR PEDIDO COM DIVISAO NA TELA DE RECEBIMENTO
			if($('#tela_finaliza-pedido-enter').val()){
				$("#botao_impressao_pedido_divisao").click();
			}
		}


		//TECLA F8//
		if(keyCode == 119) {
			//ADICIONAR MAIS ITENS - A PARTIR DA TELA DE RECEBIMENTO
			if($('#tela_finaliza-pedido-enter').val()){
				mais_item_pedido();
			}
		}

		
		//TECLA F10//
		if(keyCode == 121) {
			
			//PARA PESQUISA DE PRODUTOS NA TELA DE MONTAGEM
			if($('#avanca-pedido-enter').val()){				
    			$("#input_pesquisa_produto").focus(); 				    		    			  				
			}

			//PARA EFETUAR RECEBIMENTOS
			if($('#tela_finaliza-pedido-enter').val()){
				realiza_pagamento();
			}

		}


		//TECLA F12//
		if(keyCode == 123) {
			//ADICIONAR MAIS ITENS - A PARTIR DA TELA DE RECEBIMENTO
			if($('#tela_finaliza-pedido-enter').val()){
				$("#botao_muda_cliente_recebimento").click();
			}
		}


		//TECLA ENTER//
    	if(keyCode == 13) {    		
    		
    		//ADICIONA ITEM AO PEDIDO NA TELA DE MONTAGEM   			
    		if($('#avanca-pedido-enter').val()){    			    			
    			if(var_global==0 && sim_novo_pedido==0 && sim_imprime_pedido_completo==0 && sim_imprime_item_pedido==0 && sim_reimprime_item_pedido==0){
    				
    				if($('#quantidade-produto').is(":visible") == true) {
    					salva_item_pedido();	
    				}	
    				
    			}    				    		
    		}		

    		//OK PARA INICIAR NOVO PEDIDO   			
    		if(sim_novo_pedido==1){
    			inicia_pedido();
    			sim_novo_pedido=0;
    		} 

    		//OK PARA IMPRIMIR PEDIDO COMPLETO   			
    		if(sim_imprime_pedido_completo==1){
    			imprime_comanda01();
    			sim_imprime_pedido_completo=0;
    		} 

    		//OK PARA IMPRIMIR ITEM DO PEDIDO			
    		if(sim_imprime_item_pedido==1){
    			imprime_comanda02();
    			sim_imprime_item_pedido=0;
    		}


    		//OK PARA IMPRIMIR COMPROVANTE DE PAGAMENTO CREDIARIO		
    		if(sim_imprime_comp_crediario==1){
    			imprime_comprovante_crediario();
    			sim_imprime_comp_crediario=0;
    		} 

    		//OK PARA IMPRIMIR COMPROVANTE DE CIENCIA DE DIVIDA		
    		if(sim_imprime_comp_debito_crediario==1){
    			imprime_ciencia_crediario();
    			sim_imprime_comp_debito_crediario=0;
    		}  

    		//OK PARA REIMPRIMIR ITEM DO PEDIDO			
    		if(sim_reimprime_item_pedido==1){
    			reimprime_item_avulso();
    			sim_reimprime_item_pedido=0;
    		}  				    		
    				


    	}        	
    	

    
	});

});	