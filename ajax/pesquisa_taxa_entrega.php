<?php 
require("../admin/class/class.db.php");
require("../admin/class/class.seguranca.php");

$pega = $db->select("SELECT valor FROM tipos_entrega WHERE id='$id' LIMIT 1");			
$ln = $db->expand($pega);
echo $ln['valor'];	

?>