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
    <li class="breadcrumb-item active" aria-current="page">FISCAL</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    ARQUIVOS FISCAIS XML
  </h6>
</div>


<form method="post" action="controlers/fiscal/pesquisa_xml.php" id="PesquisaXML">
<div class="section-wrapper">
          

      <div class="form-layout">
      <div class="row row-xs ">


        
       <div class="col-md-3">
           <div class="form-group">
                <label for="exampleInputEmail1">Informe o mês/ano para pesquisar</label>
                <select class="form-control upper" name="mes_xml" required="required">
                    <option value="">-- ESCOLHA -- </option>
                    <option value="01">Janeiro</option>
                    <option value="02">Fevereiro</option>
                    <option value="03">Março</option>
                    <option value="04">Abril</option>
                    <option value="05">Maio</option>
                    <option value="06">Junho</option>
                    <option value="07">Julho</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </select>  
           </div>
        </div> 

       <div class="col-md-2">
           <div class="form-group">
                <label for="exampleInputEmail1">&nbsp;</label><br>
                <select class="form-control" name="ano_xml" required="required">
                    <?php
                      $ano = date("Y");
                      echo '<option value="'.$ano.'">'.$ano.'</option>';
                      echo '<option value="'.($ano-1).'">'.($ano-1).'</option>';
                    ?>
                </select>  
           </div>
        </div> 

        <div class="col-md-4">
        	<div class="form-group">
                <label for="exampleInputEmail1">&nbsp;</label><br>
        		<button type="submit" id="btn_pesquisa" class="btn btn-primary bd-0">PESQUISAR</button>     
        	</div>	
        </div>	


    </div><!-- row -->
	</div><!-- form-layout -->
             
  
</div>
</form>


<div class="section-wrapper top20 hide" id="resultado_pesquisa">
         
</div>



<?php require("../../includes/rodape.php"); ?>