// JavaScript Document


function marca_checkbox(){
	marcado=0;
	$('.ompa').each(function () {
       if($(this).is(":checked")){
       		marcado++;
       }
  });

	if(marcado>0){
		$("#botao_apaga_registros").show();
	} else {
		$("#botao_apaga_registros").hide();
	}
}

function valida_ncm(ncm){
	$("#ncm_erro").hide();
	$("#esconde_frase").show();
	$.post("ajax/valida_ncm.php",{ncm:ncm},function(resposta){
		if(resposta==0){
			$("#esconde_frase").hide();
			$("#ncm_erro").show();
		}
	});
}


$(".muda_tabs").click(function(){
	var target = $(this).attr('data-id');			
	$(".tabs").css('display', 'none');
	$("#tab"+target).css('display', 'flex');
});



$("#PesquisaXML").submit(function(){
		
		$("#resultado_pesquisa").html("<center>PESQUISANDO, AGUARDE...</center>");
		$("#resultado_pesquisa").show();
		$("#btn_pesquisa").html('PESQUISANDO...');
		var formdata = $("#PesquisaXML").serialize();		
		
		$.ajax({type: "POST", url:$("#PesquisaXML").attr('action'), data:formdata, success: function(retorno){										
				
				$("#resultado_pesquisa").html(retorno);
				$("#btn_pesquisa").html("<center>PESQUISAR</center>");
								
			} 
		
		});
		
		return false;
});


$("#EnviaXML").submit(function(){
		
		$("#sucesso_xml").hide();
		$("#erro_xml").hide();	

		$(".form-control")		
		$("#btn_envio").html('AGUARDE, ENVIANDO...');
		var formdata = $("#EnviaXML").serialize();		
		
		$.ajax({type: "POST", url:$("#EnviaXML").attr('action'), data:formdata, success: function(retorno){										

				if(retorno==1){
					$("#sucesso_xml").show();
				} else {
					
					if(retorno==''){
						$("#erro_xml").html('ERRO AO ANEXAR ARQUIVO E ENVIAR E-MAIL');
					} else {
						$("#erro_xml").html(retorno);
					}
					
					$("#erro_xml").show();

				}

				$("#btn_envio").html('COMPACTAR E ENVIAR');
								
			} 
		
		});
		
		return false;
});




function marcar_todas_opcoes(tipo){

	var categoria_selecionar = $("#categoria_selecionar").val();

	$(".prdx"+categoria_selecionar).each(function () {
		if(tipo==1){
			$(this).prop("checked", true);	
		} else {
			$(this).prop("checked", false);	
		}
        
    });

}

function salva_cadastro_insere(){	
	$('<input>').attr({
	    type: 'hidden',
	    value: '1',
	    name: 'retorno'
	}).appendTo('form');

}

$(document).ready(function(){


		$('#ModalNovoIngrediente').on('shown.bs.modal', function () {
	  		$("#ingrediente").focus();
		});

		$('#ModalNovoIngrediente').on('hidden.bs.modal', function (){
	  		$("#msg_ok_ingrediente").hide();	
		});

		
		$(".cat").change(function(){
			var p = this.value;
			$("#produtos").html('<option value="">pesquisando...</option>');
			$.post("ajax/pega_produtos.php",{categoria:p},function(resposta){

				$("#produtos").html(resposta);
			});
		
		});			

		$(".chk").click(function(){
			var target = $(this).attr('data-id');
			
			if($(this).is(':checked')) {
				$("#ord"+target).prop('disabled', false); 
				$("#ord"+target).prop('required',true);  
			} else  {
				$("#ord"+target).prop('disabled', true);   
				$("#ord"+target).prop('required',false);  
				$("#ord"+target).val('');  
			}

		});




	$("#FormCadastroIngredientes").submit(function(){
		
		$("#msg_ok_ingrediente").hide();	
		$("#btn_salva_ingrediente").html('SALVANDO...');
		var formdata = $("#FormCadastroIngredientes").serialize();		
		var ingrediente_name = $("#ingrediente").val();

			$.ajax({type: "POST", url:$("#FormCadastroIngredientes").attr('action'), data:formdata, success: function(retorno){										
							
				$('#FormCadastroIngredientes')[0].reset();
				$("#ingrediente").focus();
				$("#msg_ok_ingrediente").show();	
				$("#btn_salva_ingrediente").html('CADASTRAR');

				var total_colunas = $(".apend_ingredientes:last td").length;	
				$("#some_nenhum_ingrediente").hide();			
				if(total_colunas==4){
					var row = $('</tr><tr class="apend_ingredientes"><td class="upper coluna-fixa"><input name="ingrediente_produto[]" value="'+retorno+'" class="form-control" type="checkbox"> '+ingrediente_name+'</td>');    				
					$('#tabela_ingredientes').append(row);
				} else {
					var row = $('<td class="upper coluna-fixa"><input name="ingrediente_produto[]" class="form-control" value="'+retorno+'" type="checkbox">'+ingrediente_name+'</td>');    				
					$('.apend_ingredientes:last').append(row);
				}
								
			} 
		
		});
		
		return false;
	});


	$("#FormLoginRetaguarda").submit(function(){
		$(".alerta-index").hide();		
		$("#botao_login").html('VALIDANDO USUÁRIO...');
		var formdata = $("#FormLoginRetaguarda").serialize();		

			$.ajax({type: "POST", url:$("#FormLoginRetaguarda").attr('action'), data:formdata, success: function(msg){										
							
				if(msg==1){

						location.href = 'home';

				} else {
					
					$(".msg_erro").show();	
					$("#botao_login").html('ACESSAR');
					
				}
								
			} 
		
		});
		
		return false;
	});


});


$(".valores").maskMoney({
	    symbol:'', // Simbolo
	    decimal:'.', // Separador do decimal
	    precision:2, // Precisão
	    thousands:'', // Separador para os milhares
	    allowZero:true, // Permite que o digito 0 seja o primeiro caractere
	    showSymbol:false // Exibe/Oculta o símbolo
    });


function varia(tipo){

	if(tipo==''){
		$("#precos_produtos_variacao").hide();
		$("#precos_produtos_normal").hide();

			$(".chk2").each(function () {
	        	$(this).prop("checked", false);        	
	    	});

			$(".xxvv2").each(function () {
	        	$(this).val('');      	
	        	$(this).attr('disabled', true);      	
	    	});    	

			$("#valor_fechado").val('');
			$('#valor_fechado').prop('required',false);	
	
	} else {

		preco_composto = $("#preco_composto").val();
	

		//VARIACAO DE PRECO
		if(preco_composto==1){
			
				$.post("controlers/ajax/variacao_precos.php",{categoriax:tipo},function(resposta){
			
					$("#ajax_variacoes").html(resposta);
		   
					$("#precos_produtos_normal").hide();	
					$("#precos_produtos_variacao").show();

					$("#valor_fechado").val('');
					$('#valor_fechado').prop('required',false);	

				});	
				
		} 

		//APENAS UM PRECO
		if(preco_composto==0 && preco_composto!=''){
			$("#precos_produtos_variacao").hide();
			$("#precos_produtos_normal").show();

			$(".chk2").each(function () {
	        	$(this).prop("checked", false);        	
	    	});

			$(".xxvv2").each(function () {
	        	$(this).val('');      	
	        	$(this).attr('disabled', true);      	
	    	});    	

			$("#valor_fechado").val('');
			$('#valor_fechado').prop('required',true);	
		}


	}	

}


function lista_opcoes(tipo){
	
	//CATEGORIAS//
	if(tipo==1){
		$("#list_produtos").hide();	
		$("#list_categorias").show();	
	}

	//PRODUTOS//
	if(tipo==2){				
		$("#list_categorias").hide();	
		$("#list_produtos").show();
	}

}



function exibe_precos_variacao_tamanho(tipo){
	if(tipo==''){
		$("#precos_produtos_variacao").hide();
		$("#precos_produtos_normal").hide();	
	}

	//VARIACAO DE PRECO
	if(tipo==1){


		categoriax = $("#categoria").val();

		if(categoriax==""){
			
			alert("ESCOLHA A CATEGORIA PARA LISTAR AS VARIAÇÕES.");			
			$("#precos_produtos_normal").hide();	
			$("#valor_fechado").val('');
			$('#valor_fechado').prop('required',false);	

		} else {


			$.post("controlers/ajax/variacao_precos.php",{categoriax:categoriax},function(resposta){

				$("#ajax_variacoes").html(resposta);
	   
				$("#precos_produtos_normal").hide();	
				$("#precos_produtos_variacao").show();

				$("#valor_fechado").val('');
				$('#valor_fechado').prop('required',false);	

			});	
			

		}		
		
	} 

	//APENAS UM PRECO
	if(tipo==0){
		$("#precos_produtos_variacao").hide();
		$("#precos_produtos_normal").show();

		$(".chk2").each(function () {
        	$(this).prop("checked", false);        	
    	});

		$(".xxvv2").each(function () {
        	$(this).val('');      	
        	$(this).attr('disabled', true);      	
    	});    	

		$("#valor_fechado").val('');
		$('#valor_fechado').prop('required',true);	
	}
}



