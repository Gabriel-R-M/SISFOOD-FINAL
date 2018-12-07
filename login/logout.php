<?php
ob_start();
@session_start();
unset($_SESSION['usuario_sistema_sis_erp']);
header("location: home");

?>