<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");

$salva = $db->select("UPDATE dados_loja_internet SET tempo_retirada='$tempo_retirada', tipo_tempo_retirada='$tipo_tempo_retirada', tempo_entrega='$tempo_entrega', tipo_tempo_entrega='$tipo_tempo_entrega'  LIMIT 1");




echo 1;

?>