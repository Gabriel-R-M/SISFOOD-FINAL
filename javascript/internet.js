$(document).ready(function(){
	

	$('#ModalRejeicaoPedidoInternet').on('shown.bs.modal', function () {
    	$('#motivo_erro_internet').focus();
	}) 

	toca_som_pedido_web=1;

	if(typeof(modulo_internet) != "undefined") {
		if(modulo_internet==1){		

			var mobile = 0;
			if($('.is_mobile').is(":visible") == true) {
				mobile = 1;       
			}

			if(mobile==0){	
				verifica_pedidos_internet();	
			}
			
		}
	}

	

	$("#FormRejeitaPedidoInternet").submit(function(){			
		$("#botao_rejeita_pedido_modal").html('AGUARDE...');
		var formdata = $("#FormRejeitaPedidoInternet").serialize();		

			$.ajax({type: "POST", url:$("#FormRejeitaPedidoInternet").attr('action'), data:formdata, success: function(msg){										
				
				pedidos_internet();
				$("#id_pedido_rejeicao").val('');
				$("#ModalRejeicaoPedidoInternet").modal('hide');
				$("#botao_rejeita_pedido_modal").html('REJEITAR');
						
			} 
		
		});
		
		return false;
	});



});


function atualiza_horarios_abre_fecha(){
	

		$("#resposta_sucesso_servidor").hide();

		$(".altura_progresso").show();
		$("#barra_progresso_servidor_web").css('width', 10+'%');				
		$("#barra_progresso_servidor_web").html(10+'%');
		
		$("#botao_atualiza_horarios").html('ATUALIZANDO, AGUARDE...');
		var formdata = $("#FormHorariosFuncionamento").serialize();		

			$.ajax({type: "POST", url:$("#FormHorariosFuncionamento").attr('action'), data:formdata, success: function(msg){										
				
				$("#barra_progresso_servidor_web").css('width', 50+'%');				
				$("#barra_progresso_servidor_web").html(50+'%');

				$.post('menu_internet/actions/atualiza_horarios_servidor.php', function(resposta){	
					
					$("#barra_progresso_servidor_web").css('width', 100+'%');																		
					$("#barra_progresso_servidor_web").html(100+'%');
					$("#botao_atualiza_horarios").html('SALVAR HORÁRIOS');

					if(resposta==1){
						$("#resposta_sucesso_servidor").show();
					} else {
						$("#resposta_erro_servidor").show();
					}
		
				});

						
			} 
		
		});
		
		

}


function atualiza_tempo_entrega_retirada(){

	
		$("#resposta_sucesso_servidor").hide();

		$(".altura_progresso").show();
		$("#barra_progresso_servidor_web").css('width', 10+'%');				
		$("#barra_progresso_servidor_web").html(10+'%');
		
		$("#botao_atualiza_horarios").html('ATUALIZANDO, AGUARDE...');
		var formdata = $("#FormTempoEntregaRetirada").serialize();		

			$.ajax({type: "POST", url:$("#FormTempoEntregaRetirada").attr('action'), data:formdata, success: function(msg){										
				
				$("#barra_progresso_servidor_web").css('width', 50+'%');				
				$("#barra_progresso_servidor_web").html(50+'%');

				$.ajax({type: "POST", url:'menu_internet/actions/atualiza_tempo_entrega_retirada.php', data:formdata, success: function(resposta){										
					
					$("#barra_progresso_servidor_web").css('width', 100+'%');																		
					$("#barra_progresso_servidor_web").html(100+'%');
					$("#botao_atualiza_horarios").html('ATUALIZAR NO SITE');

					if(resposta==1){
						$("#resposta_sucesso_servidor").show();
					} else {
						$("#resposta_erro_servidor").show();
					}

				}
		
				});

						
			} 
		
		});
		
	

}


function verifica_pedidos_internet(){

	$.post('menu_internet/actions/pedido_verifica_novos.php', function(resposta){	
			
		if(resposta>0){			
			if(toca_som_pedido_web==1){
				$("#menu_aviso_pedidos_internet").addClass('menu_pisca_internet');
				$('body').append('<iframe src="menu_internet/sons/aviso2.mp3" allow="autoplay" style="display:none" class="AudioStopFrame">');	
			}
			toca_som_pedido_web=0;
		} else {
			toca_som_pedido_web=1;
		}	


		setTimeout(function(){ verifica_pedidos_internet(); }, 20000);

	});		
	
	

}


function pedidos_internet(){
	$("#menu_aviso_pedidos_internet").removeClass('menu_pisca_internet');
	$('.AudioStopFrame').remove();	
	toca_som_pedido_web=1;

	carregando();
	$.post('menu_internet/telas/pedidos_internet.php', function(resposta){					
		$("#conteudo_geral").html(resposta);

		$.post('menu_internet/actions/pedido_verifica_novos.php');	

	});			
	
	
}


function detalhes_pedido_internet(id){
	$("#detalhes_pedido_internet_conteudo").html('<center><br><h4>CARREGANDO...</h4></center><br>');	
	$("#ModalPedidoInternet").modal();
	$.post('menu_internet/telas/detalhes_pedido.php', {id:id}, function(resposta){					
		$("#detalhes_pedido_internet_conteudo").html(resposta);	
	});	
	
}


function aceita_rejeita_pedido_web(id,status){
	$("#botao_aceita_pedido_internet"+id).html('<i class="fa fa-circle-o-notch fa-spin fa-fw icone_rodando_btn"></i>');
	$("#botao_aceita_pedido_internet"+id).blur();
	$("#botao_recusa_pedido_internet"+id).prop('disabled', true);
	$("#botao_verifica_pedido_internet"+id).prop('disabled', true);
	$.post('menu_internet/actions/aceita-rejeita-pedido.php', {id:id, status:2, motivo_erro_internet:''}, function(resposta){
		sim_imprime_pedido_completo=1;
		$("#ModalPerguntaImprime01").modal();	
		pedidos_internet();
	});	
}


function aceita_rejeita_pedido_web_modal(id){
	$("#id_pedido_rejeicao").val(id)
	$("#motivo_erro_internet").val('');
	$("#ModalRejeicaoPedidoInternet").modal();
}

