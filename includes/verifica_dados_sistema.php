<?php

$selecionax = $db->select("SELECT * FROM sistema LIMIT 1");
$dados_sistema = $db->expand($selecionax);

?>