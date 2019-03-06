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




?>