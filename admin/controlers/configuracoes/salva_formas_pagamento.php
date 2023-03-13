<?php
require("../../config.php");

	$grava = $db->select("UPDATE formas_pagamento SET ativo='$dinheiro' WHERE id='1' LIMIT 1");	
	$grava = $db->select("UPDATE formas_pagamento SET ativo='$cartao' WHERE id='2' LIMIT 1");	
	$grava = $db->select("UPDATE formas_pagamento SET ativo='$crediario' WHERE id='3' LIMIT 1");	
	$grava = $db->select("UPDATE formas_pagamento SET ativo='$aiqfome' WHERE id='10' LIMIT 1");	
	$grava = $db->select("UPDATE formas_pagamento SET ativo='$ifood' WHERE id='11' LIMIT 1");	


//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Formas de pagamento atualizadas com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."formas-pagamento");

?>