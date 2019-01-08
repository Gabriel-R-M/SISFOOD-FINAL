// JavaScript Document

function salva_cadastro_insere(){	
	$('<input>').attr({
	    type: 'hidden',
	    value: '1',
	    name: 'retorno'
	}).appendTo('form');

}


$(document).ready(function(){


		
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



