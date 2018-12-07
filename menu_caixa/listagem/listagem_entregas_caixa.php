<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_caixa_aberto.php");
?>

<div class="table-responsive">
  <table class="table table-striped">
    
    <thead>
      <tr>
        <th width="200">Data/Hora</th>
        <th width="150">Valor</th>
        <th>Entregador</th>        
      </tr>
    </thead>

    <tbody>
      <?php
	      $sel = $db->select("SELECT aguarda_venda.*, entregadores.nome 
	      	FROM aguarda_venda 
	      	LEFT JOIN entregadores ON aguarda_venda.entregador=entregadores.id
	      	WHERE aguarda_venda.id_caixa='$id_caixa_aberto' AND aguarda_venda.entrega!='0'
	      	ORDER BY data_pedido DESC, pedido_inicio DESC
	      	");
		  	if($db->rows($sel)){
			while($dados = $db->expand($sel)){
	  ?>
      <tr>
        <td><?php echo data_mysql_para_user($dados['data_pedido']); ?> ás <?php echo substr($dados['pedido_inicio'],0,5); ?>hs</td>
        <td>R$ <?php echo number_format($dados['valor_entrega'],2,",","."); ?></td>
        <td>
        	<?php echo ($dados['nome']); ?>        	
        </td>        
      </tr>
      <?php
      	}} else {
           echo '
            <tr>              
              <td colspan="10">
                  <center>Nenhuma entrega encontrada!</center>
              </td>        
            </tr>
           '; 
        }
      ?>
    </tbody>

  </table>
</div>