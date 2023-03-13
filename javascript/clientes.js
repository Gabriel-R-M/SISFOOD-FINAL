$(document).ready(function(){

	sim_imprime_comp_crediario=0;
	id_imprime_comp_crediario =0;
	sim_imprime_comp_debito_crediario=0;
	
	$('#ModalEditaDadosClienteVenda').on('hidden.bs.modal', function (){
	  $("#exibe_dados_cliente_pedido").html('');
	});

	$('#CancelaItemPedidoSenha').on('hidden.bs.modal', function (){
	  var_global=0;
	});

	$('#ModalPerguntaImprime03').on('hidden.bs.modal', function (){
	  sim_imprime_comp_crediario=0;
	  id_imprime_comp_crediario =0;
	});

	$('#ModalPerguntaImprime04').on('hidden.bs.modal', function (){
	  sim_imprime_comp_debito_crediario=0;
	  id_imprime_comp_crediario =0;
	});



});


function recebe_conta_cliente_divisao(val){
	$("#valor_recebe").val(val.toFixed(2));
	$("#ModalCompartilhamentoMesaRecebimento").modal('hide');
}


function historico_resgate_pontos(){
	var id_cliente = $("#id_cliente").val();	
	carregando();
	abre_menu('menu_clientes/telas/historico_resgate_pontos.php?id_cliente_venda='+id_cliente);	
}


function busca_cliente_cartao(){
	var cartao = $("#numero_cartao").val();
	$("#btn_buscar3").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
	$("#reload_pesquisa").html('<br><center>CARREGANDO...</center>');
	$.post('menu_clientes/listagem/listagem_clientes.php', {cartao:cartao}, function(resposta){
		$("#btn_buscar3").html('<i class="icofont-search" style="font-size: 17px"></i>');
		$("#reload_pesquisa").html(resposta);	
	});
}


function pergunta_imprime_debito_crediario(id){
	sim_imprime_comp_debito_crediario=1;
	id_imprime_comp_crediario =id;
	$("#ModalPerguntaImprime04").modal();
}


function pergunta_imprime_comprovante_pagamento_crediario(id){
	sim_imprime_comp_crediario=1;
	id_imprime_comp_crediario =id;
	$("#ModalPerguntaImprime03").modal();
}

function pesquisa_cadastro_clientes(){

	$("#reload_pesquisa").html('<br><CENTER><h16>PESQUISANDO...</h16></CENTER>');
	var formdata = $("#FormPesquisaCadastroClientes").serialize();				
	$.ajax({type: "POST", url:$("#FormPesquisaCadastroClientes").attr('action'), data:formdata, success: function(msg){										
					
		$("#reload_pesquisa").html(msg);
								
		} 
		
	});
		
	return false;
}


function altera_outro_endereco_cliente(id_endereco){
	$("#exibe_dados_cliente_pedido").html('');
	$("#id_endereco").val(id_endereco);
	var id_cliente = $("#id_cliente").val();

	$(".trava_endereco").prop('disabled', true);
	$.post('menu_clientes/actions/recupera_dados_endereco.php', {id_endereco:id_endereco, id_cliente:id_cliente}, function(resposta){		
		var val = resposta.split('&@&');
		$("#endereco").val(val[0]);
		$("#numero").val(val[1]);
		$("#complemento").val(val[2]);
		$("#bairro").val(val[3]);
		
		$("#carregando_outro_endereco").hide();
		$(".trava_endereco").prop('disabled', false);	

	});

}


function exibe_ficha_cliente(id){
	$("#carrega_dados_cliente_modal").html('<br><center><h16>CARREGANDO...</h16></center><br>');
	$("#ModalFichaCliente").modal();
	$("#carrega_dados_cliente_modal").load('menu_clientes/listagem/ficha_cliente.php?id='+id);
}


function edita_ficha_cliente(){
	
	$("#outros_enderecos").html('');
	id_cliente = $("#id_cliente_exibe").val();
	telefone_cliente = $("#telefone_cliente_exibe").val();	
	$(".procura-telefone-cliente").val(telefone_cliente);
	
	busca_cliente(1);
	$("#ModalFichaCliente").modal('hide');
}


function cancela_cadastro_cliente(){
	$("#id_cliente").val('');
	$("#numero_cartao").val('');
	$("#nome").val('');
	$("#endereco").val('');
	$("#numero").val('');
	$("#bairro").val('');
	$("#cidade").val('');
	$("#complemento").val('');
	$("#ddd").val('');
	$("#numero_telefone").val('');
	$("#celular").val('');	
	$(".btn-cancela-edicao").hide();
	$("#pontos_resgatar_display").hide();

	$("#exibe_outros_enderecos").hide();
	$("#outros_enderecos").html('');

}


function salva_edicao_cliente(){

	var id_cliente = $("#id_cliente").val();
	var id_endereco = $("#id_endereco").val();
	var numero_cartao = $("#numero_cartao").val();
	var nome = $("#nome").val();
	var endereco = $("#endereco").val();
	var numero = $("#numero").val();
	var bairro = $("#bairro").val();
	var cidade = $("#cidade").val();
	var complemento = $("#complemento").val();
	var ddd = $("#ddd").val();
	var numero_telefone = $("#numero_telefone").val();
	var celular = $("#celular").val();	
	
	if(nome==''){ 
		exibe_erros_gerais('Informe o nome do cliente!');	
		return;
	}

	if(numero_telefone==''){ 
		exibe_erros_gerais('Informe o telefone do cliente!');	
		return;
	}
	
	$("#reload_pesquisa").html("<br><center>CARREGANDO...</center>");
	$.post('menu_clientes/actions/salva_cliente.php', {id_endereco:id_endereco, id_cliente:id_cliente, numero_cartao:numero_cartao, nome:nome, endereco:endereco, numero:numero, bairro:bairro, cidade:cidade, complemento:complemento, ddd:ddd, numero_telefone:numero_telefone, celular:celular}, function(resposta) {		

		$("#reload_pesquisa").load("menu_clientes/listagem/listagem_clientes.php");	
		
		$("#sucesso_cliente").show();
		setTimeout('$("#sucesso_cliente").hide()',3000 );

		$("#btn_cancel").hide();

		$("#id_cliente").val('');
		$("#id_endereco").val('');
		$("#numero_cartao").val('');
		$("#nome").val('');
		$("#endereco").val('');
		$("#numero").val('');
		$("#bairro").val('');
		$("#cidade").val('');
		$("#complemento").val('');
		$("#ddd").val('');
		$("#numero_telefone").val('');
		$("#celular").val('');	

		$("#pontos_resgatar_display").hide();
		$("#exibe_outros_enderecos").hide();
		$("#outros_enderecos").html('');
		
	});
}


function salva_edicao_cliente_venda(){

	var id_cliente = $("#id_cliente").val();
	var id_cliente_venda = $("#id_cliente_venda").val();	
	
	var numero_cartao = $("#numero_cartao").val();
	var nome = $("#nome").val();
	var endereco = $("#endereco").val();
	var numero = $("#numero").val();
	var bairro = $("#bairro").val();
	var cidade = $("#cidade").val();
	var complemento = $("#complemento").val();
	var ddd = $("#ddd").val();
	var numero_telefone = $("#numero_telefone").val();
	var celular = $("#celular").val();	
	
	if(nome==''){ $("#nome").focus(); $("#nome").css('border','1px solid red'); return;}


	$("#btn_salvar").html('SALVANDO, AGUARDE...');
	$.post('menu_clientes/actions/salva_cliente.php', {altera_cliente_venda:1, id_cliente_venda_altera:id_cliente_venda, id_cliente:id_cliente, numero_cartao:numero_cartao, nome:nome, endereco:endereco, numero:numero, bairro:bairro, cidade:cidade, complemento:complemento, ddd:ddd, numero_telefone:numero_telefone, celular:celular}, function(resposta) {		
		
		$("#ModalEditaDadosClienteVenda").modal('hide');
		$("#exibe_dados_cliente_pedido").html('');

		$("#reload_dados_cliente_tela_pagamento").html('<CENTER><h5>CARREGANDO...</h5></CENTER>');		
	    $("#reload_dados_cliente_tela_pagamento").load('menu_pedidos/listagem/exibe_dados_cliente_tela_pagamento.php');		

	});

}



function consulta_compras_cliente(){
	id_cliente = $("#id_cliente_exibe").val();
	carregando();
	$("#conteudo_geral").load('menu_clientes/telas/compras_cliente.php?id='+id_cliente);
	$("#ModalFichaCliente").modal('hide');
}


function exibe_detalhes_compra_cliente(id){
	$("#exibe_detalhes_venda_modal").html('<br><center><h16>CARREGANDO...</h16></center><br>');
	$("#ModalDetalhesCompra").modal();
	$("#exibe_detalhes_venda_modal").load("menu_clientes/listagem/lista_itens_venda.php?id="+id);
}



function realiza_recebimento_crediario(){

	var valor_recebe = $("#valor_recebe").val();
	if(valor_recebe=='' || valor_recebe=='0.00'){

		$("#icon-ok-val-recebe").hide();
		$("#icon-erro-val-recebe").show();

		$("#valor_recebe").focus();
		return;

	} else {
		$("#icon-erro-val-recebe").hide();
		$("#icon-ok-val-recebe").show();
	}

	var forma_pagamento = $("#forma_pagamento").val();
	if(forma_pagamento==0){				
		exibe_erros_gerais('Escolha o tipo de pagamento!');
		return;	
	}
		  
	var troco_recebe = $("#troco_recebe").val(); 
	var id_cliente_crediario = $("#id_cliente_crediario").val(); 
	var restante_receber = $("#restante_receber").val();


	$("#escrito_btn_recebimento").html("AGUARDE...");	

	$.post('menu_clientes/actions/salva_recebimento_crediario.php',{restante_receber:restante_receber, id_cliente_crediario:id_cliente_crediario, troco_recebe:troco_recebe, forma_pagamento:forma_pagamento, valor_recebe:valor_recebe}, function(resposta){				


			pergunta_imprime_comprovante_pagamento_crediario(resposta)
			carregando();
			$("#conteudo_geral").load('menu_clientes/telas/compras_cliente.php?id='+id_cliente_crediario);			

	});
		
}




function faz_troco_cliente(valor){
	
	var final = parseFloat($("#restante_receber").val());	
	var recebe = parseFloat(valor);

	//var final_menos_desconto = (final-desconto);
	var resta_receber = (final-recebe);
	
	if(resta_receber<=0){
		resta_receber=0;	
	}

	troco = (recebe-final);
	if(troco<0){
		troco=0;
	}


	//$("#valor_geral_final").val('R$ '+resta_receber.toFixed(2));
	$("#troco_recebe").val('R$ '+troco.toFixed(2));

}