<?php require("../../includes/topo.php"); ?>


<div class="slim-pageheader">
  <a href="novo-cliente"><button type="button" class="btn btn-primary  pull-right">NOVO CLIENTE</button></a>
  <h6 class="slim-pagetitle">LISTAGEM DE CLIENTES</h6>
</div><!-- slim-pageheader -->


<form method="post" action="clientes">
<div class="section-wrapper">
          
  <label class="section-title">PESQUISA DE CLIENTES</label>

      <div class="form-layout">
            <div class="row row-xs">
          
          <input type="hidden" name="pesquisa" value="1">

    

         <div class="col-lg-9 top10">              
              <div class="input-group">

              <input type="text" name="nome" class="form-control" placeholder="PESQUISE PELO NOME OU PARTE DO NOME" value="<?php if (isset($nome)){echo $nome;} ?>">               
                
              </div>
         </div>


         <div class="col-lg-3 top10">  
          <button type="submit" class="btn btn-primary  bd-0">PESQUISAR</button> 
          <a href="clientes"><button type="button" class="btn btn-primary  bd-0">LIMPAR</button> </a>
         </div> 


      </div><!-- row -->
  </div><!-- form-layout -->         
  
</div>
</form>



<form method="post" action="controlers/cadastros/apaga_clientes.php">
<div class="row row-sm">        
<div class="col-lg-12 top20">
  <div class="card card-table">
  

              <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                  <thead>
                    <tr class="tx-10">
                    <th class="pd-y-5" width="5"><input type="checkbox" id="checa_todos" onclick="javascript:marca_todos_checkbox();"></th>    
                    <th class="pd-y-5" width="20">CÓD</th>    
                      <th class="pd-y-5">NOME</th>                      
                      <th class="pd-y-5">ÚLTIMA COMPRA</th>                      
                      <th class="pd-y-5">TELEFONE</th>
                      <th class="pd-y-5"></th>
                      <th class="pd-y-5 tx-center"></th>
                    </tr>
                  </thead>
                  <tbody>

                <?php

                // Maximo de registros por pagina
                $maximo = 50;
                 
                // Declaração da pagina inicial
                
                if(!isset($pagina)){
                    $pagina = 1;
                } 
                 
                // Calculando o registro inicial
                $inicio = $pagina - 1;
                $inicio = $maximo * $inicio;


                // Conta os resultados no total da query
                $query = $db->select("SELECT COUNT(*) AS num_registros FROM clientes");
                $row = $db->expand($query);
                $total = $row["num_registros"];


                if(isset($nome) && $nome!='') {

                   $sel = $db->select("SELECT ddd, id, nome, telefone FROM clientes WHERE id!='0' AND nome LIKE '%$nome%' ORDER BY nome");                    

                 } else {

                    $sel = $db->select("SELECT ddd, id, nome, telefone FROM clientes ORDER BY nome LIMIT $inicio,$maximo");


                }
                
                if($db->rows($sel)){
                  $x=1; 
                  while($yy = $db->expand($sel)){ 

                    $id_cliente = $yy['id'];
                    $cau = $db->select("SELECT data_pedido FROM aguarda_venda WHERE id_cliente='$id_cliente' ORDER BY id DESC LIMIT 1");
                    if($db->rows($cau)){
                        $pok = $db->expand($cau);
                        $ultima_venda = data_mysql_para_user($pok['data_pedido']);
                    } else {
                        $ultima_venda = '<span class="tx-danger">NUNCA COMPROU</span>';
                    }

                ?>    

                    <tr>
                     
                      <td class="valign-middle upper"><input type="checkbox" class="ompa" value="<?php echo $yy['id']; ?>" name="apaga[]" onclick="javascript:marca_checkbox();"></td>

                      <td class="valign-middle upper"><?php if($yy['id']<10){echo '0';} echo $yy['id']; ?></td>   
                      <td class="valign-middle upper"><?php echo $yy['nome']; ?></td>
                      <td class="valign-middle upper"><?php echo $ultima_venda; ?></td>
                      
                     
                      <td class="valign-middle">                                              
                          <?php 
                            if(!empty($yy['telefone'])){
                              echo '('.$yy['ddd'].') '.$yy['telefone']; 
                            } else {
                              echo 'Ñ INFORMADO'; 
                            }
                          ?>
                      </td>

                      <td class="valign-middle">                                              
                          <?php echo $ativo; ?>
                      </td>


                      <td class="valign-middle tx-center">
                        <a href="#" data-toggle="dropdown" class="tx-gray-600 tx-24">
                          <i class="icon ion-android-more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu">
                          <nav class="nav dropdown-nav">
                            <a href="clientes/edit/<?php echo $yy['id']; ?>"  class="nav-link"><i class="icon ion-edit"></i> Editar Ítem</a>
                            <a href="clientes/delete/<?php echo $yy['id']; ?>" class="nav-link"><i class="icon ion-android-delete"></i> Excluir Ítem</a>                            
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

            
            <div class="col-md-3 top10 hide" id="botao_apaga_registros">
                <button type="submit" class="btn btn-danger">APAGAR REGISTROS</button>
            </div>


            <div class="col-md-12 top15 text-center">  





            <?php

              $menos = $pagina - 1;
              $mais = $pagina + 1;
               
              $pgs = ceil($total / $maximo);
               
              if($pgs > 1 ) {
               
                echo "<br />";
               
                  // Mostragem de pagina
                  if($menos > 0) {
                  echo '<a class="paginacao" href="'.$_SERVER['PHP_SELF'].'?pagina='.$menos.'">anterior</a>';
                  }
               
                  // Listando as paginas
                for($i=1;$i <= $pgs;$i++) {
                  if($i != $pagina) {
                    echo '<a class="paginacao" href="'.$_SERVER['PHP_SELF'].'?pagina='.($i).'">'.$i.'</a>';
                  } else {
                    echo '<a class="paginacao selecionada" href="javascript:void(0)">'.$i.'</a>';
                  }
                }
               
                if($mais <= $pgs) {
                  echo '<a class="paginacao" href="'.$_SERVER['PHP_SELF'].'?pagina='.$mais.'">próxima</a>';
                }
              }

            ?>  
          </div>



</div>
</form>



<?php require("../../includes/rodape.php"); ?>