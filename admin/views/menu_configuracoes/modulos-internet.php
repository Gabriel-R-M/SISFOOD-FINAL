<?php require("../../includes/topo.php"); ?>

<?php
  $sql = $db->select("SELECT * FROM configuracoes");  
  $ln = $db->expand($sql);

  $sql2 = $db->select("SELECT * FROM sistema");  
  $ln2 = $db->expand($sql2);
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">GERAIS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    PEDIDOS WEB
  </h6>
</div>


<form method="post" action="modulos-internet/save">
<div class="section-wrapper">
          

      <div class="form-layout">
            <div class="row mg-b-25">

        <div class="col-md-12">    	
	        <div class="alert alert-warning">
			  Para ativação do módulo de internet, contate o suporte, para habilitação da conta junto ao servidor. Não basta apenas ativar o módulo aqui no sistema.
			</div>    	
		</div>	

        <div class="col-md-4 top10">
           <div class="form-group">
                <label for="exampleInputEmail1">Ativar Módulo de Pedidos Web</label>
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


        <div class="col-md-8 top10">
           <div class="form-group">
                <label for="exampleInputEmail1">URL do Servidor de Pedidos</label>
                <input class="form-control" name="url_servidor_pedidos" value="<?php echo $ln2['url_servidor_pedidos']; ?>" <?php if($ln['modulo_internet']==0){ echo 'readonly'; }?>>        
                <small>* http://seudominio.com.br/webservice</small>            
           </div>
        </div> 





        






       


            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button>              


              <?php if($ln['modulo_internet']==1){ ?>
                <a href="atualiza-servidor-web"><button type="button" class="btn btn-warning bd-0 pull-right">ATUALIZAR SERVIDOR WEB</button></a>              
              <?php } ?>  

            </div><!-- form-layout-footer -->




          </div><!-- form-layout -->
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>