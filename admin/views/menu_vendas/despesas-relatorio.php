<?php require("../../includes/topo.php"); ?>

<?php
  $sql = $db->select("SELECT * FROM configuracoes");  
  $ln = $db->expand($sql);

  $sql2 = $db->select("SELECT * FROM mesas");  
  $ln2 = $db->expand($sql2);
?>

<div class="slim-pageheader">
  <a href="despesas-nova"><button type="button" class="btn btn-primary  pull-right">NOVA DESPESA</button></a>
  <h6 class="slim-pagetitle upper">
    RELATÓRIO DE DESPESAS
  </h6>
</div>


<form method="post" action="despesas-relatorio">
<div class="section-wrapper">
          
	<label class="section-title">FILTROS DA PESQUISA</label>

      <div class="form-layout">
            <div class="row row-xs">
          
          <div class="col-lg-3">          	  
              <div class="input-group">              	
                
                <select class="form-control" style="height: 44px" name="categoria">
                	<?php

                		if(isset($categoria) && !empty($categoria)){
                			$sql = $db->select("SELECT * FROM categorias_despesas WHERE id='$categoria' LIMIT 1");	
		                	$line = $db->expand($sql);
		                	echo '<option value="'.$line['id'].'" selected>'.$line['categoria'].'</option>';				                		
                		}

                		echo '<option value="0">-------- categoria ------</option>';
	                	$sql = $db->select("SELECT * FROM categorias_despesas ORDER BY categoria");	
	                	while($line = $db->expand($sql)){
	                		echo '<option value="'.$line['id'].'">'.$line['categoria'].'</option>';		
	                	}
                	?>	
                </select>

              </div>
          </div>

          <div class="col-lg-3">          	  
              <div class="input-group">              	
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                  </div>
                </div>
                <input type="date" name="data_inicio" value="<?php if(isset($data_inicio)){echo $data_inicio;} ?>"  class="form-control">
              </div>
          </div>

          <div class="col-lg-3">              
              <div class="input-group">    
              <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                  </div>
                </div>          	
                <input type="date" name="data_fim" value="<?php if(isset($data_fim)){echo $data_fim;} ?>" class="form-control">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit" style="height: 45px"><i class="fa fa-search"></i></button>
                </span>
              </div>
         </div>


     	</div><!-- row -->
	</div><!-- form-layout -->         
  
</div>
</form>




<div class="row row-sm" style="margin-top: 15px">        
<div class="col-lg-12">
  <div class="card card-table">
  
             
              <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                  <thead>
                    <tr class="tx-10">
                    	<th class="pd-y-5" width="60">ID</th>
				        <th class="pd-y-5" width="190">Data/Hora</th>				        				        				        
                		<th class="pd-y-5">Descrição</th>               
                		
                		<th class="pd-y-5">Categoria</th>               
                		<th class="pd-y-5">Valor R$</th>               
                	        
				        <th class="pd-y-5" width="60"></th>                    	
                    </tr>
                  </thead>
                  <tbody>

                  	<?php   

				      	  if(!isset($data_inicio)  || !isset($data_fim) || !isset($categoria) ){
				      	  	
				      	  		echo '<tr><td class="valign-middle upper" colspan="10"><center>UTILIZE A BUSCA ACIMA PARA FILTRAR.</center></td></tr>';

				      	  } else {	

				      	  	$busca1='';
				      	  	$busca2='';
				      	  	$busca3='';	

				      	  	if(isset($data_inicio) && !empty($data_inicio)){
				      	  		$busca1 = " AND despesas.data>='$data_inicio'";
				      	  	}

				      	  	if(isset($data_fim) && !empty($data_fim)){
				      	  		$busca2 = " AND despesas.data<='$data_fim'";
				      	  	}
				      	  	
				      	  	if(isset($categoria) && !empty($categoria)){
				      	  		$busca3 = " AND despesas.categoria='$categoria'";
				      	  	}

					      	$sel = $db->select("SELECT despesas.*, categorias_despesas.categoria AS nome_cat FROM despesas
						      LEFT JOIN categorias_despesas ON despesas.categoria=categorias_despesas.id 
						      WHERE despesas.id!='0' $busca1 $busca2 $busca3
						      ORDER BY despesas.data DESC, despesas.hora DESC						      
						      ");   						     
							
							if($db->rows($sel)){
								$soma = 0;
								while($dados = $db->expand($sel)){

								$soma = ($soma+$dados['valor']);	
							
					  ?>
						     

						     <tr>
						        <td class="valign-middle upper">#<?php echo ($dados['id']); ?></td>
						        <td class="valign-middle upper"><?php echo data_mysql_para_user($dados['data']); ?> ás <?php echo substr($dados['hora'],0,5);?>hs</td>						        
						        
                   
			                    <td class="valign-middle thin upper"><?php echo ($dados['descricao']); ?></td>
			                    
			                    <td class="valign-middle thin upper"><?php echo ($dados['nome_cat']); ?></td>						        

			                    <td class="valign-middle upper">R$ <?php echo number_format($dados['valor'],2,".",","); ?></td>


                    			 <td class="valign-middle tx-center">
			                        <a href="#" data-toggle="dropdown" class="tx-gray-600 tx-24">
			                          <i class="icon ion-android-more-horizontal"></i>
			                        </a>
			                        <div class="dropdown-menu">
			                          <nav class="nav dropdown-nav">
			                            <a href="despesas/edit/<?php echo $dados['id']; ?>"  class="nav-link"><i class="icon ion-edit"></i> Editar Ítem</a>
			                            <a href="despesas/delete/<?php echo $dados['id']; ?>" class="nav-link"><i class="icon ion-android-delete"></i> Excluir Ítem</a>                            
			                          </nav>
			                        </div>
			                      </td>

						     </tr>
						      
				      <?php
				      		}

				      		echo '<tr>';
				      			echo '<td></td>';
				      			echo '<td></td>';
				      			echo '<td></td>';
				      			echo '<td align="right"><h5>TOTAL:</h5></td>';
				      			echo '<td class="valign-middle upper"><h5>R$ '.number_format($soma,2,".",",").'</h5></td>';
				      			echo '<td></td>';
				      		echo '</tr>';
					      
					      } else {
					      	echo '<tr><td  class="valign-middle upper" colspan="10"><center>NENHUMA DESPESA ENCONTRADA!</center></td></tr>';
					      }

					    }  
				      ?>

                  
                
                  </tbody>
                </table>
              </div>
              
             
  </div>
</div>
</div>

<?php require("../../includes/rodape.php"); ?>