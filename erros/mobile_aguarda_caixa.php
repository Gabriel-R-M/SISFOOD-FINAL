<?php 
require("../admin/class/class.db.php");
require("../admin/class/class.seguranca.php");
require("../includes/verifica_session.php");
?>




<div class="col-md-12 text-center" id="informacao_qtd_itens_pedido">
		<br><br>
		<span class="texto_peq_itens_grande">ATENÇÃO:</span><br>		
		<span class="texto_itens_grande">CAIXA NÃO INICIADO.</span>
		
</div>




<script>
	window.clearTimeout(atualiza_pedidos);	
</script>

