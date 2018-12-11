<?php
include_once ("class/class.db.php"); 
include_once ("class/class.seguranca.php");
include_once ("../includes/verifica_dados_sistema.php");
include_once ("../includes/verifica_dados_loja.php");


	$curl = curl_init();                                                                      
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $dados_sistema['url_servidor'].'login?cliente='.$dados_loja['cnpj'],
	    CURLOPT_USERAGENT => 'Request'
	));

	$return = curl_exec($curl);

	if($return){
	    
	    $json_decoded = json_decode($return, false);  
		define("QTD_USUARIOS_LIMITE", $json_decoded->qtd_usuarios);	

	
	//ERRO AO CONECTAR COM O SERVIDOR	
	} else {
		define("QTD_USUARIOS_LIMITE", 3);	
	} 

	curl_close($curl); 

	

?>