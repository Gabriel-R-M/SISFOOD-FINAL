<?php require("../../includes/topo.php"); ?>



<?php
  $sql = $db->select("SELECT * FROM formas_pagamento");  
  while($ln = $db->expand($sql)){

  		if($ln['id']==1){
  			$ativo_dinheiro = $ln['ativo'];	
  		}

  		if($ln['id']==2){
  			$ativo_cartao = $ln['ativo'];	
  		}

  		if($ln['id']==3){
  			$ativo_crediario = $ln['ativo'];	
  		}

      if($ln['id']==10){
        $ativo_aiqfome = $ln['ativo'];  
      }

      if($ln['id']==11){
        $ativo_ifood = $ln['ativo'];  
      }
  		
  }
?> 

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">FORMAS DE PAGAMENTO</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    FORMAS DE PAGAMENTO
  </h6>
</div>


<form method="post" action="formas-pgto/save">
<div class="section-wrapper">
          

      <div class="form-layout">
            <div class="row mg-b-25">
              
        
 

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">
                	Receber em: <b>Dinheiro</b>
                </label>
                <select class="form-control" name="dinheiro" required="required">
                    <?php
                      if($ativo_dinheiro==1){
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
                <label for="exampleInputEmail1">
                	Receber em: <b>Cartão</b>
                </label>
                <select class="form-control" name="cartao" required="required">
                    <?php
                      if($ativo_cartao==1){
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
                <label for="exampleInputEmail1">
                  Receber no: <b>Crediário</b>
                </label>
                <select class="form-control" name="crediario" required="required">
                    <?php
                      if($ativo_crediario==1){
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


        <div class="col-md-12"><hr></div>


        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">
                	Receber com: <b>APP AiqFome</b>
                </label>
                <select class="form-control" name="aiqfome" required="required">
                    <?php
                      if($ativo_aiqfome==1){
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
                <label for="exampleInputEmail1">
                  Receber com: <b>APP Ifood</b>
                </label>
                <select class="form-control" name="ifood" required="required">
                    <?php
                      if($ativo_ifood==1){
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