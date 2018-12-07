<?php
include_once ("../../class/class.db.php");
include_once ("../../class/class.seguranca.php");

$sel = $db->select("SELECT id, categoria FROM categorias WHERE ativo='1' ORDER BY categoria");

		if($db->rows($sel)){
		
		echo '<div class="row row-xs">';	
			
			while($yy = $db->expand($sel)){

				$id_cat = $yy['id'];

				$check='';
				if($edit==1){
					$sel2 = $db->select("SELECT id FROM opcionais2 WHERE id_categoria LIKE '%$id_cat%' AND id='$id' LIMIT 1");	
					if($db->rows($sel2)){
						$check = 'checked';
					}
				}
				
				echo '<div class="col-md-3 text-center">';

					echo '<div class="col-md-12 text-center" style="border:1px solid #efefef; margin-bottom:10px; padding:10px">';

						echo '<input class="categoria" name="categorias[]" '.$check.' type="checkbox" value="'.$yy['id'].'"><br>';
						echo '<span style="text-transform:uppercase; margin-top:8px; font-weight:300">'.$yy['categoria'].'</span>';

					echo '</div>';	

				echo '</div>';
			}

		echo '</div>';	



		}  else {

			echo '<br>NENHUMA CATEGORIA ENCONTRADA.';

		}

?>