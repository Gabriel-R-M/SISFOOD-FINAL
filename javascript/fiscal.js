$(document).ready(function(){

	global_cpf_cliente = 0;

	$('#ModalEditaDadosClienteVenda').on('shown.bs.modal', function () {
    	global_cpf_cliente = 1;
    	$('#cpf_cliente').focus();    	
	}) 

}) 


function exibe_avisos_fiscais(mensagem){
	$("#botao_erro_sat").hide();
	$("#hide_input_fiscal").show();
	$("#cpf_cliente").val('');
	$("#cupom_fiscal_avisos").html(mensagem);		
	$("#ModalCupomFiscal").modal();	
}


function muda_mensagem_fiscal(mensagem){
	$("#hide_input_fiscal").hide();
	$("#cupom_fiscal_avisos").html('');	
	$("#cupom_fiscal_avisos").html(mensagem);	
}


function libera_venda_fiscal(){
	$("#ModalCupomFiscal").modal('hide');
	inicia_sistema();
}


function venda_fiscal(){

	global_cpf_cliente = 0;
	var cpf_cliente = $("#cpf_cliente").val();

	muda_mensagem_fiscal("<br>Aguarde, inicializando equipamento...<br><br>");
	$.post('fiscal/inicializa_sat.php',{inicializa:1}, function(resposta_fiscal){

		if(resposta_fiscal==1){
														
			muda_mensagem_fiscal("<br>Emitindo cupom fiscal...<br><br>");
			$.post('fiscal/cria_cupom_fiscal.php',{cpf_cliente:cpf_cliente}, function(resposta_fiscal2){
				
				if(resposta_fiscal2==1){

					muda_mensagem_fiscal("<br>Transmitindo cupom...<br><br>");
					$.post('fiscal/envia_cupom_sat.php',{fiscal:1}, function(resposta_fiscal3){
						

						var val = resposta_fiscal3.split('&@&');


						if(val[0]==1){

							muda_mensagem_fiscal("<br>Imprimindo cupom...<br><br>");
							$.post('fiscal/imprime_cupom_sat.php',{arquivo_imprimir:val[1]}, function(resposta_fiscal3){	

								$("#ModalCupomFiscal").modal('hide');	
								inicia_sistema();


							});
							

						//ERRO AO TRANSMITIR CUPOM	
						} else {
							$("#botao_erro_sat").show();
							muda_mensagem_fiscal("<h4>Erro:</h4>"+val[1]);				
						}
						
																

					});	
					

				//ERRO AO CRIAR CUPOM//	
				} else {
					$("#botao_erro_sat").show();
					muda_mensagem_fiscal("<h4>Erro:</h4>"+resposta_fiscal2);				
				}
												

			});	

										
		//ERRO AO INICIALIZAR O SAT//
		} else {
			$("#botao_erro_sat").show();
			muda_mensagem_fiscal("<h4>Erro:</h4> Problema ao inicializar equipamento.");				
		}

	});
}