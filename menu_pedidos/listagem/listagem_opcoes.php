<?php
require_once("../../admin/class/class.db.php");
require_once("../../admin/class/class.seguranca.php");
require_once("../../includes/verifica_session.php");
require_once("../../includes/verifica_venda_aberta.php");
?>

<?php

$contador_opcoes=0;

$seleciona_produtos = $db->select("SELECT * FROM opcionais2 
	WHERE ativo='1' AND (id_categoria LIKE '%$categoria%' OR id_produto LIKE '%$produto%') 
	ORDER BY opcional2");
$class=''; 

echo '<div class="row row-xs">';


if($db->rows($seleciona_produtos)) {
	while($line = $db->expand($seleciona_produtos)){
		
		echo '<div class="col-6 col-md-3 bottom10" >';

			if(empty($class)){
				$link='javascript:marca_opcoes('.$line['id'].')';
			} else{
				$link = "javascript:void(0)";
			}

			echo '<div class="card cursor produto-round opcoes_combo" id="line_opcao'.$line['id'].'" onclick="'.$link.'">';
				echo '<div class="col-md-12 detalhes-produtos">';
			  		
			  		echo '<span class="destaca cor_branca" id="3destaca_adicionais'.$line['id'].'">OPÇÕES</span>';

					echo '<input  type="checkbox" class="hide opcoes_desmarca" name="opcoes[]" value="'.$line['id'].'"  id="line2_opcao'.$line['id'].'">';
				  	
				  	echo '<span class="destaca pull-right" id="4destaca_adicionais'.$line['id'].'">R$ '.number_format($line['valor_opcional2'],2,",",".").'</span>';
			  		
			  		echo '<h2 class=" prod_name">'.$line['opcional2'].'</h2>';	
	

			  	echo '</div>';	
			echo '</div>';

		

		
		echo '</div>';
		
		$contador_opcoes++;
	}
} else {
	echo '<div class="col-md-12 bottom10 text-center">';
		echo '<div class="card produto-round">';
			echo '<br>NENHUMA OPÇÃO ENCONTRADA PARA A CATEGORIA OU PRODUTO.';
		echo '</div>';
	echo '</div>';	
}

echo '</div>';


?>	

<input type="hidden" id="contador_opcoes" value="<?php echo $contador_opcoes;  ?>">