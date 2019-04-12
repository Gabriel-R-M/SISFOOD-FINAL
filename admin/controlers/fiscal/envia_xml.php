<?php
include_once ("../../config.php");
require_once("../../email_autenticado/class.phpmailer.php");

if(is_dir(dirname(__FILE__))){

	$dh = opendir(dirname(__FILE__)); 
	while (false !== ($filename = readdir($dh))) { 
	
		if (substr($filename,-4) == ".zip" || substr($filename,-4) == ".rar") { 
			@unlink($filename);
		}

	}
}


if(is_dir(dirname($pasta_fiscal))){
	
	$zip = new ZipArchive();
	$zip->open('arquivos_fiscais_'.$mes_xml.'_'.$ano_xml.'.zip', ZipArchive::OVERWRITE);

	$dh = opendir($pasta_fiscal); 
	
	while (false !== ($filename = readdir($dh))) { 
	
		if (substr($filename,-4) == ".xml") { 
			$zip->addFile(realpath($pasta_fiscal."/".$filename), basename($pasta_fiscal."/".$filename));				
		}

	}	

	$zip->close();


		$sql = $db->select("UPDATE fiscal SET email_envio_xml='$email_envio_xml' ");


		$body = '<table cellspacing="0" style="font-family: Helvetica; font-size: 15px; width:800px;">';
	    $body.= '<tr>';
	    $body.= '<td colspan="2" style="padding-bottom:8px; padding-top:14px"><img src="https://sisconnection.com.br/nao_apagar/sis_logo_novo.jpg" style="width: 140px;  display: block;" alt=""></td>';
	    $body.= '</tr>';
	    $body.= '<tr><td>';	    
	   
			$body.= '<p>'.nl2br($mensagem_xml).'</p>';
		
		
	    $body.= '<p><small>E-MAIL AUTOMÁTICO ENVIADO PELO SISTEMA EM '.@date('d/m/Y \à\s H:i').'</small></p>';
	    $body.= '</td></tr></table>';



	$anexo = '../../controlers/fiscal/arquivos_fiscais_'.$mes_xml.'_'.$ano_xml.'.zip';
	$retorno = envia_email_xml_fiscais($email_envio_xml,$body,'SIS SISTEMAS - ARQUIVOS FISCAIS',$anexo);
	
	echo $retorno;
	

} else {
	echo 0;
}

?>