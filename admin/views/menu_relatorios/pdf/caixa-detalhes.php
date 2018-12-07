
<?php
//CONFIGURAÇOES DO BD MYSQL 
include_once("../../../config.php");

//ENDEREÇO DA BIBLIOTECA FPDF 
$end_fpdf = "../../../fpdf"; 

//ENDEREÇO ONDE SERÁ GERADO O PDF
$end_final = "";

//TIPO DO PDF GERADO 
//F-> SALVA NO ENDEREÇO ESPECIFICADO NA VAR END_FINAL 
//I-> ABRE NA TELA
$tipo_pdf = "I";

//PREPARA PARA GERAR O PDF///
define("FPDF_FONTPATH", "$end_fpdf/font/");
require_once("$end_fpdf/fpdf.php"); 

require_once("$end_fpdf/pdf_protect.php"); 
$pdf=new FPDF_Protection();
$pdf->SetProtection(array('modify', 'print'));
$pdf->AddFont('MyriadPro-Semibold','','MyriadPro-Semibold.php');

$pdf->Open(); 
$pdf->SetFont('MyriadPro-Semibold','',20);
$pdf->AddPage('P','A4'); 

//LINHA//
$pdf->Line(10,3,200,3);
//LINHA//


//PESQUISA GERAL//
$sql = $db->select("SELECT caixa.*, usuarios.nome FROM caixa 
	LEFT JOIN usuarios ON caixa.id_usuario=usuarios.id
	WHERE caixa.id='$id' 
	LIMIT 1");
$ob = $db->expand($sql);	
//PESQUISA GERAL//

////CABEÇALHO RELATORIO////
$pdf->SetY(3);
$pdf->SetFont("MyriadPro-Semibold", "", 13);
$pdf->Ln(4);	
$pdf->Cell(191, 6, 'RELATÓRIO CONSOLIDADO DE VENDAS',0, 0, 'C');

$pdf->SetFont("MyriadPro-Semibold", "", 11);
$pdf->Ln(7);	
$pdf->Cell(191, 6, 'CAIXA: #'.$id.' | RESPONSÁVEL: '.$ob['nome'],0, 0, 'C');
$pdf->Ln(6);
$pdf->Cell(191, 6, 'ABERTO EM: '.data_mysql_para_user($ob['data_abertura']).' - '.substr($ob['hora_abertura'],0,5).' | '.'FINALIZADO EM: '.data_mysql_para_user($ob['data_fechamento']).' - '.substr($ob['hora_fechamento'],0,5).'',0, 0, 'C');


$pdf->SetFont("MyriadPro-Semibold", "", 9);
$pdf->SetTextColor(0,0,0);
////CABEÇALHO RELATORIO////
$pdf->Ln(11);
$pdf->SetFillColor(244,244,244);

$pdf->Cell(32, 6, 'DATA/HORA',1, 0, 'L',true);	
$pdf->Cell(88, 6, 'CLIENTE',1, 0, 'L',true);
$pdf->Cell(51, 6, 'ATENDENTE',1, 0, 'L',true);			
$pdf->Cell(20, 6, 'R$ TOTAL',1, 0, 'R',true);		
$pdf->Ln(6);

//DADOS DA VENDA
$total_vendas=0;
$sql = $db->select("SELECT aguarda_venda.*, usuarios.nome AS atendente, clientes.nome FROM aguarda_venda 
	LEFT JOIN usuarios ON aguarda_venda.id_usuario=usuarios.id
	LEFT JOIN clientes ON aguarda_venda.id_cliente=clientes.id
	WHERE aguarda_venda.id_caixa='$id' 
	ORDER BY aguarda_venda.data_pedido, aguarda_venda.pedido_inicio");
if($db->rows($sql)){
	while($row= $db->expand($sql)){
		$pdf->Cell(32, 6, data_mysql_para_user($row['data_pedido']).' ás '.substr($row['pedido_inicio'],0,5),1, 0, 'L',false);	
		$pdf->Cell(88, 6, $row['nome'],1, 0, 'L',false);
		$pdf->Cell(51, 6, $row['atendente'],1, 0, 'L',false);			
		$pdf->Cell(20, 6, 'R$ '.number_format($row['valor_final_venda'],2,".",","),1, 0, 'R',false);	
		$pdf->Ln(6);

		$total_vendas = ($total_vendas+$row['valor_final_venda']);
	}

	$pdf->Ln(4);
	$pdf->SetFont("MyriadPro-Semibold", "", 12);
	$pdf->Cell(139, 6, '',0, 0, 'L',false);	
	$pdf->Cell(24, 6, 'TOTAL VENDAS:',0, 0, 'R',false);	
	$pdf->Cell(28, 6, 'R$ '.number_format($total_vendas,2,".",","),0, 0, 'R',false);	


} else {
	$pdf->Cell(191, 6, 'NENHUMA VENDA ENCOTRADA.',1, 0, 'C',0);
}



//SAIDA DO PDF
$pdf->Output("$end_final", "$tipo_pdf");






?>
