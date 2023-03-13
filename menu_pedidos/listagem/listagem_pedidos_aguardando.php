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
            	<div class="card card-popular-product" style="border-left-color: <?php echo $entrega3; ?>">
            		  

                  <label class="prod-id thin" <?php if($dados['pedido_internet']!=0){ echo 'style="margin-bottom:8px"'; } ?> >
                    <?php
                      if($dados['pedido_internet']!=0){
                        echo '<span class="label-mesa" style="font-size:15px; ">INTERNET: '.$dados['id'].'</span>';
                      } else {
                          echo 'PEDIDO: '.($dados['id']);
                      }

                      if($dados['finalizada']==1){
                        echo '
                          <button class="btn btn-teal pull-right btn-sm" style="font-weight: 300" onclick="javascript:finaliza_venda_final('.$dados['id'].');">
                            ENTREGUE
                          </button> 
                        ';
                      }

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
                    <div class="<?php echo $entrega2; ?> top10"><?php echo $entrega; ?></div>
          
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
 

 