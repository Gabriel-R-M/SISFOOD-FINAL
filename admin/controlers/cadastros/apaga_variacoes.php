<?php
require("../../config.php");

//APAGA O PRODUTO
$apaga = $db->select("DELETE FROM tamanhos WHERE id='$id' LIMIT 1");
$update = $db->select("UPDATE sistema SET aviso_update_internet='1'");

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Variação(ões) excluída(s) com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."variacoes");

?>