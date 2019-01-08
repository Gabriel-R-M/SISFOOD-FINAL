<?php require("../../includes/topo.php"); ?>

<?php
$edit=0;
if(isset($id)){
	$sql = $db->select("SELECT * FROM clientes WHERE id='$id' LIMIT 1");	
	$ln = $db->expand($sql);
	$edit=1;
}
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">CLIENTES</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		<?php
  			if($edit==1){
  				echo $ln['nome'];
  			} else {
  				echo 'NOVO CLIENTE';
  			}
  		?>
  </h6>
</div>


<form method="post" action="clientes/save">
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
             
              <div class="col-lg-2">
                <div class="form-group">
                  <label class="form-control-label">DDD: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="ddd" required="required" value="<?php if($edit==1){ echo $ln['ddd'];} ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-5">
                <div class="form-group">
                  <label class="form-control-label">Telefone: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="numero_telefone" required="required" value="<?php if($edit==1){ echo $ln['telefone'];} ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-5">
                <div class="form-group">
                  <label class="form-control-label">Telefone 2:</label>
                  <input class="form-control" type="text" name="celular" value="<?php if($edit==1){ echo $ln['celular'];} ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-10">
                <div class="form-group">
                  <label class="form-control-label">Endereço:</label>
                  <input class="form-control" type="text" name="endereco" value="<?php if($edit==1){ echo $ln['endereco'];} ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-2">
                <div class="form-group">
                  <label class="form-control-label">Nº:</label>
                  <input class="form-control" type="text" name="numero" value="<?php if($edit==1){ echo $ln['numero'];} ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Bairro:</label>
                  <input class="form-control" type="text" name="bairro" value="<?php if($edit==1){ echo $ln['bairro'];} ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Complemento:</label>
                  <input class="form-control" type="text" name="complemento" value="<?php if($edit==1){ echo $ln['complemento'];} ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Cidade:</label>
                  <input class="form-control" type="text" name="cidade" value="<?php if($edit==1){ echo $ln['cidade'];} ?>">
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