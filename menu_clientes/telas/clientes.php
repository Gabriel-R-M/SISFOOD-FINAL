<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_configuracoes_loja.php");
?>


<div class="col-md-4">
			
	<div class="order-top">
		<h20>Novo Cadastro</h20>			
	</div>

	<div class="card">
	<div class="col-md-12 top15 bottom15">    	
	<div class="row row-xs">	
			
		  <input type="hidden" id="id_cliente">	
		  <input type="hidden" id="id_endereco">	


		  <?php if($dados_configuracoes['modulo_pontuacao']==1){ ?>

		  	<div class="col-md-7 bottom15">    
		      
			    <div class="input-group">                                
	                <input class="form-control" id="numero_cartao" placeholder="CARTÃO FIDELIDADE">
	                <span class="input-group-btn">                 
	                  <button style="height: 42px;  margin-left: -3px" class="btn btn-primary" type="button" id="btn_buscar3" onClick="javascript:busca_cliente(2, <?php echo $dados_configuracoes['modulo_pontuacao']; ?>);">
	                    <i class="icofont-search" style="font-size: 17px"></i>
	                  </button>
	                   
	                </span>
	            </div>

		    </div>

		  <?php } ?>	

		  <div class="col-md-12">    
		      
		      <div class="input-group">                                
                <input class="form-control" id="nome" placeholder="NOME" >
                <span class="input-group-btn">                 
                  <button style="height: 42px;  margin-left: -3px" class="btn btn-primary" type="button" id="btn_buscar2" onClick="javascript:busca_cliente_nome();">
                    <i class="icofont-search-user" style="font-size: 17px"></i>
                  </button>
                   
                </span>
            </div>

		  </div>


		   <div class="col-md-9 col-xs-12 top15">    
		      <input type="text" class="form-control " id="endereco" placeholder="ENDEREÇO">    
		  </div>
		  
		  <div class="col-md-3 col-xs-12 top15">    
		      <input type="text" class="form-control " id="numero" placeholder="Nº">    
		  </div>


		  <div class="col-lg-6  col-xs-12 top15">    
		      <input type="text" class="form-control " id="bairro" placeholder="BAIRRO">    
		  </div>
		  
		  <div class="col-lg-4  col-xs-12 top15" style="display: none;">    
		      <input type="text" class="form-control " id="cidade" value="LENÇÓIS PAULISTA" value="<?php echo $dados['cidade']; ?>" placeholder="CIDADE">    
		  </div>
		  
		  <div class="col-lg-6  col-xs-12 top15">    
		      <input type="text" class="form-control " id="complemento" placeholder="COMPLEMENTO">    
		  </div>


		  <div class="col-lg-3 col-xs-12 top15">    
		      <input type="text" class="form-control " id="ddd" placeholder="DDD">    
		  </div>
		  
		  <div class="col-lg-9 col-xs-12 top15">    
		  	
		  	<div class="input-group">                                
                <input class="form-control procura-telefone-cliente" id="numero_telefone" onkeypress='return SomenteNumero(event)' placeholder="TELEFONE">
                <span class="input-group-btn">                 
                  <button style="height: 42px; display: none;  margin-left: -3px" class="btn btn-primary" type="button" id="btn_buscar" onClick="javascript:busca_cliente(1, <?php echo $dados_configuracoes['modulo_pontuacao']; ?>);">
                    <i class="icofont-search-user" style="font-size: 17px"></i>
                  </button>
                   
                </span>
            </div>	
		    
		  </div>
		  
		  <div class="col-lg-4 col-xs-12 top15" style="display: none;">    
		      <input type="text" class="form-control " id="celular"  placeholder="Telefone 2">    
		  </div>


		  <div class="col-lg-12 col-xs-12 top15 upper hide" id="exibe_outros_enderecos">    
		      <select class="form-control upper" id="outros_enderecos" onchange="javascript:altera_outro_endereco_cliente(this.value);">
		      </select>  
		  </div>
		  

		<div class="col-md-12  col-xs-12 top15 hide" id="pontos_resgatar_display">    
			<div class="input-group">                
                <div class="input-group-append">
                  <span class="input-group-text" style="border-right:0">PONTOS A RESGATAR:</span>
                </div>
                <input class="form-control text-center" readonly="readonly" id="pontos_resgatar">
                <span class="input-group-btn">                 
                  <button style="height: 42px;  margin-left: -3px" class="btn btn-success" type="button" onClick="javascript:historico_resgate_pontos();">
                    VER HISTÓRICO
                  </button>
                   
                </span>                
            </div>   
		</div>





		  <div class="col-lg-12 top15">
		  	<button type="button" class="btn btn-md  btn-primary" id="btn_salvar" onClick="javascript:salva_edicao_cliente();">
		  		<i class="icofont-save"></i>&nbsp;&nbsp;SALVAR CADASTRO&nbsp;(F2)</button>    

		  	<button type="button" class="btn btn-md  btn-primary hide btn-cancela-edicao" id="btn_cancel" onClick="javascript:cancela_cadastro_cliente();">
		  		<i class="icofont-ui-close"></i> CANCELAR&nbsp;&nbsp;(F4)</button>    
		  </div>


	</div>
	</div>	  
	</div>

	
      <div class="alert alert-danger top10" role="alert" style=" font-weight: 300; display: none; margin-bottom: 0; padding: 12px; " id="erro">
        <i class="icofont-exclamation-tringle"></i> Cliente não cadastrado.
      </div>

      <div class="alert alert-success top10" role="alert" style=" font-weight: 300; display: none; margin-bottom: 0; padding: 12px; " id="sucesso_cliente">
        <i class="icofont-check-circled"></i> Cliente salvo com sucesso.
      </div>
  

</div>


<div class="col-md-8" >	
		
	<div class="order-top" style="border-bottom: 0">
		<h20>Últimos clientes cadastrados</h20>			
	</div>
	
	<div class="card" id="exibe-listagem-clientes">

		<div  id="reload_pesquisa">
			<?php require("../listagem/listagem_clientes.php"); ?>	
		</div>
	</div>		

</div>




<input type="hidden" id="tela-clientes-cadastros" value="1">

<script>		
	$(document).ready(function(){

	$(".procura-telefone-cliente").keypress(function(event) {		
	    if (event.which == 13) {
	        event.preventDefault();
			busca_cliente(1, <?php echo $dados_configuracoes['modulo_pontuacao']; ?>);
	    }
	});

	$("#numero_cartao").keypress(function(event) {		
	    if (event.which == 13) {
	        event.preventDefault();
			busca_cliente(2, <?php echo $dados_configuracoes['modulo_pontuacao']; ?>);
	    }
	});

	$("#nome").keypress(function(event) {		
	    if (event.which == 13) {
	        event.preventDefault();
			busca_cliente_nome();
	    }
	});

		$('#reload_pesquisa').perfectScrollbar();
	});	
	window.clearTimeout(atualiza_pedidos);	
</script>
