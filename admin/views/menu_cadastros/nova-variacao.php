<?php require("../../includes/topo.php"); ?>

<?php
$edit=0;
if(isset($id)){
	$sql = $db->select("SELECT * FROM tamanhos WHERE id='$id' LIMIT 1");	
	$ln = $db->expand($sql);
	$edit=1;
}
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">VARIAÇÕES</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		<?php
  			if($edit==1){
  				echo $ln['tamanho'];
  			} else {
  				echo 'NOVA VARIAÇÃO';
  			}
  		?>
  </h6>
</div>


<form method="post" action="variacoes/save">
<div class="section-wrapper">
  		
		<input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

  		<div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Variação: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="tamanho" required="required" value="<?php if($edit==1){ echo $ln['tamanho'];} ?>">
                </div>
              </div><!-- col-4 -->
             

              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Categoria: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="id_categoria"  required="required">
	                    <?php
	                		if($edit==1){
	                			
		                		$categoria = $ln['id_categoria'];
	                			$sql = $db->select("SELECT * FROM categorias WHERE id='$categoria' LIMIT 1");
	                			$row = $db->expand($sql);
	                			echo '<option class="upper" value="'.$row['id'].'" selected>'.$row['categoria'].'</option>';

	                			$sql = $db->select("SELECT * FROM categorias WHERE id!='$categoria' ORDER BY categoria");
	                			while($row = $db->expand($sql)){
	                				echo '<option class="upper" value="'.$row['id'].'">'.$row['categoria'].'</option>';
	                			}
                			

                		} else {

                				echo '<option value="">-- escolha a categoria --</option>';
                				$sql = $db->select("SELECT * FROM categorias ORDER BY categoria");
                				while($row = $db->expand($sql)){
                					echo '<option class="upper" value="'.$row['id'].'">'.$row['categoria'].'</option>';
                				}

                		}
	                	?>	
                  </select>
                </div>
              </div><!-- col-4 -->


        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Obrigatória escolha de <b>OPÇÕES</b> caso houver:</label>
                <select class="form-control" name="opcao_obrigatoria" required="required">
                    <?php
                      if($ln['opcao_obrigatoria']==1){
                        echo '<option value="1" selected>SIM</option>';
                        echo '<option value="0">NÃO</option>';
                      } else {
                        echo '<option value="0" selected>NÃO</option>';
                        echo '<option value="1">SIM</option>';                        
                      }
                    ?>
                </select>                
                <small>(*USADO APENAS EM CASOS DE COMBOS)</small>
           </div>
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