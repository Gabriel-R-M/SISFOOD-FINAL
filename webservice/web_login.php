<?php
require ("../admin/class/class.db.php"); 
require ("../admin/class/class.seguranca.php");
require ("../includes/verifica_dados_loja.php");
require ("../includes/verifica_dados_sistema.php");

$curl = curl_init();                                                                      
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $dados_sistema['url_servidor'].'login?cliente='.$dados_loja['cnpj'],
    CURLOPT_USERAGENT => 'Request'
));

$return = curl_exec($curl);


//SE FOR MOBILE.....ELE PULA A VERIFICACAO DE LICENÇA

if($return && $mobile==0){
    
    $json_decoded = json_decode($return, false);    
    
    if($json_decoded->status==1){
	    
        //CLIENTE CANCELADO//   
        if($json_decoded->cancelado==1){

            $resposta = '0&@&ERRO: 4433. Favor entrar em contato com o suporte.';   
            $atualiza = $db->select("UPDATE sistema SET mensagem_retorno='$resposta' ");

            //APAGA ARQUIVOS//
            unlink("../administracao.php");
            unlink("../index.php");

    	//CLIENTE BLOQUEADO//	
    	} else if($json_decoded->bloqueado==1){

    		$resposta = '0&@&ERRO: 4431. Favor entrar em contato com o suporte.';	
            $atualiza = $db->select("UPDATE sistema SET mensagem_retorno='$resposta' ");	

    	//CLIENTE LIBERADO//		
    	} else {
    		
    		$resposta = '1&@&OK: Cliente validado com sucesso.';	
            $atualiza = $db->select("UPDATE sistema SET data_servidor=now(), mensagem_retorno='$resposta' ");

    	}

    // CLIENTE NAO ENCONTRADO NO SERVIDOR
    } else {
    	$resposta = '0&@&ERRO: 4432. Favor entrar em contato com o suporte.'; 
        $atualiza = $db->select("UPDATE sistema SET mensagem_retorno='$resposta' ");     
    }

//ERRO AO CONECTAR COM O SERVIDOR
} else {
    

    $sel = $db->select("SELECT data_servidor FROM sistema LIMIT 1");
    $resultado = $db->expand($sel);

    $data_servidor = new DateTime($resultado['data_servidor']);
    $data_atual = new DateTime(date("Y-m-d"));

    // Resgata diferença entre as datas
    $dateInterval = $data_servidor->diff($data_atual);
    $intervalo_datas = $dateInterval->days;

    //MAIS DE 10 DIAS SEM SE CONECTAR COM O SERVIDOR
    if($intervalo_datas>=10){
        $resposta = '0&@&ERRO: 4430. Favor entrar em contato com o suporte.';              
    } else {
        $resposta = '1&@&OK: Expirando licença mensal em: '.$intervalo_datas.' dias.';      
    }

    $atualiza = $db->select("UPDATE sistema SET mensagem_retorno='$resposta' ");  
    


    
}
curl_close($curl); 
echo $resposta;


?>