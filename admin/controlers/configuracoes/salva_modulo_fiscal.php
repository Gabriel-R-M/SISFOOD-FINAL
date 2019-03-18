<?php
require("../../config.php");

$grava = $db->select("UPDATE configuracoes SET  modulo_fiscal='$modulo_fiscal', fiscal_sempre_ativo='$fiscal_sempre_ativo'");


$grava = $db->select("UPDATE fiscal  SET caminho_acbr='$caminho_acbr', ncm_sistema='$ncm_sistema', cst_sistema='$cst_sistema', cfop_sistema='$cfop_sistema', cnpj_desenvolvedor='$cnpj_desenvolvedor', versao_cfe='$versao_cfe', chave_sat='$chave_sat' ");	


$grava = $db->select("UPDATE dados_loja  SET  cnpj='$cnpj', inscricao_estadual='$inscricao_estadual'");	

   

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Módulo atualizado com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."modulos-fiscal");

?>