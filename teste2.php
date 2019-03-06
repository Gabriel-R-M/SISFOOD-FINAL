<?php
require ("admin/class/class.db.php"); 
require ("admin/class/class.seguranca.php");
require ("includes/verifica_dados_sistema.php");

$del = $db->select("DELETE FROM aguarda_venda");
$del = $db->select("DELETE FROM produtos_venda");
$del = $db->select("DELETE FROM opcionais_produtos_venda");

?>






<button>teste</button>

