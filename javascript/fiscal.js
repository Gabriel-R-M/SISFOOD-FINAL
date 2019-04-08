$(document).ready(function(){

	global_cpf_cliente = 0;

	$('#ModalCupomFiscal').on('shown.bs.modal', function () {
    	global_cpf_cliente = 1;
    	$('#cpf_cliente').focus();    	
	}) 

	$('#ModalCupomFiscal').on('hidden.bs.modal', function (){
    	global_cpf_cliente = 0;    	
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


function reeimprimi_venda_fiscal(){
	
	$("#botao_erro_sat").hide();
	$("#hide_input_fiscal").hide();	
	$("#cupom_fiscal_avisos").html('<br><i class="icofont-hour-glass"></i><br><br>Aguarde, inicializando equipamento...<br><br>');		
	$("#ModalCupomFiscal").modal();	

	$.post('fiscal/inicializa_sat.php',{inicializa:1}, function(resposta_fiscal){

		if($.trim(resposta_fiscal)==1){
			
			muda_mensagem_fiscal('<br><i class="icofont-printer"></i><br><br>Imprimindo cupom...<br><br>');	
			$.post('fiscal/imprime_cupom_sat.php',{venda_pesquisa:1}, function(resposta_fiscal){		

				$("#ModalCupomFiscal").modal('hide');	
				$.post('fiscal/inicializa_sat.php',{inicializa:0}, function(resposta_fiscal){});

			});	

		//ERRO AO INICIALIZAR O SAT//
		} else {
			$("#botao_erro_sat").show();
			muda_mensagem_fiscal("<h4>Erro:</h4> Problema ao inicializar equipamento.");				
		}

	});


}



function venda_fiscal(){

	global_cpf_cliente = 0;
	var cpf_cliente = $("#cpf_cliente").val();

	muda_mensagem_fiscal('<br><i class="icofont-hour-glass"></i><br><br>Aguarde, inicializando equipamento...<br><br>');
	$.post('fiscal/inicializa_sat.php',{inicializa:1}, function(resposta_fiscal){

		if($.trim(resposta_fiscal)==1){
														
			muda_mensagem_fiscal('<br><i class="icofont-binary"></i><br><br>Emitindo cupom fiscal...<br><br>');
			$.post('fiscal/cria_cupom_fiscal.php',{cpf_cliente:cpf_cliente}, function(resposta_fiscal2){
				
				if($.trim(resposta_fiscal2)==1){

					muda_mensagem_fiscal('<br><i class="icofont-wifi"></i><br><br>Transmitindo cupom...<br><br>');
					$.post('fiscal/envia_cupom_sat.php',{fiscal:1}, function(resposta_fiscal3){
						
						resposta_fiscal3 = $.trim(resposta_fiscal3);
						var val = resposta_fiscal3.split('&@&');

						arquivo_imprimir = $.trim(val[1]);	

						if(val[0]==1){

							muda_mensagem_fiscal('<br><i class="icofont-printer"></i><br><br>Imprimindo cupom...<br><br>');

								$.post('fiscal/imprime_cupom_sat.php',{arquivo_imprimir:arquivo_imprimir}, function(resposta_fiscal3){	


									if($.trim(resposta_fiscal3)==''){
										$("#ModalCupomFiscal").modal('hide');	
									} else {
										$("#botao_erro_sat").show();
										muda_mensagem_fiscal("<h4>Erro:</h4>"+resposta_fiscal3);
									}	 
									
									inicia_sistema();

									$.post('fiscal/inicializa_sat.php',{inicializa:0}, function(resposta_fiscal){});


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