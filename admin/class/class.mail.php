<?php
function envia_email_servicos_sis($email,$mensagem){
				
	$mail = new PHPMailer;	
	$mail->SMTPDebug =0;                 	
	$mail->isSMTP();                    
	$mail->Host = 'srv74.prodns.com.br';  
	$mail->SMTPAuth = true;                             
	$mail->Username = 'sistema@sisconnection.com.br';
	$mail->Password = 'a1b2c3d4';                      
	$mail->SMTPSecure = 'tls';                         
	$mail->Port = 587;                                 
	
	$mail->setFrom('sistema@sisconnection.com.br', 'SisConnection');
	$mail->addAddress($email);     
	$mail->AddCC('diogomastrangelo@uol.com.br', 'SisConnection');
	$mail->addReplyTo('diogomastrangelo@uol.com.br', 'SisConnection');
	
	$mail->isHTML(true);                              
	
	$mail->Subject = 'SOLICITAÇÃO DE SERVIÇOS';
	$mail->Body    = $mensagem;
	
	if(!$mail->send()) {
			//echo 'Mailer Error: ' . $mail->ErrorInfo;
			return 0;
	} else {
			return 1;
	}
				
}



function envia_email_xml_fiscais($email,$mensagem,$assunto, $anexo=''){
				
	$mail = new PHPMailer;	
	$mail->SMTPDebug =0;                 	
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
	
	if(!$mail->send()) {
			return 'Problema ao enviar e-mail, informe ao suporte do sistema.';
			//$mail->ErrorInfo;			
	} else {
			return 1;
	}
				
}
?>