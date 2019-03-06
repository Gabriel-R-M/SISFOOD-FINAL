<?php
require("../../config.php");
$Images = new UploadArquivoSis(); 

//UPDATE
if($id!=0){
	
	$id_produto = $id;
	$arquivo = $Images->Upload('../../../imagens/produtos','foto',600);

	$q = '';
	if(!empty($arquivo)){
		$foto=$arquivo;
		$q = ", foto='$foto'";
	}
	
		
	$grava = $db->select("UPDATE lanches SET produto='$produto', preco_composto='$preco_composto', categoria='$categoria', codigo='$codigo', ativo='$ativo' $q WHERE id='$id' LIMIT 1");	


	//APAGA OS PRECOS E INSERE
	$grava = $db->select("DELETE FROM lanches_tamanhos_valores  WHERE id_produto='$id'");	

	if(isset($_POST['variacoes'])){

		$variacoes = $_POST['variacoes'];
		$precos = $_POST['precos'];

		foreach(array_combine($variacoes, $precos) AS $valor1 => $valor2) {
		    
			$grava = $db->select("INSERT INTO lanches_tamanhos_valores (id_produto, id_tamanho, preco) VALUES ('$id', '$valor1', '$valor2')");	   	

		}

	}

	if(isset($_POST['valor_fechado']) && !empty($_POST['valor_fechado'])){

		$grava = $db->select("INSERT INTO lanches_tamanhos_valores (id_produto, id_tamanho, preco) VALUES ('$id', '0', '$valor_fechado')");	   

	}


//INSERT
} else {
	

	$arquivo = $Images->Upload('../../../imagens/produtos','foto',600);

	$foto='';
	if(!empty($arquivo)){
		$foto=$arquivo;
	}

	$grava = $db->select("INSERT INTO lanches (produto, foto, preco_composto, categoria, codigo, ativo) VALUES ('$produto', '$foto', '$preco_composto', '$categoria', '$codigo', '$ativo')");	

	$id_produto = $db->last_id($grava);
	

	//APAGA OS PRECOS E INSERE
	$grava = $db->select("DELETE FROM lanches_tamanhos_valores  WHERE id_produto='$id'");	

	if(isset($_POST['variacoes'])){

		$variacoes = $_POST['variacoes'];
		$precos = $_POST['precos'];

		foreach(array_combine($variacoes, $precos) AS $valor1 => $valor2) {
		    
			$grava = $db->select("INSERT INTO lanches_tamanhos_valores (id_produto, id_tamanho, preco) VALUES ('$id_produto', '$valor1', '$valor2')");	   	

		}

	}

	
	if(isset($_POST['valor_fechado']) && !empty($_POST['valor_fechado'])){

		$grava = $db->select("INSERT INTO lanches_tamanhos_valores (id_produto, id_tamanho, preco) VALUES ('$id_produto', '0', '$valor_fechado')");	   

	}


}



////INGREDIENTES/////
$grava = $db->select("DELETE FROM ingredientes_lanches  WHERE id_produto='$id_produto'");	
if(isset($ingrediente_produto)){
	
	foreach($_POST['ingrediente_produto'] as $k => $v){ 
    	$ingrediente_produto = $v;

		$ins = $db->select("INSERT INTO ingredientes_lanches (id_produto, id_ingrediente) VALUES ('$id_produto', '$ingrediente_produto')");

    }   

}


$update = $db->select("UPDATE sistema SET aviso_update_internet='1'");





//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Produto cadastrado com sucesso.';


//REDIRECIONA PARA A PÁGINA//
if(isset($retorno) && $retorno==1){
	header("Location: ".ADMIN_DIR."novo-produto");
} else {
	header("Location: ".ADMIN_DIR."produtos-categoria/$categoria");
}



?>