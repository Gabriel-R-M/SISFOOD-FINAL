<?php
require("admin/class/class.db.php");
require("admin/class/class.seguranca.php");
require("includes/verifica_configuracoes_loja.php");
require("includes/verifica_venda_aberta.php");




        


        $txt = ajusta_caracteres_impressao('testajshasahsgbans12lkalska12askal99088129182828','M');


        $arquivo = 'pedido23.txt';	
	    $file = 'pedidos_imprimir/'.$arquivo;
	    $_file  = fopen($file,"w"); 
	    fwrite($_file,$txt); 
	    fclose($_file);




?>        