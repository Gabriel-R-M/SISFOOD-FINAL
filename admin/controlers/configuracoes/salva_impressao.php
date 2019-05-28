<?php
require("../../config.php");

//impressora_principal='$impressora_principal', impressora_secundaria='$impressora_secundaria'

$grava = $db->select("UPDATE dados_loja SET cabecalho_linha01='$cabecalho_linha01', cabecalho_linha02='$cabecalho_linha02', cabecalho_linha03='$cabecalho_linha03'");

$grava = $db->select("UPDATE configuracoes SET primeira_impressao='$primeira_impressao', imprimir_endereco_entrega_cozinha='$imprimir_endereco_entrega_cozinha', impressao_avulsa_item='$impressao_avulsa_item'");

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Configurações atualizadas com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."impressao");

?>