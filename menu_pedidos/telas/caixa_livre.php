<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
?>

<div class="col-md-12 mesas-exibicao">	
<div class="row row-xs"> 	
	
	

</div>
</div>


<script>	
	$(document).ready(function(){
		$('.mesas-exibicao').perfectScrollbar();
	});	
	window.clearTimeout(atualiza_pedidos);	
	//var atualiza_pedidos = setInterval(function(){ atualiza_mesas_automatico() }, 60000);
	
</script>




