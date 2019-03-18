<?php 
require_once("../../admin/class/class.db.php");
require_once("../../admin/class/class.seguranca.php");
require_once("../../includes/verifica_configuracoes_loja.php");
require_once("../../diversos/funcoes_diversas.php");
?>


	<div class="order-top" style="border-bottom: 0">
		<h20>Loja Online</h20>			
	</div>



	<div class="card" >
		

		<div class="col-md-12">	
		<div class="row row-xs">


			<?php
				$pega = $db->select("SELECT tipo_abertura_loja, loja_aberta_manual FROM dados_loja_internet");
				$line = $db->expand($pega);
				if($line['tipo_abertura_loja']=='' || $line['tipo_abertura_loja']=='automatica'){					
					$aberto = loja_aberta_fechada();
					if(($aberto==1 && $line['loja_aberta_manual']!='2') || $line['loja_aberta_manual']=='1'){	
						$frase1 = 'LOJA ABERTA';
						$style1 = 'success';
						$frase2 = 'ENCERRAR';
						$style2 = 'primary';
						$link = 'javascript:abre_fecha_loja_online(2)';
					} else {
						$frase1 = 'LOJA FECHADA';
						$style1 = 'danger';
						$frase2 = 'ABRIR LOJA';
						$style2 = 'success';
						$link = 'javascript:abre_fecha_loja_online(1)';
					}

				} else {

					if($line['loja_aberta_manual']==1){

						$frase1 = 'LOJA ABERTA';
						$style1 = 'success';
						$frase2 = 'ENCERRAR';
						$style2 = 'primary';
						$link = 'javascript:abre_fecha_loja_online(2)';

					} else {

						$frase1 = 'LOJA FECHADA';
						$style1 = 'danger';
						$frase2 = 'ABRIR LOJA';
						$style2 = 'success';
						$link = 'javascript:abre_fecha_loja_online(1)';

					}

				}
			?>
				

				<div class="col-md-3 top15 ">
					<h5>STATUS DA LOJA</h5>	
					<div class="alert alert-<?php echo $style1; ?> thin text-center" style="padding: 9.5px">
						<h5 style="padding: 0; font-size: 15px; font-weight: 300; margin-bottom: 0"><?php echo $frase1; ?></h5>
					</div>				
				</div>

				<div class="col-md-3 top15 ">
					<h5>&nbsp;</h5>		
					<button id="botao_atualiza_abre_fecha" class="btn btn-<?php echo $style2; ?> btn-block"  type="button" onclick="<?php echo $link; ?>"><?php echo $frase2; ?></button>
				</div>

			

			<div class="col-md-12">
				<hr style="margin-top: 10px; margin-bottom: 10px">
			</div>

			
			<div class="col-md-6 top15">
				<h5>TIPO DE ABERTURA</h5>	
				<select class="form-control" onchange="javascript:abre_loja_online(this.value);" id="tipo_abertura_loja">
					<?php						
						if($line['tipo_abertura_loja']=='' || $line['tipo_abertura_loja']=='automatica'){

							echo '<option value="automatica" selected>AUTOMÁTICA</option>';
							echo '<option value="manual">MANUAL</option>';

						} else {

							echo '<option value="manual" selected>MANUAL</option>';
							echo '<option value="automatica">AUTOMÁTICA</option>';							

						}
					?>					
					
				</select>
			</div>

			<div class="col-md-2 top15">
				<h5>&nbsp;</h5>	
				<button id="botao_atualiza" class="btn btn-primary btn-block" onclick="javascript:altera_tipo_abertura_loja_online();"  type="button">ALTERAR</button>
			</div>

			<div class="col-md-12 top15">

				<?php
					if($line['tipo_abertura_loja']=='' || $line['tipo_abertura_loja']=='automatica'){
				?>		
					<div class="alert alert-info thin" id="automatica">
						<i class="icofont-check-circled"></i> SERÁ ABERTO BASEADO NOS HORÁRIOS DE FUNCIONAMENTO.
					</div>

					<div class="alert alert-warning thin hide" id="manual">
						<i class="icofont-check-circled"></i> SERÁ ABERTO MANUALMENTE ATRAVÉS DESTA ÁREA.
					</div>
				<?php 
					} else {
				?>
					<div class="alert alert-warning thin" id="manual">
						<i class="icofont-check-circled"></i> SERÁ ABERTO MANUALMENTE ATRAVÉS DESTA ÁREA.
					</div>

					<div class="alert alert-info thin hide" id="automatica">
						<i class="icofont-check-circled"></i> SERÁ ABERTO BASEADO NOS HORÁRIOS DE FUNCIONAMENTO.
					</div>
				<?php 
					}
				?>	
			</div>	


			


			
			
	
		</div>
		</div>


	</div>	

