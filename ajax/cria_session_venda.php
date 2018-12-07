<?php
require("../admin/class/class.db.php");
require("../admin/class/class.seguranca.php");

@session_start();


unset($_SESSION['id_caixa_erp_sis'] );

$_SESSION['id_venda_erp_sis']=$id;


if(isset($mesa)){
	if($mesa==0){
		unset($_SESSION['id_mesa_erp_sis'] );		
	}
}


echo 1;	

?>