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
    PRODUTOS VENDIDOS
  </h6>
</div>


<form method="post" action="relatorio-produtos-vendidos">
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
                    	<th class="pd-y-5" width="30">QTD</th>
                      	<th class="pd-y-5">PRODUTO</th>                                                                  
                    </tr>
                  </thead>
                  <tbody>

                  	<?php   

				      	  if(!isset($data_inicio)  && !isset($data_fim) ){
				      	  	
				      	  		echo '<tr><td class="valign-middle upper" colspan="10"><center>UTILIZE A BUSCA ACIMA PARA FILTRAR.</center></td></tr>';

				      	  } else {		
				      	  	

					      	$sel = $db->select("SELECT SUM(produtos_venda.quantidade) AS total, produtos_venda.*, aguarda_venda.id 
					      		FROM produtos_venda
					      		LEFT JOIN aguarda_venda ON produtos_venda.id_venda=aguarda_venda.id
						      WHERE aguarda_venda.data_pedido>='$data_inicio'  AND aguarda_venda.data_pedido<='$data_fim'
						      
						      GROUP BY id_produtos      
						      ");
							
									if($db->rows($sel)){
										while($px = $db->expand($sel)){

											$id_produto = $px['id_produtos'];
											

											if(is_numeric($id_produto)){

												$pg = $db->select("SELECT produto FROM lanches WHERE id='$id_produto' LIMIT 1");
												$var = $db->expand($pg);
												$nome_produto= $var['produto'];
												

											//MEIO A MEIO	
											} else {	

												$nome_produto='';
												$prods = explode(',', $id_produto);	
												foreach($prods as $prod) {

											    	$id_produto = trim($prod);		    	

											    	$pg = $db->select("SELECT produto FROM lanches WHERE id='$id_produto' LIMIT 1");
													$var = $db->expand($pg);
													
													$nome_produto= $nome_produto.$var['produto'].'/';

												}
												

											}	

											//REMOVE A ULTIMA VIRGULA
											$final = substr($nome_produto, -1);
											if($final=='/'){
												$size = strlen($nome_produto);
												$nome_produto = substr($nome_produto,0, $size-1);
											}

											if($px['total']<10){
												$px['total'] = '0'.$px['total'];
											}	


											


					  ?>
						     
						      <tr>
						        <td class="valign-middle upper"><?php echo $px['total']; ?></td>						        
						        <td class="valign-middle upper"><?php echo $nome_produto; ?></td>
						        
						      </tr>
				      <?php
				      			
				      				

				      		}
					      } else {
					      	echo '<tr><td  class="valign-middle upper" colspan="10"><center>NENHUM PRODUTO ENCONTRADO!</center></td></tr>';
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