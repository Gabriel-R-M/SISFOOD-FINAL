function vendas_internet(){	
	if(typeof(verifica_internet) != "undefined") {
		$.post('menu_internet/actions/verifica_pedidos.php', function(resposta){					
			
			if(resposta==1){
				$(".internet").animate({left: '0px'});
				//alert(1)
			} else {
				$(".internet").animate({left: '-100px'});
				//alert(0)
			}
		
		});
	}
}


function ok_pedido_internet(){
	$(".internet").animate({left: '-100px'});
}