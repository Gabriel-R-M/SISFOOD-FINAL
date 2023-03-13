<?php require("../../includes/topo.php"); ?>


<div class="slim-pageheader">
  <a href="novo-adicional"><button type="button" class="btn btn-primary  pull-right">NOVO ADICIONAL</button></a>
  <h6 class="slim-pagetitle">LISTAGEM DE ADICIONAIS</h6>
</div><!-- slim-pageheader -->


<form method="post" action="adicionais">
<div class="section-wrapper">
          
  <label class="section-title">PESQUISA DE ADICIONAIS</label>

      <div class="form-layout">
            <div class="row row-xs">
      
         <div class="col-lg-9 top10">              
              <div class="input-group">

              <input type="text" name="nome" class="form-control" placeholder="PESQUISE PELO ADICIONAL" value="<?php if (isset($nome)){echo $nome;} ?>">               
                
              </div>
         </div>


         <div class="col-lg-3 top10">  
          <button type="submit" class="btn btn-primary  bd-0">PESQUISAR</button> 
          <a href="adicionais"><button type="button" class="btn btn-primary  bd-0">LIMPAR</button> </a>
         </div> 


      </div><!-- row -->
  </div><!-- form-layout -->         
  
</div>
</form>

<div class="row row-sm">        
<div class="col-lg-12 top20">
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

                  if(isset($nome) && $nome!='') {

                    $sel = $db->select("SELECT * FROM opcionais WHERE opcional LIKE '%$nome%' ORDER BY opcional");

                  } else {

                    $sel = $db->select("SELECT * FROM opcionais ORDER BY opcional");

                  }
                
                if($db->rows($sel)){
                  $x=1; 
                  while($yy = $db->expand($sel)){  
                  
                    $id_opcional = $yy['id'];
                  	$ativo = ativo_produto($yy['ativo']);

                ?>    

                    <tr>
                     
                      <td class="valign-middle upper"><?php if($yy['id']<10){echo '0';} echo $yy['id']; ?></td>	
                      <td class="valign-middle upper">
                          <?php echo $yy['opcional']; ?><br>
                          <?php 
                            $pega = $db->select("SELECT opcionais_categorias_relacao.id_categoria, categorias.categoria 
                              FROM opcionais_categorias_relacao 
                              LEFT JOIN categorias ON opcionais_categorias_relacao.id_categoria=categorias.id
                              WHERE opcionais_categorias_relacao.id_opcional='$id_opcional'");
                              if($db->rows($pega)){
                                echo '<small class="tx-primary upper">[<B>CATEGORIAS LIBERADAS: </B>';
                                while($line = $db->expand($pega)){
                                  echo $line['categoria'].', ';
                                }
                                echo ']</small>';                              
                              } else {
                                  echo '<small class="tx-primary upper">[<B>CATEGORIAS LIBERADAS:</B> TODAS]</small>';
                              }
                          ?> 
                      </td>
                      
                     
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