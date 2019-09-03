<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");
unset($_SESSION['id_caixa_erp_sis'] );
include_once("../../includes/verifica_caixa_aberto.php");
include_once("../../includes/verifica_configuracoes_loja.php");
include_once("../../diversos/funcoes_diversas.php");
?>




      <?php 

        if(isset($busca) && $busca!=''){
          $busca = " AND (aguarda_venda.nome_cliente LIKE '%$busca%' OR clientes.nome LIKE '%$busca%' )";
        }

          //

	      $sel = $db->select("SELECT aguarda_venda.*, clientes.nome FROM aguarda_venda 	      	
	      LEFT JOIN clientes ON aguarda_venda.id_cliente=clientes.id
	      WHERE aguarda_venda.baixado='0' AND aguarda_venda.aguarde='1' 
	      AND aguarda_venda.id_caixa='$id_caixa_aberto' AND aguarda_venda.id_mesa='0' $busca
	      ORDER BY 
        aguarda_venda.pedido_entregue ASC,
        aguarda_venda.pedido_inicio DESC
	      ");

		if($db->rows($sel)){
			
			while($dados = $db->expand($sel)){

       $id_venda_roda = $dados['id']; 
			
			//ENTREGA	
			if($dados['entrega']!=0){				
				$entrega = '<i class="fa fa-motorcycle fa-fw" aria-hidden="true"></i> AGUARDANDO ENTREGA';
				$entrega2 = 'tx-danger';
				$entrega3 = '#B92A25';

            if($dados['pedido_saiu_entrega']!='00:00:00'){
                $entrega = '<i class="fa fa-motorcycle fa-fw" aria-hidden="true"></i>&nbsp; SAIU P/ ENTREGA ÁS '.substr($dados['pedido_saiu_entrega'],0,5);
                $entrega2 = 'tx-danger';
                $entrega3 = '#B92A25';  

                //$tempo_decorrido = tempo_decorrido_pedido($dados['pedido_entregue'],2);              
                //if($tempo_decorrido>=30){
                if($dados['pedido_entregue']!='00:00:00'){
                    $entrega = '<i class="fa fa-check fa-fw" aria-hidden="true"></i> ENTREGA REALIZADA';
                    $entrega2 = 'tx-success';
                    $entrega3 = '#B92A25';                    
                } 

            }

			//RETIRA BALCÃO	
			} else {				
				$entrega = '<i class="fa fa-male fa-fw" aria-hidden="true"></i> RETIRA/BALCÃO';
				$entrega2 = 'tx-warning';
				$entrega3 = '#B92A25';
			}	


	  ?>
	  		
	  		  <div class="col-12 col-md-3 bottom10 cursor">
            	<div class="card card-popular-product" style="border-left-color: <?php echo $entrega3; ?>; height: 230px; max-height: 230px" >
            		  

                  <label class="prod-id thin" <?php if($dados['pedido_internet']!=0){ echo 'style="margin-bottom:8px"'; } ?> >
                    <?php
                      if($dados['pedido_internet']!=0){
                        echo '<span class="label-mesa" style="font-size:15px; ">INTERNET: '.$dados['id'].'</span>';
                      } else {
                          echo 'PEDIDO: '.($dados['id']);
                      }

                      //if($dados['finalizada']==1){
                        //echo '
                          //<button class="btn btn-teal pull-right btn-sm" style="font-weight: 300" onclick="javascript:finaliza_venda_final('.$dados['id'].');">
                          //  ENTREGUE
                         // </button> 
                       // ';
                     // }

                    ?>

                    
            		  <?php
                    if($dados_configuracoes['modulo_entregas']==1){

                      $sal = $db->select("SELECT id FROM pagamentos_vendas WHERE id_venda='$id_venda_roda' LIMIT 1");

                      if(!$db->rows($sal)){
                        echo '<input tabindex="-1" value="'.$dados['id'].'" id="" type="checkbox" class="pull-right top5 marca_pedidos_entrega hide_mobile" onclick="javascript:marca_pedidos_entrega();">';
                      }
                    }
                  ?>
                  </label>

                 

              		<h5 onclick="javascript:edita_pedido(<?php echo ($dados['id']); ?>);" class="prod-name upper corta_texto"><a href="javascript:void(0);">
                      <?php 
                        if(!empty($dados['nome_cliente'])){
                            echo $dados['nome_cliente'];
                        } else {
                             echo $dados['nome'];
                        }
                      ?>
                    </a></h5>
              		<p onclick="javascript:edita_pedido(<?php echo ($dados['id']); ?>);" class="prod-by"><?php echo data_mysql_para_user($dados['data_pedido']); ?> ás <?php echo substr($dados['pedido_inicio'],0,5).'hs'; ?></p>
              			<div onclick="javascript:edita_pedido(<?php echo ($dados['id']); ?>);" class="row" style="padding-bottom: 0; margin-bottom: 0">
                			<div class="col-12" style="margin-top: -12px; padding-bottom: 0; margin-bottom: 0">
                  				<h3 class="tx-lato" style="padding-bottom: 0; margin-bottom: 0; color: <?php echo $entrega3; ?>">
                  					<small>R$</small>
                  					&nbsp;<?php echo number_format($dados['valor_final_venda'],2,",","."); ?>
                  				</h3>                  				
                			</div>	                		
              			</div>
                    <div id="entrega_escrita<?php echo ($dados['id']); ?>" class="<?php echo $entrega2; ?> top10"><?php echo $entrega; ?></div>



                    <?php
                      $display_entregadores = ''; 
                      $display_marca_ok = '';
                      $col= 6; 
                     
                      if($dados['pedido_saiu_entrega']=='00:00:00'){  
                        
                        $display_entregadores = ''; 
                        $display_marca_ok = 'style="display:none"'; 
                        $display_marca_ok2 = 'style="display:none"'; 

                      } else {                      

                        $display_entregadores = 'style="display:none"'; 
                        $display_marca_ok = ''; 
                        $display_marca_ok2 = ''; 

                          if($dados['pedido_entregue']!='00:00:00'){  
                              $display_marca_ok2 = 'style="display:none;"'; 
                              $col= 6; 
                          }

                      }
                    ?>  


            <?php
              if($dados['entrega']!=0){
            ?>          
                    <div class="row row-xs" style="margin-top: 8px">
                            
                            <div class="col-md-12" id="seleciona_entregador<?php echo ($dados['id']); ?>" <?php echo $display_entregadores; ?>>
                              <select style="height: 38px; font-size: 13px; margin-bottom: 0; padding-bottom: 0; margin-top: 4px" class="form-control upper" onChange="javascript:marca_pedido_entregue_interno_sistema(this.value,<?php echo ($dados['id']); ?>,1);" id="nome_entregador<?php echo ($dados['id']); ?>">
                                <?php
                                  if($dados['entregador']!=0){
                                    $id_entregador=$dados['entregador'];
                                    $sql = $db->select("SELECT * FROM entregadores WHERE id='$id_entregador' LIMIT 1");
                                    $row = $db->expand($sql);
                                    echo '<option value="'.$row['id'].'" selected>'.$row['nome'].'</option>';
                                          
                                  } else {
                                    echo '<option value="">--- ESCOLHA O ENTREGADOR---</option>';
                                    $id_entregador=0; 
                                  }
                                      
                                  $sql = $db->select("SELECT * FROM entregadores WHERE ativo='1' AND id!='$id_entregador' ORDER BY nome");
                                  while($row = $db->expand($sql)){
                                    echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
                                  }
                                ?>  
                              </select>
                            </div>


                            <div  class="col-md-<?php echo $col; ?>" id="marca_ok_entrega<?php echo ($dados['id']); ?>" <?php echo $display_marca_ok; ?>> 
                               <button style="margin-bottom: 0; margin-top: 6px" class="btn btn-block btn-primary btn-sm" onclick="javascript:marca_pedido_entregue_interno_sistema(0,<?php echo ($dados['id']); ?>,0);" type="button">NÃO ENTREGUE</button> 
                            </div>

                            <?php
                              if($dados['finalizada']==1) {
                            ?>

                              <div  class="col-md-6" id="marca_ok_entrega2<?php echo ($dados['id']); ?>" <?php echo $display_marca_ok2; ?>> 
                                 <button style="margin-bottom: 0; margin-top: 6px" class="btn btn-block btn-success  btn-sm" onclick="javascript:marca_pedido_entregue_interno_sistema(0,<?php echo ($dados['id']); ?>,1,1);" type="button">ENTREGUE</button> 
                              </div>

                            <?php
                              } else {
                            ?>

                                <div class="col-md-6" id="marca_ok_entrega2<?php echo ($dados['id']); ?>"  <?php echo $display_marca_ok; ?>> 
                                    <div class="tx-danger" style="color: #B92A25; margin-top: 8px">
                                      <i class="icofont-warning"></i>  
                                      AGUARDA PGTO
                                    </div>
                              </div>


                            <?php
                              }
                            ?>

                        </div>   



          <?php
            } else if($dados['finalizada']==1) {
          ?>

                <div class="row row-xs top15" >

                    <div class="col-md-12" id="marca_ok_entrega<?php echo ($dados['id']); ?>"> 
                        <button class="btn btn-block btn-success btn-sm" onclick="javascript:marca_pedido_entregue_interno_sistema(0,<?php echo ($dados['id']); ?>,1,1);" type="button">ENTREGUE</button> 
                    </div>

                </div>  

          <?php
            } else {
          ?>
  
                <div class="row row-xs top10" >

                    <div class="col-md-12" style="margin-top: 4px"> 
                          <div class="tx-danger" style="color: #B92A25">
                            <i class="icofont-warning"></i>
                            VENDA AGUARDANDO PAGAMENTO
                          </div>
                    </div>

                </div> 

          <?php
            } 
          ?>                        
          
            	</div>
           	  </div>


      <?php
      	}
      } else {

          $entrega2 = 'tx-primary';
          $entrega3 = '#B92A25';

      ?>  
      		

          <div class="col-md-12 col-lg-12 bottom10 cursor">
              <div class="card card-popular-product" style="border-left-color: <?php echo $entrega3; ?>"> 
                
                  <label class="prod-id" style="font-weight: 300"><small>ENTREGA/BALCÃO</small></label>
                  <h5 class="prod-name upper corta_texto"><a href="javascript:void(0);">NENHUM PEDIDO ENCONTRADO</a></h5>
                  
              </div>
              </div>


      <?php      
      }
      ?>
 

 