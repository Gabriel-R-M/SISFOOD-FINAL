<?php
include_once ("../../admin/class/class.db.php"); 
include_once ("../../admin/class/class.seguranca.php");	
include_once ("../../includes/verifica_dados_sistema.php");	
include_once ("../../includes/verifica_configuracoes_loja.php");	


if($dados_configuracoes['modulo_internet']==1){
	

	$update = $db->select("UPDATE dados_loja_internet SET loja_aberta_manual='$tipo'");


	//UPDATE NO SERVIDOR ONLINE//
	$post = [
    'chave_seguranca' => md5('user_sisconnection_adm'),
    'tipo' => $tipo,
    'campo' => 'loja_aberta_manual'
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

}

?>