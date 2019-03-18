  <?php

      $avisos = new AvisosLoja();

      $avisos->AvisoUpdateBaseInternet();
      

?>

<div class="slim-navbar">
      <div class="container">
        <ul class="nav">
          

          <li class="nav-item with-sub active">
            <a class="nav-link" href="javascript:void(0);">
              <img src="img/logo-menu.png">
              <span>SIS E-FOOD</span>
            </a>
            <div class="sub-item">
              <ul>
                <li><a href="home">VENDAS ANALÍTICO</a></li>                

                <li class="sub-with-sub">
                  <a href="javascript:void(0);">DESPESAS</a>
                  <ul>
                    <li><a href="despesas-categorias">CATEGORIAS</a></li>
                    <li><a href="despesas-nova">NOVA DESPESA</a></li>                    
                    <li><a href="despesas-relatorio">RELATÓRIOS</a></li>                    
                  </ul>
                </li> 

              </ul>
            </div><!-- dropdown-menu -->
          </li>


          <li class="nav-item with-sub">
            <a class="nav-link" href="javascript:void(0);">
              <i class="icon ion-ios-filing-outline"></i>
              <span>CADASTROS</span>
            </a>
            <div class="sub-item">
              <ul>                                
                
                <li class="sub-with-sub">
                  <a href="javascript:void(0);">ATENDENTES</a>
                  <ul>
                    <li><a href="atendentes">LISTAGEM</a></li>
                    <li><a href="novo-atendente">NOVO ATENDENTE</a></li>                    
                  </ul>
                </li>	

                <li class="sub-with-sub">
                  <a href="javascript:void(0);">ADICIONAIS</a>
                  <ul>
                    <li><a href="adicionais">LISTAGEM</a></li>
                    <li><a href="novo-adicional">NOVO ADICIONAL</a></li>                    
                  </ul>
                </li>


                <li class="sub-with-sub">
                  <a href="javascript:void(0);">OPÇÕES P/ COMBOS</a>
                  <ul>
                    <li><a href="opcoes">LISTAGEM</a></li>
                    <li><a href="nova-opcao">NOVA OPÇÃO</a></li>                    
                  </ul>
                </li>

                <li class="sub-with-sub">
                  <a href="javascript:void(0);">CATEGORIAS</a>
                  <ul>
                    <li><a href="categorias">LISTAGEM</a></li>
                    <li><a href="nova-categoria">NOVA CATEGORIA</a></li>                    
                  </ul>
                </li>


                <li class="sub-with-sub">
                  <a href="javascript:void(0);">CLIENTES</a>
                  <ul>
                    <li><a href="clientes">LISTAGEM</a></li>
                    <li><a href="novo-cliente">NOVO CLIENTE</a></li>                    
                  </ul>
                </li>


                <li class="sub-with-sub">
                  <a href="javascript:void(0);">ENTREGADORES</a>
                  <ul>
                    <li><a href="entregadores">LISTAGEM</a></li>
                    <li><a href="novo-entregador">NOVO ENTREGADOR</a></li>                    
                  </ul>
                </li>

                <li class="sub-with-sub">
                  <a href="javascript:void(0);">PRODUTOS</a>
                  <ul>                    
                    <li><a href="novo-produto">NOVO PRODUTO</a></li>            
                    <li><a href="produtos">LISTAR TODOS</a></li>                                        
                    <?php
                    	$sel = $db->select("SELECT id, categoria FROM categorias WHERE ativo='1' ORDER BY categoria");
                    	while($row = $db->expand($sel)){
                    		echo '<li><a href="produtos-categoria/'.$row['id'].'" class="upper">LISTAR '.$row['categoria'].'</a></li>';
                    	}
                    ?>
                  </ul>
                </li>

                <li class="sub-with-sub">
                  <a href="javascript:void(0);">VARIAÇÕES</a>
                  <ul>                    
                  	<li><a href="variacoes">LISTAGEM</a></li>	
                    <li><a href="nova-variacao">NOVA VARIAÇÃO</a></li>                                       
                  </ul>
                </li>

                <li class="sub-with-sub">
                  <a href="javascript:void(0);">TAXAS DE ENTREGA</a>
                  <ul>
                    <li><a href="taxas">LISTAGEM</a></li>
                    <li><a href="nova-taxa">NOVA TAXA</a></li>                    
                  </ul>
                </li>

              
                               
              </ul>
            </div><!-- dropdown-menu -->
          </li>


          <li class="nav-item with-sub">
            <a class="nav-link" href="javascript:void(0);">
              <i class="icon ion-ios-book-outline"></i>
              <span>RELATÓRIOS</span>
            </a>
            <div class="sub-item">
              <ul>                
                <li><a href="relatorio-clientes" target="_blank">CLIENTES CADASTRADOS</a></li>
                <li><a href="relatorio-produtos-vendidos">PRODUTOS VENDIDOS</a></li>
                <li><a href="relatorio-vendas-consolidadas">VENDAS CONSOLIDADAS</a></li>
                               
              </ul>
            </div><!-- dropdown-menu -->
          </li>
          

          <li class="nav-item with-sub">
            <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
              <i class="icon ion-ios-gear-outline"></i>
              <span>CONFIGURAÇÕES</span>
            </a>
            <div class="sub-item">
              <ul>                
                <li><a href="modulos-fiscal">MÓDULO FISCAL</a></li>                                
                <li><a href="modulos">MÓDULO CONTROLE DE ENTREGAS</a></li>                                
                <li><a href="modulos-internet">MÓDULO PEDIDOS WEB</a></li>                                                
                <li><a href="impressao">IMPRESSÃO</a></li>                                
                <li><a href="gerais">GERAIS</a></li>                
                <li><a href="formas-pagamento">FORMAS DE PAGAMENTO</a></li>                
                <li><a href="config-sistema-pontos">SISTEMA DE PONTOS</a></li>   
              </ul>
            </div><!-- dropdown-menu -->
          </li>
         
          

          <li class="nav-item with-sub">
            <a class="nav-link" href="javascript:void(0);">
              <i class="icon ion-ios-people"></i>
              <span><?php echo $nome_user; ?></span>
              <?php
                  $mensagens = $MensagensSistema->MensagensDesenvolvedor();
                  if($mensagens==1){
                    echo '<span class="square-8"></span>';
                  }
              ?>
            </a>
            <div class="sub-item">
              <ul>
                <li><a href="mensagens"><i class="icon ion-ios-bell-outline"></i>&nbsp;&nbsp;MENSAGENS</a> </li>                                
                <li><a href="profile"><i class="icon ion-compose"></i>&nbsp;&nbsp;EDITAR DADOS</a></li>                
                <li><a href="logout"><i class="icon ion-forward"></i>&nbsp;&nbsp;LOGOUT</a></li>                
              </ul>
            </div><!-- dropdown-menu -->
          </li>
         

        </ul>
      </div><!-- container -->
    </div><!-- slim-navbar -->


    <?php
      $mensagens = $MensagensSistema->MensagensImportantesDesenvolvedor();
      if($mensagens==1){     
        echo '<a href="mensagens">';   
          echo '<div class="alert alert-warning avisos-desenvolvedor">';
            echo '<div class="container">';
              echo '<i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i>&nbsp;';
              echo 'Existem mensagens importantes para seu estabelecimento. Clique aqui para ver mais.';
            echo '</div>';  
          echo '</div>';
        echo '</a>';  
      } 
    ?>


    <?php
      
      $avisos->Avisos(); 

    ?>
