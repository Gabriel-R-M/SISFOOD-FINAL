<?php
require_once("../../admin/class/class.db.php");
require_once("../../admin/class/class.seguranca.php");
require_once("../../includes/verifica_session.php");
require_once("../../includes/verifica_venda_aberta.php");
?>

<option value="">-- ESCOLHA UMA OPÇÃO --</option>
<?php
$peg = $db->select("SELECT * FROM tamanhos WHERE id_categoria='$categoria' ORDER BY tamanho");
while($line= $db->expand($peg)){
	$id_tamanho = $line['id'];
	
	$puk = $db->select("SELECT id FROM lanches_tamanhos_valores WHERE id_tamanho='$id_tamanho' AND id_produto='$produto' LIMIT 1");
		if($db->rows($puk)){
			echo '<option value="'.$line['id'].'&@@&'.$line['opcao_obrigatoria'].'">'.$line['tamanho'].'</option>';			
		}
}
?>