<?php 
require_once("../../admin/class/class.db.php");
require_once("../../admin/class/class.seguranca.php");

$pega = $db->select("SELECT tempo_retirada, tempo_entrega, tipo_tempo_retirada, tipo_tempo_entrega FROM dados_loja_internet");
$line = $db->expand($pega);

?>

	<div class="order-top" style="border-bottom: 0">
		<h20>Tempo de Entrega e Retirada</h20>			
	</div>



	<div class="card" >
	<form id="FormTempoEntregaRetirada" method="post" action="menu_configuracoes/actions/salva_tempo_entrega_retirada.php">	

		<div class="col-md-12">	
		<div class="row ">
			
			<div class="col-md-12 top15">
				<div class="row row-xs">
					<div class="col-md-6">
						<h5>TEMPO P/ ENTREGA</h5>	
						<input type="text" class="form-control" name="tempo_entrega" value="<?php echo $line['tempo_entrega']; ?>">
					</div>
					<div class="col-md-6">
						<h5>&nbsp;</h5>	
						<select class="form-control" required name="tipo_tempo_entrega">
							<?php
								if($line['tipo_tempo_entrega']=='minutos'){
									echo '<option value="minutos" selected>Minutos</option>';
									echo '<option value="hora(s)">Hora(s)</option>';
								} else if($line['tipo_tempo_entrega']=='hora(s)'){
									echo '<option value="hora(s)" selected>Hora(s)</option>';
									echo '<option value="minutos">Minutos</option>';									
								} else {
									echo '<option value="minutos">Minutos</option>';									
									echo '<option value="hora(s)">Hora(s)</option>';									
								}
							?>	
						</select>
					</div>
				</div>
			</div>	


			<div class="col-md-12 top15">
				<div class="row row-xs">
					<div class="col-md-6">
						<h5>TEMPO P/ RETIRADA</h5>	
						<input type="text" class="form-control" name="tempo_retirada" value="<?php echo $line['tempo_retirada']; ?>">
					</div>
					<div class="col-md-6">
						<h5>&nbsp;</h5>	
						<select class="form-control" required name="tipo_tempo_retirada">
							<?php
								if($line['tipo_tempo_retirada']=='minutos'){
									echo '<option value="minutos" selected>Minutos</option>';
									echo '<option value="hora(s)">Hora(s)</option>';
								} else if($line['tipo_tempo_retirada']=='hora(s)'){
									echo '<option value="hora(s)" selected>Hora(s)</option>';
									echo '<option value="minutos">Minutos</option>';									
								} else {
									echo '<option value="minutos">Minutos</option>';									
									echo '<option value="hora(s)">Hora(s)</option>';									
								}
							?>	
						</select>
					</div>
				</div>
			</div>

			
		
			
			<div class="col-md-4 top15">
				
				<button id="botao_atualiza_horarios" class="btn btn-primary btn-block bottom15 top10"  type="button" onclick="javascript:atualiza_tempo_entrega_retirada();">ATUALIZAR NO SITE </button>
			</div>


			<div class="col-md-12 top15">
				<div class="progress mg-b-20 altura_progresso hide">
	              <div id="barra_progresso_servidor_web" class="altura_progresso progress-bar progress-bar-striped wd-10p progress-bar-lg" role="progressbar" aria-valuenow="25" aria-valuemin="" aria-valuemax="100" ></div>
	            </div>

	            <div class="alert alert-success thin hide" id="resposta_sucesso_servidor">
					<i class="icofont-check-circled"></i> SERVIDOR ATUALIZADO COM SUCESSO.
				</div>	

				<div class="alert alert-danger thin hide" id="resposta_erro_servidor">
					<i class="icofont-warning"></i> ERRO AO ATUALIZAR SERVIDOR. TENTE NOVAMENTE.
				</div>	
        	</div>

	
		</div>
		</div>

	</form>	
	</div>	



