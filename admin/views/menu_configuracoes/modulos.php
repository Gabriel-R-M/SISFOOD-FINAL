<?php require("../../includes/topo.php"); ?>

<?php
  $sql = $db->select("SELECT * FROM configuracoes");  
  $ln = $db->expand($sql);

  $sql2 = $db->select("SELECT * FROM fiscal");  
  $ln2 = $db->expand($sql2);

  $sql3= $db->select("SELECT * FROM dados_loja");  
  $ln3= $db->expand($sql3);


?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">GERAIS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    CONFIGURAÇÕES GERAIS
  </h6>
</div>


<form method="post" action="modulos/save">
<div class="section-wrapper">
          

      <div class="form-layout">
            <div class="row mg-b-25">


        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Ativar Módulo de Controle de Entregas</label>
                <select class="form-control" name="modulo_entregas" required="required">
                    <?php
                      if($ln['modulo_entregas']==1){
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



   


            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button>              
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>