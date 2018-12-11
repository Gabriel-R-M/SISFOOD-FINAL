<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");

unset($_SESSION['id_caixa_erp_sis'] );

require("../../includes/verifica_caixa_aberto.php");

$dt = date("Y-m-d");
$hora = date("H:i:s");
unset($_SESSION['id_venda_erp_sis'] );


//UPDATE NO CLIENTE
if($id_cliente!='' && $id_cliente!=0){

	$query = $db->select("UPDATE clientes SET cartao='$numero_cartao', nome='$nome', ddd='$ddd', telefone='$numero_telefone', celular='$celular', endereco='$endereco', numero='$numero', complemento='$complemento', bairro='$bairro', cidade='$cidade' WHERE id='$id_cliente' LIMIT 1");


	
//NOVO CLIENTE
} else {

		if($nome=='CLIENTE AVULSO'){

			$peg = $db->select("SELECT id FROM clientes WHERE nome='CLIENTE AVULSO' ORDER BY id DESC LIMIT 1");
			if($db->rows($peg)){
				$linha = $db->expand($peg);			
				$id_cliente = $linha['id'];
				$cadastra=0;
			} else {
				$cadastra=1;
			}	

		} else {			
			$cadastra=1;
		}



		if($cadastra==1){
			$query = $db->select("INSERT INTO clientes (venda_avulsa, data_cadastro, cartao, nome, ddd, telefone, celular, endereco, numero, complemento, bairro, cidade) VALUES ('$venda_avulsa', '$dt', '$numero_cartao', '$nome', '$ddd', '$numero_telefone', '$celular', '$endereco', '$numero', '$complemento', '$bairro', '$cidade')");
			
			$peg = $db->select("SELECT id FROM clientes ORDER BY id DESC LIMIT 1");
			$linha = $db->expand($peg);
			
			$id_cliente = $linha['id'];
		}
	
	
}



	$seleciona = $db->select("SELECT id FROM aguarda_venda WHERE id_usuario='$id_usuario' AND finalizada='0' AND aguarde='0' ORDER BY id DESC");

	if($db->rows($seleciona)){
		while($ln = $db->expand($seleciona)){
			$id_venda = $ln['id'];	
			$del = $db->select("DELETE FROM produtos_venda WHERE id_venda='$id_venda'");
			$del = $db->select("DELETE FROM opcionais_produtos_venda WHERE id_venda='$id_venda' ");
			$del = $db->select("DELETE FROM opcionais_produtos_venda2 WHERE id_venda='$id_venda' ");
			$del = $db->select("DELETE FROM aguarda_venda WHERE id='$id_venda'");
			$del = $db->select("DELETE FROM pagamentos_vendas WHERE id_venda='$id_venda'");
		}
	}



	//QUANDO INICIA O PEDIDO ATRAVÉS DA MESA
	@session_start();
	unset($_SESSION['id_mesa_erp_sis'] );
	
	if(isset($mesa) && $mesa!=0){
		$_SESSION['id_mesa_erp_sis']=$mesa;
	} 

	//INICIA PEDIDO
	$insere = $db->select("INSERT INTO aguarda_venda (id_usuario, id_cliente, id_caixa, pedido_inicio, data_pedido) VALUES ('$id_usuario', '$id_cliente', '$id_caixa_aberto', '$hora', '$dt')");



	


echo 1;


?>