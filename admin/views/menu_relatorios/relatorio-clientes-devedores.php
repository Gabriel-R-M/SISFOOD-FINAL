<?php require("../../includes/topo.php"); ?>


<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">RELATÓRIOS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    CLIENTES DEVEDORES
  </h6>
</div>



<div class="row row-sm" >        
<div class="col-lg-12">
  <div class="card card-table">
  
             
              <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                  <thead>
                    <tr class="tx-10">
                    	<th class="pd-y-5" width="60">ID</th>
				        <th class="pd-y-5" >ÚLTIMA COMPRA</th>
                <th class="pd-y-5" >R$ DEVEDOR</th>
                <th class="pd-y-5" >CLIENTE</th>
                        
				        <th class="pd-y-5" width="50"></th>                    	
                    </tr>
                  </thead>
                  <tbody>

                  	<?php   


					      	$sel = $db->select("SELECT id_cliente, SUM(IF(tipo = '0', valor, 0)) AS divida, SUM(IF(tipo = '1', valor_recebe, 0)) AS recebido FROM contas_clientes GROUP BY id_cliente");
                  if($db->rows($sel)){
                  while($row = $db->expand($sel)) {

                     // echo 'id_cliente: '.$row['id_cliente'].'<br>';
                     // echo 'divida: '.$row['divida'].'<br>';
                     // echo 'recebido: '.$row['recebido'].'<br><br>';

                      $diferenca = ($row['divida']-$row['recebido']);
                      if($diferenca<0){$diferenca=0;}

                      if($diferenca!=0 && $diferenca!='0.00'){

                          $id_cliente = $row['id_cliente'];
                          $pl = $db->select("SELECT nome FROM clientes WHERE id='$id_cliente' LIMIT 1");
                          $hg = $db->expand($pl);
                          $name = $hg['nome'];

                          $pk = $db->select("SELECT data_pedido FROM aguarda_venda WHERE id_cliente='$id_cliente' LIMIT 1"); 
                          $nnm = $db->expand($pk);

                          if($name!=''){
                      ?>    

                      
                        <tr>
                        <td class="valign-middle upper">#<?php echo ($row['id_cliente']); ?></td>
                        <td class="valign-middle upper"><?php echo data_mysql_para_user($nnm['data_pedido']); ?></td>                                          
                        <td class="valign-middle upper">R$ <?php echo number_format($diferenca,2,".",","); ?></td>
                        
                        <td class="valign-middle upper"><?php echo ($name); ?></td>

                        <td class="valign-middle upper">
                          <a target="_blank" href="views/menu_relatorios/pdf/dividas-detalhes.php?id=<?php echo $id_cliente; ?>"><button class="btn btn-primary btn-sm">RELATÓRIO</button></a>  
                        </td> 
                      </tr>

                      <?php
                    }
                      }


                  }  						     
							
									} else {
              ?>   

                  
                  <tr><td colspan="20" align="center">NENHUM CLIENTE DEVEDOR ENCONTRADO.</td></tr>  


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