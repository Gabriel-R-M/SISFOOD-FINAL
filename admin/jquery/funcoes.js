// JavaScript Document

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


				$.post("ajax/variacao_precos.php",{categoriax:tipo},function(resposta){

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


			$.post("ajax/variacao_precos.php",{categoriax:categoriax},function(resposta){

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


function loga(){
		
	   $("#erro").hide();
	   $("#sucesso").hide();
	   usuario = $("#usuario").val();	      	   	   	   
	   senha = $("#senha").val();
	   
	   
	   if(usuario==''){
			$("#usuario").css('background-color','#FCF8E3');
			$("#usuario").focus();
			return;   
	   }
	   
	   if(senha==''){
			$("#senha").css('background-color','#FCF8E3');
			$("#senha").focus();
			return;   
	   }
	   
	   $("#btn").html('VERIFICANDO...');
	   
	   $.post("ajax/login.php",{usuario:usuario, senha:senha},function(resposta){
	   
			if(resposta==1){
				window.location.href = 'administracao.php';						
			} else {
				$("#erro").show();
				$("#btn").html('ACESSAR');					
			}
		});
			
			
			
	

}


function logout(){
		
		window.location.href = 'index.php?logout=1';			
		
}