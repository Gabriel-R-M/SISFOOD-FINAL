<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../actions/totalizadores_caixa.php");
?>


<div class="row">
<div class="col-md-12 tudo">
			
	<div class="order-top">
		<h20>Caixas Finalizados</h20>			
	</div>


	<div class="col-md-3 pull-right">
		<div class="row">	
			<form method="post" action="menu_caixa/listagem/listagem_caixas_finalizados.php" id="FormPesquisaCaixasFinalizados" onSubmit="return pesquisa_caixas_finalizados()">
				<div class="input-group">
			    	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				    <input name="data" type="date" class="form-control" required="required">
				    <span onclick="javascript:pesquisa_caixas_finalizados();" class="input-group-addon cursor"><i class="glyphicon glyphicon-search"></i></span>
			  </div>
			</form>
		</div>	
	</div>

	<div id="reload_pesquisa" class="top15">

			<?php require("../listagem/listagem_caixas_finalizados.php"); ?>	

	</div>		

</div>
</div>

<script>		
	window.clearTimeout(atualiza_pedidos);	
</script>

