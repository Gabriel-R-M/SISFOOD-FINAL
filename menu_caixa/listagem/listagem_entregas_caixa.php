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
      $seleciona = $db->select("SELECT * FROM entregadores WHERE ativo='1'");
      if($db->rows($seleciona)){     

      while($linha = $db->expand($seleciona)){

          $total_entregador=0;
          $total_entregas=0;

          $id_entregador = $linha['id'];
          $nome_entregador = $linha['nome'];          

          $sel = $db->select("SELECT aguarda_venda.*, tipos_entrega.entrega AS local_entrega FROM aguarda_venda
          LEFT JOIN tipos_entrega ON aguarda_venda.entrega=tipos_entrega.id 
          WHERE aguarda_venda.id_caixa='$id_caixa_aberto' AND aguarda_venda.entrega!='0' AND aguarda_venda.entregador='$id_entregador'
          ORDER BY aguarda_venda.data_pedido DESC, aguarda_venda.pedido_inicio DESC
          ");

          if($db->rows($sel)){

            echo '<tr><td colspan="10" class="upper thin"><b>'.$nome_entregador.'</b></td></tr>';

            while($dados = $db->expand($sel)){

                $total_entregador=($total_entregador+$dados['valor_entrega']);
                $total_entregas++; 

                echo '
                 <tr>
                  <td class="upper thin">'.data_mysql_para_user($dados['data_pedido']).' ás '.substr($dados['pedido_inicio'],0,5).'</td>
                  <td class="upper thin">R$ '.($dados['valor_entrega']).'</td>

                  <td class="upper thin">'.($dados['local_entrega']).'</td>
                      
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