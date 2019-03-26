<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_configuracoes_loja.php");
?>

<div class="col-md-4">	

		<div class="order-top" style="border-bottom: 0">
			<h20>Configurações</h20>			
		</div>

		<ul class="list-group">
            <li class="list-group-item upper">
            	<a tabindex="-1" href="javascript:submenu_impressoras();"><p class="mg-b-0 thin">            		
            		<i class="icofont-print mg-r-8"></i>	
            		Manutenção de Impressoras</p>
            	</a>
            </li>
            <li tabindex="-1" class="list-group-item upper" style="border-top: 0">
            	<a href="javascript:void();"><p class="mg-b-0 thin">   
            		<i class="icofont-wifi-router mg-r-8"></i>         		            		
            		CONFIGURAÇÃO SAT</p>
            	</a>
            </li>


            <?php 
             	if($dados_configuracoes['modulo_internet']==1){                                      
            ?>
	            <li tabindex="-1" class="list-group-item upper" style="border-top: 0">
	            	<a href="javascript:submenu_abre_loja_online();"><p class="mg-b-0 thin">   
	            		<i class="icofont-addons mg-r-8"></i>         		            		
	            		LOJA DE PEDIDOS ONLINE</p>
	            	</a>
	            </li>

	            <li tabindex="-1" class="list-group-item upper" style="border-top: 0">
	            	<a href="javascript:submenu_horarios_funcionamento();"><p class="mg-b-0 thin">   
	            		<i class="icofont-clock-time mg-r-8"></i>         		            		
	            		HORÁRIOS DE FUNCIONAMENTO</p>
	            	</a>
	            </li>

                <li tabindex="-1" class="list-group-item upper" style="border-top: 0">
                    <a href="javascript:submenu_tempo_retirada_entrega();"><p class="mg-b-0 thin">   
                        <i class="icofont-motor-biker mg-r-8"></i>                        
                        TEMPO DE RETIRADA E ENTREGA</p>
                    </a>
                </li>
            <?php 
             	}
            ?>


            <li tabindex="-1" class="list-group-item upper" style="border-top: 0">
            	<a href="admin" target="_blank"><p class="mg-b-0 thin">   
            		<i class="icofont-gear mg-r-8"></i>      		            		
            		RETAGUARDA ADMINISTRATIVA</p>
            	</a>
            </li>
            
        </ul>
		
			
</div>


<div class="col-md-8" id="telas_menu_ajustes">	
	
	<?php 
		require("impressoras.php");
	?>

</div>	


<script>	
	window.clearTimeout(atualiza_pedidos);		
</script>




