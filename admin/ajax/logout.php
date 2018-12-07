<?php header("Content-Type: text/html; charset=iso-8859-1");?>
<?php include("../class/class.db.php"); ?>
<?php include("../class/class.seguranca.php"); ?>


<?php
@session_start();			
session_destroy();
?>