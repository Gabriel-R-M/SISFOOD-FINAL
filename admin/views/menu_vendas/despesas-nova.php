<?php require("../../includes/topo.php"); ?>

<?php
$edit=0;
if(isset($id)){
	$sql = $db->select("SELECT * FROM despesas WHERE id='$id' LIMIT 1");	
	$ln = $db->expand($sql);
	$edit=1;
}
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">DESPESAS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		<?php
  			if($edit==1){
  				echo $ln['descricao'];
  			} else {
  				echo 'NOVA DESPESA';
  			}
  		?>
  </h6>
</div>


<form method="post" action="despesas-nova/save">
<div class="section-wrapper">
  		
		<input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

  		<div class="form-layout">
            <div class="row mg-b-25">
              
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Descrição: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="descricao" required="required" value="<?php if($edit==1){ echo $ln['descricao'];} ?>">
                </div>
              </div><!-- col-4 -->


              <div class="col-lg-3">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Valor: <span class="tx-danger">*</span></label>
                  <input class="form-control valores" required name="gasto" value="<?php if($edit==1){ echo $ln['valor'];} ?>">	                    
                </div>
              </div><!-- col-4 -->	


              <div class="col-lg-3">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Categoria:</label>
                  <select class="form-control select2 upper" name="categoria">
	                    <?php
	                		if($edit==1){
	                			
	                			$cat = $ln['categoria'];
	                			$sql = $db->select("SELECT * FROM categorias_despesas WHERE id='$cat' LIMIT 1");	
	                			$line = $db->expand($sql);
	                			echo '<option value="'.$line['id'].'" selected>'.$line['categoria'].'</option>';		
	                			
	                			$sql = $db->select("SELECT * FROM categorias_despesas WHERE id!='$cat' ORDER BY categoria");	
	                			while($line = $db->expand($sql)){
	                				echo '<option value="'.$line['id'].'">'.$line['categoria'].'</option>';		
	                			}

	                		} else {
	                			
	                			echo '<option value="0">--------------</option>';
	                			$sql = $db->select("SELECT * FROM categorias_despesas ORDER BY categoria");	
	                			while($line = $db->expand($sql)){
	                				echo '<option value="'.$line['id'].'">'.$line['categoria'].'</option>';		
	                			}

	                		}
	                	?>	
                  </select>
                </div>
              </div><!-- col-4 -->

              
              <div class="col-lg-3">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Data: <span class="tx-danger">*</span></label>
                  <input type="date" class="form-control valores" required name="data" value="<?php if($edit==1){ echo $ln['data'];} ?>">	                    
                </div>
              </div><!-- col-4 -->	

              <div class="col-lg-3">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Horário:</label>
                  <input type="time" class="form-control" name="hora" value="<?php if($edit==1){ echo $ln['hora'];} ?>">	                    
                </div>
              </div><!-- col-4 -->	
              
              
            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button>  
              <button type="submit" onclick="javascript:salva_cadastro_insere();" class="btn btn-primary bd-0 pull-right">SALVAR E INSERIR MAIS</button>             
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>