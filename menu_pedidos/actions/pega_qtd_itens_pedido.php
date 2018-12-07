<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_venda_aberta.php");

$sql = $db->select("SELECT SUM(quantidade) AS qtd_total FROM produtos_venda WHERE id_venda='$id_venda'");
$row = $db->expand($sql);

if($row['qtd_total']==''){$row['qtd_total']=0;}
echo $row['qtd_total'];

?>