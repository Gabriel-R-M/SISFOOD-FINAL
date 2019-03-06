<?php
include_once ("../../admin/class/class.db.php"); 
include_once ("../../admin/class/class.seguranca.php");
include_once ("../../includes/verifica_configuracoes_loja.php");
include_once ("../../includes/verifica_dados_sistema.php");

	$curl = curl_init();                                                                      
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $dados_sistema['url_servidor_pedidos'].'/verifica-existe-pedido',
	    CURLOPT_USERAGENT => 'Request'
	));

	$return = curl_exec($curl);

	if($return){
	    
	    $json_decoded = json_decode($return, false);  
		echo $json_decoded->qtd;  
	
	//ERRO AO CONECTAR COM O SERVIDOR	
	} else {
		echo 0;
	} 

	curl_close($curl); 
	

?>