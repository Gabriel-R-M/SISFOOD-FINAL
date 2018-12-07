<?php header("Content-Type: text/html; charset=iso-8859-1");?>
<?php include("../includes/conecta.php"); ?>
<?php include("../includes/seguranca.php"); ?>

<?php

//TELEFONE
if($tipo==1){
	$pega = mysql_query("SELECT * FROM clientes WHERE telefone='$telefone' OR celular='$telefone' LIMIT 1");			
//CARTAO
} else if($tipo==2){
	$pega = mysql_query("SELECT * FROM clientes WHERE cartao='$cartao' LIMIT 1");			
}

if(mysql_num_rows($pega)){
	
	$pontuacao_real =0;
	$pontuacao_usada =0;
	$ln = mysql_fetch_array($pega);
	$id_cliente_achado = $ln['id'];
	
	///PONTOS///
	$pontos = mysql_query("SELECT SUM(pontos) AS pontos FROM pontuacao_acumulada WHERE id_cliente='$id_cliente_achado'");
	if(mysql_num_rows($pontos)){
		$pt = mysql_fetch_array($pontos);
		$pontos = $pt['pontos'];
		$pontuacao_real = $pontos;
	}
	
	$pontos2 = mysql_query("SELECT SUM(pontos) AS pontos FROM pontuacao_usada WHERE id_cliente='$id_cliente_achado'");
	if(mysql_num_rows($pontos2)){
		$pt2 = mysql_fetch_array($pontos2);
		$pontos2 = $pt2['pontos'];
		$pontuacao_usada = $pontos2;
		
		$pontuacao_real = ($pontuacao_real-$pontuacao_usada);
	}
	
	
	///PONTOS///
	
	
	
	echo $ln['id'].'&*&'.$ln['cartao'].'&*&'.$ln['nome'].'&*&'.$ln['ddd'].'&*&'.$ln['telefone'].'&*&'.$ln['celular'].'&*&'.$ln['endereco'].'&*&'.$ln['numero'].'&*&'.$ln['cep'].'&*&'.$ln['complemento'].'&*&'.$ln['bairro'].'&*&'.$ln['cidade'].'&*&'.$pontuacao_real;
		
} else {
	echo 0;		
}




?>