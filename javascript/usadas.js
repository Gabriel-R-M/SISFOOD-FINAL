$(document).ready(function(){



	  id_global_item_selecao = 0;	


	  $(window).on('scroll', function () {
	    if($(this).scrollTop() > 100) {
	    	var largura = $('#elemento-pai').width();
	        $('#barra-lateral').css('width',largura);
	        $('#barra-lateral').addClass('fixa_lateral');
	    } else {
	        $('#barra-lateral').removeClass('fixa_lateral');
	    }
	  });

	//$('#tudo_conteudo').perfectScrollbar();


});


function exibe_erros_gerais(erro){
	$("#erros_escritos_gerais").html(erro);
	$("#ModalErrosGerais").modal();	
}

function fecha_aviso_topo_caixa(){
	$("#div_erro_caixa_dia").hide();
}

function bloqueia_campos(){
	$("#numero_cartao").prop("disabled",true);
	$("#nome").prop("disabled",true);
	$("#endereco").prop("disabled",true);
	$("#numero").prop("disabled",true);
	$("#bairro").prop("disabled",true);
	$("#complemento").prop("disabled",true);
	$("#cidade").prop("disabled",true);
	$("#ddd").prop("disabled",true);
	$("#celular").prop("disabled",true);	
	$("#numero_telefone").prop("disabled",true);
				
	$("#btn_pesq").prop("disabled",true);
	$("#btn_salvar").prop("disabled",true);
			
}


function desbloqueia_campos(){
	$("#numero_cartao").prop("disabled",false);
	$("#nome").prop("disabled",false);
	$("#endereco").prop("disabled",false);
	$("#numero").prop("disabled",false);
	$("#bairro").prop("disabled",false);
	$("#complemento").prop("disabled",false);
	$("#cidade").prop("disabled",false);
	$("#ddd").prop("disabled",false);
	$("#celular").prop("disabled",false);	
	$("#numero_telefone").prop("disabled",false);
				
	$("#btn_pesq").prop("disabled",false);
	$("#btn_salvar").prop("disabled",false);
	$("#btn_cancelar").prop("disabled",false);

	
}


function carregando(){

	$(".botoes_rodape").hide();
	$("#conteudo_geral").html('<div class="col-md-12 text-center"><CENTER><h90>CARREGANDO...</h90></CENTER></div>');		
}


function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}




////NAVEGACAO COM SETAS PELOS ITENS/////

$(document).on('keyup', function (e) {

if ($("#avanca-pedido-enter").length){			
	if ($("#avanca-pedido-enter").val() ==1){		    		

        // ATRIBUINDO O KEY CODE PARA AS VARIAVEIS PARA MELHOR LEGIBILIDADE
        let right = 39;
        let left = 37;
        let up = 38;
        let down = 40;
        let enter = 32;    	
        let esc = 27;


        if(e.keyCode === esc){  
            if($('#ModalErrosGerais').is(":visible") == false) {          

                $(".marca-produtos").each(function () {
                
                    if($(this).is(':checked')){
                        
                                            
                        $(".pdr1").removeClass("produto-round_cor");
                        $(".pdr2").removeClass("produto-round_cor");
                        $(".pdr1a").css("color","#333");            
                        $(".pdr2a").css("color","#333");    
                        $(".destaca").css("color","#B92A25");   

                        $(".prod-meio-meio").prop( "checked", false);   
                        $(".prod-normais").prop( "checked", false);
                        $("#quantidade-produto").val('1');
                        $("#observacoes-produto").val('');

                        //OCULTA CAMPO VARIACOES E BOTOES DE INSERIR
                        $(".box-nome-cliente").hide();
                        $(".botoes-insercao-itens-pedido").hide();
                        $("#campo_para_variacao_produto").hide();
                        $("#tamanho").html('<option value="0"></option>');  
                        $("#campo_para_pesquisa_produto").show();
                        selecao_variacao();

                        //MOSTRA OS PRODUTOS E CATEGORIAS
                        $("#exibicao_adicionais_produto_selecionado").hide();
                        $("#exibicao_opcoes_produto_selecionado").hide();
                        $("#exibicao_adicionais_produto_selecionado").html('<center><br><br>CARREGANDO...</center>');       
                        
                        $("#exibicao_produtos_pedido, #exibicao_categorias_pedido").show();

                        $(".opcoes_desmarca").prop( "checked", false);  

                    }

                });
                return;
            } 
        }


        // VARIAVEIS AUXILIARES PARA NAVEGACAO
        let index = 1;
        let totalColunas = 4;
        let proximo = 1;


        var categoria = $("#categoria_selecionada").val();      


        $.each($('.navegacao'+categoria), function () {
              if ($(this).hasClass('selected')) {
                     var id = $(this).attr("data-id");
                     id_global_item_selecao = id;

                }
                
        });


        if(e.keyCode === enter){
            if($('.botoes-insercao-itens-pedido').is(":visible") == false) {          
            	if(id_global_item_selecao!=0){
        			$("#link_selecao"+id_global_item_selecao).click();
        		}
            }
    	}    

        // VERIFICA SE A TECLA QUE ESTÁ SENDO DISPARADA É ALGUMA TECLA QUE QUEREMOS TRABALHAR EM CIMA
        if (e.keyCode === right || e.keyCode === left || e.keyCode === up || e.keyCode === down) {

    


            // PERCORE TODAS AS DIVS DA CLASSE ITEM PARA SETAR O INDICE DA PROXIMA
            $.each($('.navegacao'+categoria), function () {
                if ($(this).hasClass('selected')) {
                    switch (e.keyCode) {
                        case right:
                            proximo += index;
                            break;
                        case left:
                            proximo = index - 1;
                            break;
                        case up:
                            proximo = index - totalColunas;
                            break;
                        case down:
                            proximo += index + (totalColunas -1);
                            break;
                    }

                }
                index++;
            });

            index = 1;
            // VERIFICA SE O RETORNO É MAIOR QUE O NUMERO TOTAL DE DIVS E RETORNA FALSO PARA A NAVEGACAO NÃO SAIR DE DAS DIVS
            if(proximo > $('.navegacao'+categoria).length) {
                return false;
            // VERIFICA SE O RETORNO É MENOR QUE 1 E RETORNA FALSO PARA A NAVEGAÇÃO NÃO SAIR DAS DIVS
            }else if(proximo < 1 ) {
                return false;
            }
            // PERCORRE TODAS AS DIVS ITEMS PARA ATRIBUIR A CLASSE SELECTED NA DIV QUE O CURSOR DEVE IR SETADO NA VARIAVEL PROXIMO
            $.each($('.navegacao'+categoria), function () {
                $(this).removeClass('selected');
                if (index === proximo) {
                    $(this).addClass('selected');
                    var id = $(this).attr("data-id");
                    if(id!='undefined'){
                    	id_global_item_selecao = id;
                    } else {
                    	id_global_item_selecao = 0;
                    }
                }
                index++;
            })
        }


	}
}


});






