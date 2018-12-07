// JavaScript Document

$(document).ready(function(){


	$("#FormLoginRetaguarda").submit(function(){
		$(".alerta-index").hide();		
		$("#botao_login").html('ATUALIZANDO INFORMAÇÕES...');
		var formdata = $("#FormLoginRetaguarda").serialize();		

		$.ajax({type: "POST", url:'webservice/web-informacoes-sistema.php', data:formdata, success: function(msg){

			$("#botao_login").html('VALIDANDO USUÁRIO...');

			$.ajax({type: "POST", url:$("#FormLoginRetaguarda").attr('action'), data:formdata, success: function(msg){										
							
					if(msg==1){

							location.href = 'home';

					} else {
						
						$(".msg_erro").show();	
						$("#botao_login").html('ACESSAR');
						
					}
									
				} 
			
			});

			} 
		
		});	
		
		return false;
	});


});