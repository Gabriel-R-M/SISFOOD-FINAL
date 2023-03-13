	




function atualiza_servidor_web(repetidor=1,apaga_barra=0){

	if(apaga_barra==1){
		$("#barra_progresso_servidor_web").html('');
		$("#barra_progresso_servidor_web").css('width', 0+'%');

		$("#botao_atualiza_servidor_web").html('ATUALIZANDO, AGUARDE...');
		$("#botao_atualiza_servidor_web").prop('disabled', true);

		$(".aviso_servidor_web_atualizado").addClass("hide");
		$(".aviso_erro_servidor_web_atualizado").addClass("hide");
		
		$(".altura_progresso").removeClass("hide");	
	}

	var tabela = $(".tabelas"+repetidor).val();
	var count = $(".tabelas").length;
	var porcentagem = Math.round((100/count));
	var porcentagem = (porcentagem*repetidor);
	if(repetidor==count){porcentagem=100;}


	$.post($("#FormAtualizaServidorWeb").attr('action'), {table:tabela, repetidor:repetidor, total_tabelas:count}, function(resposta){
	
		if(apaga_barra==1){	
			
			$("#erro_atualiza_servidor").html('');
		}
			
		$("#barra_progresso_servidor_web").html(porcentagem+'%');
		$("#barra_progresso_servidor_web").css('width', porcentagem+'%');

		repetidor++;
		if(repetidor<=count){
			if(resposta==''){
				atualiza_servidor_web(repetidor,0)				
			} else {

				$("#erro_atualiza_servidor").html(resposta);
				$(".aviso_erro_servidor_web_atualizado").removeClass("hide");
				$("#botao_atualiza_servidor_web").html('ATUALIZAR AGORA');
				$(".aviso_servidor_web_atualizado").addClass("hide");
				$("#botao_atualiza_servidor_web").prop('disabled', false);
			}	
		//ACABOU A ATUALIZACAO//			
		} else {
				
			//TUDO OK
			if(resposta==''){
				$("#botao_atualiza_servidor_web").html('ATUALIZAR AGORA');
				$(".aviso_servidor_web_atualizado").removeClass("hide");
				$("#barra_aviso_servidor").addClass("hide");
				$("#botao_atualiza_servidor_web").prop('disabled', false);			

			//PROBLEMAS	
			} else {
				
				$("#erro_atualiza_servidor").html(resposta);
				$(".aviso_erro_servidor_web_atualizado").removeClass("hide");
				$("#botao_atualiza_servidor_web").html('ATUALIZAR AGORA');
				$(".aviso_servidor_web_atualizado").addClass("hide");
				$("#botao_atualiza_servidor_web").prop('disabled', false);
			}	

		}
		
	});



}


	