<?php require("../../includes/topo.php"); ?>

<?php
$edit=0;
if(isset($id)){
	$sql = $db->select("SELECT * FROM categorias WHERE id='$id' LIMIT 1");	
	$ln = $db->expand($sql);
	$edit=1;
}
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">CATEGORIAS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		<?php
  			if($edit==1){
  				echo $ln['categoria'];
  			} else {
  				echo 'NOVA CATEGORIA';
  			}
  		?>
  </h6>
</div>


<form method="post" action="categorias/save">
<div class="section-wrapper">
  		
		<input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

  		<div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Categoria: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="categoria" required="required" value="<?php if($edit==1){ echo $ln['categoria'];} ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="form-control-label">Ordem: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text"  name="ordem" required="required" value="<?php if($edit==1){ echo $ln['ordem'];} ?>">
                </div>
              </div><!-- col-4 -->
              
              <div class="col-lg-3">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Meio-Meio: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="meio_meio"  required="required">
	                    <?php
	                		if($edit==1){
	                			
	                			if($ln['meio_meio']==1){
	                				echo '<option value="1" selected>SIM</option>';
	                				echo '<option value="0">NÃO</option>';
	                			}	

	                			else if($ln['meio_meio']==0){
	                				echo '<option value="0" selected>NÃO</option>';
	                				echo '<option value="1">SIM</option>';                				
	                			}

	                		} else {
	                				echo '<option value="0" selected>NÃO</option>';
	                				echo '<option value="1">SIM</option>';

	                		}
	                	?>	
                  </select>
                </div>
              </div><!-- col-4 -->


              <div class="col-lg-3">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Adicionais: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="adicionais"  required="required">
	                    <?php
	                		if($edit==1){
	                			
	                			if($ln['adicionais']==1){
	                				echo '<option value="1" selected>SIM</option>';
	                				echo '<option value="0">NÃO</option>';
	                			}	

	                			else if($ln['adicionais']==0){
	                				echo '<option value="0" selected>NÃO</option>';
	                				echo '<option value="1">SIM</option>';                				
	                			}

	                		} else {
	                				echo '<option value="0" selected>NÃO</option>';
	                				echo '<option value="1">SIM</option>';
	                				

	                		}
	                	?>	
                  </select>
                </div>
              </div><!-- col-4 -->


              <div class="col-lg-3">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Imprime Cód. Comanda: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="imprime_codigo"  required="required">
	                    <?php
	                		if($edit==1){
	                			
	                			if($ln['imprime_codigo']==1){
	                				echo '<option value="1" selected>SIM</option>';
	                				echo '<option value="0">NÃO</option>';
	                			}	

	                			else if($ln['imprime_codigo']==0){
	                				echo '<option value="0" selected>NÃO</option>';
	                				echo '<option value="1">SIM</option>';                				
	                			}

	                		} else {
	                				echo '<option value="1" selected>SIM</option>';
	                				echo '<option value="0">NÃO</option>';

	                		}
	                	?>	
                  </select>
                </div>
              </div><!-- col-4 -->


              <div class="col-lg-3">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Impressora Principal: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="impressao"  required="required">
	                    <?php
	                		if($edit==1){
	                			
	                			if($ln['impressao']=='principal'){
	                				echo '<option value="principal" selected>Principal (Caixa)</option>';
	                				echo '<option value="secundaria">Secundária (Cozinha)</option>';
	                			}	

	                			else if($ln['impressao']=='secundaria'){
	                				echo '<option value="secundaria" selected>Secundária (Cozinha)</option>';
	                				echo '<option value="principal">Principal (Caixa)</option>';                				
	                			}

	                		} else {

	                				echo '<option value="principal" selected>Principal (Caixa)</option>';
	                				echo '<option value="secundaria">Secundária (Cozinha)</option>';                				

	                		}
                	    ?>
                  </select>
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-3">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Ativo: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="ativo"  required="required">
	                    <?php
	                		if($edit==1){
	                			
	                			if($ln['ativo']==1){
	                				echo '<option value="1" selected>SIM</option>';
	                				echo '<option value="0">NÃO</option>';
	                			}	

	                			else if($ln['ativo']==0){
	                				echo '<option value="0" selected>NÃO</option>';
	                				echo '<option value="1">SIM</option>';                				
	                			}

	                		} else {
	                				echo '<option value="1" selected>SIM</option>';
	                				echo '<option value="0">NÃO</option>';

	                		}
	                	?>	
                  </select>
                </div>
              </div><!-- col-4 -->



              <div class="col-md-12 top20">

              <div id="accordion2" class="accordion-two accordion-two-primary" >
                <div class="card">
                  <div class="card-header" role="tab" id="headingOne2">
                    <a data-toggle="collapse">
                      CONFIGURAÇÕES FISCAIS PARA A CATEGORIA
                    </a>
                  </div><!-- card-header -->

                  <div id="collapseOne2" class="collapse show" role="tabpanel" aria-labelledby="headingOne2">
                    
                    <div class="card-body" style="background-color: #FFF">
                           
                          <div class="row">  

                           

                            <div class="col-md-3">
                               <div class="form-group">
                                    <label for="exampleInputEmail1">NCM PADRÃO</label>
                                    <input type="number"  class="form-control" name="ncm_categoria" value="<?php if($edit==1){ echo $ln['ncm_categoria'];} ?>">  
                               </div>
                            </div>

                            <div class="col-md-3">
                               <div class="form-group">
                                    <label for="exampleInputEmail1">CST PADRÃO</label>
                                    <input type="number"  class="form-control" name="cst_categoria" value="<?php if($edit==1){ echo $ln['cst_categoria'];} ?>">  
                               </div>
                            </div>

                            <div class="col-md-3">
                               <div class="form-group">
                                    <label for="exampleInputEmail1">CFOP PADRÃO</label>
                                    <input type="number"  class="form-control" name="cfop_categoria" value="<?php if($edit==1){ echo $ln['cfop_categoria'];} ?>">  
                               </div>
                            </div>

                            <div class="col-md-12"> 
                              <div class="alert alert-warning thin">
                                  <i class="icofont-exclamation-tringle"></i> AS INFORMAÇÕES ACIMA, SÓ SÃO OBRIGATÓRIAS EM UTILIZAÇÃO FISCAL.
                              </div>
                            </div>


                          </div>    


                    </div>

                  </div>
                </div>
                
              </div><!-- accordion -->

          </div>

            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button>        
              <button type="submit" onclick="javascript:salva_cadastro_insere();" class="btn btn-primary bd-0 pull-right">SALVAR E INSERIR MAIS</button>      
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>