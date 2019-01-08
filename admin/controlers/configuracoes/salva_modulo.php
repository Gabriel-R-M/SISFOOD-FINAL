<?php
require("../../config.php");

	$grava = $db->select("UPDATE configuracoes SET  modulo_fiscal='$modulo_fiscal', modulo_internet='$modulo_internet', modulo_entregas='$modulo_entregas' ");


	$grava = $db->select("UPDATE fiscal  SET  cnpj_desenvolvedor='$cnpj_desenvolvedor', versao_cfe='$versao_cfe', chave_sat='$chave_sat' ");	


	$grava = $db->select("UPDATE dados_loja  SET  cnpj='$cnpj', inscricao_estadual='$inscricao_estadual'");	

   

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Módulos atualizados com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."modulos");

?>