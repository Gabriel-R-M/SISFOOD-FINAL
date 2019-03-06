<?php require("../../includes/topo.php"); ?>


<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">PEDIDOS WEB</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		ATUALIZAÇÃO DE SERVIDOR WEB
  </h6>
</div>


<form method="post" action="controlers/configuracoes/atualiza_servidor_web.php" id="FormAtualizaServidorWeb">
<div class="section-wrapper">
  		

  		<div class="form-layout">
            <div class="row mg-b-25">
              

           
	          <div class="col-lg-12" >
              <label class="form-control-label">AS TABELAS ABAIXO, SERÃO ESPELHADAS COM O SERVIDOR WEB:</label>      
           
              <hr>
              
              <div class="row">
              	<?php
                  $contador=1;
              		$tabelas = array('categorias', 'lanches', 'tamanhos', 'tipos_entrega', 'dados_loja_internet', 'formas_pagamento', 'horarios_funcionamento', 'ingredientes', 'ingredientes_lanches', 'opcionais', 'lanches_tamanhos_valores', 'opcionais_categorias_relacao');
                 // $tabelas = array('categorias');
              		foreach ($tabelas as $table) {
              	?>

              		<div class="col-md-3 text-center">
						<div class="col-md-12 text-center" style="border:1px solid #efefef; margin-bottom:10px; padding:10px">

							<input checked  onclick="return false;" class="tabelas<?php echo $contador; ?> tabelas" type="checkbox" value="<?php echo $table; ?>"><br>
							<span style="text-transform:uppercase;font-weight:300"><?php echo $table; ?></span>

						</div>
					</div>

				      <?php
                  $contador++;
              		}
              	?>		
	          </div>	
	      	
	          </div>


            </div>

            <div class="form-layout-footer">
              <button type="button" class="btn btn-primary bd-0" id="botao_atualiza_servidor_web" onclick="javascript:atualiza_servidor_web(1,1);">ATUALIZAR AGORA</button>     
              
            </div>

            <div class="progress mg-t-20 altura_progresso hide">
              <div id="barra_progresso_servidor_web" class="altura_progresso progress-bar progress-bar-striped wd-0p progress-bar-lg" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" ></div>
            </div>


            <div class="aviso_servidor_web_atualizado alert alert-success top10 hide" style="font-weight: 300">
      			  <i class="icofont-check-circled"></i>&nbsp;SERVIDOR WEB ATUALIZADO COM SUCESSO.
      			</div>

            <div class="aviso_erro_servidor_web_atualizado alert alert-danger top10 hide" style="font-weight: 300">
              <i class="icofont-warning"></i>&nbsp;ERRO: <span class="upper" id="erro_atualiza_servidor"></span>
            </div>


          </div>
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>