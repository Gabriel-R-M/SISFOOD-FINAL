<?php
include_once ("../admin/class/class.db.php"); 
include_once("../admin/class/class.seguranca.php");
include_once ("../includes/verifica_configuracoes_loja.php");
include_once ("../includes/verifica_dados_sistema.php");



if($dados_configuracoes['aviso_atualizacoes']==1){

	$curl = curl_init();                                                                      
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $dados_sistema['url_servidor'].'versao',
	    CURLOPT_USERAGENT => 'Request'
	));

	$return = curl_exec($curl);

	if($return){
	    
	    $json_decoded = json_decode($return, false);  

	    //TEM NOVA VERSAO
	    if($json_decoded->versao!=$dados_sistema['versao']){  
	    	$msg_versao = 'Nova atualização do sistema disponível!';	    	
	    	echo $msg_versao;

	    //TUDO ATUALIZADO	
		} else {
			echo 0;
		}
	
	//ERRO AO CONECTAR COM O SERVIDOR	
	} else {
		echo 0;
	} 

	curl_close($curl); 
	
//NAO EXIBE ATUALIZACOES
} else {
	echo 0;
}

?>