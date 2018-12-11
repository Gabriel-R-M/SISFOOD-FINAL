<?php 
require("../../class/class.db.php");
require("../../class/class.seguranca.php");

@session_start();

$db = new DB();    
$sel = $db->select("SELECT id FROM usuarios_admin WHERE usuario='$usuario' AND senha='$senha' AND ativo='1' LIMIT 1");
if($db->rows($sel)){
	$line = $db->expand($sel);
	$_SESSION['user_sisconnection_adm']=$line['id'];
	echo 1;	
} else {
	echo 0;
}


?>