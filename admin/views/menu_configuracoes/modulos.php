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
    CONFIGURAÇÕES GERAIS
  </h6>
</div>


<form method="post" action="modulos/save">
<div class="section-wrapper">
          

      <div class="form-layout">
            <div class="row mg-b-25">



        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Ativar Módulo de Internet</label>
                <select class="form-control" name="modulo_internet" required="required">
                    <?php
                      if($ln['modulo_internet']==1){
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

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Ativar Módulo Fiscal</label>
                <select class="form-control" name="modulo_fiscal" required="required">
                    <?php
                      if($ln['modulo_fiscal']==1){
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



        <div class="col-md-12">

              <div id="accordion2" class="accordion-two accordion-two-primary" role="tablist" aria-multiselectable="true">
                <div class="card">
                  <div class="card-header" role="tab" id="headingOne2">
                    <a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2" class="tx-gray-800 transition">
                      Configurações Módulo Fiscal
                    </a>
                  </div><!-- card-header -->

                  <div id="collapseOne2" class="collapse show" role="tabpanel" aria-labelledby="headingOne2">
                    
                    <div class="card-body" style="background-color: #FFF">
                           
                            


                    </div>

                  </div>
                </div>
                
              </div><!-- accordion -->

          </div>








       


            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button>              
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>