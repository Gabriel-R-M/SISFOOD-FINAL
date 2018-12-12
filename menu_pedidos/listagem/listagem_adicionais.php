<?php
require_once("../../admin/class/class.db.php");
require_once("../../admin/class/class.seguranca.php");
require_once("../../includes/verifica_session.php");
require_once("../../includes/verifica_venda_aberta.php");
?>


<?php
$contador_adicionais=0;
$seleciona_produtos = $db->select("SELECT adicionais FROM categorias WHERE id='$categoria'LIMIT 1");
$line = $db->expand($seleciona_produtos);
if($line['adicionais']==1){


	$seleciona_produtos = $db->select("SELECT * FROM opcionais WHERE ativo='1' ORDER BY opcional");
	$class=''; 

	echo '<div class="row row-xs">';

	if($db->rows($seleciona_produtos)) {
		while($line = $db->expand($seleciona_produtos)){
			
			echo '<div class="col-6 col-md-3 bottom10" >';

				if(empty($class)){
					$link='javascript:marca_opcional('.$line['id'].')';
				} else{
					$link = "javascript:void(0)";
				}

				echo '<div class="card cursor produto-round" id="line'.$line['id'].'" onclick="'.$link.'">';
					echo '<div class="col-md-12 detalhes-produtos">';
				  		
				  		echo '<span class="destaca cor_branca" id="1destaca_adicionais'.$line['id'].'">ADICIONAIS</span>';

						echo '<input  type="checkbox" class="hide" name="opc[]" value="'.$line['id'].'"  id="line2'.$line['id'].'">';
					  	
					  	echo '<span class="destaca pull-right" id="2destaca_adicionais'.$line['id'].'">R$ '.number_format($line['valor'],2,",",".").'</span>';
				  		
				  		echo '<h2 class=" prod_name">'.$line['opcional'].'</h2>';	
		

				  	echo '</div>';	
				echo '</div>';

			

			
			echo '</div>';

			$contador_adicionais++;


		}
	} else {
		
		echo '<div class="row row-xs">';
			echo '<div class="col-md-12 bottom10 text-center">';
				echo '<div class="card produto-round">';
					echo '<br>NENHUM ADICIONAL ENCONTRADO PARA A CATEGORIA.';
				echo '</div>';
			echo '</div>';	
		echo '</div>';	
			
	}

	echo '</div>';


} else {
	echo '<div class="row row-xs">';
		echo '<div class="col-md-12 bottom10 text-center">';
			echo '<div class="card produto-round">';
				echo '<br>A CATEGORIA NÃO PERMITE ADICIONAIS.';
			echo '</div>';
		echo '</div>';	
	echo '</div>';		
}

?>	


<input type="hidden" id="contador_adicionais" value="<?php echo $contador_adicionais;  ?>">