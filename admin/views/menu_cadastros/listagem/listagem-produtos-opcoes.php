<?php
include_once ("../../class/class.db.php");
include_once ("../../class/class.seguranca.php");

$sel = $db->select("SELECT lanches.id, lanches.produto, categorias.categoria 
	FROM lanches 
	LEFT JOIN categorias ON lanches.categoria=categorias.id
	WHERE lanches.ativo='1' 
	ORDER BY lanches.categoria");

		if($db->rows($sel)){
		
		echo '<div class="row row-xs">';	
			
			while($yy = $db->expand($sel)){

				$id_prod = $yy['id'];

				$check='';
				if($edit==1){
					$sel2 = $db->select("SELECT id FROM opcionais2 WHERE id_produto LIKE '%$id_prod%' AND id='$id' LIMIT 1");	
					if($db->rows($sel2)){
						$check = 'checked';
					}
				}
				
				echo '<div class="col-md-3 text-center">';

					echo '<div class="col-md-12 text-center" style="border:1px solid #efefef; margin-bottom:10px; padding:10px">';

						echo '<input class="produto" name="produtos[]" '.$check.' type="checkbox" value="'.$yy['id'].'"><br>';
						echo '<span style="text-transform:uppercase;font-weight:300; color:#990000"><small>['.$yy['categoria'].']</small></span><br>';
						echo '<span style="text-transform:uppercase;font-weight:300">'.$yy['produto'].'</span>';

					echo '</div>';	

				echo '</div>';
			}

		echo '</div>';	



		}  else {

			echo '<br>NENHUM PRODUTO ENCONTRADO.';

		}

?>