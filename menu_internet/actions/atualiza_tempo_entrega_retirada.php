<?php
include_once ("../../admin/class/class.db.php"); 
include_once ("../../admin/class/class.seguranca.php");	
include_once ("../../includes/verifica_dados_sistema.php");	
include_once ("../../includes/verifica_configuracoes_loja.php");	


if($dados_configuracoes['modulo_internet']==1){
	

	//UPDATE NO SERVIDOR ONLINE//
	$post = [
    'chave_seguranca' => md5('user_sisconnection_adm'),
    'tempo_entrega' => $tempo_entrega,
    'tempo_retirada' => $tempo_retirada,
    'tipo_tempo_entrega' => $tipo_tempo_entrega,
    'tipo_tempo_retirada' => $tipo_tempo_retirada
	];

	$curl = curl_init();                                                                      
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $dados_sistema['url_servidor_pedidos'].'/atualiza-tempo-entrega-retirada',
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