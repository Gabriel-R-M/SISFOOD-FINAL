<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_caixa_aberto.php");
?>

<div class="table-responsive">
  <table class="table table-striped">
    
    
    <tbody>
      <?php

        $sel = $db->select("SELECT entregador FROM aguarda_venda
          WHERE id_caixa='$id_caixa_aberto' AND entrega!='0' 
          GROUP BY entregador          
          ");


          if($db->rows($sel)){

              while($dados = $db->expand($sel)){

                $entregador_id = $dados['entregador'];

                if($entregador_id==0){
                    $nome_entregador = 'Entregador não identificado';
                } else {
                    $seleciona = $db->select("SELECT * FROM entregadores WHERE id='$entregador_id' LIMIT 1");
                    $nm = $db->expand($seleciona);
                    $nome_entregador = $nm['nome'];
                }

                echo '<tr><td colspan="10" class="upper thin"><b>'.$nome_entregador.'</b></td></tr>';

                 $sel2 = $db->select("SELECT aguarda_venda.valor_entrega, aguarda_venda.data_pedido, aguarda_venda.pedido_inicio, tipos_entrega.entrega AS local_entrega FROM aguarda_venda
                  LEFT JOIN tipos_entrega ON aguarda_venda.entrega=tipos_entrega.id 
                  WHERE aguarda_venda.id_caixa='$id_caixa_aberto' AND aguarda_venda.entrega!='0' AND aguarda_venda.entregador='$entregador_id'
                  ORDER BY aguarda_venda.data_pedido DESC, aguarda_venda.pedido_inicio DESC
                  ");

                  if($db->rows($sel2)){

                        $total_entregador=0;
                        $total_entregas=0;

                        while($dados2 = $db->expand($sel2)){

                              $total_entregador=($total_entregador+$dados2['valor_entrega']);
                              $total_entregas++;  

                              echo '
                               <tr>
                                <td class="upper thin">'.data_mysql_para_user($dados2['data_pedido']).' ás '.substr($dados2['pedido_inicio'],0,5).'</td>
                                <td class="upper thin">R$ '.($dados2['valor_entrega']).'</td>
                                <td class="upper thin">'.($dados2['local_entrega']).'</td>                                    
                              </tr>
                              ';

                        }

                        if($total_entregas<10){
                          $total_entregas = '0'.$total_entregas;
                        }

                        echo '<tr><td colspan="10" class="upper thin"><b>'.$total_entregas.' ENTREGAS, TOTALIZANDO R$: '.number_format($total_entregador,2,",",".").'</b></td></tr>';

                  }
       

                
              }

         

          } else {

              echo '
              <tr>              
                <td colspan="10">
                    <center>Nenhuma entrega realizada!</center>
                </td>        
              </tr>
             '; 

          }



		  	
	  ?>
     
      
    </tbody>

  </table>
</div>