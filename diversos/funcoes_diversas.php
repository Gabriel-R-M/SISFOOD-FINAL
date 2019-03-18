<?php

function nomes_produtos_busca($str){

	$str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    $str = strtolower($str);
		
	return $str;		


}



function tempo_decorrido_pedido($hora,$tipo){
	$data1 = $hora;
	$data2 = date("H:i:s");
						
	$unix_data1 = strtotime($data1);
	$unix_data2 = strtotime($data2);
						
	$nHoras   = ($unix_data2 - $unix_data1) / 3600;
	$nMinutos = (($unix_data2 - $unix_data1) % 3600) / 60;
						
	if($tipo==2){
		return floor($nMinutos);
	}
}



function loja_aberta_fechada(){
	$db = new DB();
	$hoje = date("w");
	$sql = $db->select("SELECT * FROM horarios_funcionamento WHERE dia='$hoje' LIMIT 1");
	$dados_funcionamento = $db->expand($sql);

	if($dados_funcionamento['abre']!='00:00:00'){

		$hora1 = strtotime(substr($dados_funcionamento['abre'],0,4));
    	$hora2 = strtotime(substr($dados_funcionamento['fecha'],0,4));
    	$horaAtual = strtotime(date('H:i'));
    
    	switch ($horaAtual){
        	case ($horaAtual > $hora1 && $horaAtual < $hora2) : $retorno = 1; break; 
        	default :  $retorno = 0;
    	}
   
	} else {
		$retorno = 0;
	}

	return $retorno;
}



?>