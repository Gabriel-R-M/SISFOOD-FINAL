<?php
require ("../../admin/class/class.db.php"); 
require ("../../admin/class/class.seguranca.php");
require ("../../includes/verifica_dados_sistema.php");
?>


<div class="col-md-12 pedidos-gerais-aguardando top10">	
<div class="row row-xs" id="reload"> 


<?php
$curl = curl_init();                                                                      
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $dados_sistema['url_servidor_pedidos'].'/resgata-pedidos',
	    CURLOPT_USERAGENT => 'Request'
	));

	$return = curl_exec($curl);

	if($return){	    

	    $json_decoded = json_decode($return, TRUE);  	    	    
	    
	    
	    foreach ($json_decoded["pedidos"]["pedido"] as $valor){	    	    	

	    		if($valor['id_internet']==0){
	    			
	    			echo '<div class="col-md-12 col-lg-12 bottom10 cursor">';
              			echo '<div class="card card-popular-product" style="border-left-color:#B92A25">'; 
                			echo '<label class="prod-id" style="font-weight: 300"><small>PEDIDOS ONLINE</small></label>';
                  			echo '<h5 class="prod-name upper corta_texto"><a href="javascript:void(0);">NENHUM PEDIDO AGUARDANDO ACEITAÇÃO</a></h5>';                  
              			echo '</div>';
              		echo '</div>';
	    		
	    		} else {


	    		//ENTREGA	
				if($valor['entrega']!=0){				
					$entrega = 'PEDIDO PARA ENTREGA';
					$entrega2 = 'tx-danger';
					$entrega3 = '#B92A25';
	            
				//RETIRA BALCÃO	
				} else {				
					$entrega = 'PEDIDO PARA RETIRADA';
					$entrega2 = 'tx-warning';
					$entrega3 = '#B92A25';
				}	


		   		echo '
				<div class="col-12 col-md-3 bottom10 cursor">
            	<div class="card card-popular-product" style="border-left-color: '.$entrega3.'">
            		  
					<label class="prod-id thin" style="margin-bottom:10px">
						<span class="label-mesa" style="font-size:15px; ">INTERNET: '.$valor['id_internet'].'</span>						
					</label>

              		<h5 class="prod-name upper corta_texto"><a href="javascript:void(0);">'.$valor['nome_cliente'].'</a></h5>
              		<p class="prod-by">'.data_mysql_para_user($valor['data_pedido']).' ás '.substr($valor['pedido_inicio'],0,5).'hs</p>
              			<div class="row" style="padding-bottom: 0; margin-bottom: 0">
                			<div class="col-12" style="margin-top: -12px; padding-bottom: 0; margin-bottom: 0">
                  				<h3 class="tx-lato" style="padding-bottom: 0; margin-bottom: 0; color: '.$entrega3.'">
                  					<small>R$</small>
                  					&nbsp;'.number_format($valor['valor_final_venda'],2,",",".").'
                  				</h3>                  				
                			</div>	                		
              			</div>
                    <div class="'.$entrega2.' top10">'.$entrega.'</div>

                    <hr>
                    
                    <div class="row row-xs">
                    	<div class="col-md-4">
                    		<button class="btn btn-block btn-success" id="botao_aceita_pedido_internet'.$valor['id_internet'].'" onclick="javascript:aceita_rejeita_pedido_web('.$valor['id_internet'].',2);">ACEITAR</button>
                    	</div>
                    	<div class="col-md-4">
                    		<button class="btn btn-block btn-danger" id="botao_recusa_pedido_internet'.$valor['id_internet'].'" onclick="javascript:aceita_rejeita_pedido_web_modal('.$valor['id_internet'].',3);">RECUSAR</button>
                    	</div>
                    	<div class="col-md-4">
                    		<button class="btn btn-block btn-info" id="botao_verifica_pedido_internet'.$valor['id_internet'].'" onclick="javascript:detalhes_pedido_internet('.$valor['id_internet'].');">VERIFICAR</button>
                    	</div>
                    </div>
                    
                    
                    

            	</div>
           	  </div>';

           	}


		
		}
	
	} else {
		echo '<center><h4>Erro ao conectar com o servidor.</h4></center>';
	}

	
	curl_close($curl); 


?>

</div>
</div>


<script>	
	$(document).ready(function(){
		$('.pedidos-gerais-aguardando').perfectScrollbar();
	});	
	window.clearTimeout(atualiza_pedidos);		
</script>

