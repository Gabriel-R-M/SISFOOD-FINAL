<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
require("../../includes/verifica_cliente_venda.php");
require("../../includes/verifica_caixa_aberto.php");
?>

<div class="col-md-12">
	<div class="order-top">
		<h20>Pedidos finalizados para o caixa atual</h20>							
	</div>
</div>


	
<div class="col-md-12" id="lista_pedidos_finalizados">
	
	<div class="card" >
			
		<?php require("../listagem/listagem_pedidos_finalizados.php"); ?>

	</div>	

</div>




<script>	
	$(document).ready(function(){
		$('#lista_pedidos_finalizados').perfectScrollbar();
	});	
	window.clearTimeout(atualiza_pedidos);	
</script>
