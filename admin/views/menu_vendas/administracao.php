<?php 
require("../../includes/topo.php"); 
$total = new TotalizadoresVendas();
?>


        <div class="slim-pageheader">
          <ol class="breadcrumb slim-breadcrumb">
           
          </ol>
          <h6 class="slim-pagetitle">
            
            <small><?php echo $dados_loja['razao']; ?></small>
          </h6>
        </div><!-- slim-pageheader -->

        <div class="dash-headline">
          <div class="dash-headline-left">
            <div class="dash-headline-item-one">
              <div id="chartArea1" class="dash-chartist"></div>
              <div class="dash-item-overlay">
                <h1><span class="tx-24">R$</span> <?php echo $total->Movimentacao('ultima_valores'); ?> </h1>
                <p class="earning-label">TOTAL DE VENDAS DO DIA 
                  <?php
                      echo $total->Movimentacao('ultima');
                  ?>                    
                  </p>
                <p class="earning-desc">Para ver mais detalhes sobre as movimentações, acesse o menu "Relatórios".</p>
                <a href="relatorio-vendas-consolidadas" class="statement-link">VER RELATÓRIO <i class="fa fa-angle-right mg-l-5"></i></a>
              </div>
            </div><!-- dash-headline-item-one -->
          </div><!-- dash-headline-left -->



          <div class="dash-headline-right">
            <div class="dash-headline-right-top">
              
              <div class="dash-headline-item-two">
                <div id="chartMultiBar1" class="chart-rickshaw"></div>
                <div class="dash-item-overlay">
                  <h4><span class="tx-20">R$</span> <?php echo $total->Periodo30Dias('valores'); ?></h4>
                  <p class="item-label">últimos 30 dias</p>
                  <p class="item-desc">Consolidado de vendas no período de <?php echo $total->Periodo30Dias('periodo'); ?></p>
                  <a href="relatorio-vendas-consolidadas" class="report-link">VER RELATÓRIO <i class="fa fa-angle-right mg-l-5"></i></a>
                </div>
              </div><!-- dash-headline-item-two -->

            </div><!-- dash-headline-right-top -->
            <div class="dash-headline-right-bottom">
              <div class="dash-headline-right-bottom-left">
                <div class="dash-headline-item-three">
                  <span id="sparkline3" class="sparkline wd-100p">1,4,4,7,5,9,10,5,4,4,7,5,9,10</span>
                  <div>
                    <h1><?php echo $total->Periodo30Dias('entregas'); ?></h1>
                    <p class="item-label">ENTREGAS</p>
                    <p class="item-desc">ÚLTIMOS 30 DIAS <BR>PERÍODO DE <?php echo $total->Periodo30Dias('periodo'); ?></p>
                  </div>
                </div><!-- dash-headline-item-three -->
              </div><!-- dash-headline-right-bottom-left -->
              <div class="dash-headline-right-bottom-right">
                <div class="dash-headline-item-three">
                  <span id="sparkline4" class="sparkline wd-100p">1,4,4,7,5,7,4,3,4,4,6,5,9,7</span>
                  <div>
                    <h1><?php echo $total->Periodo30Dias('balcao'); ?></h1>
                    <p class="item-label">BALCÃO/MESAS</p>
                    <p class="item-desc">ÚLTIMOS 30 DIAS <BR>PERÍODO DE <?php echo $total->Periodo30Dias('periodo'); ?></p>
                  </div>
                </div><!-- dash-headline-item-three -->
              </div><!-- dash-headline-right-bottom-right -->
            </div><!-- dash-headline-right-bottom -->
          </div><!-- wd-50p -->
        </div><!-- d-flex ht-100v -->



        <div class="card card-dash-one mg-t-20">
          <div class="row no-gutters">
            <div class="col-lg-4">
              <i class="icon ion-ios-analytics-outline"></i>
              <div class="dash-content">
                <label class="tx-primary">TOTAL EM PEDIDOS GERAIS</label>
                <h2>
                  <?php
                      echo '<small>R$</small> '.$total->VendasTotais();
                  ?>
                </h2>
              </div><!-- dash-content -->
            </div><!-- col-3 -->
            <div class="col-lg-4">
              <i class="icon ion-ios-people-outline"></i>
              <div class="dash-content">
                <label class="tx-success">CLIENTES CADASTRADOS</label>
                <h2>
                  <?php
                      echo $total->ClientesTotais();
                  ?>
                </h2>
              </div><!-- dash-content -->
            </div><!-- col-3 -->
            <div class="col-lg-4">
              <i class="icon ion-ios-bell-outline"></i>
              <div class="dash-content">
                <label class="tx-purple">PRODUTOS CADASTRADOS</label>
                <h2>
                  <?php
                      echo $total->ProdutosTotais();
                  ?>                     
                </h2>
              </div><!-- dash-content -->
            </div><!-- col-3 -->
            
          </div><!-- row -->
        </div><!-- card -->



<?php require("../../includes/rodape.php"); ?>