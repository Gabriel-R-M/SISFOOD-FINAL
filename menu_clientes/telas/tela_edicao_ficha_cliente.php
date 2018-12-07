<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_configuracoes_loja.php");

$sql = $db->select("SELECT * FROM clientes WHERE id='$id' LIMIT 1");
$dados = $db->expand($sql);
?>


   
<div class="row row-xs">


  <input type="hidden" id="id_cliente" value="">	
  <input type="hidden" id="id_cliente_venda" value="<?php echo $id; ?>">	



 <div class="col-lg-7 top5"> 
 <div class="input-group">                
                <div class="input-group-append">
                  <span class="input-group-text" style="border-right:0"><i class="icofont-ui-dial-phone"></i></span>
                </div>
                <input class="form-control" id="telefone" onkeypress='return SomenteNumero(event)'  autofocus="autofocus">
                <span class="input-group-btn">                 
                  <button style="height: 42px;  margin-left: -3px" class="btn btn-primary" type="button" id="btn_buscar" onClick="javascript:busca_cliente(1);">
                    <i class="icofont-search-user" style="font-size: 17px"></i>
                  </button>
                   
                </span>
            </div>
  </div> 


<?php if($dados_configuracoes['modulo_pontuacao']==1){ ?>

<div class="col-lg-5 top5"> 
 <div class="input-group">                
                <div class="input-group-append">
                  <span class="input-group-text" style="border-right:0"><i class="icofont-ui-v-card"></i></span>
                </div>
                <input type="text" class="form-control" id="numero_cartao" value="<?php if($dados['cartao']!=0){echo $dados['cartao'];} ?>">
                <span class="input-group-btn">                 
                  <button style="height: 42px;  margin-left: -3px" class="btn btn-primary" type="button" id="btn_buscar" onClick="javascript:busca_cliente(2);">
                    <i class="icofont-search" style="font-size: 17px"></i>
                  </button>
                   
                </span>
            </div>
  </div> 
  
<?php } ?>

         

  

  <div class="col-lg-12 top5">
      <div class="alert alert-danger top5" role="alert" style=" display: none; font-weight: 300; margin-bottom: 0; padding: 6px; margin-top: 0" id="erro">
        <i class="icofont-exclamation-tringle"></i> Cliente não cadastrado.
      </div>
  </div>  

  <div class="col-md-12"><hr></div>
  
  <div class="col-md-12">    
      <input type="text" class="form-control " id="nome" value="<?php echo $dados['nome']; ?>" placeholder="Nome">    
  </div>


   <div class="col-md-9 col-xs-12 top15">    
      <input type="text" class="form-control " id="endereco" value="<?php echo $dados['endereco']; ?>" placeholder="Endereço">    
  </div>
  
  <div class="col-md-3 col-xs-12 top15">    
      <input type="text" class="form-control " id="numero" value="<?php echo $dados['numero']; ?>" placeholder="Nº">    
  </div>


  <div class="col-lg-6  col-xs-12 top15">    
      <input type="text" class="form-control " id="bairro" value="<?php echo $dados['bairro']; ?>" placeholder="Bairro">    
  </div>
  
  <div class="col-lg-4  col-xs-12 top15" style="display: none;">    
      <input type="text" class="form-control " id="cidade" value="LENÇÓIS PAULISTA" value="<?php echo $dados['cidade']; ?>" placeholder="Cidade">    
  </div>
  
  <div class="col-lg-6  col-xs-12 top15">    
      <input type="text" class="form-control " id="complemento" value="<?php echo $dados['complemento']; ?>" placeholder="Complemento">    
  </div>


  <div class="col-lg-3 col-xs-12 top15">    
      <input type="text" class="form-control " id="ddd"  value="<?php echo $dados['ddd']; ?>" placeholder="DDD">    
  </div>
  
  <div class="col-lg-9 col-xs-12 top15">    
      <input type="text" class="form-control " id="numero_telefone"  value="<?php echo $dados['telefone']; ?>" placeholder="Telefone">    
  </div>
  
  <div class="col-lg-4 col-xs-12 top15" style="display: none;">    
      <input type="text" class="form-control " id="celular" value="<?php echo $dados['celular']; ?>" placeholder="Telefone 2">    
  </div>


  <div class="col-md-12"><hr></div>

  <div class="col-lg-6">
  	<button type="button" class="btn btn-md  btn-primary" id="btn_salvar" onClick="javascript:salva_edicao_cliente_venda();"  >SALVAR CADASTRO</button>    
  </div>
  

</div>  


<script>
$(document).ready(function(){   // incial o jquery
  $("#telefone").keypress(function(event) {
      if (event.which == 13) {
          event.preventDefault();
      busca_cliente(1); 
      }
  }); 

  $("#numero_cartao").keypress(function(event) {
      if (event.which == 13) {
          event.preventDefault();
      busca_cliente(2); 
      }
  });  
});
</script> 
  