<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
?>




<div class="col-md-12 pedidos-gerais-aguardando">	
<div class="row row-xs"> 
	<?php require("../listagem/listagem_pedidos_aguardando.php"); ?>
</div>
</div>




<script>	
	$(document).ready(function(){
		$('.pedidos-gerais-aguardando').perfectScrollbar();
	});	
	window.clearTimeout(atualiza_pedidos);	
	var atualiza_pedidos = setInterval(function(){ atualiza_entregas_automatico() }, 60000);
</script>




