<?php require("../../includes/topo.php"); ?>

<?php
  $sql = $db->select("SELECT * FROM configuracoes");  
  $ln = $db->expand($sql);
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">GERAIS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    SISTEMA DE PONTUAÇÃO
  </h6>
</div>


<form method="post" action="sistema-pontuacao/save">
<div class="section-wrapper">
          

      <div class="form-layout">
            <div class="row mg-b-25">
              
       
                     <div class="col-md-3">
                       <div class="form-group">
                            <label for="exampleInputEmail1">Ativar Sistema de Pontuação</label>
                            <select class="form-control" name="modulo_pontuacao" required="required">
                                <?php
                                  if($ln['modulo_pontuacao']==1){
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


                    <div class="col-md-3">
                       <div class="form-group">
                            <label for="exampleInputEmail1">Valor gasto em R$ para 1 ponto</label>
                            <input type="text" class="form-control valores" name="valor_real_ponto"  value="<?php echo $ln['valor_real_ponto']; ?>"/>
                       </div>
                    </div>


                    <div class="col-md-3">
                       <div class="form-group">
                            <label for="exampleInputEmail1">Equivalencia PONTO/R$ para troca</label>
                            <input type="text" class="form-control valores" name="valor_ponto_troca"  value="<?php echo $ln['valor_ponto_troca']; ?>"/>
                       </div>
                    </div>

                    <div class="col-md-3">
                       <div class="form-group">
                            <label for="exampleInputEmail1">Dias p/ Expirar Pontos</label>
                            <input type="number" class="form-control" name="dias_expira_pontos"  value="<?php echo $ln['dias_expira_pontos']; ?>" maxlenght="2" />
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