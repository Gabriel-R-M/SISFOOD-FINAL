<?php 
include("../admin/class/class.db.php"); 
include("../admin/class/class.seguranca.php"); 


@session_start();
$db = new DB();    
$sel = $db->select("SELECT id FROM usuarios WHERE usuario='$usuario' AND senha='$senha' AND ativo='1' LIMIT 1");
if($db->rows($sel)){
	$line = $db->expand($sel);
	$_SESSION['usuario_sistema_sis_erp']=$line['id'];
	echo 1;	
} else {
	echo 'USUÁRIO OU SENHA INVÁLIDOS.';
}


?>