<?php 
include("../admin/class/class.db.php"); 
include("../admin/class/class.seguranca.php"); 


@session_start();
$db = new DB();    
$sel = $db->select("SELECT id, online FROM usuarios WHERE usuario='$usuario' AND senha='$senha' AND ativo='1' LIMIT 1");
if($db->rows($sel)){

	$line = $db->expand($sel);

	//if($line['online']==0){

		$_SESSION['session_usuario_sistema_sis_erp']=md5(time());
		$_SESSION['usuario_sistema_sis_erp']=$line['id'];
		$id_logado = $line['id'];
	//	$update = $db->select("UPDATE usuarios SET online='1' WHERE id='$id_logado' LIMIT 1");
		echo 1;	

	//} else {

	//	echo 'USUÁRIO ATIVO EM OUTRO DISPOSITIVO.';

	//}

	
} else {
	echo 'USUÁRIO OU SENHA INVÁLIDOS.';
}


?>