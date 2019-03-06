<?php
require("../../config.php");

	$grava = $db->select("UPDATE configuracoes SET  senha_cancelamento='$senha_cancelamento', escolhe_motoqueiro='$escolhe_motoqueiro', ordem_exibicao_produtos='$ordem_exibicao_produtos', categorias_mobile='$categorias_mobile' ");	

    $grava = $db->select("UPDATE mesas SET mesa='$mesa'");

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Configurações atualizadas com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."gerais");

?>