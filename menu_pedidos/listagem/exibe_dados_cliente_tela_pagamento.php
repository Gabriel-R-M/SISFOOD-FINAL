<?php
require_once("../../admin/class/class.db.php");
require_once("../../admin/class/class.seguranca.php");
require_once("../../includes/verifica_session.php");
require_once("../../includes/verifica_venda_aberta.php");
require_once("../../includes/verifica_cliente_venda.php");
require_once("../../includes/verifica_configuracoes_loja.php");
?>


<?php
$pontuacao_cliente=0;
if($dados_configuracoes['modulo_pontuacao']==1){ 
if(!empty($dados_cliente['nome']) && $dados_cliente['nome']!="CLIENTE AVULSO" ){
	require_once("../../includes/verifica_pontuacao_cliente.php");	
}
}
?>

<input type="hidden" id="pontos_validos_troca" value="<?php echo $pontuacao_cliente; ?>"> 

<input type="hidden" id="nome_cliente_venda" value="<?php echo $dados_cliente['nome']; ?>">
<input type="hidden" id="endereco_cliente_venda" value="<?php echo $dados_cliente['endereco']; ?>">

<input type="hidden" id="id_cliente_venda" value="<?php echo $dados_venda['id_cliente']; ?>">

<a href="javascript:void(0);" id="botao_muda_cliente_recebimento" onclick="javascript:modal_edita_cliente_pedido(<?php echo $dados_venda['id_cliente']; ?>);">
	<button class="btn btn-danger pull-right"><i class="icofont-edit"></i> (F12)</button>
</a>

<?php 
	//MODULO DE PONTUACAO ATIVO	
	if($dados_configuracoes['modulo_pontuacao']==1){ 	
	if($dados_cliente['cartao']!=0){		
?>	
	<span class="upper"><b>CARTÃO: </b><?php echo $dados_cliente['cartao']; ?></span> <br>	
<?php }} ?>			

<?php if(!empty($dados_cliente['nome'])){ ?>
	<span class="upper"><?php echo $dados_cliente['nome']; ?></span> 
<?php } else { ?>	
	<span>NOME NÃO INFORMADO
<?php }  ?>			


<br>
			
<?php if(!empty($dados_cliente['ddd'])){ ?>
	<span class="thin">(<?php echo $dados_cliente['ddd']; ?>) <?php echo $dados_cliente['telefone']; ?></span></span><br>
<?php } else { ?>	
	<span class="thin">TELEFONE NÃO INFORMADO<br>	
<?php }  ?>		
			
<?php if(!empty($dados_cliente['endereco'])){ ?>		
	<span class="thin"><?php echo $dados_cliente['endereco']; ?>, <?php echo $dados_cliente['numero']; ?>
	<br><?php echo $dados_cliente['bairro']; ?></span>
	<?php if(!empty($dados_cliente['complemento'])){ ?>		
		<span class="thin"> - <?php echo $dados_cliente['complemento']; ?></span>
	<?php } ?>
	<br>
<?php } else { ?>
	<span class="thin">ENDEREÇO NÃO INFORMADO<br>	
<?php }  ?>	




<?php 
	//MODULO DE PONTUACAO ATIVO	
	if($dados_configuracoes['modulo_pontuacao']==1){ 
	if(!empty($dados_cliente['nome']) && $dados_cliente['nome']!="CLIENTE AVULSO" ){	
	require_once("../../includes/verifica_pontuacao_cliente.php");		
?>		
	<span class="thin"><b>PONTOS A UTILIZAR: </b>
		<?php 
			echo $pontuacao_cliente; 
			$pontos_validos = $pontuacao_cliente; 
			if($pontos_validos>0){
				echo ' (R$ ';
				include_once("../actions/calcula_desconto_pontuacao.php");				
				echo ')';	
			}
			
		?>
	</span>
	<?php
		if($pontuacao_cliente>0){
			echo '
				<button class="btn btn-success btn-sm pull-right" type="button" onclick="javascript:resgate_pontos();">RESGATAR</button>
			';
		}
	?>
<?php }} ?>
			

