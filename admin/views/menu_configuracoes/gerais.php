<?php require("../../includes/topo.php"); ?>

<?php
  $sql = $db->select("SELECT * FROM configuracoes");  
  $ln = $db->expand($sql);

  $sql2 = $db->select("SELECT * FROM mesas");  
  $ln2 = $db->expand($sql2);
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


<form method="post" action="gerais/save">
<div class="section-wrapper">
          

      <div class="form-layout">
            <div class="row mg-b-25">
              
        
        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Senha de Cancelamento</label>
                <input type="text" class="form-control" name="senha_cancelamento" required="required" value="<?php echo $ln['senha_cancelamento']; ?>"/>
           </div>
        </div>


        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Quantidade de Mesas</label>
                <input type="text" class="form-control" name="mesa"  value="<?php echo $ln2['mesa']; ?>"/>
           </div>
        </div> 

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Escolher motoqueiro ao finalizar pedido?</label>
                <select class="form-control" name="escolhe_motoqueiro" required="required">
                    <?php
                      if($ln['escolhe_motoqueiro']==1){
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
                <label for="exampleInputEmail1">Ordem de exibição dos produtos:</label>
                <select class="form-control" name="ordem_exibicao_produtos" required="required">
                    <?php
                      if($ln['ordem_exibicao_produtos']=='' || $ln['ordem_exibicao_produtos']=='codigo'){
                        echo '<option value="codigo" selected>CÓDIGO</option>';
                        echo '<option value="nome">NOME</option>';
                      } else {
                        echo '<option value="nome" selected>NOME</option>';
                        echo '<option value="codigo">CÓDIGO</option>';                        
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