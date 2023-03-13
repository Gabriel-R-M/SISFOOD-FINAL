<?php

$seleciona2 = $db->select("SELECT * FROM clientes 	
	WHERE id='$id_cliente_venda' 	
	LIMIT 1");

$dados_cliente = $db->expand($seleciona2);


?>