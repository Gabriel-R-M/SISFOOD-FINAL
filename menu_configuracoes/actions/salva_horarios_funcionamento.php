<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");

$salva = $db->select("UPDATE horarios_funcionamento SET abre='$dia1_inicio', fecha='$dia1_fim' WHERE dia='1' LIMIT 1");
$salva = $db->select("UPDATE horarios_funcionamento SET abre='$dia2_inicio', fecha='$dia2_fim' WHERE dia='2' LIMIT 1");
$salva = $db->select("UPDATE horarios_funcionamento SET abre='$dia3_inicio', fecha='$dia3_fim' WHERE dia='3' LIMIT 1");
$salva = $db->select("UPDATE horarios_funcionamento SET abre='$dia4_inicio', fecha='$dia4_fim' WHERE dia='4' LIMIT 1");
$salva = $db->select("UPDATE horarios_funcionamento SET abre='$dia5_inicio', fecha='$dia5_fim' WHERE dia='5' LIMIT 1");
$salva = $db->select("UPDATE horarios_funcionamento SET abre='$dia6_inicio', fecha='$dia6_fim' WHERE dia='6' LIMIT 1");
$salva = $db->select("UPDATE horarios_funcionamento SET abre='$dia7_inicio', fecha='$dia7_fim' WHERE dia='7' LIMIT 1");



echo 1;

?>