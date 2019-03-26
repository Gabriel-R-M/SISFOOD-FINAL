$.post('menu_caixa/actions/verifica_sistema.php', {id:1}, function(resposta) {		
		
		//TUDO OK PARA INICIAR VENDAS
		if(resposta==1){

			if(mobile==1){
				$("#conteudo_geral").load('mobile/tela_aguarde.php');			
			} else {
				$("#conteudo_geral").load('menu_pedidos/telas/mesas_pedidos.php');			
			}

			
		//NAO TEM CAIXA ABERTO
		} else {

			if(mobile==1){
				$("#conteudo_geral").load('erros/mobile_aguarda_caixa.php');		
			} else {
				$("#conteudo_geral").load('menu_caixa/telas/abre_caixa.php', function(){
					$("#troco").focus();				
				});			
			}

				
		}		


	});	