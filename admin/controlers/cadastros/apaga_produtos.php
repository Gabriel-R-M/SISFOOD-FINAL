<?php
require("../../config.php");

//APAGA O PRODUTO
$apaga = $db->select("DELETE FROM lanches WHERE id='$id' LIMIT 1");

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Produto(s) excluído(s) com sucesso.';

//REDIRECIONA PARA A PÁGINA//

if(isset($id2)){
	header("Location: ".ADMIN_DIR."produtos-categoria/$id2");
} else {
	header("Location: ".ADMIN_DIR."produtos");	
}



?>