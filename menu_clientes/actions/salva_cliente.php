<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");


if(isset($id_cliente_venda_altera) && $id_cliente_venda_altera!=''){	
	if($id_cliente=='' || $id_cliente==0){
		$id_cliente = $id_cliente_venda_altera;
	}
}

$dt = date("Y-m-d");
$hora = date("H:i:s");



if($id_cliente!=''){

	$update=1;

	$peg = $db->select("SELECT nome FROM clientes WHERE id='$id_cliente' LIMIT 1");
	$linha = $db->expand($peg);			
	//SE FOR CLIENTE AVULSO CADASTRA ELE COMO NOVO
	if($linha['nome']=='CLIENTE AVULSO'){

		$query = $db->select("INSERT INTO clientes (venda_avulsa, data_cadastro, cartao, nome, ddd, telefone, celular, endereco, numero, complemento, bairro, cidade) VALUES ('$venda_avulsa', '$dt', '$numero_cartao', '$nome', '$ddd', '$numero_telefone', '$celular', '$endereco', '$numero', '$complemento', '$bairro', '$cidade')");

		$peg = $db->select("SELECT id FROM clientes ORDER BY id DESC LIMIT 1");
		$linha = $db->expand($peg);
		$id_cliente = $linha['id'];

	//SENAO FAZ O UPDATE	
	} else {

		$query = $db->select("UPDATE clientes SET cartao='$numero_cartao', nome='$nome', ddd='$ddd', telefone='$numero_telefone', celular='$celular', endereco='$endereco', numero='$numero', complemento='$complemento', bairro='$bairro', cidade='$cidade' WHERE id='$id_cliente' LIMIT 1");

	}
	
	
	

} else {

	$update=0;
	
	$query = $db->select("INSERT INTO clientes (venda_avulsa, data_cadastro, cartao, nome, ddd, telefone, celular, endereco, numero, complemento, bairro, cidade) VALUES ('$venda_avulsa', '$dt', '$numero_cartao', '$nome', '$ddd', '$numero_telefone', '$celular', '$endereco', '$numero', '$complemento', '$bairro', '$cidade')");



	$peg = $db->select("SELECT id FROM clientes ORDER BY id DESC LIMIT 1");
	$linha = $db->expand($peg);
	$id_cliente = $linha['id'];

}


	//ALTERA O CLIENTE DA VENDA CASO VENHA A VÁRIAVEL
	if(isset($altera_cliente_venda)){
			$sql = $db->select("UPDATE aguarda_venda SET id_cliente='$id_cliente' WHERE id='$id_venda' LIMIT 1");
	}


echo $update;


?>	