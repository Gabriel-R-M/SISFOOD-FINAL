<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");

unset($_SESSION['id_caixa_erp_sis'] );

$sel = $db->select("SELECT id FROM caixa WHERE data_fechamento='0000-00-00' ORDER BY id DESC LIMIT 1");
if($db->rows($sel)){
	echo 1;
} else {
	echo 0;	
}


?>