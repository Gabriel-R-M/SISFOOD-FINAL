 $(function(){
        'use strict';

        // Initialize tooltip
        $('[data-toggle="tooltip"]').tooltip();

        $('[data-toggle="tooltip-danger"]').tooltip({
          template: '<div class="tooltip tooltip-danger" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
        });    

});


function inicia_sistema(){

	var mobile = 0;
	if($('.is_mobile').is(":visible") == true) {
		mobile = 1;       
	}

	carregando();
	
	
			
	var mobile = 0;
	if($('.is_mobile').is(":visible") == true) {
		mobile = 1;       
	}

	carregando();
	$("#conteudo_geral").load('menu_pedidos/telas/novo_pedido.php');
	
	
							

	
}



function menu_configuracoes(){
	carregando();
	$("#conteudo_geral").load('menu_configuracoes/telas/configuracoes.php');
}


function entregas_comandas(){
	carregando();
	abre_menu('menu_pedidos/telas/entregas_comandas.php');	
}

function mesas_pedidos(){
	carregando();
	abre_menu('menu_pedidos/telas/mesas_pedidos.php');	
}


function mesas_pedidos(){
	carregando();
	abre_menu('menu_pedidos/telas/mesas_pedidos.php');	
}


function novo_pedido(){
	carregando();
	abre_menu('menu_pedidos/telas/novo_pedido.php');	
}

function novo_pedido_mobile(){
	carregando();
	abre_menu('menu_pedidos/telas/novo_pedido_mobile.php');	
}


function manutencao_caixa(){
	$("#menu_caixa").tooltip('hide');
	carregando();
	abre_menu('menu_caixa/telas/manutencao_caixa.php');		
}


function menu_clientes(){
	carregando();
	$("#conteudo_geral").load('menu_clientes/telas/clientes.php');	
}


function abre_menu(pagina){



	var mobile = 0;
	if($('.is_mobile').is(":visible") == true) {
		mobile = 1;       
	}

	$.post('menu_caixa/actions/verifica_sistema.php', {id:1}, function(resposta) {		
		//TUDO OK VAI PARA A PÁGINA
		if(resposta==1){
			$("#conteudo_geral").load(pagina);	
		//NAO TEM CAIXA ABERTO PA
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
}

function pedidos_finalizados(){
	carregando();
	$("#conteudo_geral").load('menu_pedidos/telas/pedidos_finalizados.php');	
}

function cadastro_clientes(){
	carregando();
	$("#conteudo_geral").load('menu_clientes/telas/clientes.php');	
}






