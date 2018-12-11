<?php
header("Content-Type: text/html; charset=iso-8859-1");
date_default_timezone_set('America/Sao_Paulo');
require ("../../class/class.db.php");
require ("../../class/class.seguranca.php");
require ("../class/class.mail.php");
include("../class/class.session_ativa.php");

	 $db = new DB(); 
	 
	 require("../../email_autenticado/class.phpmailer.php");
	 
	 
	 $nome = utf8_decode($nome_ajuda);
	 $assunto = utf8_decode($assunto_ajuda);	
	 $mensagem = utf8_decode($mensagem_ajuda);
	 
	 
	  $mensagem_email='
		<table cellspacing="0" style="font-family: Helvetica; font-size: 14px; width:600px; margin: 0 auto; border: 1px solid #990000;">
			<tr bgcolor="#990000"><td height="60" valign="middle" align="center"><span style="color:#fff; font-size:20px">SOLICITAÇÃO DE SERVIÇO</span></td></tr>
			<tr><td style="padding:14px;">
			<h3>Enviada por: <span style="background-color:#990000; padding:6px; color:#FFF">'.$empresa_usuario.'</span> em '.date("d/m/Y").' às '.date("H:i").'hs.</h3>		
			<p><strong>NOME:</strong> '.$nome.'</p>
			<p><strong>ASSUNTO:</strong> '.$assunto.'</p>			
			<p><strong>MENSAGEM:</strong><br>'.nl2br($mensagem).'</p>
			
			</td></tr>
			<tr bgcolor="#990000"><td height="40" valign="middle" align="center"><span style="color:#fff; font-size:12px">IMPORTANTE: NÃO RESPONDA ESSE E-MAIL, ELE É GERADO AUTOMATICAMENTE.</span></td></tr>
		</table>	
	';
			 
	 if(envia_email_servicos_sis('contato@sisconnection.com.br',$mensagem_email)==1){		
		echo 1;	 
	 } else {
		echo 2;			 
	 }
	  

?>