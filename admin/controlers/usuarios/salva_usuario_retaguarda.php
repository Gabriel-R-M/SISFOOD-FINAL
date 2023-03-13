<?php
require("../../config.php");


	$insert = $db->select("UPDATE usuarios_admin SET nome='$nome', usuario='$usuario', senha='$senha'");


//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Dados alterados com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."profile");

?>