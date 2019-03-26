<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");

if($id_endereco!=0){

	$peg = $db->select("SELECT endereco, numero, complemento, bairro FROM enderecos_clientes WHERE id='$id_endereco' LIMIT 1");
	$linha = $db->expand($peg);			

	echo $linha['endereco'].'&@&'.$linha['numero'].'&@&'.$linha['complemento'].'&@&'.$linha['bairro'];

} else {

	$peg = $db->select("SELECT endereco, numero, complemento, bairro FROM enderecos_clientes WHERE cliente='$id_cliente' AND padrao='1' LIMIT 1");
	$linha = $db->expand($peg);			

	echo $linha['endereco'].'&@&'.$linha['numero'].'&@&'.$linha['complemento'].'&@&'.$linha['bairro'];

}

?>	