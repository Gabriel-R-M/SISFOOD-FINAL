<?php require("../../includes/topo.php"); ?>

<?php
$edit=0;
if(isset($id)){
	$sql = $db->select("SELECT * FROM lanches WHERE id='$id' LIMIT 1");	
	$ln = $db->expand($sql);
	$edit=1;
}
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">PRODUTOS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		<?php
  			if($edit==1){
  				echo $ln['produto'];
  			} else {
  				echo 'NOVO PRODUTO';
  			}
  		?>
  </h6>
</div>


<form method="post" action="produtos/save" enctype="multipart/form-data">
<div class="row">
<div class="col-md-8">

<div class="section-wrapper">
  		
		<input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

  		<div class="form-layout">
            <div class="row mg-b-25">

              <div class="col-lg-3">
                <div class="form-group">
                  <label class="form-control-label">Código:</label>
                  <input class="form-control" type="text" name="codigo" value="<?php if($edit==1){ echo $ln['codigo'];} ?>">
                </div>
              </div>

              <div class="col-lg-9">
                <div class="form-group">
                  <label class="form-control-label">Produto:</label>
                  <input class="form-control" type="text"  name="produto" required="required" value="<?php if($edit==1){ echo $ln['produto'];} ?>">
                </div>
              </div>


              <div class="col-lg-9">
                <div class="form-group">
                  <label class="form-control-label">Foto:</label>
                  <input class="form-control" type="file"  name="foto">
                </div>
              </div>

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


            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button> 
              <button type="submit" onclick="javascript:salva_cadastro_insere();" class="btn btn-primary bd-0 pull-right">SALVAR E INSERIR MAIS</button>              
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
             
  
</div>

</div>

<div class="col-md-4">

<div class="section-wrapper">
  		
		
  		<div class="form-layout">
            <div class="row mg-b-25">

	             <div class="col-lg-12">
	                <div class="form-group">
	                  <label class="form-control-label">Categoria:</label>
	                  <select class="form-control select2" name="categoria" id="categoria" required="required" onchange="javascript:varia(this.value);">
		                	<?php
		                		if($edit==1){
		                			
		                			$categoria = $ln['categoria'];
		                			$sql = $db->select("SELECT * FROM categorias WHERE id='$categoria' LIMIT 1");
		                			$row = $db->expand($sql);
		                			echo '<option value="'.$row['id'].'" selected>'.$row['categoria'].'</option>';

		                			$sql = $db->select("SELECT * FROM categorias WHERE id!='$categoria' ORDER BY categoria");
		                			while($row = $db->expand($sql)){
		                				echo '<option value="'.$row['id'].'">'.$row['categoria'].'</option>';
		                			}
		                			

		                		} else {

		                				echo '<option value="">-- escolha a categoria --</option>';
		                				$sql = $db->select("SELECT * FROM categorias ORDER BY categoria");
		                				while($row = $db->expand($sql)){
		                					echo '<option value="'.$row['id'].'">'.$row['categoria'].'</option>';
		                				}

		                		}
		                	?>
	                </select>	
	                </div>
	              </div>


	              <div class="col-lg-12">
	                <div class="form-group">
	                  <label class="form-control-label">Preços com variações?</label>
	                  <select class="form-control select2" name="preco_composto" id="preco_composto" required="required" onchange="javascript:exibe_precos_variacao_tamanho(this.value);">
		                	<?php
		                		if($edit==1){
		                			
		                			if($ln['preco_composto']==1){
		                				$pre_composto=1;
		                				$pre_normal=0;
		                				echo '<option value="1" selected>SIM</option>';
		                				echo '<option value="0">NÃO</option>';
		                			
		                			} else if($ln['preco_composto']==0 && $ln['preco_composto']!=''){
		                				$pre_composto=0;
		                				$pre_normal=1;
		                				echo '<option value="0" selected>NÃO</option>';
		                				echo '<option value="1">SIM</option>';                				
		                			
		                			} else if($ln['preco_composto']==''){

		                				$pre_composto='';
		                				$pre_normal='';
		                				echo '<option value="">--- escolha o tipo de preço ---</option>';	
		                				echo '<option value="1">SIM</option>';
		                				echo '<option value="0">NÃO</option>';

		                			}

		                		} else {
		                				$pre_composto='';
		                				$pre_normal='';
		                				echo '<option value="">--- escolha o tipo de preço ---</option>';	
		                				echo '<option value="1">SIM</option>';
		                				echo '<option value="0">NÃO</option>';

		                		}
		                	?>	
		                </select>	
	                </div>
	              </div>


	              <div class="col-md-12" style="<?php if($pre_composto==1){echo 'display: block;';} else {echo 'display: none;';} ?>" id="precos_produtos_variacao">
			          <label for="exampleInputEmail1">Informe os preços do produto</label>
				        <div class="row" id="ajax_variacoes">	
								 <?php 
								 	if($edit==1){
								 		$categoriax = $ln['categoria'];
								 		include('../../controlers/ajax/variacao_precos.php'); 
								 	}
								 ?>
						</div>
				</div> 


				<div class="col-md-12" style="<?php if($pre_normal==1){echo 'display: block;';} else{echo 'display: none;';} ?>"" id="precos_produtos_normal">
			          <label for="exampleInputEmail1">Informe o preço do produto</label>
				        <div class="row">	
				        	<?php
				        		if($edit==1){
				        			$pei = $db->select("SELECT preco FROM lanches_tamanhos_valores WHERE id_produto='$id' AND id_tamanho='0' LIMIT 1");
				        			$ju = $db->expand($pei);
				        			$val_unico= $ju['preco'];
				        		} else {
				        			$val_unico='';
				        		}
				        	?>	
				         	<div class="col-md-12" style="margin-bottom:10px">
								<input type="text"  placeholder="0.00" value="<?php echo $val_unico; ?>" class="form-control valores" name="valor_fechado" id="valor_fechado" >	
							</div>	 
						
						</div>
				</div> 
				


			 </div>
		</div>

</div>


</div>

</div>




</form>

<?php require("../../includes/rodape.php"); ?>