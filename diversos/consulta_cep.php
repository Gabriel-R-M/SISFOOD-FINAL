<?php header("Content-Type: text/html; charset=iso-8859-1");?>
<?php ini_set("allow_url_fopen", 1); //funçao habilitada  ?>

<?php
$cep = $_POST['cep'];
$cep = str_replace(".","",$cep);
$cep = str_replace("-","",$cep);
$cep = trim($cep);


function busca_cep($cep){
	$resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');
	if(!$resultado){
		$resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
	}
	parse_str($resultado, $retorno); 
	return $retorno;
}


/*
 * Exemplo de utilização 
 */

//Vamos buscar o CEP 90020022
$resultado_busca = busca_cep($cep);


switch($resultado_busca['resultado']){
	case '2':
	$texto=0;
	break;
	
	case '1':
		$texto = $resultado_busca['logradouro'].'&*&'.$resultado_busca['bairro'].'&*&'.$resultado_busca['cidade'];
	break;
	
	default:
		$texto=0;
	break;
}

echo $texto;
?>