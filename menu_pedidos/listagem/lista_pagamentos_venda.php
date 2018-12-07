<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");
?>

<div class="table-responsive">
  <table class="table table-striped">
    
    <thead>
      <tr>
        <th width="200">Data/Hora</th>
        <th>Valor Recebido</th>
        <th>Forma Pagamento</th>
        <th>Atendente</th>
      </tr>
    </thead>

    <tbody>
      <?php
	      $sel = $db->select("SELECT pagamentos_vendas.*, formas_pagamento.forma, usuarios.nome FROM pagamentos_vendas 
	      	LEFT JOIN formas_pagamento ON pagamentos_vendas.forma_pagamento=formas_pagamento.id
	      	LEFT JOIN usuarios ON pagamentos_vendas.id_usuario=usuarios.id
	      	WHERE pagamentos_vendas.id_venda='$id_venda'
	      	ORDER BY pagamentos_vendas.id DESC
	      	");
		  	if($db->rows($sel)){
			while($dados = $db->expand($sel)){
	  ?>
      <tr>
        <td><?php echo data_mysql_para_user($dados['data']); ?> ás <?php echo substr($dados['hora'],0,5); ?></td>
        <td>R$ <?php echo number_format($dados['valor_caixa_real'],2,",","."); ?></td>
        <td><?php echo ($dados['forma']); ?></td>
        <td><?php echo ($dados['nome']); ?></td>
      </tr>
      <?php
      	}}
      ?>
    </tbody>

  </table>
</div>