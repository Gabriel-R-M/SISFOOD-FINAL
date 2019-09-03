<?php
require_once("../../admin/class/class.db.php");
require_once("../../admin/class/class.seguranca.php");
require_once("../../includes/verifica_session.php");
require_once("../../includes/verifica_venda_aberta.php");
?>

<?php
				  	$sel = $db->select("SELECT nome_cliente_divisao FROM produtos_venda WHERE id_venda='$id_venda' AND nome_cliente_divisao!='' GROUP BY nome_cliente_divisao ORDER BY nome_cliente_divisao");	
				  	if($db->rows($sel)){
				  		echo '<option value="">ESCOLHA A SUBMESA</option>';
				  		while($row = $db->expand($sel)){	
				  						  	
					  		echo '<option value="'.$row['nome_cliente_divisao'].'">'.$row['nome_cliente_divisao'].'</option>';				  			
					  		
				  		}
				  	} else {
				  		echo '<option value="">--NENHUMA SUBMESA ENCONTRADA--</option>';				  			
				  	}
				  	
?>	
