<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");

$apaga = $db->select("DELETE FROM saidas_caixa WHERE id='$id' LIMIT 1");

echo 1;

?>