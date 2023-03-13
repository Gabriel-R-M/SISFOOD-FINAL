<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
?>



<?php 
$seleciona_produtos = $db->select("SELECT id, codigo, produto, preco_composto, categoria FROM lanches WHERE produto LIKE '%$busca%' AND ativo='1'  ORDER BY produto ");
if($db->rows($seleciona_produtos)){
	while($row = $db->expand($seleciona_produtos)){	

		$id_produto = $row['id'];
		$categoria = $row['categoria'];

?>

	<div class="col-md-12 upper text-left">
		<?php echo $row['produto']; ?>
		<?php
		if($row['preco_composto']==1){

			$sel1 = $db->select("SELECT * FROM tamanhos WHERE id_categoria='$categoria' ORDER BY id");
			if($db->rows($sel1)){
				while($yy = $db->expand($sel1)){
					
					$id_tam = $yy['id'];							
					$pei = $db->select("SELECT * FROM lanches_tamanhos_valores WHERE id_produto='$id_produto' AND id_tamanho='$id_tam' LIMIT 1");
					while($ju = $db->expand($pei)){
            			$val_unico= $ju['preco'];
						
						echo '<br><span style="color:#990000">'.$yy['tamanho'].' - R$ '.$val_unico.'</span>';
					}

				}

			} 

		} else {

			$pei = $db->select("SELECT preco FROM lanches_tamanhos_valores WHERE id_produto='$id_produto' AND id_tamanho='0' LIMIT 1");
            $ju = $db->expand($pei);
            $val_unico= $ju['preco'];

            echo '<br><span style="color:#990000">R$ '.$val_unico.'</span>';

		}

		?>


		<hr>
	</div>	

<?php 
	}
} else {
?>



<?php 
}
?>
