<?php					
include_once("../../config.php");

						$sel = $db->select("SELECT * FROM tamanhos WHERE id_categoria='$categoriax' ORDER BY id");
						if($db->rows($sel)){

							echo '<div class="col-md-12 col-lg-12 mg-t-20 mg-md-t-0-force">
              					<ul class="list-group">
                			';

							$r=80000;
							while($yy = $db->expand($sel)){
								$ord='';
								$pts='';
								$check = '';
								$disabled = 'disabled';
								$id_tam = $yy['id'];								
								//if($x==1){	

									$pei = $db->select("SELECT * FROM lanches_tamanhos_valores WHERE id_produto='$id' AND id_tamanho='$id_tam' LIMIT 1");
									if($db->rows($pei)){
										$ju = $db->expand($pei);
										$check = 'checked="checked"';	
										$ord=$ju['preco'];	
										$pts=$ju['pontos'];	
										$disabled = '';
									}

								//}
												
								echo'
										
										<li class="list-group-item">
						                  <p class="mg-b-0">
						                  <input '.$check.' type="checkbox" value="'.$yy['id'].'" name="variacoes[]" class="chk chk2" data-id="'.$r.'">
						                  <strong class="tx-inverse tx-medium">&nbsp;'.$yy['tamanho'].'</strong>

						                  <div class="row row-xs">

						                  		<div class="col-md-12">
						                  			<input type="text" '.$disabled.'  placeholder="0.00" id="ord'.$r.'" value="'.$ord.'" class="form-control valores2 xxvv2" name="precos[]"  >
						                  		</div>

						                  		
						                  </div>

						                  

						                  </p>
						                </li>
               

															
											
									';	
								
								$r++;
							}

							echo '</ul>
            				</div>';

						} else {

								echo '<div class="col-md-12"><div class="alert alert-danger">Nenhuma variação de preço encontrada para esta categoria.</div></div>';
						}
					
?> 


<?php 
if(!isset($edit)){
?>	

<?php
}
?>




<script src="<?php echo ADMIN_DIR; ?>lib/jquery/js/jquery.js"></script>
<script src="<?php echo ADMIN_DIR; ?>js/mascara_money.js"></script>
<script src="<?php echo ADMIN_DIR; ?>javascript/funcoes.js"></script>


<script>
	$(".valores2").maskMoney({
	    symbol:'', // Simbolo
	    decimal:'.', // Separador do decimal
	    precision:2, // Precisão
	    thousands:'', // Separador para os milhares
	    allowZero:true, // Permite que o digito 0 seja o primeiro caractere
	    showSymbol:false // Exibe/Oculta o símbolo
    });
</script>

