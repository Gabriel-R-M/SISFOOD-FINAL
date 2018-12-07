<?php
include_once ("../class/class.db.php"); 
include_once ("../class/class.seguranca.php");
include_once ("../../includes/verifica_dados_sistema.php");
include_once ("../../includes/verifica_dados_loja.php");


	$curl = curl_init();                                                                      
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $dados_sistema['url_servidor'].'mensagens?cliente='.$dados_loja['cnpj'],
	    CURLOPT_USERAGENT => 'Request'
	));

	$return = curl_exec($curl);

	if($return){	    
	    
	    $json_decoded = json_decode($return, TRUE);  	    
	    $sql = $db->select("DELETE FROM admin_mensagens_sistema");

	    foreach ( $json_decoded["mensagens"]["mensagem_cliente"] as $valor){	    
		   
		   if($valor['status']==1){

		   		$importante = $valor['importante'];
		   		$mensagem = $valor['mensagem'];
		   		$data = $valor['data'];

				$sql = $db->select("INSERT INTO admin_mensagens_sistema (importante, mensagem, data) VALUES ('$importante', '$mensagem', '$data')");   	
		   }
		
		}
	
	}
	
	curl_close($curl); 

	

?>