<?php 
require("../admin/class/class.db.php");
require("../admin/class/class.seguranca.php");
require("../includes/verifica_session.php");
?>


<div class="col-md-12 text-center hide" id="sucesso_salva_pedido_mobile">
	<div  class="alert alert-success thin">
		<i class="icofont-ui-check"></i>  Pedido atualizado com sucesso.
	</div>	
</div>


<div class="col-md-12 text-center" id="informacao_qtd_itens_pedido">
	<br><br>
		<span class="texto_peq_itens_grande">SISTEMA ON-LINE</span><br>		
		<span class="texto_itens_grande"><?php echo $dados_usuario_nome; ?></span><br>
		<span class=" thin"><?php echo date("d/m/Y"); ?></span>
		
</div>




<script>
	window.clearTimeout(atualiza_pedidos);	
</script>

