<?php
require_once("../../admin/class/class.db.php");
require_once("../../admin/class/class.seguranca.php");

$seleciona_produtos = $db->select("SELECT lanches.preco_composto, lanches.codigo, lanches.id, lanches.produto, categorias.categoria, categorias.meio_meio, categorias.id AS categoria_id    
FROM lanches
LEFT JOIN categorias ON lanches.categoria=categorias.id 
WHERE lanches.ativo='1' AND (lanches.produto LIKE '%$pesquisa%' OR lanches.codigo='$pesquisa') 
ORDER BY lanches.codigo, lanches.categoria, lanches.produto");


echo '<div class="row row-xs">';

if($db->rows($seleciona_produtos)) {
	while($line = $db->expand($seleciona_produtos)){
		
		echo '<div class="col-md-3 bottom10" >';

			if($line['meio_meio']!=0){
				$classe = 'pdr1';
				$classe2 = 'pdr1a';
				echo '<a href="javascript:void(0)" onclick="javascript: seleciona_produtos(1,'.$line['id'].','.$line['preco_composto'].','.$line['categoria_id'].');">';
			} else {
				echo '<a href="javascript:void(0)" onclick="javascript: seleciona_produtos(2,'.$line['id'].','.$line['preco_composto'].','.$line['categoria_id'].');">';
				$classe = 'pdr2';
				$classe2 = 'pdr2a';
			}

			echo '<div class="card '.$classe.' produto-round" id="produtox'.$line['id'].'">';
				echo '<div class="col-md-12 detalhes-produtos">';
			  							

					if($line['meio_meio']!=0){
				  		echo '<input name="produto" type="checkbox" class="radio-produtos2 marca-produtos prod-meio-meio" value="'.$line['id'].'" id="check'.$line['id'].'" >';
				  	} else {				  									
				  		echo '<input name="produto" value="'.$line['id'].'" type="radio" class="radio-produtos2 marca-produtos prod-normais" id="check'.$line['id'].'">';
				  	}
				  							
			  		echo '<input type="text" id="foca_campo'.$line['id'].'" value="['.$line['categoria'].']" class="campo-focus upper '.$classe2.'" readonly>';

			  		if(!empty($line['codigo'])){	
			  			echo '<span class="destaca pull-right" id="destaca'.$line['id'].'">('.$line['codigo'].')</span>';
			  		}

			  		echo '<h2 id="prod_name'.$line['id'].'" class=" prod_name">'.$line['produto'].'</h2>';	
	

			  	echo '</div>';	
			echo '</div>';

		echo '</a>';

		
		echo '</div>';


	}
} else {
	echo '<div class="col-md-12 bottom10 text-center">';
		echo '<div class="card produto-round">';
			echo '<br>NENHUM PRODUTO ENCONTRADO.';
		echo '</div>';
	echo '</div>';	
}

echo '</div>';


?>	
