      
      

      <div class="slim-sidebar">
        

        <ul class="nav nav-sidebar">
          
          <li class="sidebar-nav-item">
            
            <a href="javascript:void(0);" tabindex="-1" class="sidebar-nav-link" id="impressao_menu" style="background-color: black; display: none;">    
              <i class="icofont-printer"  style="margin-left: -4px;"></i>
            </a>       
            <a href="javascript:void(0);" tabindex="-1" class="sidebar-nav-link upper" id="logo_icone_menu" ><img src="img/icone.png"></a>  
          </li>

          <li class="sidebar-nav-item">
            <a href="javascript:void(0);" onclick="javascript:confirma_abertura_pedido();" class="sidebar-nav-link" tabindex="-1">
                <i class="icofont-fast-food"></i>
            </a>
          </li>

          <?php if($dados_mesas['mesa']>0){ ?>
          <li class="sidebar-nav-item">
            <a href="javascript:void(0);" onclick="javascript:inicia_sistema(0);" class="sidebar-nav-link" tabindex="-1">
              <i class="icofont-dining-table"></i>
            </a>
          </li>
         <?php } ?>

          <li class="sidebar-nav-item">
            <a href="javascript:void(0);" onclick="javascript:entregas_comandas(0);" class="sidebar-nav-link" tabindex="-1">
              <i class="icofont-motor-biker"></i>
            </a>
          </li>

          <?php if($dados_configuracoes['modulo_internet']==1){ ?>
          <li class="sidebar-nav-item" id="menu_aviso_pedidos_internet">
            <a href="javascript:void(0);" onclick="javascript:pedidos_internet();" class="sidebar-nav-link" tabindex="-1">              
              <i class="icofont-ui-cell-phone"></i>
            </a>
          </li>
         <?php } ?>

          <li class="sidebar-nav-item">
            <a href="javascript:void(0);" onclick="javascript:pedidos_finalizados();"  class="sidebar-nav-link" tabindex="-1">
              <i class="icofont-check-circled"></i>
            </a>
          </li>

          <li class="sidebar-nav-item">
            <a href="javascript:void(0);" onclick="javascript:menu_clientes();"  class="sidebar-nav-link" tabindex="-1">
              <i class="icofont-users-alt-5"></i>
            </a>
          </li>


          <li class="sidebar-nav-item">
            <a href="javascript:void(0);" onclick="javascript:menu_configuracoes();"  class="sidebar-nav-link" tabindex="-1"> 
              <i class="icofont-settings-alt"></i>
            </a>
          </li>

          <li class="sidebar-nav-item">
            <a href="javascript:void(0);" tabindex="-1" id="menu_caixa" onclick="javascript:manutencao_caixa();"  class="sidebar-nav-link" data-toggle="tooltip-danger" data-placement="right" title="" data-original-title="CAIXA ABERTO EM: <?php echo data_mysql_para_user($dados_caixa['data_abertura']).' ÀS '.substr($dados_caixa['hora_abertura'],0,5); ?>h">
              <i class="icofont-money-bag"></i>
            </a>
          </li>
          
          <li class="sidebar-nav-item">
            <a href="logout" class="sidebar-nav-link" tabindex="-1" data-toggle="tooltip-danger" data-placement="right" title="" data-original-title="USUÁRIO: <?php echo $dados_usuario_nome; ?>">
                <i class="icofont-close-line"></i>
            </a>
          </li>

        </ul>
      </div>


      