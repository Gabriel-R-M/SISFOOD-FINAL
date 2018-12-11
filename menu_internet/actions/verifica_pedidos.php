<?php
//require("../../admin/class/class.db.php");
require("../../admin/class/class.db.servidor.php");
//require("../../admin/class/class.seguranca.php");

$db_server = new DB_SERVER();

$sel = $db_server ->select("SELECT pedido FROM pedidos LIMIT 1");
if($db_server->rows($sel)){
	echo 1;
} else {
	echo 0;
}


?>