$(document).ready(function(){

	global_opcao_combo_obrigatoria=0;
	global_pesquisa_adicionais = 0;
	global_pesquisa_opcoes=0;
	global_produto_selecionado = 0;

	$('#CancelaItemPedidoSenha').on('show.bs.modal', function (){
		$("#senha_cancelamento_item_pedido").focus();	  
	});
	
	$('#ModalPerguntaImprime01').on('hidden.bs.modal', function (){
	  sim_imprime_pedido_completo=0;
	});

	$('#ModalPerguntaImprime02').on('hidden.bs.modal', function (){
	  sim_imprime_item_pedido=0;
	});


	$('#ModalIniciaNovoPedido').on('hidden.bs.modal', function (){
	  sim_novo_pedido = 0;
	});


	$('#ModalErrosGerais').on('hidden.bs.modal', function (){
	  	if($('#avanca-pedido-enter').val()){
	  		if(focus_campo_variacao==1){
	  			$("#tamanho").focus();
	  		}	
	  	}
	});



	$("#FormCancelaVenda").submit(function(){
		$("#erro_senha_cancela").hide();		
		$("#botao_cancela_pedido").html('AGUARDE...');
		var formdata = $("#FormCancelaVenda").serialize();		

			$.ajax({type: "POST", url:$("#FormCancelaVenda").attr('action'), data:formdata, success: function(msg){										
				
				if(msg==1){

					inicia_sistema();
					$("#CancelaVendaSenha").modal('hide');
					$("#botao_cancela_pedido").html('CANCELAR VENDA');

				} else {
					
					$("#erro_senha_cancela").show();	
					$("#botao_cancela_pedido").html('CANCELAR VENDA');
					
				}
								
			} 
		
		});
		
		return false;
	});



	$("#FormCancelaItemPedido").submit(function(){
		$("#erro_senha_cancela_item_pedido").hide();		
		$("#botao_cancela_item_pedido").html('AGUARDE...');
		var pedido_aguarda_venda = $("#pedido_aguarda_venda").val();
		var formdata = $("#FormCancelaItemPedido").serialize()+'&pedido_aguarda_venda='+pedido_aguarda_venda;		

			$.ajax({type: "POST", url:$("#FormCancelaItemPedido").attr('action'), data:formdata, success: function(msg){
																
				if(msg==0){

					$("#erro_senha_cancela_item_pedido").show();	
					$("#botao_cancela_item_pedido").html('CANCELAR ÍTEM');	
					

				} else {

					var tela_mobile = $("#tela-mobile").val();		

					//PEGA QTD DE ITENS E ATUALIZA NO MOBILE
					if(tela_mobile==1){
					$.post('menu_pedidos/actions/pega_qtd_itens_pedido.php',{id:1}, function(resposta){
						$(".qtd_itens_grande").html(resposta)
					});					
					}
					
					$("#id_prod_venda_cancelamento").val('');	

					$("#resumo-pedido-comanda").html('<br><center>CARREGANDO...</center>');			
					$("#resumo-pedido-comanda").load('menu_pedidos/listagem/listagem_itens_pedido.php');
					atualiza_valor_final_pedido_comanda();	

					$("#CancelaItemPedidoSenha").modal('hide');
					$("#botao_cancela_item_pedido").html('CANCELAR ÍTEM');
					
				}
								
			} 
		
		});
		
		return false;
	});






	$("#FormCancelaAdicionalPedido").submit(function(){
		$("#erro_senha_cancela_adicional").hide();		
		$("#botao_cancela_adicional_pedido").html('AGUARDE...');
		
		var formdata = $("#FormCancelaAdicionalPedido").serialize();		

			$.ajax({type: "POST", url:$("#FormCancelaAdicionalPedido").attr('action'), data:formdata, success: function(msg){
						
				if(msg==0){

					$("#erro_senha_cancela_adicional").show();	
					$("#botao_cancela_adicional_pedido").html('CANCELAR');	
					

				} else {
					
					$("#id_adicional_cancelamento").val('');	

					$("#resumo-pedido-comanda").html('<br><center>CARREGANDO...</center>');
					$("#resumo-pedido-comanda").load('menu_pedidos/listagem/listagem_itens_pedido.php');
					atualiza_valor_final_pedido_comanda();

					$("#CancelaAdicionalPedidoSenha").modal('hide');
					$("#botao_cancela_adicional_pedido").html('CANCELAR');
					
				}
								
			} 
		
		});
		
		return false;
	});


	$("#FormCancelaOpcoesPedido").submit(function(){
		$("#erro_senha_cancela_opcoes").hide();		
		$("#botao_cancela_opcoes_pedido").html('AGUARDE...');
		
		var formdata = $("#FormCancelaOpcoesPedido").serialize();		

			$.ajax({type: "POST", url:$("#FormCancelaOpcoesPedido").attr('action'), data:formdata, success: function(msg){
						
				if(msg==0){

					$("#erro_senha_cancela_opcoes").show();	
					$("#botao_cancela_opcoes_pedido").html('CANCELAR');	
					

				} else {
					
					$("#id_opcoes_cancelamento").val('');	

					$("#resumo-pedido-comanda").html('<br><center>CARREGANDO...</center>');
					$("#resumo-pedido-comanda").load('menu_pedidos/listagem/listagem_itens_pedido.php');
					atualiza_valor_final_pedido_comanda();

					$("#CancelaOpcoesPedidoSenha").modal('hide');
					$("#botao_cancela_opcoes_pedido").html('CANCELAR');
					
				}
								
			} 
		
		});
		
		return false;
	});



	

});	



function procura_pedido(busca){
	$("#reload").html('<div class="col-md-12"><h5><center><br>PROCURANDO...</center></h5></div>');
	$.post('menu_pedidos/listagem/listagem_pedidos_aguardando.php', {busca:busca}, function(resposta){		
		$("#reload").html(resposta);	
	});
}


function mais_item_pedido(){
	
	var tela_mobile = $("#tela-mobile").val();

	carregando();
	if(tela_mobile==1){
		$("#conteudo_geral").load('menu_pedidos/telas/novo_pedido_mobile.php', function(){
			$("#input_pesquisa_produto").focus();
		});
	} else {
		$("#conteudo_geral").load('menu_pedidos/telas/novo_pedido.php');	
	}	 
	
	
}


function marca_opcional(a){
	
	if( $("#line2"+a).is(':checked') ){				
		$("#line2"+a).prop("checked", false)
		$("#line"+a).removeClass('active_opcional');
		$("#marcado"+a).hide();
		$("#mais"+a).show();
		$("#1destaca_adicionais"+a).css('color','#B92A25');
		$("#2destaca_adicionais"+a).css('color','#B92A25');
		
	} else {		
		$("#line2"+a).prop("checked", true)		
		$("#line"+a).addClass('active_opcional');		
		$("#mais"+a).hide();
		$("#marcado"+a).show();
		$("#1destaca_adicionais"+a).css('color','#FFF');
		$("#2destaca_adicionais"+a).css('color','#FFF');

	}
	
}


function marca_opcoes(a){
	
	if( $("#line2_opcao"+a).is(':checked') ){				
		$("#line2_opcao"+a).prop("checked", false)
		$("#line_opcao"+a).removeClass('active_opcional');
		$("#marcado"+a).hide();
		$("#mais"+a).show();
		$("#3destaca_adicionais"+a).css('color','#B92A25');
		$("#4destaca_adicionais"+a).css('color','#B92A25');
		
	} else {		
		$("#line2_opcao"+a).prop("checked", true)		
		$("#line_opcao"+a).addClass('active_opcional');		
		$("#mais"+a).hide();
		$("#marcado"+a).show();
		$("#3destaca_adicionais"+a).css('color','#FFF');
		$("#4destaca_adicionais"+a).css('color','#FFF');

	}
	
}



function ve_compartilhamento_mesa(){
	$("#exibe_compartilhamento_mesa_recebimento").html('<br><br><CENTER><h4>CARREGANDO...</h4><br><br></CENTER>');
	$("#ModalCompartilhamentoMesaRecebimento").modal();
	$("#exibe_compartilhamento_mesa_recebimento").load('menu_pedidos/listagem/lista_compartilhamento_mesa.php');
}





function modal_edita_cliente_pedido(cliente){	
	$("#exibe_dados_cliente_pedido").html('<br><CENTER><h4>CARREGANDO...</h4></CENTER><br>');
	$("#ModalEditaDadosClienteVenda").modal();
	$.post('menu_clientes/telas/tela_edicao_ficha_cliente.php', {id:cliente}, function(resposta){			
			$("#exibe_dados_cliente_pedido").html(resposta);	
	});
}



function atualiza_mesas_automatico(){		
	carregando();
	$("#conteudo_geral").load('menu_pedidos/telas/mesas_pedidos.php',function(){
		vendas_internet();
	});	
}

function atualiza_entregas_automatico(){		
	carregando();
	$("#conteudo_geral").load('menu_pedidos/telas/entregas_comandas.php',function(){
		vendas_internet();
	});	
}


function edita_pedido(id,mesa=0){

	if(id!=0){
		
		$("#ModalExibeVendasCaixa").modal('hide');
		carregando();
		$.post('ajax/cria_session_venda.php', {id:id, mesa:mesa}, function(resposta){			

			if($('.is_mobile').is(":visible") == true) {
				$("#conteudo_geral").load('menu_pedidos/telas/novo_pedido_mobile.php');		 	
			} else {
				$("#conteudo_geral").load('menu_pedidos/telas/novo_pedido.php');		
			}

		});
	
	} else {

		if($('.is_mobile').is(":visible") == true) {			
			inicia_pedido(mesa,1);
		} else {			
			inicia_pedido(mesa);	
		}
		
		
	}

}



function cancela_ficha(){
	$("#id_cliente").val('');
	$("#numero_cartao").val('');
	$("#nome").val('');
	$("#endereco").val('');
	$("#numero").val('');
	$("#bairro").val('');
	$("#complemento").val('');
	$("#cidade").val('LENÇÓIS PAULISTA');
	$("#ddd").val('14');
	$("#celular").val('');	
	$("#numero_telefone").val('');

	bloqueia_campos();	
	
	$("#cartao").val('');
	$("#telefone").val('');
	$("#telefone").focus();	
	
	$("#btn_excluir").hide();	
	
	$.post('menu_pedidos/actions/cancela_venda.php', {id:1}, function(resposta){});
	
}

function busca_cliente_nome(){
	var nome = $("#nome").val();
	$("#btn_buscar2").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
	$("#reload_pesquisa").html('<br><center>CARREGANDO...</center>');
	$.post('menu_clientes/listagem/listagem_clientes.php', {nome:nome}, function(resposta){
		$("#btn_buscar2").html('<i class="icofont-search-user" style="font-size: 17px"></i>');
		$("#reload_pesquisa").html(resposta);	
	});
}


function busca_cliente(a,modulo_pontos=0){
	
	var telefone = '';
	var cartao = '';
	
	//BUSCA POR TELEFONE
	if(a==1){
		var cartao = '';	
		
		if ($("#telefone").length){
			var telefone = $("#telefone").val();
			if(telefone==''){ $("#telefone").focus(); return;}
		} else {

			if ($("#numero_telefone").length){
				var telefone = $("#numero_telefone").val();
				if(telefone==''){ $("#numero_telefone").focus(); return;}
			}
			
		}

		
	//BUSCA POR CARTAO	
	} else {
		var cartao = $("#numero_cartao").val();
		var telefone = '';
		if(cartao==''){ $("#cartao").focus(); return;}	
	}
	
	$("#btn_buscar").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
	bloqueia_campos()
	
	
	$.post('ajax/procura_cliente.php', {telefone:telefone, cartao:cartao, tipo:a}, 
	function(resposta) {



				$("#btn_buscar").html('<i class="icofont-search-user" style="font-size: 17px"></i>');
				desbloqueia_campos()
		
				//NAO ACHOU O CLIENTE
				if(resposta==0){
						
						$("#erro").show();
						setTimeout('$("#erro").hide()',3000 );
					
						if(a==1){
							$("#nome").focus();	
						} else {
							$("#nome").focus();	
						}
						
						$("#venda_avulsa").val(0);
						$("#id_cliente").val('');
						$("#id_cliente_venda").val('');
						$("#nome").val('');
						$("#endereco").val('');
						$("#numero").val('');
						$("#bairro").val('');
						$("#complemento").val('');
						$("#cidade").val('LENÇÓIS PAULISTA');
						$("#ddd").val('14');
						$("#celular").val('');						

						$("#pontos_resgatar_display").hide();

						
						$("#numero_telefone").val(telefone);
						$("#numero_cartao").val(cartao);
						
						if(a==1){
							$("#btn_excluir").hide();	
						}
						
					
				//achou o cliente	
				} else {

					$(".btn-cancela-edicao").show();
					var val = resposta.split('&*&');
						
					$("#venda_avulsa").val(0);
						
					$("#id_cliente").val(val[0]);
					$("#numero_cartao").val(val[1]);
					$("#nome").val(val[2]);
					$("#endereco").val(val[6]);
					$("#numero").val(val[7]);
					$("#bairro").val(val[10]);
					$("#complemento").val(val[9]);
					$("#cidade").val(val[11]);
					$("#ddd").val(val[3]);
					$("#celular").val(val[5]);
					
					$("#numero_telefone").val(val[4]);
					
					$("#pontuacao").val(val[12]);
					
					$("#nome").focus();

					//BUSCA A PONTUACAO//
					if(modulo_pontos==1){						
						$("#pontos_resgatar_display").show();
						$("#pontos_resgatar").val('------');
						$.post('includes/verifica_pontuacao_cliente.php', {id_cliente_venda:val[0], exibe_pontos:1}, function(resposta){
							$("#pontos_resgatar").val(resposta);
						});
					}

					
				}
		
	});
	
		
}



function confirma_abertura_pedido(){
	sim_novo_pedido = 1;
	$("#ModalIniciaNovoPedido").modal();
}

function confirma_abertura_pedido_mobile(){
	sim_novo_pedido = 1;
	$("#ModalIniciaNovoPedido").modal();
}




function inicia_pedido(mesa=0,mobile=0){

	carregando(); 
	sim_novo_pedido=0;
	$("#ModalIniciaNovoPedido").modal('hide');

	$.post('menu_caixa/actions/verifica_sistema.php', {id:1}, function(resposta) {	

		if(resposta==1){

			var venda_avulsa = 1;
			var id_cliente = 0;
			var numero_cartao = "";
			var nome = 'CLIENTE AVULSO';
			var endereco = '';
			var numero = '';
			var bairro = '';
			var cidade = '';
			var complemento = '';
			var ddd = '';
			var numero_telefone = '';
			var celular = '';							
			
			//var width = $(window).width(); 
			if($('.is_mobile').is(":visible") == true) {
				mobile=1;
			}
			
			$.post('menu_pedidos/actions/inicia_pedido.php', {mesa:mesa, venda_avulsa:venda_avulsa, id_cliente:id_cliente, numero_cartao:numero_cartao, nome:nome, endereco:endereco, numero:numero, bairro:bairro, cidade:cidade, complemento:complemento, ddd:ddd, numero_telefone:numero_telefone, celular:celular}, function(resposta) {		

				if(mobile==1){
					$("#conteudo_geral").load('menu_pedidos/telas/novo_pedido_mobile.php');	
				} else {
					$("#conteudo_geral").load('menu_pedidos/telas/novo_pedido.php');	
				}
				
				
			});

		} else {

			

			if(mobile==1){
					$("#conteudo_geral").load('erros/mobile_aguarda_caixa.php');	
			} else {
				
				$("#conteudo_geral").load('menu_caixa/telas/abre_caixa.php', function(){
					$("#troco").focus();				
				});	

			}

			

		}


	}); 
		
	
}



function exibicao_opcoes_produto_selecionado(){

	$("#exibicao_adicionais_produto_selecionado").hide();	

	if( $('#exibicao_opcoes_produto_selecionado').is(':visible') ) {
		
		$("#exibicao_opcoes_produto_selecionado").hide();
		$("#exibicao_produtos_pedido, #exibicao_categorias_pedido").show();
			
	} else {

	    $("#exibicao_produtos_pedido, #exibicao_categorias_pedido").hide();		
		$("#exibicao_opcoes_produto_selecionado").show();		

	}

}


function exibicao_adicionais_produto_selecionado(){

	$("#exibicao_opcoes_produto_selecionado").hide();	

	if( $('#exibicao_adicionais_produto_selecionado').is(':visible') ) {
		
		$("#exibicao_adicionais_produto_selecionado").hide();
		$("#exibicao_produtos_pedido, #exibicao_categorias_pedido").show();
			
	} else {

	    $("#exibicao_produtos_pedido, #exibicao_categorias_pedido").hide();		
		$("#exibicao_adicionais_produto_selecionado").show();		

	}

	
}


function selecao_variacao(valor_recebe='0&@@&0'){

	var tela_mobile = $("#tela-mobile").val();

	var val = valor_recebe.split('&@@&');
	var valor = val[0];
	var opcao_combo_obg = val[1];
	

	if(opcao_combo_obg==1){
		
		//APENAS PARA MOBILE	
		if(tela_mobile==1){
			$(".botao-adicao-produto").removeClass('metade_tamanho');
			$(".botao-adicao-produto").addClass('um_terco_tamanho');
		}

		global_opcao_combo_obrigatoria=1;
		$("#botao_opcoes_combo").show();
	} else {

		$("#botao_opcoes_combo").hide();

		//APENAS PARA MOBILE	
		if(tela_mobile==1){
			$(".botao-adicao-produto").removeClass('um_terco_tamanho');
			$(".botao-adicao-produto").addClass('metade_tamanho');
			
		}

		global_opcao_combo_obrigatoria=0;
		
	}


	if(valor==0){
		$(".error-select-variacao").show();
		$(".ok-select-variacao").hide();
	} else {
		$(".ok-select-variacao").show();
		$(".error-select-variacao").hide();		
	}
}



function seleciona_produtos(tipo,id,preco_composto,categoria){

	var tela_mobile = $("#tela-mobile").val();

	if(global_pesquisa_adicionais==0 || global_produto_selecionado!=id){
		$("#exibicao_adicionais_produto_selecionado").html('<center><br><br>CARREGANDO...</center>');
		$("#exibicao_adicionais_produto_selecionado").load('menu_pedidos/listagem/listagem_adicionais.php?categoria='+categoria);		
		global_pesquisa_adicionais=1;	
	}

	if(global_pesquisa_opcoes==0 || global_produto_selecionado!=id){
		$("#exibicao_opcoes_produto_selecionado").html('<center><br><br>CARREGANDO...</center>');
		$("#exibicao_opcoes_produto_selecionado").load('menu_pedidos/listagem/listagem_opcoes.php?categoria='+categoria+'&produto='+id);		
		global_pesquisa_opcoes=1;	
	}

	global_produto_selecionado = id;

	//MEIO A MEIO
	if(tipo==1){

		qtd=0;
		$(".prod-normais").prop( "checked", false);
		$(".pdr2").removeClass("produto-round_cor");		
		$(".pdr2a").css("color","#333");			

		//DESMARCA O CHECKBOX
		if($("#check"+id).is(':checked')){			
			$("#check"+id).prop( "checked", false);		
			$("#produtox"+id).removeClass("produto-round_cor");	
			$("#foca_campo"+id).css("color","#333");				
			$("#destaca"+id).css("color","#B92A25");					

		} else {			
			$("#check"+id).prop( "checked", true);		
			$("#produtox"+id).addClass("produto-round_cor");		
			$("#foca_campo"+id).css("color","#FFF");			
			$("#destaca"+id).css("color", "#FFF");				
		}
		

		$(".prod-meio-meio").each(function () {
        	if($(this).is(':checked')){
        		qtd++;             		
        	}        	
    	});


    	if(qtd>0){    		    		
    		$(".box-nome-cliente").show();
    		
    		if(tela_mobile==1){    			
    			$("#exibicao_produtos_pedido").addClass('margin30');    			
    		}

    		$(".botoes-insercao-itens-pedido").show(0, function(){
    			if(tela_mobile==0){
    				$("#quantidade-produto").focus().select();	
    			}    			
    		}); 

    		//MOSTRA CAMPO VARIACOES
    		if(preco_composto==1){
    			
    			if(tela_mobile==0){ 
    				$("#campo_para_pesquisa_produto").hide(); 
    			}

    			$("#tamanho").prop('disabled', false);
    			$("#tamanho").html('<option value="">CARREGANDO</option>');	
    			$("#campo_para_variacao_produto").show();
    			$.post('menu_pedidos/listagem/listagem_variacao_tamanhos.php', {categoria:categoria, produto:id}, function(resposta){
					$("#tamanho").html(resposta);	
				});
    		} else {
				
				//OCULTA CAMPO VARIACOES
	    		$("#campo_para_variacao_produto").show();
	    		$("#tamanho").html('<option value="0">----------</option>');	
	    		$("#tamanho").prop('disabled', true);	
	    		
	    		if(tela_mobile==0){ 

    				$("#campo_para_pesquisa_produto").show(); 
    			}

	    		selecao_variacao();

    		}

    	} else {

    		if(tela_mobile==1){    			
    			$("#exibicao_produtos_pedido").removeClass('margin30');
    		}

    		//ZERA A VARIAVEL DE PESQUISA DE ADICIONAIS
    		global_pesquisa_adicionais=0;	

    		$(".box-nome-cliente").hide();
    		$(".botoes-insercao-itens-pedido").hide();

    		//OCULTA CAMPO VARIACOES
    		$("#campo_para_variacao_produto").hide();
    		$("#tamanho").html('<option value="0"></option>');	
    		
    		if(tela_mobile==0){ 
    			$("#campo_para_pesquisa_produto").show(); 
    		}

    		selecao_variacao();

    	}


	//NORMAL	
	} else {

		$(".prod-meio-meio").prop( "checked", false);		
		$(".pdr1").removeClass("produto-round_cor");
		$(".pdr2").removeClass("produto-round_cor");
		$(".pdr1a").css("color","#333");			
		$(".pdr2a").css("color","#333");	
		$(".destaca").css("color","#B92A25");			

		//DESMARCA O RADIO
		if($("#check"+id).is(':checked')){		

			if(tela_mobile==1){    			
    			$("#exibicao_produtos_pedido").removeClass('margin30');
    		}

			$("#check"+id).prop( "checked", false);		
			$("#produtox"+id).removeClass("produto-round_cor");		
			$("#foca_campo"+id).css("color","#333");
			$("#destaca"+id).css("color","#B92A25");	
			$(".box-nome-cliente").hide();
			$(".botoes-insercao-itens-pedido").hide();

			//OCULTA CAMPO VARIACOES
	    	$("#campo_para_variacao_produto").hide();
	    	$("#tamanho").html('<option value="0"></option>');	
	    	
	    	if(tela_mobile==0){ 
    			$("#campo_para_pesquisa_produto").show(); 
    		}

	    	selecao_variacao();

	    	//ZERA A VARIAVEL DE PESQUISA DE ADICIONAIS
	    	global_pesquisa_adicionais=0;	
			
		} else {	

			if(tela_mobile==1){    			
    			$("#exibicao_produtos_pedido").addClass('margin30');
    		}	

			$("#check"+id).prop( "checked", true);
			$("#produtox"+id).addClass("produto-round_cor");
			$("#foca_campo"+id).css("color","#FFF");
			$("#destaca"+id).css("color","#FFF");		
			$(".box-nome-cliente").show();
			$(".botoes-insercao-itens-pedido").show(0, function(){
				if(tela_mobile==0){
    				$("#quantidade-produto").focus().select();	
    			}
			});

			//MOSTRA CAMPO VARIACOES
    		if(preco_composto==1){
    			
    			if(tela_mobile==0){ 
    				$("#campo_para_pesquisa_produto").hide(); 
    			}

    			$("#tamanho").prop('disabled', false);
    			$("#tamanho").html('<option value="">CARREGANDO</option>');	
    			$("#campo_para_variacao_produto").show();
    			$.post('menu_pedidos/listagem/listagem_variacao_tamanhos.php', {categoria:categoria, produto:id}, function(resposta){
					$("#tamanho").html(resposta);	
				});
    		} else {
				
				//OCULTA CAMPO VARIACOES
	    		$("#campo_para_variacao_produto").show();
	    		$("#tamanho").html('<option value="0">----------</option>');	
	    		$("#tamanho").prop('disabled', true);	
	    		
	    		if(tela_mobile==0){ 
	    			$("#campo_para_variacao_produto").hide();
    				$("#campo_para_pesquisa_produto").hide(); 
    			}

	    		selecao_variacao();
    		    			
    		}

			
		}


	}


}

		
		
		


function limpa_pesquisa_produtos(){
	$("#exibe_categorias").show();
	$("#exibe_pesquisa").hide();		
	$("#pesquisa_prods").val('');
}


function pesquisa_produtos_venda(pesquisa){

	$("#sucesso_salva_pedido_mobile").hide();
	
	var tela_mobile = $("#tela-mobile").val();		

	$(".marca-produtos").each(function () {
		var id = $(this).val();
        if($(this).is(':checked')){
        	$('#prod_name_div'+id).show();
        } else {
        	$('#prod_name_div'+id).hide();
        }        	
    });


	if(tela_mobile==1){
	
	    if(pesquisa==''){
	    	var qtd = 0;
	    	$(".marca-produtos").each(function () {
	    		var id = $(this).val();
	        	if($(this).is(':checked')){
	    			qtd++; 
	    		}
	    	});

	    	if(qtd==0){
	    		$("#informacao_qtd_itens_pedido").show();	
	    	} else {
	    		$("#informacao_qtd_itens_pedido").hide();
	    	}
	    	
	    } else {
	    	$("#informacao_qtd_itens_pedido").hide();
	    }
	
	} else {

		if(pesquisa==''){
			var categoria_selecionada = $("#categoria_selecionada").val();				
			$(".produtos_categoria_selecionada"+categoria_selecionada).show();
		}
	}

	var pesquisa = pesquisa.toLowerCase();	
	$('[data-name*="'+pesquisa+'"]').show();
}


function exclui_opcao_pedido(id){

	var pedido_aguarda_venda = $("#pedido_aguarda_venda").val();

	if(pedido_aguarda_venda == 1){
		$("#id_opcoes_cancelamento").val(id);
		$("#senha_cancelamento_opcoes_pedido").val('');
		$("#erro_senha_cancela_opcoes").hide();
		$("#CancelaOpcoesPedidoSenha").modal();
	} else {
		$("#resumo-pedido-comanda").html('<br><center>CARREGANDO...</center>');
		$.post('menu_pedidos/actions/exclui_opcao_venda.php', {id:id}, function(resposta){				
			$("#resumo-pedido-comanda").load('menu_pedidos/listagem/listagem_itens_pedido.php');
			atualiza_valor_final_pedido_comanda();
		});
	}


	
}



function exclui_adicional_pedido(id){
	var pedido_aguarda_venda = $("#pedido_aguarda_venda").val();

	if(pedido_aguarda_venda == 1){
		$("#id_adicional_cancelamento").val(id);
		$("#senha_cancelamento_adicional_pedido").val('');
		$("#erro_senha_cancela_adicional").hide();
		$("#CancelaAdicionalPedidoSenha").modal();
	} else {
		$("#resumo-pedido-comanda").html('<br><center>CARREGANDO...</center>');
		$.post('menu_pedidos/actions/exclui_adicional_venda.php', {id:id}, function(resposta){				
			$("#resumo-pedido-comanda").load('menu_pedidos/listagem/listagem_itens_pedido.php');
			atualiza_valor_final_pedido_comanda();
		});
	}
}


function exlcui_produto_pedido(tipo,id){


	var pedido_aguarda_venda = $("#pedido_aguarda_venda").val();

	if(pedido_aguarda_venda==1){
		var_global=1;
		$("#id_prod_venda_cancelamento").val(id);
		$("#senha_cancelamento_item_pedido").val('');
		$("#senha_cancelamento_item_pedido").focus();
		$("#CancelaItemPedidoSenha").modal();
	} else {

		$("#resumo-pedido-comanda").html('<br><center>CARREGANDO...</center>');
		$.post('menu_pedidos/actions/exclui_produto_venda.php', {id_prod_venda_cancelamento:id, pedido_aguarda_venda:pedido_aguarda_venda}, function(resposta){								
			
			var tela_mobile = $("#tela-mobile").val();		

			//PEGA QTD DE ITENS E ATUALIZA NO MOBILE
			if(tela_mobile==1){
			$.post('menu_pedidos/actions/pega_qtd_itens_pedido.php',{id:1}, function(resposta){
				$(".qtd_itens_grande").html(resposta)
			});					
			}

			$("#resumo-pedido-comanda").load('menu_pedidos/listagem/listagem_itens_pedido.php');
			atualiza_valor_final_pedido_comanda();
		});	
	}
}





function cancela_venda(id){
	$("#exibe_cancelamento_venda").val(id);
	$("#senha_cancelamento").val('');
	$("#erro_senha_cancela").hide();
	$("#CancelaVendaSenha").modal();
}


function defini_tipo_troco_cartao_entrega(tipo){

	//DINHEIRO
	if(tipo==1){
		$("#tipo_escolha_pgto").html('TROCO PARA:');
		$("#troco_leva_maquina").attr("placeholder", "0.00");				
		$("#levar_maquina_cartao").val('0');		
		$("#troco_leva_maquina").attr('disabled', false);
		$("#troco_leva_maquina").focus();
		$("#pre_tipo_pagamento").val('1');		
	}

	//CARTÃO
	if(tipo==2){		
		$("#tipo_escolha_pgto").html('CARTÃO');
		$("#troco_leva_maquina").val('');	
		$("#troco_leva_maquina").attr("placeholder", "LEVAR MÁQUINA");					
		$("#levar_maquina_cartao").val('1');		
		$("#troco_leva_maquina").attr('disabled', true);
		$("#pre_tipo_pagamento").val('2');		
	}

}


function escolhe_taxa_entrega(a){

	var total_pedido = parseFloat($("#soma_pedido").val());	
	var val_recebido = parseFloat($("#val_recebido").val());	
	var mesa_id = $("#mesa").val();

	//NAO TEM TAXA DE ENTREGA
	if(a==0){

		if(mesa_id==0){			
			$("#embala_viagem").val($("#embala_viagem option:eq(1)").val());	
		} 

		//ZERA ENTREGADOR E TROCO DA ENTREGA
		$("#definicoes_entrega").hide();
		$("#tipo_escolha_pgto").html('ESCOLHA');
		$("#troco_leva_maquina").val('');
		$("#troco_leva_maquina").attr("placeholder", "");
		$("#troco_leva_maquina").attr('disabled', true);
		$("#levar_maquina_cartao").val('0');
		$("#entregador").val($("#entregador option:first").val());
		$("#pre_tipo_pagamento").val('0');	
		////
	
		$("#val_taxa_entrega").html('0,00');
		$("#soma_entrega").val(0);
		$("#soma_final").val((total_pedido));	

		var geral = (total_pedido-val_recebido);
		if(geral<0){geral=0;}

		$("#val_final_com_taxa").html(''+(total_pedido).toFixed(2));
		$("#val_final").html(''+(geral).toFixed(2));

	//TEM TAXA	
	} else {

		//ZERA ENTREGADOR E TROCO DA ENTREGA
		$("#definicoes_entrega").show();

		////

		$("#mesa").val($("#mesa option:first").val());
		$("#val_taxa_entrega").html('<img src="img/loading.gif">');
		//$("#val_subtotal").html('<img src="img/loading.gif">');
		$("#val_final").html('<img src="img/loading.gif">');


			$.post('ajax/pesquisa_taxa_entrega.php', {id:a}, function(resposta){
				$("#val_taxa_entrega").html(''+resposta);
				$("#soma_entrega").val(resposta);

					var soma_pedido_entrega = (total_pedido+parseFloat(resposta));
					$("#soma_final").val(soma_pedido_entrega);						

					var geral = (soma_pedido_entrega-val_recebido);

					if(geral<0){geral=0;}

					$("#val_final_com_taxa").html(''+(soma_pedido_entrega).toFixed(2));
					$("#val_final").html(''+(geral).toFixed(2));
			});

	}

}



function escolhe_mesa(){
	$("#taxa_entrega").val($("#taxa_entrega option:first").val());
	escolhe_taxa_entrega(0)	
}



function fazdesconto(tipo){

	total_pedido = $("#soma_pedido").val();	
	total_final = $("#soma_final").val();
	total_entrega  = $("#soma_entrega").val();
	desconto  = $("#val_desconto").val();

	if(desconto=='' || desconto=='0.00'){
		exibe_erros_gerais('Informe o valor ou percentual de desconto!');
		return;
	}

	

	//DESCONTO EM PORCENTAGEM
	if(tipo==1){
		$("#utiliza_resgate_pontos").val('0');
		$("#avisa_troca_pontos").hide();
		valor_percente = ((parseFloat(total_pedido)*parseFloat(desconto))/100);
		desconto_final = ((parseFloat(total_pedido)-parseFloat(valor_percente))+parseFloat(total_entrega));	
		$("#soma_desconto").val(parseFloat(valor_percente));		
		$("#val_final").html(''+desconto_final.toFixed(2));
		$("#tipo_desconto").val('porcentagem');
	}

	//DESCONTO EM REAIS
	if(tipo==2){
		$("#avisa_troca_pontos").hide();
		desconto_final = ((parseFloat(total_pedido)-parseFloat(desconto))+parseFloat(total_entrega));
		$("#soma_desconto").val(parseFloat(desconto));			
		$("#val_final").html(''+desconto_final.toFixed(2));
		$("#tipo_desconto").val('dinheiro');		
	}

	//REMOVE OS DESCONTOS
	if(tipo==3){

		$("#val_desconto").attr('disabled', false);	
		$("#btn_desconto1").attr('disabled', false);	
		$("#btn_desconto2").attr('disabled', false);	

		$("#utiliza_resgate_pontos").val('0');
		$("#avisa_troca_pontos").hide();
		desconto_final = (parseFloat(total_pedido)+parseFloat(total_entrega));
		$("#soma_desconto").val(0);		
		$("#val_final").html(''+desconto_final.toFixed(2));
		$("#val_desconto").val('');		
		$("#tipo_desconto").val('');
	}

	$("#soma_final").val(parseFloat(desconto_final));	

}



function escolhe_forma_pgto(id){

	
	$(".formas_pgto").removeClass("formas_pgto_marcada");
	$("#forma_pg"+id).prop("checked", true);
	$("#div_forma_pgto"+id).addClass("formas_pgto_marcada");		

	entrega = $("#taxa_entrega").val();
	$("#aviso_cartao_entrega").hide();
	$("#aviso_troco_entrega").hide();
	
}

function faz_saldo_restante(valor){
	
	var final = parseFloat($("#restante_receber").val());
	var desconto = parseFloat($("#soma_desconto").val());
	var recebe = parseFloat(valor);

	//var final_menos_desconto = (final-desconto);
	var resta_receber = (final-desconto);
	
	if(resta_receber<=0){
		resta_receber=0;	
	}

	troco = (recebe-resta_receber);
	if(troco<0){
		troco=0;
	}


	//$("#valor_geral_final").val('R$ '+resta_receber.toFixed(2));
	$("#troco_recebe").val('R$ '+troco.toFixed(2));

}


function ve_pagamentos_recebidos(){
	$("#exibe_pagamentos_recebidos").html('<br><br><CENTER><h4>CARREGANDO...</h4><br><br></CENTER>');
	$("#ModalPgtosRecebidos").modal();
	$("#exibe_pagamentos_recebidos").load('menu_pedidos/listagem/lista_pagamentos_venda.php');
}


function edita_nome_cliente_comanda(id){
	$("#span_edita_nome"+id).hide();
	$("#campo_edita_nome"+id).show();
	$("#campo_edita_nome"+id).focus();
	$("#campo_edita_nome"+id).select();
	var_global=1;
}

function edita_quantidade_item(id){
	$("#span_edita_qtd"+id).hide();
	$("#campo_edita_qtd"+id).show();
	$("#campo_edita_qtd"+id).focus();
	$("#campo_edita_qtd"+id).select();
	var_global=1;
}


function altera_nome_cliente_comanda(campo){
	var nome = $("#campo_edita_nome"+campo).val();	
	$("#span_edita_nome"+campo).html(nome);	
	$("#campo_edita_nome"+campo).hide();
	$("#span_edita_nome"+campo).show();
	$.post('menu_pedidos/actions/altera_nome_divisao_mesa_comanda.php',{id:campo, nome:nome});		
	var_global=0;
}

function altera_quantidade_produto(campo){
	var qtd = $("#campo_edita_qtd"+campo).val();
	if(qtd<10){qtd='0'+qtd;}
	if(qtd==0){qtd='01';}
	$("#span_edita_qtd"+campo).html(qtd);
	$(".qtd_opcionais"+campo).html(qtd);
	$("#campo_edita_qtd"+campo).hide();
	$("#span_edita_qtd"+campo).show();
	$.post('menu_pedidos/actions/altera_quantidade.php',{id:campo, qtd:qtd}, function(a){		
		atualiza_valor_final_pedido_comanda();	
	});	
	
	var_global=0;
}


function atualiza_valor_final_pedido_comanda(){
	$.post('menu_pedidos/actions/salva_totais_pedido.php',{id:1}, function(resposta){				
		$("#valor_final_pedido_comanda").html(resposta);
	});
	
}

function salva_item_pedido(){

	//VE SE É NO MOBILE
	var tela_mobile = $("#tela-mobile").val();

	//VERIFICA SE A VENDA JÁ ESTA EM AGUARDE
	var venda_aguarde = $("#pedido_aguarda_venda").val();

	//PEGO OS PRODUTOS
	var meio_meio = new Array();
	var normal = 0;
	
	$(".prod-meio-meio").each(function () {
        if($(this).is(':checked')){
        	meio_meio.push($(this).val());
        }        	
    });

    $(".prod-normais").each(function () {
        if($(this).is(':checked')){
        	normal = $(this).val();
        }        	
    });


    //QUANTIDADE, OBSERVACOES, TAMANHO, NOME DO CLIENTE
    var qtd = $("#quantidade-produto").val();
	var observacoes = $("#observacoes-produto").val();
	var nome_cliente = $("#nome-cliente-produto").val();
	var tamanho = $("#tamanho").val();

	//ADICIONAIS
	camposMarcados = new Array();
	$("input[type=checkbox][name='opc[]']:checked").each(function(){
		camposMarcados.push($(this).val());
	});

	//OPCOES
	opcoes_produto = new Array();
	$("input[type=checkbox][name='opcoes[]']:checked").each(function(){
		opcoes_produto.push($(this).val());
	});


	if(normal=='' && meio_meio==0){ 
		exibe_erros_gerais('Escolha o produto!');		
		return;
	}

	if(qtd=='' || qtd==0){ 
		exibe_erros_gerais('Informe a quantidade!');		
		return;
	}

	if(tamanho==''){ 
		exibe_erros_gerais('Escolha a variação de preço!');	
		focus_campo_variacao=1;	
		return;
	}


	if(global_opcao_combo_obrigatoria==1){
		if(opcoes_produto==''){
			exibe_erros_gerais('Escolha uma opção para o combo!');		
			return;	
		}
	}


		$(".opcoes_combo").removeClass('active_opcional');
  		$("#resumo-pedido-comanda").html('<br><center>CARREGANDO...</center>');
  		$(".pdr1").removeClass("produto-round_cor");
		$(".pdr2").removeClass("produto-round_cor");
		$(".pdr1a").css("color","#333");			
		$(".pdr2a").css("color","#333");	
		$(".destaca").css("color","#B92A25");	

		$(".prod-meio-meio").prop( "checked", false);	
		$(".prod-normais").prop( "checked", false);
		$("#quantidade-produto").val('1');
		$("#observacoes-produto").val('');		

		//OCULTA CAMPO VARIACOES E BOTOES DE INSERIR
		$(".box-nome-cliente").hide();
		$(".botoes-insercao-itens-pedido").hide();
	    $("#campo_para_variacao_produto").hide();
	    $("#tamanho").html('<option value="0"></option>');	
	    $("#campo_para_pesquisa_produto").show();
	    selecao_variacao();

	    //MOSTRA OS PRODUTOS E CATEGORIAS
	    $("#exibicao_adicionais_produto_selecionado").hide();
	    $("#exibicao_opcoes_produto_selecionado").hide();
		$("#exibicao_adicionais_produto_selecionado").html('<center><br><br>CARREGANDO...</center>');
		$("#exibicao_produtos_pedido, #exibicao_categorias_pedido").show();

		//APENAS PARA MOBILE//						
		if(tela_mobile==1){
			pesquisa_produtos_venda('');
			$("#exibicao_produtos_pedido").removeClass('margin30');
			$("#input_pesquisa_produto").val('');
			$("#quantidade-produto").val('');
			//$("#input_pesquisa_produto").focus();
		}

	if(tela_mobile==1){	
		$(".qtd_itens_grande").html('<i class="icofont-restaurant"></i>');	
	}

	$.post('menu_pedidos/actions/salva_produto_venda.php?meio_meio='+meio_meio+'&opcionais='+camposMarcados+'&opcoes_produto='+opcoes_produto, {normal:normal, tamanho:tamanho, qtd:qtd, observacoes:observacoes, nome_cliente:nome_cliente}, function(resposta){

		//PEGA QTD DE ITENS E ATUALIZA NO MOBILE
		if(tela_mobile==1){
			$("#sucesso_salva_pedido_mobile").show();
			setTimeout('$("#sucesso_salva_pedido_mobile").hide()',4000 );
			$.post('menu_pedidos/actions/pega_qtd_itens_pedido.php',{id:1}, function(resposta){
				$(".qtd_itens_grande").html(resposta)
			});					
		}

		//ZERA A VARIAVEL DE PESQUISA DE ADICIONAIS
		global_pesquisa_adicionais=0;	

		//ZERA A VARIAVEL DE OBGRIGATORIO OPCOES COMBO
		global_opcao_combo_obrigatoria==0;

		$("#resumo-pedido-comanda").load('menu_pedidos/listagem/listagem_itens_pedido.php');
		atualiza_valor_final_pedido_comanda();

		//PERGUNTA SE IMPRIME O ÍTEM UNICO	
		if(venda_aguarde!=0){
			sim_imprime_item_pedido = 1;
			$("#ModalPerguntaImprime02").modal();
		}

		
	});
	
}




function finaliza_pedido(){
	var totais_itens_pedido = $("#totais_itens_pedido").val();
	var tela_mobile = $("#tela-mobile").val();		

	if(totais_itens_pedido>0){
		carregando();

		if(tela_mobile==1){
			$("#conteudo_geral").load('menu_pedidos/telas/recebimento_mobile.php');
		} else {
			$("#conteudo_geral").load('menu_pedidos/telas/recebimento.php');	
		}
		
	} else {
		exibe_erros_gerais('Nenhum produto adicionado ao pedido!');
		return;	
	}
}


function finaliza_pedido2(imprime=0, reload=0){

	var tela_mobile = $("#tela-mobile").val();		


	var nome_cliente_mobile = $("#nome_cliente_mobile").val();

	var mesa = $("#mesa").val();
	var entrega = $("#taxa_entrega").val();
	var desconto = $("#soma_desconto").val();
	var final_venda = $("#soma_final").val();
	var val_desc = $("#val_desconto").val();
	var taxa_entrega = $("#soma_entrega").val();
	var tipo_desconto = $("#tipo_desconto").val();
	var entregador = $("#entregador").val();
	var troco_leva_maquina = $("#troco_leva_maquina").val();
	var levar_maquina_cartao = $("#levar_maquina_cartao").val();
	var pre_tipo_pagamento = $("#pre_tipo_pagamento").val();
	var embala_viagem = $("#embala_viagem").val();
	var venda_aguarde = $("#pedido_aguarda_venda").val();



	//MOBILE
	if(tela_mobile==1){

		if(nome_cliente_mobile=='' || nome_cliente_mobile=='CLIENTE AVULSO'){
			exibe_erros_gerais('Informe nome do cliente!');
			return;	
		}

	//DESKTOP	
	} else {

		if(entrega==''){

			if(mesa==0){
				exibe_erros_gerais('Escolha entrega ou retirada.');
				return;	
			}	

		}

		var nome_cliente_mobile = $("#nome_cliente_venda").val(); 
		var endereco_cliente_venda = $("#endereco_cliente_venda").val(); 

		//É ENTREGA//
		if(entrega!=0){
			if(nome_cliente_mobile=='' || nome_cliente_mobile=='CLIENTE AVULSO'){
				exibe_erros_gerais('Informe os dados do cliente para entrega!');
				return;	
			}

			if(endereco_cliente_venda==''){
				exibe_erros_gerais('Informe o endereço do cliente para entrega!');
				return;	
			}	

			if(pre_tipo_pagamento=='' || pre_tipo_pagamento==0){
				exibe_erros_gerais('Informe se é para levar máquina ou troco!');
				return;		
			}

		}


		//É RETIRADA NO BALCÃO
		if(entrega==0){
			
			if(nome_cliente_mobile=='' || nome_cliente_mobile=='CLIENTE AVULSO'){
				exibe_erros_gerais('Informe o nome do cliente para retirada!');
				return;	
			}

		}	



	}
	

	
	if(venda_aguarde==0){
		sim_imprime_pedido_completo=1;
		$("#ModalPerguntaImprime01").modal();
	}

	if(reload==0){
		carregando();
	}
	
	
	$.post('menu_pedidos/actions/salva_pedido_final.php',{nome_cliente_mobile:nome_cliente_mobile, embala_viagem:embala_viagem, pre_tipo_pagamento:pre_tipo_pagamento, levar_maquina_cartao:levar_maquina_cartao, entregador:entregador, troco_leva_maquina:troco_leva_maquina, tipo_desconto:tipo_desconto, val_desc:val_desc, desconto:desconto, entrega:entrega, mesa:mesa, taxa_entrega:taxa_entrega, final_venda:final_venda}, function(resposta2){				
		

		if(imprime!=0){
			reimpressao_completa_pedido(imprime);	
		}
		

		//FAZ ISSO QUANDO NAO É CLICK NO BOTAO DE IMPRIMIR//
		if(reload==0){

			//NO MOBILE	
			if(tela_mobile==1){
				$("#conteudo_geral").load('mobile/tela_aguarde.php', function(){
					$("#sucesso_salva_pedido_mobile").show();
					setTimeout('$("#sucesso_salva_pedido_mobile").hide()',2000 );
				});			
			} else {
				if(mesa!=0){
					$("#conteudo_geral").load('menu_pedidos/telas/mesas_pedidos.php');				
				} else {
					$("#conteudo_geral").load('menu_pedidos/telas/entregas_comandas.php');			
				}
			}

		}
		

		
		
		
	});
	
}


function realiza_pagamento(){
		

			var valor_recebe = $("#valor_recebe").val();
			if(valor_recebe=='' || valor_recebe=='0.00'){

				$("#icon-ok-val-recebe").hide();
				$("#icon-erro-val-recebe").show();

				$("#valor_recebe").focus();
				$("#escrito_btn_recebimento").html("RECEBER (F10)");		
				$("#btn_realiza_pagamento").attr('disabled', false);	
				return;
			} else {
				$("#icon-erro-val-recebe").hide();
				$("#icon-ok-val-recebe").show();
			}

			var forma_pagamento = $("#forma_pagamento").val();
			if(forma_pagamento==0){				
				exibe_erros_gerais('Escolha o tipo de pagamento!');
				$("#escrito_btn_recebimento").html("RECEBER (F10)");		
				$("#btn_realiza_pagamento").attr('disabled', false);	
				return;	
			}
		  
		  	var troco_recebe = $("#troco_recebe").val(); 
		  	
		  	var id_cliente_venda = $("#id_cliente_venda").val(); 
		  	var nome_cliente_venda = $("#nome_cliente_venda").val(); 


		  	//MARCA NA CONTA DO CLIENTE//
		  	if(forma_pagamento==3){
		  		if(nome_cliente_venda=='CLIENTE AVULSO'){
		  			modal_edita_cliente_pedido(id_cliente_venda);
		  			return;
		  		}
		  	}
		  	
		  	//USAR PONTUACAO CLIENTE
		  	var utiliza_resgate_pontos = $("#utiliza_resgate_pontos").val(); 
		  	var pontos_validos_troca = $("#pontos_validos_troca").val(); 

		  		
			$("#val_recebido_texto").html('----');
			$("#val_final").html('----');



			$("#escrito_btn_recebimento").html("AGUARDE...");	
			$("#btn_realiza_pagamento").attr('disabled', true);	

			var mesa = $("#mesa").val();
			var entrega = $("#taxa_entrega").val();
			var desconto = $("#soma_desconto").val();
			var final_venda = $("#soma_final").val();
			var val_desc = $("#val_desconto").val();
			var taxa_entrega = $("#soma_entrega").val();
			var tipo_desconto = $("#tipo_desconto").val();
			var entregador = $("#entregador").val();
			var troco_leva_maquina = $("#troco_leva_maquina").val();
			var levar_maquina_cartao = $("#levar_maquina_cartao").val();
			var pre_tipo_pagamento = $("#pre_tipo_pagamento").val();
			var embala_viagem = $("#embala_viagem").val();
			var venda_aguarde = $("#pedido_aguarda_venda").val();

			$.post('menu_pedidos/actions/salva_pedido_final.php',{embala_viagem:embala_viagem, pre_tipo_pagamento:pre_tipo_pagamento, levar_maquina_cartao:levar_maquina_cartao, entregador:entregador, troco_leva_maquina:troco_leva_maquina, tipo_desconto:tipo_desconto, val_desc:val_desc, desconto:desconto, entrega:entrega, mesa:mesa, taxa_entrega:taxa_entrega, final_venda:final_venda}, function(resposta2){				
			

					$("#escrito_btn_recebimento").html("EFETUANDO...");	

					$.post('menu_pedidos/actions/salva_recebimento.php',{pontos_validos_troca:pontos_validos_troca, utiliza_resgate_pontos:utiliza_resgate_pontos, troco_recebe:troco_recebe, forma_pagamento:forma_pagamento, valor_recebe:valor_recebe}, function(resposta){				

							var val = resposta.split('&@&');
							var ja_recebido = parseFloat(val[1]);
							var resta_receber = parseFloat(val[0]);
		
							//NAO FALTA RECEBER MAIS NADA
							if(resta_receber==0){
								
								//PAGOU TUDO E AINDA NAO IMPRIMIU//	
								if(venda_aguarde==0){

									if(forma_pagamento==3){											
										imprime_ciencia_crediario();
									} else {										
										imprime_recebimentos();
									}
									
									sim_imprime_pedido_completo=1;
									$("#ModalPerguntaImprime01").modal();	

								} else {
									
									if(forma_pagamento==3){	

										imprime_ciencia_crediario();
									} else {
										imprime_recebimentos();
									}
								}

								carregando();
								$("#conteudo_geral").load('menu_pedidos/telas/mesas_pedidos.php');		


							//AINDA TEM COISA A RECEBER	
							} else {
								
								imprime_recebimentos();				
								$("#val_recebido_texto").html(ja_recebido.toFixed(2));
								$("#val_final").html(resta_receber.toFixed(2));
								$("#restante_receber").val(resta_receber);

								
								$("#aviso_pagamentos_existentes").show();								
								$("#valor_recebe").val('');
								$("#valor_recebe").focus();
								$("#escrito_btn_recebimento").html("RECEBER (F10)");		
								$("#btn_realiza_pagamento").attr('disabled', false);
							}


					});

			});		

	

}




function resgate_pontos(){
	$("#val_desconto").val('');			
	$("#utiliza_resgate_pontos").val(1);

	$("#val_desconto").attr('disabled', true);	
	$("#btn_desconto1").attr('disabled', true);	
	$("#btn_desconto2").attr('disabled', true);	

	var pontos_validos = $("#pontos_validos_troca").val();
	$.post('menu_pedidos/actions/calcula_desconto_pontuacao.php',{pontos_validos:pontos_validos}, function(resposta){		
		
		$("#val_desconto").val(resposta);			
		fazdesconto(2);
		$("#avisa_troca_pontos").show();
	});
	
}


function exibe_produtos_categorias_pedido(categoria){
	$(".tab-pane").hide();
	$("#div"+categoria).show();
}


