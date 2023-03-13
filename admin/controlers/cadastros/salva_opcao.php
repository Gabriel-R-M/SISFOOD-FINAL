<?php
require("../../config.php");

//CATEGORIAS//
$categorias = $_POST['categorias']; 
$cats = '';
foreach($categorias as $k => $v){ 
	$cats .= $v.','; 
} 
//REMOVE A ULTIMA BARRA
$final = substr($cats, -1);
if($final==','){
	$size = strlen($cats);
	$cats = substr($cats,0, $size-1);
}


//PRODUTOS//
$produtos = $_POST['produtos']; 
$prods = '';
foreach($produtos as $k => $v){ 
	$prods .= $v.','; 
} 
//REMOVE A ULTIMA BARRA
$final = substr($prods, -1);
if($final==','){
	$size = strlen($prods);
	$prods = substr($prods,0, $size-1);
}



//UPDATE
if($id!=0){
	$grava = $db->select("UPDATE opcionais2 SET opcional2='$opcional', valor_opcional2='$preco', ativo='$ativo', id_categoria='$cats', id_produto='$prods' WHERE id='$id' LIMIT 1");	

//INSERT
} else {
	$grava = $db->select("INSERT INTO opcionais2 (opcional2, valor_opcional2, ativo, id_categoria, id_produto) VALUES ('$opcional', '$preco', '$ativo', '$cats', '$prods')");
}


$update = $db->select("UPDATE sistema SET aviso_update_internet='1'");



//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Opção cadastrada com sucesso.';



//REDIRECIONA PARA A PÁGINA//
if(isset($retorno) && $retorno==1){
	header("Location: ".ADMIN_DIR."nova-opcao");
} else {
	header("Location: ".ADMIN_DIR."opcoes");
}



?>