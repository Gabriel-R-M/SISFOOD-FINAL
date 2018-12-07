<?php
						
include_once("../class/class.db.php");
include_once("../class/class.seguranca.php");





						$sel = $db->select("SELECT * FROM tamanhos WHERE id_categoria='$categoriax' ORDER BY id");
						if($db->rows($sel)){
							$r=80000;
							while($yy = $db->expand($sel)){
								$ord='';
								$check = '';
								$disabled = 'disabled';
								$id_tam = $yy['id'];								
								//if($x==1){	

									$pei = $db->select("SELECT * FROM lanches_tamanhos_valores WHERE id_produto='$id' AND id_tamanho='$id_tam' LIMIT 1");
									if($db->rows($pei)){
										$ju = $db->expand($pei);
										$check = 'checked="checked"';	
										$ord=$ju['preco'];	
										$disabled = '';
									}

								//}
												
								echo'
										
										<div class="col-md-2" style="margin-bottom:10px">
											<div class="col-md-12 text-center" style="border:1px solid #215C83; padding:10px">
												
												  <label><input '.$check.' type="checkbox" value="'.$yy['id'].'" name="variacoes[]" class="chk chk2" data-id="'.$r.'"> 
												  <br>'.$yy['tamanho'].'

												</label>

		 										<input type="text" '.$disabled.'  placeholder="0.00" id="ord'.$r.'" value="'.$ord.'" class="form-control valores xxvv2" name="precos[]"  style="width:100%;" >

												
											</div>	
										</div>							
											
									';	
								
								$r++;
							}
						} else {

								echo '<div class="col-md-12"><div class="alert alert-danger">Nenhuma variação de preço encontrada para esta categoria.</div></div>';
						}
					
?> 


<script src='jquery/funcoes.js'></script>

<script type="text/javascript">     
	   $(".valores").maskMoney({
		symbol:'', // Simbolo
		decimal:'.', // Separador do decimal
		precision:2, // Precisão
		thousands:'', // Separador para os milhares		
		allowZero:true, // Permite que o digito 0 seja o primeiro caractere
		showSymbol:false // Exibe/Oculta o símbolo
		});
</script>  
