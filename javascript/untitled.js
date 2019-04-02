$.post('menu_caixa/actions/verifica_sistema.php', {id:1}, function(resposta) {		

		var val = resposta.split('&@&');
		
		//TUDO OK PARA INICIAR VENDAS
		if(val[0]==1){

			if(mobile==1){
				$("#conteudo_geral").load('mobile/tela_aguarde.php');			
			} else {

				//TEM MESAS
				if(val[1]>0){
					$("#conteudo_geral").load('menu_pedidos/telas/mesas_pedidos.php');				
				//NAO TEM MESAS MAS TEM ENTREGAS	
				} else if(val[2]==1){
					$("#conteudo_geral").load('menu_pedidos/telas/entregas_comandas.php');			
				//NAO TEM MESAS NEM ENTREGAS		
				} else {
					inicia_pedido();
				}
				
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