function exibe_avisos_fiscais(mensagem){
	$("#botao_erro_sat").hide();
	$("#hide_input_fiscal").show();
	$("#cpf_cliente").val('');
	$("#cupom_fiscal_avisos").html(mensagem);		
	$("#ModalCupomFiscal").modal();	
}


function muda_mensagem_fiscal(mensagem){
	$("#hide_input_fiscal").hide();
	$("#cupom_fiscal_avisos").html(mensagem);	
}


function libera_venda_fiscal(){
	$("#ModalCupomFiscal").modal('hide');
	inicia_sistema();
}


function venda_fiscal(){

	var cpf_cliente = $("#cpf_cliente").val();

	muda_mensagem_fiscal("Aguarde, inicializando equipamento...");
	$.post('fiscal/inicializa_sat.php',{inicializa:1}, function(resposta_fiscal){


	});
}