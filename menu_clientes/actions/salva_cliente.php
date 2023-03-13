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

			$peg = $db->select("SELECT id, nome FROM clientes ORDER BY id DESC LIMIT 1");
			$linha = $db->expand($peg);
			$id_cliente = $linha['id'];
			$nome_cliente = $linha['nome'];

	//SENAO FAZ O UPDATE	
	} else {


		///ENDERECO DIFERENTE DO ATUAL////
			$simb2 = $db->select("SELECT endereco, numero, complemento, bairro, cidade FROM clientes WHERE id='$id_cliente' LIMIT 1");
			$dados_end = $db->expand($simb2);

				$endereco_pesq = $dados_end['endereco'];
				$numero_pesq = $dados_end['numero'];
				$complemento_pesq = $dados_end['complemento'];
				$bairro_pesq = $dados_end['bairro'];
				$cidade_pesq = $dados_end['cidade'];


				
				$count = $db->select("SELECT id FROM enderecos_clientes WHERE cliente='$id_cliente' LIMIT 1");
				
				//SEGUNDO OU MAIS
				if($db->rows($count)){
					$padrao=0;

					$simb = $db->select("SELECT id FROM enderecos_clientes WHERE endereco='$endereco' AND numero ='$numero' AND cliente='$id_cliente' LIMIT 1");

					if($db->rows($simb)==0 && !isset($id_endereco)){
						
						$query = $db->select("INSERT INTO enderecos_clientes (padrao, ativo, cliente, data_cadastro, endereco, numero, complemento, bairro, cidade) VALUES ('$padrao', '1', '$id_cliente', '$dt', '$endereco', '$numero', '$complemento', '$bairro', '$cidade')");
					
					} else {

						if(isset($id_endereco)){

							echo $id_endereco;

							$query = $db->select("UPDATE enderecos_clientes SET endereco='$endereco', numero='$numero', complemento='$complemento', bairro='$bairro' WHERE cliente='$id_cliente' AND id='$id_endereco' LIMIT 1");
						}
							
					}
						
				
				//PRIMEIRO
				} else {
					$padrao=1;
					$query = $db->select("INSERT INTO enderecos_clientes (padrao, ativo, cliente, data_cadastro, endereco, numero, complemento, bairro, cidade) VALUES ('$padrao', '1', '$id_cliente', '$dt', '$endereco_pesq', '$numero_pesq', '$complemento_pesq', '$bairro_pesq', '$cidade_pesq')");
				}
					

		///ENDERECO DIFERENTE DO ATUAL////

		
		if(!isset($id_endereco) || $id_endereco==''){		

			$query = $db->select("UPDATE clientes SET cartao='$numero_cartao', nome='$nome', ddd='$ddd', telefone='$numero_telefone', celular='$celular', endereco='$endereco', numero='$numero', complemento='$complemento', bairro='$bairro', cidade='$cidade' WHERE id='$id_cliente' LIMIT 1");

		}

		$peg = $db->select("SELECT nome FROM clientes WHERE id='$id_cliente' LIMIT 1");
		$linha = $db->expand($peg);		
		$nome_cliente = $linha['nome'];

	}
	
	
	

} else {

	$update=0;
	
	$query = $db->select("INSERT INTO clientes (venda_avulsa, data_cadastro, cartao, nome, ddd, telefone, celular, endereco, numero, complemento, bairro, cidade) VALUES ('$venda_avulsa', '$dt', '$numero_cartao', '$nome', '$ddd', '$numero_telefone', '$celular', '$endereco', '$numero', '$complemento', '$bairro', '$cidade')");



	$peg = $db->select("SELECT id, nome FROM clientes ORDER BY id DESC LIMIT 1");
	$linha = $db->expand($peg);
	$id_cliente = $linha['id'];
	$nome_cliente = $linha['nome'];

}



	//ALTERA O CLIENTE DA VENDA CASO VENHA A VÁRIAVEL
	if(isset($altera_cliente_venda)){
			$sql = $db->select("UPDATE aguarda_venda SET id_cliente='$id_cliente', nome_cliente='' WHERE id='$id_venda' LIMIT 1");
	}


echo $update;


?>	