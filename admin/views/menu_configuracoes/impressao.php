<?php require("../../includes/topo.php"); ?>

<?php
  $sql = $db->select("SELECT * FROM dados_loja LIMIT 1");  
  $ln = $db->expand($sql);

  $sql2 = $db->select("SELECT * FROM configuracoes");  
  $ln2 = $db->expand($sql2);
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">IMPRESSÃO</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    CONFIGURAÇÕES DE IMPRESSÃO
  </h6>
</div>


<form method="post" action="impressao/save">
<div class="section-wrapper">
      
    

      <div class="form-layout">
            <div class="row mg-b-25">
              
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Cabeçalho Nota Linha 01: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="cabecalho_linha01" required="required" value="<?php echo $ln['cabecalho_linha01']; ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Cabeçalho Nota Linha 02: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="cabecalho_linha02" required="required" value="<?php echo $ln['cabecalho_linha02']; ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Cabeçalho Nota Linha 03: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="cabecalho_linha03" required="required"  value="<?php echo $ln['cabecalho_linha03']; ?>">
                </div>
              </div><!-- col-4 -->




        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Primeira Impressão</label>
                <select class="form-control select2" name="primeira_impressao" required="required">
                    <?php
                      if($ln2['primeira_impressao']=='IGUAIS'){
                        echo '<option value="IGUAIS" selected>IGUAIS NAS DUAS IMPRESSORAS</option>';
                        echo '<option value="PICADA">COMPLETA NO CAIXA E SEPARADA NA COZ.</option>';
                      } else if($ln2['primeira_impressao']=='PICADA'){
                        echo '<option value="PICADA" selected>COMPLETA NO CAIXA E SEPARADA NA COZ.</option>';
                        echo '<option value="IGUAIS">IGUAIS NAS DUAS IMPRESSORAS</option>';                        
                      } else {
                        echo '<option value="IGUAIS" selected>IGUAIS NAS DUAS IMPRESSORAS</option>';
                        echo '<option value="PICADA">COMPLETA NO CAIXA E SEPARADA NA COZ.</option>';
                      }
                    ?>
                </select>  
           </div>
        </div>
        

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Imprimir Endereço Cozinha</label>
                <select class="form-control" name="imprimir_endereco_entrega_cozinha" required="required">
                    <?php
                      if($ln2['imprimir_endereco_entrega_cozinha']==1){
                        echo '<option value="1" selected>SIM</option>';
                        echo '<option value="0">NÃO</option>';
                      } else {
                        echo '<option value="0" selected>NÃO</option>';
                        echo '<option value="1">SIM</option>';                        
                      }
                    ?>
                </select>  
           </div>
        </div>


        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Impressão de Ítem Avulso</label>
                <select class="form-control select2" name="impressao_avulsa_item" required="required">
                    <?php
                      if($ln2['impressao_avulsa_item']=='JUNTO APENAS UMA VEZ'){
                        echo '<option value="JUNTO APENAS UMA VEZ" selected>JUNTO APENAS UMA VEZ</option>';
                        echo '<option value="ITEM A ITEM" >ÍTEM A ÍTEM</option>';                                                
                      } else {
                        echo '<option value="ITEM A ITEM" selected>SEPARADO ÍTEM A ÍTEM</option>';
                        echo '<option value="JUNTO APENAS UMA VEZ">JUNTO APENAS UMA VEZ</option>';                       
                      }
                    ?>
                </select>  
           </div>
        </div>


            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button>              
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>