<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_caixa_aberto.php");

unset($_SESSION['id_venda_erp_sis'] );
unset($_SESSION['id_caixa_erp_sis'] );

$dt = date("Y-m-d");
$hr = date("H:i:s");

$update = $db->select("UPDATE aguarda_venda SET finalizada='1', id_mesa='0', aguarde='0'");
$update = $db->select("UPDATE caixa SET data_fechamento='$dt', hora_fechamento='$hr' WHERE data_fechamento='0000-00-00'");

echo $id_caixa_aberto;

?>