<?php
require("../admin/class/class.db.php");
require("../admin/class/class.seguranca.php");
require("../includes/verifica_dados_loja.php");
require("../includes/verifica_dados_fiscais.php");



$caminho_acbr=$dados_fiscais['caminho_acbr'];
	
///CRIA O ARQUIVO INI PARA ENVIAR AO SAT///
$ecf = '
[infCFe]

versao=0.07


[Identificacao]

CNPJ=07387314000138

signAC=T3iry1SLbKpZ/2LOFbKaUHmOAEcYMw6+DvrCmSziWgImEFk96hPW6lOqHTvc6I3YWirh16g63NueIk5doEksiCF/ocXufTBAmo/YlQ9iJeJAFtAJkUoRJHLxG067T6WNkILZWgs2CKc4UqbCN3cEHNq+9RdFTjNf9TZjtT9qIliQgw4sSseCd5tJAT6iG6N1KUb8aie05vtwRiJ8RGyic5t45o2+KzmmD7CX7NCktMU+5GJbEM37M8CZQ/BqC3tW4x3M8DazNPnvMoznxr8mOaET4srKtDHPOCRbcyVIUekhYqTBuDBKp0UCtOlna2AOBsrwk4FfeFw/rS9DuLJuFQ==

numeroCaixa=1



[Emitente]

CNPJ=13913760000131

IE=416048093114

IM=

indRatISSQN=N



[Destinatario]

CNPJCPF=35805292858

xNome=Diogo


[Entrega]

xLgr=Rua Cel. Aureliano de Camargo

nro=973

xCpl=

xBairro=Centro

xMun=Tatui

UF=SP



[Produto001]

cProd=1189

infAdProd=Teste de Produto

xProd=OVO VERMELHO

NCM=61044200

CFOP=5102

uCom=PC

qCom=1.0000

vUnCom=1.99

indRegra=A


[ObsFiscoDet001]

xCampoDet=Teste

xTextoDet=Texto Teste



[ICMS001]

Orig=0

CSOSN=102



[PIS001]

CST=49



[COFINS001]

CST=49



[Total]

vCFeLei12741=0.20




[Pagto001]

cMP=04

vMP=1.99



[DadosAdicionais]

infCpl=Teste emissao CFe/SAT
';
	

	$fp = fopen("$caminho_acbr\cupom.ini", "w");
	$escreve = fwrite($fp, $ecf);
	fclose($fp); 					
	///CRIA O ARQUIVO INI PARA ENVIAR AO SAT///
		

		
?>