<?php
require("../../config.php");

$grava = $db->select("UPDATE configuracoes SET modulo_pontuacao='$modulo_pontuacao', valor_real_ponto='$valor_real_ponto', valor_ponto_troca='$valor_ponto_troca', dias_expira_pontos='$dias_expira_pontos'");	


//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Módulo alterado com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."config-sistema-pontos");

?>