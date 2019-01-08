<?php require("../../includes/topo.php"); ?>


<div class="slim-pageheader">
  <a href="novo-adicional"><button type="button" class="btn btn-primary  pull-right">NOVO ADICIONAL</button></a>
  <h6 class="slim-pagetitle">LISTAGEM DE ADICIONAIS</h6>
</div><!-- slim-pageheader -->


<div class="row row-sm">        
<div class="col-lg-12">
  <div class="card card-table">
  
              <div class="card-header">
                <h6 class="slim-card-title">ADICIONAIS CADASTRADOS</h6>
              </div>
              

              <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                  <thead>
                    <tr class="tx-10">
                    	<th class="pd-y-5" width="20">CÓD</th>
                      <th class="pd-y-5">ADICIONAL</th>                      
                      <th class="pd-y-5">VALOR</th>
                      <th class="pd-y-5"></th>
                      <th class="pd-y-5 tx-center"></th>
                    </tr>
                  </thead>
                  <tbody>

                <?php
                 $sel = $db->select("SELECT * FROM opcionais ORDER BY opcional");
                
                if($db->rows($sel)){
                  $x=1; 
                  while($yy = $db->expand($sel)){  
                  

                  	$ativo = ativo_produto($yy['ativo']);

                ?>    

                    <tr>
                     
                      <td class="valign-middle upper"><?php if($yy['id']<10){echo '0';} echo $yy['id']; ?></td>	
                      <td class="valign-middle upper"><?php echo $yy['opcional']; ?></td>
                      
                     
                      <td class="valign-middle upper"><?php echo valores($yy['valor']); ?></td>

					<td class="valign-middle">                                              
                        	<?php echo $ativo; ?>
                      </td>


                      <td class="valign-middle tx-center">
                        <a href="#" data-toggle="dropdown" class="tx-gray-600 tx-24">
                          <i class="icon ion-android-more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu">
                          <nav class="nav dropdown-nav">
                            <a href="adicionais/edit/<?php echo $yy['id']; ?>"  class="nav-link"><i class="icon ion-edit"></i> Editar Ítem</a>
                            <a href="adicionais/delete/<?php echo $yy['id']; ?>" class="nav-link"><i class="icon ion-android-delete"></i> Excluir Ítem</a>                            
                          </nav>
                        </div>
                      </td>
                    </tr>


                  
                  <?php
                    }
                  }
                  ?>  

                  </tbody>
                </table>
              </div><!-- table-responsive -->
              
             
  </div>
</div>
</div>

<?php require("../../includes/rodape.php"); ?>