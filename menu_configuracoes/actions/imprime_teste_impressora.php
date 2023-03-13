<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_configuracoes_loja.php");


if($impressora==1){
$file = '../../pedidos_imprimir/pasta1/teste_impressora.txt';
$_file  = fopen($file,"w");
fwrite($_file,"\r\n"."\r\n"."\r\n"."\r\n".'TESTE IMPRESSORA - OK'."\r\n"."\r\n"."\r\n"."\r\n"."\r\n"."\r\n");
fclose($_file);
}

if($impressora==2){
$file2 = '../../pedidos_imprimir/pasta2/teste_impressora.txt';
$_file2  = fopen($file2,"w");
fwrite($_file2,"\r\n"."\r\n"."\r\n"."\r\n".'TESTE IMPRESSORA - OK'."\r\n"."\r\n"."\r\n"."\r\n"."\r\n"."\r\n");
fclose($_file2);	
}

if($impressora==3){
$file3 = '../../pedidos_imprimir/pasta3/teste_impressora.txt';
$_file3  = fopen($file3,"w");
fwrite($_file3,"\r\n"."\r\n"."\r\n"."\r\n".'TESTE IMPRESSORA - OK'."\r\n"."\r\n"."\r\n"."\r\n"."\r\n"."\r\n");
fclose($_file3);
}

if($impressora==4){
$file4 = '../../pedidos_imprimir/pasta4/teste_impressora.txt';
$_file4  = fopen($file4,"w");
fwrite($_file4,"\r\n"."\r\n"."\r\n"."\r\n".'TESTE IMPRESSORA - OK'."\r\n"."\r\n"."\r\n"."\r\n"."\r\n"."\r\n");
fclose($_file4);
}
?>