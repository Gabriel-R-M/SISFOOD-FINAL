<?php

require_once("admin/email_autenticado/class.phpmailer.php");

function envia_email_xml_fiscais($email,$mensagem,$assunto, $anexo=''){
				
	$mail = new PHPMailer;	
	$mail->SMTPDebug =1;                 	
	$mail->isSMTP();                    
	$mail->Host = 'srv74.prodns.com.br';  
	$mail->SMTPAuth = true;                             
	$mail->Username = 'sistema@sisconnection.com.br';
	$mail->Password = 'kaca123!@#';                      
	$mail->SMTPSecure = 'tls';                         
	$mail->Port = 587;    
	$mail->CharSet = 'UTF-8';                             
	
	if(!empty($anexo)){
		$mail->AddAttachment($anexo);
	}



	$mail->setFrom('sistema@sisconnection.com.br', 'SIS SISTEMAS');
	$mail->addAddress($email);     	
	$mail->isHTML(true);                              
	
	$mail->Subject = $assunto;
	$mail->Body    = $mensagem;
	$mail->send();
				
}

envia_email_xml_fiscais('diogo.mastrangelo@atitudecomunicacao.com.br', 'çãoasas', 'éçãasas', 'admin/teste.txt');

?>

