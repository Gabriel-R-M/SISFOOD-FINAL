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
			
			<div class="col-md-3 top15">
				<h5>IMPRESSORA 01</h5>					
				<button id="botao_teste_impressoras1" class="btn btn-primary btn-block bottom15 top10" onclick="javascript:testa_impressoras(1);">TESTAR IMPRESSORA 01</button>
			</div>

			<div class="col-md-3 top15">
				<h5>IMPRESSORA 02</h5>					
				<button id="botao_teste_impressoras2" class="btn btn-primary btn-block bottom15 top10" onclick="javascript:testa_impressoras(2);">TESTAR IMPRESSORA 02</button>
			</div>

			<div class="col-md-3 top15">
				<h5>IMPRESSORA 03</h5>					
				<button id="botao_teste_impressoras3" class="btn btn-primary btn-block bottom15 top10" onclick="javascript:testa_impressoras(3);">TESTAR IMPRESSORA 03</button>
			</div>

			<div class="col-md-3 top15">
				<h5>IMPRESSORA 04</h5>					
				<button id="botao_teste_impressoras4" class="btn btn-primary btn-block bottom15 top10" onclick="javascript:testa_impressoras(4);">TESTAR IMPRESSORA 04</button>
			</div>

			<div class="col-md-12">				
				<div class="alert alert-success thin hide" id="resposta_teste_impressora">
					<i class="icofont-verification-check"></i> O TESTE FOI REALIZADO. CONFIRA A IMPRESSÃO NA IMPRESSORA SELECIONADA.
				</div>	
			</div>
	
		</div>
		</div>


	</div>	

