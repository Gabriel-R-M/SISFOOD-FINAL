<?php

$seleciona_fiscal = $db->select("SELECT * FROM fiscal LIMIT 1");

$dados_fiscais = $db->expand($seleciona_fiscal);

?>