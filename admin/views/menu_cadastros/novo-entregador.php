<?php require("../../includes/topo.php"); ?>

<?php
$edit=0;
if(isset($id)){
	$sql = $db->select("SELECT * FROM entregadores WHERE id='$id' LIMIT 1");	
	$ln = $db->expand($sql);
	$edit=1;
}
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">ENTREGADORES</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		<?php
  			if($edit==1){
  				echo $ln['nome'];
  			} else {
  				echo 'NOVO ENTREGADOR';
  			}
  		?>
  </h6>
</div>


<form method="post" action="entregadores/save">
<div class="section-wrapper">
  		
		<input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

  		<div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="nome" required="required" value="<?php if($edit==1){ echo $ln['nome'];} ?>">
                </div>
              </div><!-- col-4 -->
             
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="form-control-label">Telefone:</label>
                  <input class="form-control" type="text" name="telefone"  value="<?php if($edit==1){ echo $ln['telefone'];} ?>">
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

            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button>              
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>