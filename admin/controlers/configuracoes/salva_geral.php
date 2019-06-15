<?php
require("../../config.php");

	$grava = $db->select("UPDATE configuracoes SET  porcentagem_garcom='$porcentagem_garcom', tipo_preco_meio_meio='$tipo_preco_meio_meio', senha_cancelamento='$senha_cancelamento', escolhe_motoqueiro='$escolhe_motoqueiro', ordem_exibicao_produtos='$ordem_exibicao_produtos', categorias_mobile='$categorias_mobile' ");	


	$sel = $db->select("SELECT mesa FROM mesas LIMIT 1");
	if($db->rows($sel)){
		$grava = $db->select("UPDATE mesas SET mesa='$mesa'");
	} else {
		$grava = $db->select("INSERT INTO mesas (mesa) VALUES ('$mesa')");
	}
    

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Configurações atualizadas com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."gerais");

?>