<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
?>



<div class="col-md-4 offset-md-4">

  <div class="order-top">
        <h20>Abertura de Caixa</h20>     
      </div>


<div class="card">

    
    <div class="col-lg-12" style="margin-top:10px">            
      
      <div class="input-group">
        <div class="input-group-append">
          <span class="input-group-text" style="border-right:0">TROCO INICIAL:</span>
        </div>    	
  		  <input style="text-transform:uppercase" type="text" class="form-control" id="troco" placeholder="0.00" >
  	  </div>
      
    </div>


<div class="col-lg-12">
<div class="row row-xs">  
        
    
    <div class="col-lg-6" style=" margin-top:10px">            
      
      <div class="input-group">
    	<div class="input-group-append">
          <span class="input-group-text" style="border-right:0">DATA:</span>
        </div>      
  		<input style="text-transform:uppercase" type="text" class="form-control input-lg" disabled="disabled" value="<?php echo date("d/m/Y"); ?>" >
  	  </div>
      
    </div>
    
    <div class="col-lg-6" style=" margin-top:10px">            
      
      <div class="input-group">
    	<div class="input-group-append">
          <span class="input-group-text" style="border-right:0">HORA:</span>
        </div>      
  		<input style="text-transform:uppercase" type="text" class="form-control input-lg" disabled="disabled" value="<?php echo date("H:i:s"); ?>" >
  	  </div>
      
    </div>

</div>    
</div>
    
    <div class="col-lg-12" style="margin-top:10px; padding-bottom:0px; ">
      
      
      
      <div class="input-group">
    	<div class="input-group-append">
          <span class="input-group-text" style="border-right:0">REPONSÁVEL:</span>
        </div>      
  		<input style="text-transform:uppercase" type="text" class="form-control input-lg" value="<?php echo $dados_usuario_nome; ?>" disabled>
  	  </div>
      


      <button type="button" class="btn top15 btn-primary bottom20 btn-block" id="btn_salvar" onClick="javascript:confirma_abre_caixa();" >ABRIR CAIXA</button>
    </div>

  
  
</div>    




<script type="text/javascript">     
	   $("#troco").maskMoney({
		symbol:'', // Simbolo
		decimal:'.', // Separador do decimal
		precision:2, // Precisão
		thousands:'', // Separador para os milhares
		allowZero:true, // Permite que o digito 0 seja o primeiro caractere
		showSymbol:false // Exibe/Oculta o símbolo
		});


  $("input").keypress(function(event) {
      if (event.which == 13) {
          event.preventDefault();
          confirma_abre_caixa();  
      }
  });

</script>


