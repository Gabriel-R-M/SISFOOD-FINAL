function testa_impressoras(imp){
	$("#resposta_teste_impressora").hide()
	$("#botao_teste_impressoras"+imp).html('ENVIANDO TESTE, AGUARDE...');
		aviso_impressao_sistema();
		$.post('menu_configuracoes/actions/imprime_teste_impressora.php',{impressora:imp}, function(resposta){				
			aviso_impressao_sistema(1);
			$("#botao_teste_impressoras"+imp).html('TESTAR IMPRESSORA 0'+imp);	
			$("#resposta_teste_impressora").show();
			setTimeout('$("#resposta_teste_impressora").hide();',6000 );
			$("#botao_teste_impressoras"+imp).blur();
		});	

}



function abre_loja_online(tipo){
	
	if(tipo=='automatica'){
		$("#manual").hide();
		$("#automatica").show();
	} else {
		$("#automatica").hide();
		$("#manual").show();
	}

}



function abre_fecha_loja_online(tipo){
	$("#botao_atualiza_abre_fecha").html("ATUALIZANDO...");
	$.post('menu_internet/actions/abre_fecha_loja.php',{tipo:tipo}, function(resposta){		
		submenu_abre_loja_online();
	});	

}


function altera_tipo_abertura_loja_online(){
	var tipo_abertura_loja = $("#tipo_abertura_loja").val();
	$("#botao_atualiza").html("ATUALIZANDO...");
	$.post('menu_internet/actions/modo_abertura_loja.php',{tipo_abertura_loja:tipo_abertura_loja}, function(resposta){		
		$.post('menu_internet/actions/abre_fecha_loja.php',{tipo:0}, function(resposta){		
			submenu_abre_loja_online();
		});	
	});	

}