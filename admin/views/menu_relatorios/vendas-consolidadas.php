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
    <li class="breadcrumb-item active" aria-current="page">RELATÓRIOS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    VENDAS CONSOLIDADAS
  </h6>
</div>


<form method="post" action="relatorio-vendas-consolidadas">
<div class="section-wrapper">
          
	<label class="section-title">PERÍODO DE PESQUISA</label>

      <div class="form-layout">
            <div class="row">
          

          <div class="col-lg-3">          	  
              <div class="input-group">              	
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                  </div>
                </div>
                <input type="date" name="data_inicio" value="<?php if(isset($data_inicio)){echo $data_inicio;} ?>"  required="required" class="form-control">
              </div>
          </div>

          <div class="col-lg-3">              
              <div class="input-group">    
              <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                  </div>
                </div>          	
                <input type="date" name="data_fim" value="<?php if(isset($data_fim)){echo $data_fim;} ?>" required="required" class="form-control">
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
				        <th class="pd-y-5" width="110">Abertura</th>				        
				        <th class="pd-y-5" width="110">Final</th>
				        
                <th class="pd-y-5" >Troco </th>               
                <th class="pd-y-5" >Vendas</th>               
                <th class="pd-y-5" >Receb. Convênio</th>               
                <th class="pd-y-5" >Saídas</th>               
				        <th class="pd-y-5" >Balanço Final R$<br><small>(VENDAS+TROCO+RECE. CONV.) - (SAIDAS)</small></th>				        
				        <th class="pd-y-5" width="50"></th>                    	
                    </tr>
                  </thead>
                  <tbody>

                  	<?php   

				      	  if(!isset($data_inicio)  && !isset($data_fim) ){
				      	  	
				      	  		echo '<tr><td class="valign-middle upper" colspan="10"><center>UTILIZE A BUSCA ACIMA PARA FILTRAR.</center></td></tr>';

				      	  } else {		
				      	  	

					      	$sel = $db->select("SELECT caixa.*, usuarios.nome FROM caixa
						      LEFT JOIN usuarios ON caixa.id_usuario=usuarios.id 
						      WHERE caixa.data_abertura>='$data_inicio'  AND caixa.data_abertura<='$data_fim'
						      ORDER BY caixa.data_abertura DESC, caixa.hora_abertura DESC						      
						      ");   						     
							
									if($db->rows($sel)){

                    $soma_vendas=0;
                    $soma_saidas=0;
                    $soma_balanco=0;

										while($dados = $db->expand($sel)){

											$id_caixa_aberto = $dados['id'];	

                      $soma_vendas = ($soma_vendas+devolve_valores_caixa($id_caixa_aberto,0));
                      $soma_saidas = ($soma_saidas+devolve_saidas_caixa($id_caixa_aberto));
                      $soma_balanco = ($soma_balanco+devolve_final_caixa($id_caixa_aberto));

					  ?>
						     

						     <tr>
						        <td class="valign-middle upper">#<?php echo ($dados['id']); ?></td>
						        <td class="valign-middle upper"><?php echo data_mysql_para_user($dados['data_abertura']); ?> ás <?php echo substr($dados['hora_abertura'],0,5);?>hs</td>						        
						        <td class="valign-middle upper"><?php echo data_mysql_para_user($dados['data_fechamento']); ?> ás <?php echo substr($dados['hora_fechamento'],0,5);?>hs</td>						        
						        
                    

                    <td class="valign-middle upper">R$ <?php echo number_format(devolve_troco_caixa($id_caixa_aberto),2,".",","); ?></td>
                    
                    <td class="valign-middle upper">R$ <?php echo number_format(devolve_valores_caixa($id_caixa_aberto,99),2,".",","); ?></td>						        

                    <td class="valign-middle upper">R$ <?php echo number_format(devolve_valores_caixa($id_caixa_aberto,3),2,".",","); ?></td>                    

                    <td class="valign-middle upper">R$ <?php echo number_format(devolve_saidas_caixa($id_caixa_aberto),2,".",","); ?></td>


                    <td class="valign-middle upper">R$ <?php echo number_format(devolve_final_caixa($id_caixa_aberto),2,".",","); ?></td>
						        <td class="valign-middle upper">
						        	<a target="_blank" href="caixa-detalhes/<?php echo $dados['id']; ?>"><button class="btn btn-primary btn-sm">RELATÓRIO</button></a>	
						        </td>	
						      </tr>
						      
				      <?php
				      		}


                  echo '<tr>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    
                    echo '<td class="valign-middle upper"><h5>R$ '.number_format($soma_vendas,2,".",",").'</h5></td>';
                    echo '<td></td>';
                    echo '<td class="valign-middle upper"><h5>R$ '.number_format($soma_saidas,2,".",",").'</h5></td>';
                    
                    echo '<td></td>';
                    echo '<td></td>';
                  echo '</tr>';



					      } else {
					      	echo '<tr><td  class="valign-middle upper" colspan="10"><center>NENHUM CAIXA ENCONTRADO ENTRE AS DATAS!</center></td></tr>';
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