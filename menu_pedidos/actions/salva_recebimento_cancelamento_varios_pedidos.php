<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_caixa_aberto.php");
require("../../includes/verifica_configuracoes_loja.php");

$data = date("Y-m-d");
$hora = date("H:i");
$data_hora = date("Y-m-d H:i");

	$pedidos = explode(',', $pedidos);	
	foreach($pedidos as $pedido) {

    	$id_venda = trim($pedido);

    	//CANCELA OS PEDIDOS//
    	if($tipo==2){


            ///VOLTA PRODUTOS NO ESTOQUE////
            $sql_estoque = $db->select("SELECT id_produtos, quantidade FROM produtos_venda WHERE id_venda='$id_venda' ORDER BY id DESC");
            if($db->rows($sql_estoque)){
                while($estoque = $db->expand($sql_estoque)){

                    $qtd_baixa = $estoque['quantidade'];
                    $prod_baixa = $estoque['id_produtos'];

                    if(is_numeric($prod_baixa)){
                        $sql = $db->select("UPDATE lanches SET estoque=estoque+$qtd_baixa WHERE id='$prod_baixa' LIMIT 1");             
                    }

                }
            }

    		$del = $db->select("DELETE FROM estoque_movimentacao WHERE id_venda='$id_venda'");
    		$del = $db->select("DELETE FROM produtos_venda WHERE id_venda='$id_venda'");
			$del = $db->select("DELETE FROM opcionais_produtos_venda WHERE id_venda='$id_venda' ");
			$del = $db->select("DELETE FROM opcionais_produtos_venda2 WHERE id_venda='$id_venda' ");
			$del = $db->select("DELETE FROM pagamentos_vendas WHERE id_venda='$id_venda'");
			$del = $db->select("DELETE FROM contas_clientes WHERE id_venda='$id_venda'");
			$del = $db->select("DELETE FROM aguarda_venda WHERE id='$id_venda' LIMIT 1");
    	
    	//RECEBE OS PEDIDOS	
    	} else {

    		$seleciona = $db->select("SELECT valor_final_venda, id_cliente FROM aguarda_venda WHERE id='$id_venda' LIMIT 1");
    		$dados_v = $db->expand($seleciona);

    		$valor_final =  $dados_v['valor_final_venda'];

    		$sql = $db->select("INSERT INTO pagamentos_vendas (id_venda, forma_pagamento, valor_pagamento, id_usuario, data, hora, id_caixa, valor_caixa_real) VALUES ('$id_venda', '$forma_pagamento_baixa_varios_pedidos', '$valor_final', '$id_usuario', '$data', '$hora', '$id_caixa_aberto', '$valor_final')");	

			$sql = $db->select("UPDATE aguarda_venda SET finalizada='1', id_mesa='0', aguarde='0', baixado='1'  WHERE id='$id_venda' LIMIT 1");



            ///BAIXA NO ESTOQUE////
            $sql_estoque = $db->select("SELECT id_produtos, quantidade FROM produtos_venda WHERE id_venda='$id_venda' ORDER BY id DESC");
            if($db->rows($sql_estoque)){
                while($estoque = $db->expand($sql_estoque)){

                    $qtd_baixa = $estoque['quantidade'];
                    $prod_baixa = $estoque['id_produtos'];

                    if(is_numeric($prod_baixa)){

                        $sql = $db->select("UPDATE lanches SET estoque=estoque-$qtd_baixa WHERE id='$prod_baixa' LIMIT 1");     

                        $sel = $db->select("INSERT INTO estoque_movimentacao (id_produto, quantidade, data, hora, tipo, id_venda, id_usuario) VALUES ('$prod_baixa', '$qtd_baixa', '$data', '$hora', '0', '$id_venda', '$id_usuario')");        
                    }

                }
            }



            $id_cliente_venda = $dados_v['id_cliente'];
            $seleciona2 = $db->select("SELECT * FROM clientes WHERE id='$id_cliente_venda' LIMIT 1");
            $dados_cliente = $db->expand($seleciona2);

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


    	}
    	
    	
	}

?>