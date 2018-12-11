

<div class="slim-navbar d-block d-sm-none">
    <div class="container">
        <ul class="nav">
          
	          <li class="nav-item">

	          	<a href="javascript:void(0);" class="nav-link" id="impressao_menu_mobile" style="background-color: black; display: none;">    
              		<i class="icon icofont-printer"></i>
            	</a>    

	            <a href="javascript:void(0);" onclick="javascript:confirma_abertura_pedido_mobile();"  class="nav-link" id="logo_icone_menu_mobile" >
	              <i class="icon icofont-fast-food"></i>             
	            </a>
	                        
	          </li>
	          
	          <?php if($dados_mesas['mesa']>0){ ?>
	          <li class="nav-item">
	            <a href="javascript:void(0);" onclick="javascript:mesas_pedidos();" class="nav-link" >
	              <i class="icon icofont-dining-table"></i>              
	            </a>            
	          </li>
	          <?php } ?>


	          <li class="nav-item">
	            <a href="javascript:void(0);" onclick="javascript:entregas_comandas(0);" class="nav-link">
	              <i class="icon icofont-restaurant"></i>          
	            </a>            
	          </li>
	          

	          <li class="nav-item">
	            <a href="logout" class="nav-link">
	              <i class="icon icofont-close-line"></i>     
	            </a>            
	          </li>

        </ul>
    </div><!-- container -->
</div><!-- slim-navbar -->


