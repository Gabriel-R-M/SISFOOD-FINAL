<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_configuracoes_loja.php");
?>

<div class="col-md-4">	

		<div class="order-top" style="border-bottom: 0">
			<h20>Configurações</h20>			
		</div>

		<ul class="list-group">
            <li class="list-group-item upper">
            	<a tabindex="-1" href="javascript:void();"><p class="mg-b-0 thin">            		
            		<i class="icofont-print mg-r-8"></i>	
            		Manutenção de Impressoras</p>
            	</a>
            </li>
            <li tabindex="-1" class="list-group-item upper" style="border-top: 0">
            	<a href="javascript:void();"><p class="mg-b-0 thin">   
            		<i class="icofont-wifi-router mg-r-8"></i>         		            		
            		CONFIGURAÇÃO SAT</p>
            	</a>
            </li>
            <li tabindex="-1" class="list-group-item upper hide" style="border-top: 0">
            	<a href="retaguarda" ><p class="mg-b-0 thin">            		
            		<i class="icofont-gear mg-r-8"></i>
            		ACESSAR RETAGUARDA ADMINISTRATIVA</p>
            	</a>
            </li>                
        </ul>
		
			
</div>


<div class="col-md-8">	
	
	<div class="order-top" style="border-bottom: 0">
		<h20>Manutenção de Impressoras</h20>			
	</div>



	<div class="card">
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

</div>	


<script>	
	window.clearTimeout(atualiza_pedidos);		
</script>




