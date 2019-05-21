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
        <th width="150">Data/Hora</th>
        <th width="150">Valor</th>
        <th>Motivo/Operador</th>        
        <th width="10"></th>        
      </tr>
    </thead>

    <tbody>
      <?php
	      $sel = $db->select("SELECT saidas_caixa.*, usuarios.nome FROM saidas_caixa 	      	
	      	LEFT JOIN usuarios ON saidas_caixa.id_usuario=usuarios.id
	      	WHERE saidas_caixa.id_caixa='$id_caixa_aberto'
	      	ORDER BY saidas_caixa.id DESC
	      	");
		  	if($db->rows($sel)){
			while($dados = $db->expand($sel)){
	  ?>
      <tr id="despesa<?php echo $dados['id']; ?>">
        <td>ÁS <?php echo substr($dados['hora'],0,5); ?>hs<br> <small>em <?php echo data_mysql_para_user($dados['data']); ?></small></td>
        <td>R$ <?php echo number_format($dados['valor_saida'],2,",","."); ?></td>
        <td class="upper">
        	<?php echo ($dados['nome']); ?>
        	<br>
        	<small><?php echo ($dados['motivo']); ?></small>
        </td>

        <td>          
            <button class="btn btn-danger btn-sm" onclick="javacript:apaga_despesa_caixa(<?php echo $dados['id']; ?>);"><i class="icofont-ui-close"></i></button>          
        </td>

      </tr>
      <?php
      	}} else {
           echo '
            <tr>              
              <td colspan="10">
                  <center>Nenhuma retirada encontrada!</center>
              </td>        
            </tr>
           '; 
        }
      ?>
    </tbody>

  </table>
</div>