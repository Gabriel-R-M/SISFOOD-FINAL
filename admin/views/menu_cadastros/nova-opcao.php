<?php require("../../includes/topo.php"); ?>

<?php
$edit=0;
if(isset($id)){
	$sql = $db->select("SELECT * FROM opcionais2 WHERE id='$id' LIMIT 1");	
	$ln = $db->expand($sql);
	$edit=1;
}
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">OPÇÕES P/ PRODUTOS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		<?php
  			if($edit==1){
  				echo $ln['opcional2'];
  			} else {
  				echo 'NOVA OPÇÃO';
  			}
  		?>
  </h6>
</div>


<form method="post" action="opcoes/save">
<div class="section-wrapper">
  		
		<input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

  		<div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Opção de Escolha: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="opcional" required="required" value="<?php if($edit==1){ echo $ln['opcional2'];} ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="form-control-label">Valor: <span class="tx-danger">*</span></label>
                  <input class="form-control valores" type="text"  name="preco" required="required" value="<?php if($edit==1){ echo $ln['valor_opcional2'];} ?>">
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


            <div class="col-lg-6" style="display: none;">
	               
	               <div class="form-group">
	                  <label class="form-control-label">Liberar Opção para:</label>
	                  <select class="form-control select2" onchange="javascript:lista_opcoes(this.value);">
	                  		<option value="">-- ESCOLHA --</option>
	                  		<option value="1">CATEGORIAS</option>
		                	<option value="2">PRODUTOS</option>
		              </select>  	
	               </div>
	          </div>

            <div class="col-lg-12">                 
                 <div class="form-group">
                                  
                 </div>
            </div>


	          <div class="col-lg-12" id="list_categorias" style="display: none; margin-top: 10px;">
	          	<?php require("listagem/listagem-categorias-opcoes.php"); ?> 
	          </div>	

	          <div class="col-lg-12" id="list_produtos">
              <label class="form-control-label">ESCOLHA OS PRODUTOS LIBERADOS PARA ESCOLHA:</label>      
	          	<?php require("listagem/listagem-produtos-opcoes.php"); ?>
	          </div>


            </div>

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button>              
            </div>

          </div>
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>