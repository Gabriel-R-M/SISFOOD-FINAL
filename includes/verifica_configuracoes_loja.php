<?php

$selecionax = $db->select("SELECT * FROM configuracoes LIMIT 1");
$dados_configuracoes = $db->expand($selecionax);

$selecionax = $db->select("SELECT mesa FROM mesas LIMIT 1");
$dados_mesas = $db->expand($selecionax);

?>