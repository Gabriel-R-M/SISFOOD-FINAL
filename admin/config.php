<?php
ob_start();
@session_start();

define('ROOT_DIR', dirname(__FILE__).'/' );
define('SISTEMA_DIR', 'http://'.$_SERVER['HTTP_HOST'].'/SISFOOD-FINAL/');
define("ADMIN_DIR", 'http://'.$_SERVER['HTTP_HOST'].'/SISFOOD-FINAL/admin/');
	

//CLASSES DE USO
require(ROOT_DIR."class/class.db.php");
require(ROOT_DIR."class/class.seguranca.php");
require(ROOT_DIR."class/class.session_ativa.php");
require(ROOT_DIR."class/class.upload.php");

require(ROOT_DIR."class/class.avisos.php");
require(ROOT_DIR."class/class.mensagens_sistema.php");
require(ROOT_DIR."class/class.totalizadores.vendas.php");

require(ROOT_DIR."../includes/verifica_dados_sistema.php");
require(ROOT_DIR."../includes/verifica_dados_loja.php");
require(ROOT_DIR."../menu_caixa/actions/totalizadores_caixa.php");

require(ROOT_DIR."class/class.mail.php");

?>