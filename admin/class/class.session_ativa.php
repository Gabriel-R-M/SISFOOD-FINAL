<?php
ob_start();		
	  
	   @session_start();	
	   if(!isset($_SESSION['user_sisconnection_adm'])){
		   header("Location: home");								   
		   
	   } else {
		   
		  $id_usuario_logado = $_SESSION['user_sisconnection_adm'];		  
		  $sel = $db->select("SELECT * FROM usuarios_admin WHERE id='$id_usuario_logado' LIMIT 1");
		  $dados_usuario = $db->expand($sel);

		  $nm = explode(' ',$dados_usuario['nome']);
		  $nome_user = $nm[0];
		  
	   }
?>