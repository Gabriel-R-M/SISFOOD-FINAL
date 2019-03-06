<?php require("../../includes/topo.php"); ?>

<?php
$sql = $db->select("SELECT categoria FROM categorias WHERE id='$id' LIMIT 1");	
$ln = $db->expand($sql);
?>

<div class="slim-pageheader">
  <a href="novo-produto"><button type="button" class="btn btn-primary  pull-right">NOVO PRODUTO</button></a>
  <h6 class="slim-pagetitle upper"><?php echo $ln['categoria']; ?></h6>
</div><!-- slim-pageheader -->


<div class="row row-sm">        
<div class="col-lg-12">
  <div class="card card-table">
  
              <div class="card-header">
                <h6 class="slim-card-title upper">PRODUTOS DA CATEGORIA: <?php echo $ln['categoria']; ?></h6>
              </div>
              

              <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                  <thead>
                    <tr class="tx-10">                      
                      <th class="pd-y-5" width="40">Cód</th>
                      <th class="pd-y-5">Produto/Categoria</th>                      
                      <th class="pd-y-5">Preços</th>
                      <th class="pd-y-5 tx-center"></th>
                    </tr>
                  </thead>
                  <tbody>

                <?php
                  $sel = $db->select("SELECT lanches.*, categorias.categoria AS cat       
                FROM lanches 
                LEFT JOIN categorias on lanches.categoria=categorias.id
                WHERE lanches.categoria='$id'
                ORDER BY categorias.categoria, lanches.codigo, lanches.produto");
                
                if($db->rows($sel)){
                  $x=1; 
                  while($yy = $db->expand($sel)){  

                    $foto = foto_produto($yy['foto']);
                    $ativo = ativo_produto($yy['ativo']);
                    $id_produto = $yy['id'];
                    $valores_produto = valores_produto($id_produto);
                      

                ?>    

                    <tr>
                      
                      <td class="valign-middle"><?php echo $yy['codigo']; ?></td>
                      
                      <td>
                        <a href="javascript:void(0);" class="tx-inverse tx-14 tx-medium d-block">
                          <span class="tx-primary">   
                            <small class="upper">[<?php echo $yy['cat']; ?>]</small><br>
                          </span>  
                          <?php echo $yy['produto']; ?></a>
                        
                        <?php 
                            $pega = $db->select("SELECT ingredientes_lanches.id_ingrediente, ingredientes.ingrediente 
                              FROM ingredientes_lanches 
                              LEFT JOIN ingredientes ON ingredientes_lanches.id_ingrediente=ingredientes.id
                              WHERE ingredientes_lanches.id_produto='$id_produto'");
                            if($db->rows($pega)){
                              echo '<small class="tx-primary upper">[<B>INGREDIENTES: </B>';
                                while($line = $db->expand($pega)){
                                  echo $line['ingrediente'].', ';
                                }
                                echo ']</small>';  
                            } else {
                              echo '<small class="tx-primary">[INGREDIENTES NÃO DEFINIDOS]</small>';
                            }
                            
                        ?>  
                      </td>
                      
                      <td class="valign-middle">                                              
                        <small><?php echo $ativo; ?></small>
                        <br>
                        <?php echo $valores_produto; ?>     
                      </td>

                      <td class="valign-middle tx-center">
                        <a href="#" data-toggle="dropdown" class="tx-gray-600 tx-24">
                          <i class="icon ion-android-more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu">
                          <nav class="nav dropdown-nav">
                            <a href="produtos/edit/<?php echo $id_produto; ?>"  class="nav-link"><i class="icon ion-edit"></i> Editar Ítem</a>
                            <a href="produtos/apagar/<?php echo $id_produto; ?>/<?php echo $id; ?>" class="nav-link"><i class="icon ion-android-delete"></i> Excluir Ítem</a>                            
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