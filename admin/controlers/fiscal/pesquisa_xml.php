<?php


include_once ("../../config.php");
include_once ("../../../includes/verifica_dados_loja.php");
include_once ("../../../includes/verifica_dados_fiscais.php");

$pasta_fiscal = $dados_fiscais['caminho_acbr'].'/Arqs/Vendas/'.$dados_loja['cnpj'].'/'.$ano_xml.$mes_xml;

if(is_dir($pasta_fiscal)){

$dh = opendir($pasta_fiscal); 
$x=0;
// loop que busca todos os arquivos até que não encontre mais nada
while (false !== ($filename = readdir($dh))) { 
// verificando se o arquivo é .jpg
	if (substr($filename,-4) == ".xml") { 
		$x++;	
	}
}

	if($x>0){
		echo '<center><h4>'.$x.' ARQUIVO(S) ENCONTRADO(S)</h4></center>';

		echo '<div class="row">';

			echo '<div class="col-md-2"></div>';

			echo '<div class="col-md-8 top20">';	

				echo '<div class="col-md-12 text-center">';	
					echo 'UTILIZE O FORMULÁRIO ABAIXO PARA ENVIAR<BR> OS ARQUIVOS FISCAIS PARA O E-MAIL DESEJADO.<BR><BR><BR>';
				echo '</div>';

			echo '<form action="controlers/fiscal/envia_xml.php" method="post" id="EnviaXML">';			

				echo '<input type="hidden" class="form-control" name="pasta_fiscal" value="'.$pasta_fiscal.'">';
				echo '<input type="hidden" class="form-control" name="mes_xml" value="'.$mes_xml.'">';
				echo '<input type="hidden" class="form-control" name="ano_xml" value="'.$ano_xml.'">';

				echo '<label>Mensagem de E-mail:</label>';
				echo '<textarea required name="mensagem_xml" class="form-control" style="height:150px; resize:none">SEGUE EM ANEXO, ARQUIVOS FISCAIS DA EMPRESA: 
'.strtoupper($dados_loja['razao']).'
REFERENTES AO MÊS: '.$mes_xml.' DE '.$ano_xml.'</textarea>';

				echo '<label class="top10">Endereço para  envio:</label>';
				echo '<input type="email" required name="email_envio_xml" class="form-control" value="'.$dados_fiscais['email_envio_xml'].'">';

				echo '<button type="submit" id="btn_envio" class="btn btn-primary bd-0 top10">COMPACTAR E ENVIAR</button>   ';

			echo '</form>';	


				echo '<div class="alert alert-danger hide top20" id="erro_xml"></div>';

				echo '<div class="alert alert-success hide top20" id="sucesso_xml">ARQUIVOS ENVIADOS COM SUCESSO.</div>';




			echo '</div>';	

		echo '</div>';	

	} else {

	}


} else {
	echo '<center>PASTA DE ARQUIVOS DO MÊS NÃO ENCONTRADA</center>';
}

?>



<script src="<?php echo ADMIN_DIR; ?>lib/jquery/js/jquery.js"></script>
<script src="<?php echo ADMIN_DIR; ?>js/mascara_money.js"></script>
<script src="<?php echo ADMIN_DIR; ?>javascript/funcoes.js"></script>
