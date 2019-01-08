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



        <div class="col-md-6">
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


        <div class="col-md-6">
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



        <div class="col-md-12">
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

                  <div id="collapseOne2" class="collapse <?php if($ln['modulo_fiscal']==1){ echo 'show'; } ?>" role="tabpanel" aria-labelledby="headingOne2">
                    
                    <div class="card-body" style="background-color: #FFF">
                           
                          <div class="row">  

                            <?php 
                              if($ln['modulo_fiscal']==0){ 
                                echo '<div class="col-md-12">'; 
                                  echo '<div class="alert alert-danger thin">';
                                    echo '<i class="icofont-exclamation-tringle"></i> ATIVE O MÓDULO FISCAL PARA EDITAR ESSAS INFORMAÇÕES';
                                  echo '</div>';
                                echo '</div>';
                              } else {

                                echo '<div class="col-md-12">'; 
                                  echo '<div class="alert alert-warning thin">';
                                    echo '<i class="icofont-exclamation-tringle"></i> MUITO CUIDADO AO ALTERAR AS INFORMAÇÕES ABAIXO';
                                  echo '</div>';
                                echo '</div>';

                              }
                            ?>
                            


                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="exampleInputEmail1">CNPJ Estabelecimento</label>
                                    <input type="number"  class="form-control" name="cnpj" <?php if($ln['modulo_fiscal']==0){ echo 'readonly'; } ?>   value="<?php echo $ln3['cnpj']; ?>">  
                               </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="exampleInputEmail1">IE Estabelecimento</label>
                                    <input  type="number" class="form-control" name="inscricao_estadual" <?php if($ln['modulo_fiscal']==0){ echo 'readonly'; } ?>   value="<?php echo $ln3['inscricao_estadual']; ?>">  
                               </div>
                            </div>


                            
                            <div class="col-md-8">
                               <div class="form-group">
                                    <label for="exampleInputEmail1">CNPJ Desenvolvedor</label>
                                    <input type="number"  class="form-control" name="cnpj_desenvolvedor" <?php if($ln['modulo_fiscal']==0){ echo 'readonly'; } ?> value="<?php echo $ln2['cnpj_desenvolvedor']; ?>">  
                               </div>
                            </div>

                            <div class="col-md-4">
                               <div class="form-group">
                                    <label for="exampleInputEmail1">Versão CFE</label>
                                    <input  class="form-control" name="versao_cfe" <?php if($ln['modulo_fiscal']==0){ echo 'readonly'; } ?> value="<?php echo $ln2['versao_cfe']; ?>">  
                               </div>
                            </div> 

                          </div>  


                          <div class="form-group">
                              <label for="exampleInputEmail1">Chave Software House</label>
                              <textarea name="chave_sat" class="form-control" style="height: 150px; resize: none;" <?php if($ln['modulo_fiscal']==0){ echo 'readonly'; } ?>><?php echo $ln2['chave_sat']; ?></textarea> 
                          </div>   


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