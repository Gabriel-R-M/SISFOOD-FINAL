<?php require("../../includes/topo.php"); ?>

<?php
$edit=0;
if(isset($id)){
	$sql = $db->select("SELECT * FROM usuarios WHERE id='$id' LIMIT 1");	
	$ln = $db->expand($sql);
	$edit=1;
}
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">ATENDENTES</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		<?php
  			if($edit==1){
  				echo $ln['nome'];
  			} else {
  				echo 'NOVO ATENDENTE';
  			}
  		?>
  </h6>
</div>


<form method="post" action="atendentes/save">
<div class="section-wrapper">
  		
		<input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

  		<div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="nome" required="required" value="<?php if($edit==1){ echo $ln['nome'];} ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="form-control-label">Usuário: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text"  name="usuario" required="required" value="<?php if($edit==1){ echo $ln['usuario'];} ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="form-control-label">Senha: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="senha"  required="required" value="<?php if($edit==1){ echo $ln['senha'];} ?>">
                </div>
              </div><!-- col-4 -->
              
              <div class="col-lg-3">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Tipo: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="nivel"  required="required">
                    	<?php
	                		if($edit==1){
	                			
	                			if($ln['nivel']==1){
	                				echo '<option value="1" selected>ATENDENDE</option>';
	                				echo '<option value="3">CAIXA</option>';
	                			}	

	                			else if($ln['nivel']==3){
	                				echo '<option value="3" selected>CAIXA</option>';
	                				echo '<option value="1">ATENDENTE</option>';                				
	                			}

	                		} else {
	                				echo '<option value="">--- escolha o tipo ---</option>';
	                				echo '<option value="1">ATENDENTE</option>';
	                				echo '<option value="3">CAIXA</option>';
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

            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button> 
              <button type="submit" onclick="javascript:salva_cadastro_insere();" class="btn btn-primary bd-0 pull-right">SALVAR E INSERIR MAIS</button>             
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>