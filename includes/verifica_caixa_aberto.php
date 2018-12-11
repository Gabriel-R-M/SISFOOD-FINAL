<?php

@session_start();



if(isset($_SESSION['id_caixa_erp_sis'])){	
	$id_cx = $_SESSION['id_caixa_erp_sis'];
	$sel_cx = $db->select("SELECT * FROM caixa WHERE id='$id_cx' LIMIT 1");

} else {	
	$sel_cx = $db->select("SELECT * FROM caixa WHERE data_fechamento='0000-00-00' ORDER BY id DESC LIMIT 1");
}



if($db->rows($sel_cx)){
	$dados_caixa_aberto = $db->expand($sel_cx);
	$id_caixa_aberto = $dados_caixa_aberto['id'];

	$id_usuario_caixa_aberto = $dados_caixa_aberto['id_usuario'];
	$samba = $db->select("SELECT nome FROM usuarios WHERE id='$id_usuario_caixa_aberto' LIMIT 1");
	$pen = $db->expand($samba);
	$nome_responsavel_caixa_aberto = $pen['nome'];

} else {
	$id_caixa_aberto =0;
}




$aviso_caixa_antigo=0;
$hoje = date("Y-m-d");
$sel = $db->select("SELECT data_abertura, hora_abertura FROM caixa WHERE data_fechamento='0000-00-00' ORDER BY id DESC LIMIT 1");
if($db->rows($sel)){
	$dados_caixa=$db->expand($sel);       
    if($dados_caixa['data_abertura']==$hoje){
    	$aviso_caixa_antigo=0;
    } else {
    	$aviso_caixa_antigo=1;
    }
} else {
    $dados_caixa['data_abertura']='---';
    $dados_caixa['hora_abertura']='---';
}  
    

?>