<?php
require ("../class/class.db.php");
require ("../class/class.seguranca.php");

$sql_ncm = $db->select("SELECT codigo, descricao FROM fiscal_ncm WHERE codigo='$ncm' LIMIT 1");
if($db->rows($sql_ncm)){
	echo 1;
} else {
	echo 0;
}

?>                                      