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