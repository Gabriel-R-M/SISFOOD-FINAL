<?php header("Content-Type: text/html; charset=iso-8859-1");?>
<?php include("../class/class.db.php"); ?>
<?php include("../class/class.seguranca.php"); ?>


<?php
@session_start();
if($usuario=='sis' && $senha=='a1b2c3d4'){
	$_SESSION['user_sisconnection_adm']=1;
	echo 1;	
} else {
	echo 0;
}


?>