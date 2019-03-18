<?php 
require_once("../../admin/class/class.db.php");
require_once("../../admin/class/class.seguranca.php");
require("../../includes/verifica_configuracoes_loja.php");
?>


	<div class="order-top" style="border-bottom: 0">
		<h20>Manutenção de Impressoras</h20>			
	</div>



	<div class="card" >
		

		<div class="col-md-12">	
		<div class="row row-xs">
			
			<div class="col-md-6 top15">
				<h5>IMPRESSORA PRINCIPAL</h5>	
				<input readonly type="text" class="form-control" value="<?php echo $dados_configuracoes['impressora_principal']; ?>">
				<button id="botao_teste_impressoras1" class="btn btn-primary btn-block bottom15 top10" onclick="javascript:testa_impressoras(1);" <?php if(empty($dados_configuracoes['impressora_principal'])){echo 'disabled';} ?> >TESTAR IMPRESSORA 01</button>
			</div>


			<div class="col-md-6 top15">
				<h5>IMPRESSORA SECUNDÁRIA</h5>	
				<input readonly type="text" class="form-control" value="<?php echo $dados_configuracoes['impressora_secundaria']; ?>">
				<button id="botao_teste_impressoras2" class="btn btn-primary btn-block bottom15 top10" onclick="javascript:testa_impressoras(2);" <?php if(empty($dados_configuracoes['impressora_secundaria'])){echo 'disabled';} ?> >TESTAR IMPRESSORA 02</button>				
			</div>

			<div class="col-md-12">				
				<div class="alert alert-success thin hide" id="resposta_teste_impressora">
					<i class="icofont-verification-check"></i> O TESTE FOI REALIZADO. CONFIRA A IMPRESSÃO NA IMPRESSORA SELECIONADA.
				</div>	
			</div>
	
		</div>
		</div>


	</div>	

