<?php require("../../includes/topo.php"); ?>


<div class="slim-pageheader">
  <a href="nova-opcao"><button type="button" class="btn btn-primary  pull-right">NOVA OPÇÃO</button></a>
  <h6 class="slim-pagetitle">LISTAGEM DE OPÇÕES</h6>
</div><!-- slim-pageheader -->


<div class="row row-sm">        
<div class="col-lg-12">
  <div class="card card-table">
  
              <div class="card-header">
                <h6 class="slim-card-title">OPÇÕES CADASTRADAS</h6>
              </div>
              

              <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                  <thead>
                    <tr class="tx-10">
                    	<th class="pd-y-5" width="20">CÓD</th>
                      <th class="pd-y-5">OPÇÃO</th>                      
                      <th class="pd-y-5">VALOR</th>
                      <th class="pd-y-5"></th>
                      <th class="pd-y-5 tx-center"></th>
                    </tr>
                  </thead>
                  <tbody>

                <?php
                 $sel = $db->select("SELECT * FROM opcionais2 ORDER BY opcional2");
                
                if($db->rows($sel)){
                  $x=1; 
                  while($yy = $db->expand($sel)){  
                  

                  	$ativo = ativo_produto($yy['ativo']);

                ?>    

                    <tr>
                     
                      <td class="valign-middle upper"><?php if($yy['id']<10){echo '0';} echo $yy['id']; ?></td>	
                      <td class="valign-middle upper">
                      		<?php 
                      			echo $yy['opcional2'].'<br>'; 

                      			$id_categoria = $yy['id_categoria'];	
                      			$id_produto = $yy['id_produto'];	

                      			//HABILITADO PARA CATEGORIAS//
                      			if(!empty($yy['id_categoria'])){

    	                      			//APENAS UMA CATEGORIA//	
    	                      			if(is_numeric($yy['id_categoria'])){

                										$pg = $db->select("SELECT categoria FROM categorias WHERE id='$id_categoria' LIMIT 1");
                										$var = $db->expand($pg);
                										$categoria_name = $var['categoria'];
                										
                									//MAIS DE UMA CATEGORIA//	
                									} else {											
                										$categoria_name='';
                										$prods = explode(',', $yy['id_categoria']);	
                										foreach($prods as $prod) {

                									    	$id_categoria = trim($prod);		    	

                									    	$pg = $db->select("SELECT categoria FROM categorias WHERE id='$id_categoria' LIMIT 1");										
                											$var = $db->expand($pg);											

                											$categoria_name .= $var['categoria'].'/';
                										}
                									}	


                									//REMOVE A ULTIMA BARRA
                									$final = substr($categoria_name, -1);
                									if($final=='/'){
                										$size = strlen($categoria_name);
                										$categoria_name = substr($categoria_name,0, $size-1);
                									}	

            									    echo '<small><b>CATEGORIAS:</b> ['.$categoria_name.']</small><br>';

            								}





            								  //HABILITADO PARA PRODUTOS//
                              if(!empty($yy['id_produto'])){

                	                //APENAS UM PRODUTO//	
                	                if(is_numeric($yy['id_produto'])){

                										$pg = $db->select("SELECT produto FROM lanches WHERE id='$id_produto' LIMIT 1");
                										$var = $db->expand($pg);
                										$produto_name = $var['produto'];
                										
                									//MAIS DE UM PRODUTO//	
                									} else {											
                										$produto_name = '';
                										$prods = explode(',', $yy['id_produto']);	
                										foreach($prods as $prod) {

                									    	$id_produto = trim($prod);		    	

                									    	$pg = $db->select("SELECT produto FROM lanches WHERE id='$id_produto' LIMIT 1");										
                											$var = $db->expand($pg);											

                											$produto_name .= $var['produto'].' - ';
                									}
                							}	


                									//REMOVE A ULTIMA BARRA
                									$final = substr($produto_name, -1);
                									if($final==' '){
                										$size = strlen($produto_name);
                										$produto_name = substr($produto_name,0, $size-3);
                									}	

            									    echo '<small><b>PRODUTOS HABILITADOS:</b><BR> ['.$produto_name.']</small>';
                                  
            								}


																


                      		?>                      		
                      </td>
                      
                     
                      <td class="valign-middle upper"><?php echo valores($yy['valor_opcional2']); ?></td>

					<td class="valign-middle">                                              
                        	<?php echo $ativo; ?>
                      </td>


                      <td class="valign-middle tx-center">
                        <a href="#" data-toggle="dropdown" class="tx-gray-600 tx-24">
                          <i class="icon ion-android-more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu">
                          <nav class="nav dropdown-nav">
                            <a href="opcoes/edit/<?php echo $yy['id']; ?>"  class="nav-link"><i class="icon ion-edit"></i> Editar Ítem</a>
                            <a href="opcoes/delete/<?php echo $yy['id']; ?>" class="nav-link"><i class="icon ion-android-delete"></i> Excluir Ítem</a>                            
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