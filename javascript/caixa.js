$(document).ready(function(){

	

	$('#NovaSaidaCaixa').on('shown.bs.modal', function () {
    	$('#valor_saida_caixa').focus();
	}) 



	$('#ModalFinalizaCaixa').on('show.bs.modal', function (){
		sim_finaliza_caixa=1;		
	});
	
	$('#ModalFinalizaCaixa').on('hidden.bs.modal', function (){
	    sim_finaliza_caixa=0;
	});


	$('#ModalAbreCaixa').on('show.bs.modal', function (){
		sim_abre_caixa=1;
	});
	
	$('#ModalAbreCaixa').on('hidden.bs.modal', function (){
	    sim_abre_caixa=0;
	});


	$("#FormSaidaCaixa").submit(function(){
				
		$("#botao_saida_caixa").html('AGUARDE...');
		var formdata = $("#FormSaidaCaixa").serialize();		
		
			$.ajax({type: "POST", url:$("#FormSaidaCaixa").attr('action'), data:formdata, success: function(msg){										
				
				$("#botao_saida_caixa").html('EFETUAR SAÍDA');
				$("#NovaSaidaCaixa").modal('hide');
				manutencao_caixa();
				$('#FormSaidaCaixa')[0].reset();
								
			} 
		
		});
		
		return false;
	});



});		



function pesquisa_caixas_finalizados(){

	$("#reload_pesquisa").html('<br><CENTER><h16>PESQUISANDO...</h16></CENTER>');
	var formdata = $("#FormPesquisaCaixasFinalizados").serialize();		
		
	$.ajax({type: "POST", url:$("#FormPesquisaCaixasFinalizados").attr('action'), data:formdata, success: function(msg){										
					
		$("#reload_pesquisa").html(msg);
								
		} 
		
	});
		
	return false;
}


function exibe_caixa_finalizado(id){
	carregando();
	$.post('ajax/cria_session_caixa.php', {id:id}, function(resposta){			
		$("#conteudo_geral").load('menu_caixa/telas/manutencao_caixa.php');	
	});
}


function confirma_abre_caixa(){
	
	valor_inicial = $("#troco").val();
	var data = new Date(),
    dia = data.getDate(),
    mes = data.getMonth() + 1,
    ano = data.getFullYear(),
    hora = data.getHours(),
    minutos = data.getMinutes();
    if(dia<10){dia='0'+dia;}
  	$("#abre_caixa").html([dia, mes, ano].join('/')+ ' ás ' + [hora, minutos].join(':'));
  	$("#confirma_troco").html('<b>Troco Inicial</b> R$ '+valor_inicial);
  	$("#ModalAbreCaixa").modal();	
}


function abre_caixa(){
	valor_inicial = $("#troco").val();
	$("#btn_abre_caixa").html('AGUARDE...');
	carregando();
	$.post('menu_caixa/actions/salva_abre_caixa.php', {valor_inicial:valor_inicial}, function(resposta){
		location.href='home';			
	});
}


function nova_saida_caixa(){
	$('#FormSaidaCaixa')[0].reset();
	$("#NovaSaidaCaixa").modal();	
}


function vizualiza_entregas_caixa() {
	$("#exibe_saidas_caixa").html('<br><br><center><h16>CARREGANDO...</h16></center><br><br>');
	$("#ModalExibeEntregasCaixa").modal();
	$("#exibe_saidas_caixa").load('menu_caixa/listagem/listagem_entregas_caixa.php');	
}

function vizualiza_vendas(tipo){
	$("#exibe_vendas_caixa").html('<br><br><center><h16>CARREGANDO...</h16></center><br><br>');
	$("#ModalExibeVendasCaixa").modal();
	$("#exibe_vendas_caixa").load('menu_caixa/listagem/listagem_vendas_caixa.php?tipo='+tipo);	
}

function vizualiza_recebimentos_crediario(){
	$("#exibe_vendas_caixa").html('<br><br><center><h16>CARREGANDO...</h16></center><br><br>');
	$("#ModalExibeVendasCaixa").modal();
	$("#exibe_vendas_caixa").load('menu_caixa/listagem/listagem_recebimentos_crediario.php');		
}

function vizualiza_saidas_caixa(){
	$("#exibe_retiradas_caixa").html('<br><br><center><h16>CARREGANDO...</h16></center><br><br>');
	$("#ModalExibeSaidasCaixa").modal();
	$("#exibe_retiradas_caixa").load('menu_caixa/listagem/listagem_retirada_caixa.php');	
}


function confirma_fecha_caixa(){	
	$("#horario_caixa").html('atualizando...');
	var data = new Date(),
    dia = data.getDate(),
    mes = data.getMonth() + 1,
    ano = data.getFullYear(),
    hora = data.getHours(),
    minutos = data.getMinutes();
    if(dia<10){dia='0'+dia;}
  	$("#horario_caixa").html([dia, mes, ano].join('/')+ ' ás ' + [hora, minutos].join(':'));
	$("#ModalFinalizaCaixa").modal();	
}



function finaliza_caixa(){	
	$("#btn_fecha_caixa").html('AGUARDE...');		
	
	
	$.post('menu_caixa/actions/finaliza_caixa.php', {id:1}, function(resposta){		
		$("#ModalFinalizaCaixa").modal('hide');
		$("#btn_fecha_caixa").html('CONFIRMAR');		
		imprime_fechamento_caixa(resposta);	
		location.reload();			
	});	
}
