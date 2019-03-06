	


	
	</div><!-- row -->
	</div><!-- container -->
	</div><!-- slim-mainpanel -->

	<?php
		if($dados_configuracoes['modulo_entregas']==1){
	?>	
		<div class="botoes_rodape hide">
			<div class="col-md-3 pull-right">
				<select id="tipo_baixa_pedidos" class="form-control pull-right" onchange="javascript:exibe_mensagem_baixa_pedidos(this.value);">
					<option value="">-- ESCOLHA UMA OPÇÃO --</option>
					<option value="1">RECEBER PEDIDOS</option>
					<option value="2">CANCELAR PEDIDOS</option>
				</select>
			</div>	
		</div>	
	<?php
		}
	?>



</body>




<?php if($dados_configuracoes['modulo_fiscal']==1){ ?>		
<script>
	modulo_fiscal =1;
</script>
<?php
	} 
?>



<?php if($dados_configuracoes['modulo_internet']==1){ ?>		
<script>
	modulo_internet =1;
</script>
<?php
	} else {
?>
<script>
	modulo_internet =0;
</script>		
<?php
	} 
?>




<script src="admin/lib/jquery/js/jquery.js"></script>
<script src="admin/lib/popper.js/js/popper.js"></script>
<script src="admin/lib/bootstrap/js/bootstrap.js"></script>
<script src="admin/lib/jquery.cookie/js/jquery.cookie.js"></script>
<script src="admin/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>

<script src="js/sistema.js"></script>
<script src="js/jquery.maskMoney.js"></script>
<script src="js/mascara.js"></script>
<script src="javascript/usadas.js"></script>
<script src="javascript/menus.js?<?php echo time(); ?>"></script>
<script src="javascript/pedidos.js?<?php echo time(); ?>"></script>
<script src="javascript/caixa.js"></script>
<script src="javascript/clientes.js"></script>
<script src="javascript/impressao.js"></script>
<script src="javascript/internet.js"></script>
<script src="javascript/teclas_atalho.js"></script>
<script src="javascript/mobile.js?<?php echo time(); ?>"></script>
<script src="javascript/entregas.js"></script>
<script src="javascript/configuracoes.js"></script>


</html>