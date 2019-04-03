<?php
require("../admin/class/class.db.php");
require("../admin/class/class.seguranca.php");
require("../includes/verifica_dados_loja.php");
require("../includes/verifica_dados_fiscais.php");
require("../includes/verifica_venda_aberta.php");
require("../diversos/funcoes_impressao.php");
require("../diversos/funcoes_diversas.php");


$caminho_acbr=$dados_fiscais['caminho_acbr'];

@unlink("$caminho_acbr\sai.txt");
@unlink("$caminho_acbr\cupom.ini");

	
///CRIA O ARQUIVO INI PARA ENVIAR AO SAT///
$ecf = '[infCFe]

versao=0.07


[Identificacao]
CNPJ='.trim($dados_fiscais['cnpj_desenvolvedor']).'
signAC='.trim($dados_fiscais['chave_sat']).'
numeroCaixa=1


[Emitente]
CNPJ='.trim($dados_loja['cnpj']).'
IE='.trim($dados_loja['inscricao_estadual']).'
IM=
indRatISSQN=N';


if(!empty($cpf_cliente)){

$ecf .= '

[Destinatario]
CNPJCPF='.trim($cpf_cliente);

}

$imposto_transparencia = 0;

$sql = $db->select("SELECT * FROM produtos_venda WHERE id_venda='$id_venda' ORDER BY id DESC");
$qtd_produtos_carrinho = $db->rows($sql);
if($db->rows($sql)){
	$x=1;
	while($row = $db->expand($sql)){

		$id_produto = $row['id_produtos'];

		//APENAS UM PRODUTO
		if(is_numeric($row['id_produtos'])){

			$pg = $db->select("SELECT produto, categoria FROM lanches WHERE id='$id_produto' LIMIT 1");
			$var = $db->expand($pg);			
			$nome_produto= $var['produto'];
			$categoria_produto=$var['categoria'];

		//MEIO A MEIO	
		} else {	

			$nome_produto='';
			$prods = explode(',', $row['id_produtos']);	
			foreach($prods as $prod) {

		    	$id_produto = trim($prod);		    	

		    	$pg = $db->select("SELECT produto, categoria FROM lanches WHERE id='$id_produto' LIMIT 1");
				$var = $db->expand($pg);				

				$nome_produto= $nome_produto.$var['produto'].'/';
				$categoria_produto=$var['categoria'];
			}
		}	

		//REMOVE A ULTIMA BARRA
		$final = substr($nome_produto, -1);
		if($final=='/'){
			$size = strlen($nome_produto);
			$nome_produto = substr($nome_produto,0, $size-1);
		}




$ecf.= '

[Produto00'.$x.']
cProd='.$id_produto.'				
xProd='.retira_acentos($nome_produto).'
NCM='.impostos_fiscais_produto('ncm',$id_produto,$categoria_produto).'
CFOP='.impostos_fiscais_produto('cfop',$id_produto,$categoria_produto).'
uCom=UN
qCom='.$row['quantidade'].'				
vUnCom='.$row['valor'].'				
indRegra=A';

$ecf.= '

[ICMS00'.$x.']
Orig=0
CSOSN='.impostos_fiscais_produto('csosn',$id_produto,$categoria_produto);

$ecf.= '

[PIS00'.$x.']
CST='.impostos_fiscais_produto('cst',$id_produto,$categoria_produto);

$ecf.= '

[COFINS00'.$x.']
CST='.impostos_fiscais_produto('cst',$id_produto,$categoria_produto);


		/////IMPOSTO LEI TRANSPARENCIA//////
		$total_produto = ($row['valor']*$row['quantidade']);
		$imposto_produto = impostos_fiscais_produto('ncm',$id_produto,$categoria_produto,'imposto_lei',$total_produto);
		$imposto_transparencia = ($imposto_transparencia+$imposto_produto);
		////////////////////////////////////



		$x++;

	}
}		



if($imposto_transparencia!=0){
$ecf.= '

[Total]
vCFeLei12741='.$imposto_transparencia;	
}


//TAXA DE ENTREGA////
if($dados_venda['valor_entrega']!='0.00'){
	$ecf.= '

[DescAcrEntr]
vAcresSubtot='.$dados_venda['valor_entrega'];
}


//DESCONTOS////
if($dados_venda['valor_desconto']!='0.00'){
	$ecf.= '

[DescAcrEntr]
vDescSubtot='.$dados_venda['valor_desconto'];
}


/////PAGAMENTOS///
$sql = $db->select("SELECT * FROM pagamentos_vendas WHERE id_venda='$id_venda' ORDER BY id DESC");
$qtd_produtos_carrinho = $db->rows($sql);
if($db->rows($sql)){
	$x=1;
	while($row = $db->expand($sql)){

		// MEIOS PAGAMENTOS - SAT
		//01 - Dinheiro
		//02 - Cheque
		//03 - Cartão de Crédito
		//04 - Cartão de Débito
		//05 - Crédito Loja
		//10 - Vale Alimentação
		//11 - Vale Refeição
		//12 - Vale Presente
		//13 - Vale Combustível	

		$pgto ='01';

		//DINHEIRO
		if($row['forma_pagamento']==1){$pgto ='01';}
		if($row['forma_pagamento']==2){$pgto ='03';}

$ecf.= '

[Pagto00'.$x.']
cMP='.$pgto.'
vMP='.$row['valor_pagamento'];

		$x++;

	}
}


$ecf.= '

[DadosAdicionais]
infCpl=Sis E-Food Sistemas
';
	

	$fp = fopen("$caminho_acbr\cupom.ini", "w");
	$escreve = fwrite($fp, $ecf);
	fclose($fp); 					
	///CRIA O ARQUIVO INI PARA ENVIAR AO SAT///


	echo 1;
		

		
?>