<?php
include_once ("../../class/class.db.php");
include_once ("../../class/class.seguranca.php");


$sel2 = $db->select("SELECT id_produto FROM opcionais2 WHERE  id='$id'");	
$prods_id = $db->expand($sel2);
$teste = $prods_id['id_produto'];
$tagsArray = explode(',', $teste);

$sel = $db->select("SELECT lanches.id, lanches.produto, lanches.categoria AS catx, categorias.categoria 
	FROM lanches 
	LEFT JOIN categorias ON lanches.categoria=categorias.id
	WHERE lanches.ativo='1' 
	ORDER BY lanches.categoria");

		if($db->rows($sel)){
		
		echo '<div class="row row-xs">';	
			
			while($yy = $db->expand($sel)){

				$id_prod = $yy['id'];

				$check='';

				if (in_array($id_prod, $tagsArray)) {
					$check='checked';
				} 
						
				
				echo '<div class="col-md-3 text-center">';

					echo '<div class="col-md-12 text-center" style="border:1px solid #efefef; margin-bottom:10px; padding:10px">';

						echo '<input class="produto  prdx'.$yy['catx'].' prdx0" name="produtos[]" '.$check.' type="checkbox" value="'.$yy['id'].'"><br>';
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