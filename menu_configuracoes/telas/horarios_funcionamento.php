<?php 
require_once("../../admin/class/class.db.php");
require_once("../../admin/class/class.seguranca.php");


$select = $db->select("SELECT * FROM horarios_funcionamento");
while($dados_horarios = $db->expand($select)){

	if($dados_horarios['dia']==1){
		$dia1_inicio = substr($dados_horarios['abre'],0,5);
		$dia1_fim = substr($dados_horarios['fecha'],0,5);
	}

	if($dados_horarios['dia']==2){
		$dia2_inicio = substr($dados_horarios['abre'],0,5);
		$dia2_fim = substr($dados_horarios['fecha'],0,5);
	}

	if($dados_horarios['dia']==3){
		$dia3_inicio = substr($dados_horarios['abre'],0,5);
		$dia3_fim = substr($dados_horarios['fecha'],0,5);
	}

	if($dados_horarios['dia']==4){
		$dia4_inicio = substr($dados_horarios['abre'],0,5);
		$dia4_fim = substr($dados_horarios['fecha'],0,5);
	}

	if($dados_horarios['dia']==5){
		$dia5_inicio = substr($dados_horarios['abre'],0,5);
		$dia5_fim = substr($dados_horarios['fecha'],0,5);
	}

	if($dados_horarios['dia']==6){
		$dia6_inicio = substr($dados_horarios['abre'],0,5);
		$dia6_fim = substr($dados_horarios['fecha'],0,5);
	}

	if($dados_horarios['dia']==7){
		$dia7_inicio = substr($dados_horarios['abre'],0,5);
		$dia7_fim = substr($dados_horarios['fecha'],0,5);
	}

}

	

?>

	<div class="order-top" style="border-bottom: 0">
		<h20>Horários de Funcionamento</h20>			
	</div>



	<div class="card" >
	<form id="FormHorariosFuncionamento" method="post" action="menu_configuracoes/actionS/salva_horarios_funcionamento.php">	

		<div class="col-md-12">	
		<div class="row ">
			
			<div class="col-md-6 top15">
				<div class="row row-xs">
					<div class="col-md-6">
						<h5>SEGUNDA-FEIRA</h5>	
						<input type="text" class="form-control" name="dia1_inicio" value="<?php echo $dia1_inicio; ?>">
					</div>

					<div class="col-md-6">
						<h5>&nbsp;</h5>	
						<input type="text" class="form-control" name="dia1_fim" value="<?php echo $dia1_fim; ?>">
					</div>
					
				</div>
			</div>	


			<div class="col-md-6 top15">
				<div class="row row-xs">
					<div class="col-md-6">
						<h5>TERÇA-FEIRA</h5>	
						<input type="text" class="form-control" name="dia2_inicio" value="<?php echo $dia2_inicio; ?>">
					</div>

					<div class="col-md-6">
						<h5>&nbsp;</h5>	
						<input type="text" class="form-control" name="dia2_fim" value="<?php echo $dia2_fim; ?>">
					</div>
					
				</div>
			</div>	

			
			<div class="col-md-6 top15">
				<div class="row row-xs">
					<div class="col-md-6">
						<h5>QUARTA-FEIRA</h5>	
						<input type="text" class="form-control" name="dia3_inicio" value="<?php echo $dia3_inicio; ?>">
					</div>

					<div class="col-md-6">
						<h5>&nbsp;</h5>	
						<input type="text" class="form-control" name="dia3_fim" value="<?php echo $dia3_fim; ?>">
					</div>
					
				</div>
			</div>


			<div class="col-md-6 top15">
				<div class="row row-xs">
					<div class="col-md-6">
						<h5>QUINTA-FEIRA</h5>	
						<input type="text" class="form-control" name="dia4_inicio" value="<?php echo $dia4_inicio; ?>">
					</div>

					<div class="col-md-6">
						<h5>&nbsp;</h5>	
						<input type="text" class="form-control" name="dia4_fim" value="<?php echo $dia4_fim; ?>">
					</div>
					
				</div>
			</div>	


			<div class="col-md-6 top15">
				<div class="row row-xs">
					<div class="col-md-6">
						<h5>SEXTA-FEIRA</h5>	
						<input type="text" class="form-control" name="dia5_inicio" value="<?php echo $dia5_inicio; ?>">
					</div>

					<div class="col-md-6">
						<h5>&nbsp;</h5>	
						<input type="text" class="form-control" name="dia5_fim" value="<?php echo $dia5_fim; ?>">
					</div>
					
				</div>
			</div>


			<div class="col-md-6 top15">
				<div class="row row-xs">
					<div class="col-md-6">
						<h5>SÁBADO</h5>	
						<input type="text" class="form-control" name="dia6_inicio" value="<?php echo $dia6_inicio; ?>">
					</div>

					<div class="col-md-6">
						<h5>&nbsp;</h5>	
						<input type="text" class="form-control" name="dia6_fim" value="<?php echo $dia6_fim; ?>">
					</div>
					
				</div>
			</div>


			<div class="col-md-6 top15">
				<div class="row row-xs">
					<div class="col-md-6">
						<h5>DOMINGO</h5>	
						<input type="text" class="form-control" name="dia7_inicio" value="<?php echo $dia7_inicio; ?>">
					</div>

					<div class="col-md-6">
						<h5>&nbsp;</h5>	
						<input type="text" class="form-control" name="dia7_fim" value="<?php echo $dia7_fim; ?>">
					</div>
					
				</div>
			</div>

			<div class="col-md-6 top15">
				<h5>&nbsp;</h5>	
				<button id="botao_atualiza_horarios" class="btn btn-primary btn-block bottom15 top10"  type="submit">SALVAR HORÁRIOS</button>
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



<script src="javascript/internet.js"></script>	