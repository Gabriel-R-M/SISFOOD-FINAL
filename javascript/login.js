$(document).ready(function(){



	$("#FormLogin").submit(function(){

		var mobile = 0;
	    if($('.is_mobile').is(":visible") == true) {
	        mobile = 1;       
	    }

		$("#erro").html('');		
		$("#erro").hide();
		$("#sucesso").hide();
		$("#botao_enviar_login").html('VALIDANDO CLIENTE...');
		var formdata = $("#FormLogin").serialize()+'&mobile='+mobile;	
			
		
		$.ajax({type: "POST", url:'webservice/web_login.php', data:formdata, success: function(msg){
				
			var retorno = $.trim(msg).split('&@&');

			if(retorno[0]==0){
				
				$("#erro").html(retorno[1]);		
				$("#erro").show();	
				$("#botao_enviar_login").html('ACESSAR');
				return false;

			} 

			$("#botao_enviar_login").html('VERIFICANDO USUÁRIO...');	

			$.ajax({type: "POST", url:$("#FormLogin").attr('action'), data:formdata, success: function(msg){										
				
					if(msg==1){
					
						location.href = 'home';
					
					} else {

						$("#erro").html(msg);		
						$("#erro").show();	
						$("#botao_enviar_login").html('ACESSAR');
						setTimeout(function(){$("#erro").hide(); }, 2000);


					}
								
				} 
		
			});

		}
		});	
		
		return false;
	});


	//VERIFICA ATUALIZAÇÕES SE NAO FOR MOBILE 
	if ($(window).width() > 992) {
		$.ajax({type: "POST", url:'webservice/web_versao.php', data:'', success: function(msg){									
			if(msg!=0){			
				$(".avisos_index_topo").html(msg);				
				$(".avisos_index_topo").show();										
			} 
		}
		});
	} 




});	


