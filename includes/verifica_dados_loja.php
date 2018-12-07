<?php

$selecionax = $db->select("SELECT * FROM dados_loja LIMIT 1");

$dados_loja = $db->expand($selecionax);

?>