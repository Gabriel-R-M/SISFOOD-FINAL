<?php
include_once ("../../admin/class/class.db.php"); 
include_once ("../../admin/class/class.seguranca.php");	
include_once ("../../includes/verifica_dados_sistema.php");	
include_once ("../../includes/verifica_configuracoes_loja.php");	

	
	$update = $db->select("UPDATE dados_loja_internet SET tipo_abertura_loja='$tipo_abertura_loja'");


	//UPDATE NO SERVIDOR ONLINE//
	$post = [
    'chave_seguranca' => md5('user_sisconnection_adm'),
    'tipo' => $tipo_abertura_loja,
    'campo' => 'tipo_abertura_loja'
	];

	$curl = curl_init();                                                                      
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $dados_sistema['url_servidor_pedidos'].'/abre-fecha-loja',
	    CURLOPT_USERAGENT => 'Request',
	    CURLOPT_POSTFIELDS =>  $post
	));

	$return = curl_exec($curl);

	if($return){	

		$json_decoded = json_decode($return, false);    

		if($json_decoded){

			//ERRO
			if($json_decoded->msg!="OK"){
				echo 0;	

			//TUDO OK CONTINUA	
			} else {

				echo 1;

			}

		} else {
			echo 0;			

		}		

	} 

	curl_close($curl); 



?>