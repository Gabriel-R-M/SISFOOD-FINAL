<?php
require("admin/class/class.db.php");
require("admin/class/class.seguranca.php");
require("includes/verifica_configuracoes_loja.php");
require("includes/verifica_venda_aberta.php");


function imprime_caixa($arquivo){

	echo $arquivo;


}


$path = "pedidos_imprimir/";
$diretorio = dir($path);
 
while($arquivo = $diretorio -> read() ){
	if($arquivo!='..' && $arquivo!='.' && $arquivo!='cozinha'){		
		imprime_caixa($arquivo);
		sleep(2);		
	}
}
$diretorio -> close();

?>