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

		if(resposta_fiscal==1){
														
			muda_mensagem_fiscal("Emitindo cupom fiscal...");
			$.post('fiscal/cria_cupom_fiscal.php',{cpf_cliente:cpf_cliente}, function(resposta_fiscal){
				
				if(resposta_fiscal==1){

					muda_mensagem_fiscal("Transmitindo cupom...");
					$.post('fiscal/envia_cupom_sat.php',{venda_fiscal:venda_fiscal}, function(resposta_fiscal){
						

													
						alert(resposta_fiscal)
																

					});	
					

				//ERRO AO CRIAR CUPOM//	
				} else {
					$("#botao_erro_sat").show();
					muda_mensagem_fiscal("<h4>Erro:</h4>"+resposta_fiscal);				
				}
												

			});	

										
		//ERRO AO INICIALIZAR O SAT//
		} else {
			$("#botao_erro_sat").show();
			muda_mensagem_fiscal("<h4>Erro:</h4> Problema ao inicializar equipamento.");				
		}

	});
}