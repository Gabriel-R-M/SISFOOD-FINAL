<?php
ob_start();
session_cache_expire(180000); 
@session_start();
session_cache_expire(180000); 
if(isset($_SESSION['usuario_sistema_sis_erp'])){		
	
	$_SESSION['id_cidade'] = 1;
	$id_usuario = $_SESSION['usuario_sistema_sis_erp'];
	$sel = $db->select("SELECT * FROM usuarios WHERE id='$id_usuario' LIMIT 1");
	
	$dados_usuario  = $db->expand($sel);
	
	$dados_usuario_nome = $dados_usuario['nome'];
	$dados_usuario_acesso = $dados_usuario['nivel'];

} else {

	header("Location: acesso"); //Direciona para a pagina de adm									
	
}

?>