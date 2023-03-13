<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");

$sql = $db->select("SELECT * FROM clientes WHERE id='$id' LIMIT 1");
$dados = $db->expand($sql);
?>		
<input id="id_cliente_exibe" value="<?php echo $dados['id']; ?>" type="hidden">
<input id="telefone_cliente_exibe" value="<?php echo $dados['telefone']; ?>" type="hidden">
<h16><?php echo $dados['nome']; ?></h16><br><br>

<?php
if($dados['cartao']!=0){
?>
<h15>
	<strong>Cartão Fidelidade:</strong>
	<?php echo $dados['cartao']; ?>
	<br>
</h15>
<?php
}
?>


<h15>
	<strong>Endereço Padrão:</strong><br>
	<?php echo verifica_vazio($dados['endereco'],1); ?> <?php echo verifica_vazio($dados['numero'],0); ?><br>
	<?php echo verifica_vazio($dados['bairro'],1); ?><br>
	<?php if(!empty($dados['complemento'])){echo $dados['complemento'].'<br>';} ?>
</h15>

<h15>
	<strong>Telefone:</strong><br>
	(<?php echo verifica_vazio($dados['ddd'],0); ?>) <?php echo verifica_vazio($dados['telefone'],0); ?><br>	
</h15>
