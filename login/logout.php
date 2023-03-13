<?php
include("../admin/class/class.db.php"); 
include("../admin/class/class.seguranca.php"); 

$id_logado = $_SESSION['usuario_sistema_sis_erp'];
$update = $db->select("UPDATE usuarios SET online='0' WHERE id='$id_logado' LIMIT 1");


unset($_SESSION['usuario_sistema_sis_erp']);
header("location: home");

?>