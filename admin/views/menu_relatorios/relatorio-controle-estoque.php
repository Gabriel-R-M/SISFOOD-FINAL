<?php 
require("../../includes/topo.php"); 
$sql = $db->select("SELECT controla_estoque FROM configuracoes");  
$config = $db->expand($sql);
$disabled='';
if($config['controla_estoque']==0){ 
	$disabled='disabled';	
}
?>


<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">RELATÓRIOS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    CONTROLE DE ESTOQUE
  </h6>
</div>


<?php 
if($config['controla_estoque']==0){ 
	echo '<div class="row">'; 	
		echo '<div class="col-md-12">'; 
	    	echo '<div class="alert alert-danger thin">';
	        	echo '<i class="icofont-exclamation-tringle"></i> O CONTROLE DE ESTOQUE ESTÁ DESATIVADO.';
	        echo '</div>';
		echo '</div>';
	echo '</div>';	
} 
?>



<form method="post" action="relatorio-controle-estoque">
<div class="section-wrapper">
          
  <label class="section-title">PESQUISA DE PRODUTOS</label>

      <div class="form-layout">
            <div class="row row-xs">
          
          <input type="hidden" name="pesquisa" value="1">

    

         <div class="col-lg-4 top10">              
              <div class="input-group">

              <input type="text" name="nome" class="form-control" placeholder="PESQUISE PELO NOME" value="<?php if (isset($nome)){echo $nome;} ?>">               
                
              </div>
         </div>


         <div class="col-lg-3 top10">              
              <div class="input-group">

              <select class="form-control select2 upper" name="categoria">
                      <?php
                        if (isset($nome) && $categoria!=''){
                                                    
                          $sql = $db->select("SELECT * FROM categorias WHERE id='$categoria' LIMIT 1");
                          $row = $db->expand($sql);
                          echo '<option value="'.$row['id'].'" selected>'.$row['categoria'].'</option>';

                          $sql = $db->select("SELECT * FROM categorias WHERE id!='$categoria' ORDER BY categoria");
                          while($row = $db->expand($sql)){
                            echo '<option value="'.$row['id'].'">'.$row['categoria'].'</option>';
                          }
                          

                        } else {

                            echo '<option value="">-- escolha a categoria --</option>';
                            $sql = $db->select("SELECT * FROM categorias ORDER BY categoria");
                            while($row = $db->expand($sql)){
                              echo '<option value="'.$row['id'].'">'.$row['categoria'].'</option>';
                            }

                        }
                      ?>
                  </select>     
                
              </div>
         </div>

         <div class="col-lg-2 top10">              
              <div class="input-group">

              <select class="form-control select2 upper" name="tipo">
                      <?php
                        if (isset($nome)){
                          
                          if($tipo==''){
							echo '<option value="">-- tipo --</option>';
                            echo '<option value="0">NEGATIVO</option>';
                            echo '<option value="1">POSITIVO</option>';                          	
                          } else if($tipo==0){                          	
                            echo '<option value="0" selected>NEGATIVO</option>';
                            echo '<option value="1">POSITIVO</option>';
                            echo '<option value="">-- tipo --</option>';
                          } else if($tipo==1){                          	
                            echo '<option value="0">NEGATIVO</option>';
                            echo '<option value="1" selected>POSITIVO</option>';
                            echo '<option value="">-- tipo --</option>';
                          }	

                        } else {

                            echo '<option value="">-- tipo --</option>';
                            echo '<option value="0">NEGATIVO</option>';
                            echo '<option value="1">POSITIVO</option>';

                        }
                      ?>
                  </select>     
                
              </div>
         </div>


         <div class="col-lg-3 top10">  
          <button type="submit" class="btn btn-primary  bd-0">PESQUISAR</button> 
          <a href="relatorio-controle-estoque"><button type="button" class="btn btn-primary  bd-0">LIMPAR</button> </a>
         </div> 


      </div><!-- row -->
  </div><!-- form-layout -->         
  
</div>
</form>



<div class="row row-sm" >        
<div class="col-lg-12 top20">
  <div class="card card-table">
  
             
              <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                  <thead>
                    <tr class="tx-10">
                    	<th class="pd-y-5" width="60">ID</th>
				        <th class="pd-y-5" >PRODUTO</th>
                		<th class="pd-y-5" width="130">ESTOQUE ATUAL</th>
                		
                		<th class="pd-y-5" width="180"></th>                    	

				        <th class="pd-y-5" width="50"></th>                    	
                    </tr>
                  </thead>
                  <tbody>

                  	<?php   	

                  	if (isset($nome)){

                  		

                  		$q1='';
                  		$q2='';
                  		$q3='';

                  		if($nome!=''){$q1=" AND produto LIKE '%$nome%'";}
                  		if($categoria!=''){$q2=" AND categoria='$categoria'";}
                  		if($tipo!=''){

                  				if($tipo==1){
                  					$q3=" AND estoque>'0'";
                  				} else if($tipo==0){
                  					$q3=" AND estoque<='0'";
                  				}

                  		}

                  		

                  		$sel = $db->select("SELECT id, produto, estoque FROM lanches 
                  			WHERE id!='0' $q1 $q2 $q3
                  			ORDER BY categoria, produto");
                  	

                  	} else {
                  		$sel = $db->select("SELECT id, produto, estoque FROM lanches ORDER BY categoria, produto");	
                  	}

					
                  
                  	if($db->rows($sel)){
                  		while($row = $db->expand($sel)) {
                    ?>    

                      
                        <tr>
                        <td class="valign-middle upper">#<?php echo ($row['id']); ?></td>
                        
                        <td class="valign-middle upper"><?php echo ($row['produto']); ?></td>

                        <td class="valign-middle upper" align="center">
                        	<input style="text-align: center; border:0" type="text" disabled id="estoque_<?php echo ($row['id']); ?>" value="<?php echo ($row['estoque']); ?>">
                        </td>

                        <td class="valign-middle upper">
                         	
                         	<div class="input-group">
                               <span class="input-group-btn">
                                <button <?php echo $disabled; ?> onclick="javascript:ajuste_estoque(1,<?php echo ($row['id']); ?>);" class="btn bd bd-r-0 btn-default btn-sm tx-gray-600 " type="button"><i class="icofont-plus"></i></button>                               
                              </span>
                              <input <?php echo $disabled; ?> type="number"  class="form-control text-center" id="novo_estoque_<?php echo ($row['id']); ?>"  style="height: 28px">  
                              <span class="input-group-btn">
                                <button <?php echo $disabled; ?> onclick="javascript:ajuste_estoque(0,<?php echo ($row['id']); ?>);" class="btn bd bd-l-0 btn-default btn-sm tx-gray-600 0" type="button"><i class="icofont-minus"></i></button>                               
                              </span>

                            </div>
                        </td> 

                        <td class="valign-middle upper">
                          <a href="javascript:void(0)" onclick="javascript:modal_relatorio(<?php echo ($row['id']); ?>)"><button class="btn btn-primary btn-sm">RELATÓRIO</button></a>  
                        </td> 
                      </tr>

                    
                    <?php                    
                      }
					  						     				
					} else {
              		?>   

                  		<tr><td colspan="20" align="center">NENHUM PRODUTO ENCONTRADO ENCONTRADO.</td></tr>  
					
					<?php
                  		}
					?>
						     

						     
						  
                  
                
                  </tbody>
                </table>
              </div>
              
             
  </div>
</div>
</div>

<?php require("../../includes/rodape.php"); ?>