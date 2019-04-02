<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_venda_aberta.php");

	
	$id_mesa_ocupou=$dados_venda['id_mesa'];	

	
	$sql = $db->select("UPDATE aguarda_venda SET finalizada='1', id_mesa='0', aguarde='0', ocupou_mesa='$id_mesa_ocupou'  WHERE id='$id_venda' LIMIT 1");
	


	@session_start();
	unset($_SESSION['id_caixa_erp_sis'] );
	$_SESSION['id_venda_erp_sis']=$id_venda;


	////TRANSFERE A VENDA PARA CLIENTE AVULSO CASO O TELEFONE SEJA VAZIO////
	if($dados_cliente['telefone']=='' && $dados_cliente['nome']!='CLIENTE AVULSO'){

		$peg = $db->select("SELECT id FROM clientes WHERE nome='CLIENTE AVULSO' ORDER BY id DESC LIMIT 1");
		if($db->rows($peg)){
			$linha = $db->expand($peg);			
			$id_cliente = $linha['id'];
			$cadastra=0;
		} else {
			$cadastra=1;
		}


		if($cadastra==1){
			$query = $db->select("INSERT INTO clientes (nome) VALUES ('CLIENTE AVULSO')");
			
			$peg = $db->select("SELECT id FROM clientes ORDER BY id DESC LIMIT 1");
			$linha = $db->expand($peg);
			
			$id_cliente = $linha['id'];
		}


		$sql = $db->select("UPDATE aguarda_venda SET id_cliente='$id_cliente' WHERE id='$id_venda' LIMIT 1");


		//APAGA O CLIENTE QUE TINHA APENAS O NOME//
		$sql = $db->select("DELETE FROM clientes WHERE id='$id_cliente_venda' LIMIT 1");



	}
	////////////////////////////////////////////////////////////////////////


	@session_start();
	unset($_SESSION['id_venda_erp_sis'] );



?>