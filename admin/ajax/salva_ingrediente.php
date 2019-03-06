<?php
require ("../class/class.db.php");
require ("../class/class.seguranca.php");


if($id!=0 || $id!=''){
	$sel = $db->select("UPDATE ingredientes SET ingrediente='$ingrediente' WHERE id='$id' LIMIT 1");
} else {
	$sel = $db->select("INSERT INTO ingredientes (ingrediente) VALUES ('$ingrediente')");
	$id = $db->last_id($sel);
}

echo $id;


?>