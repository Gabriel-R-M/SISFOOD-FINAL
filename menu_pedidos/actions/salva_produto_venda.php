<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");


$preco_produto=0;
$tam = explode('&@@&', $tamanho);
$tamanho = $tam[0];

//PRODUTO NORMAL
if(!empty($normal)){

	$ids_produtos = $normal;

	$pg = $db->select("SELECT categoria FROM lanches WHERE id='$ids_produtos' LIMIT 1");
	$var = $db->expand($pg);		
	$categoria_produto = $var['categoria'];

	$samba = $db->select("SELECT preco FROM lanches_tamanhos_valores WHERE id_tamanho='$tamanho' AND id_produto='$ids_produtos' LIMIT 1");

	$result_preco = $db->expand($samba);
	$preco_produto = $result_preco['preco'];

	
//PRODUTO MEIO MEIO
} else if(!empty($meio_meio)){

	$preco_maior=0;
	$ids_produtos='';
	$prods = explode(',', $meio_meio);	
	foreach($prods as $prod) {

    	$id_produto = trim($prod);

    	$samba = $db->select("SELECT preco FROM lanches_tamanhos_valores WHERE id_tamanho='$tamanho' AND id_produto='$id_produto' LIMIT 1");
		$result_preco = $db->expand($samba);

		if($result_preco['preco']>$preco_produto){
			$preco_produto = $result_preco['preco'];
		}

    	$pg = $db->select("SELECT categoria FROM lanches WHERE id='$id_produto' LIMIT 1");
		$var = $db->expand($pg);		
		$categoria_produto = $var['categoria'];

    	$ids_produtos= $ids_produtos.$id_produto.',';
    	
	}

	//REMOVE A ULTIMA VIRGULA
	$final = substr($ids_produtos, -1);
	if($final==','){
		$size = strlen($ids_produtos);
		$ids_produtos = substr($ids_produtos,0, $size-1);
	}

	
}

//SALVA O PRODUTO
$insere = $db->select("INSERT INTO produtos_venda (id_venda, id_produtos, quantidade, categoria_produto, nome_cliente_divisao, tamanho, observacoes, valor) VALUES ('$id_venda', '$ids_produtos', '$qtd', '$categoria_produto', '$nome_cliente', '$tamanho', '$observacoes', '$preco_produto')");

$ultimo_id = $db->last_id($insere);


//SE TIVER ADICIONAIS
$o = explode(',',$opcionais);
$quantos = count($o);

if($quantos>0){			
	for($i=0;$i+1<=$quantos;$i++){
		
		$kk = $o[$i];
		
		if($kk!=0){
		
			$pu = $db->select("SELECT valor FROM opcionais WHERE id='$kk' LIMIT 1");
			$h = $db->expand($pu);
			$val_opc = $h['valor'];
			
			$ins = $db->select("INSERT INTO opcionais_produtos_venda (id_produto, id_opcional, valor_opcional, id_venda, id_controle) VALUES ('$ids_produtos', '$kk', '$val_opc', '$id_venda', '$ultimo_id')");
		
		}
		
	}
}



//SE TIVER OPCOES
$o = explode(',',$opcoes_produto);
$quantos = count($o);


if($quantos>0){			
	for($i=0;$i+1<=$quantos;$i++){
		
		$kk = $o[$i];
		
		if($kk!=0){
		
			$pu = $db->select("SELECT valor_opcional2 FROM opcionais2 WHERE id='$kk' LIMIT 1");
			$h = $db->expand($pu);
			$val_opc = $h['valor_opcional2'];
			
			$ins = $db->select("INSERT INTO opcionais_produtos_venda2 (id_produto, id_opcional, valor_opcional, id_venda, id_controle) VALUES ('$ids_produtos', '$kk', '$val_opc', '$id_venda', '$ultimo_id')");
		
		}
		
	}


}


require("salva_totais_pedido.php");

?>