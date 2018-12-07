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


////CABEÇALHO RELATORIO////
$pdf->SetY(3);
$pdf->SetFont("MyriadPro-Semibold", "", 13);
$pdf->Ln(4);	
$pdf->Cell(191, 6, 'RELATÓRIO CLIENTES CADASTRADOS',0, 0, 'C');

$pdf->SetFont("MyriadPro-Semibold", "", 11);
$pdf->Ln(7);	
$pdf->Cell(191, 6, 'GERADO EM: '.date("d/m/Y").' ás '.date("H:i"),0, 0, 'C');


$pdf->SetFont("MyriadPro-Semibold", "", 9);
$pdf->SetTextColor(0,0,0);
////CABEÇALHO RELATORIO////
$pdf->Ln(11);


$pdf->SetFillColor(244,244,244);

$pdf->Cell(191, 6, 'CLIENTE/ENDEREÇO E TELEFONE',1, 0, 'L',true);
$pdf->Ln(8);

//DADOS DA VENDA
$sql = $db->select("SELECT * FROM clientes
	WHERE nome!='' AND nome!='CLIENTE AVULSO' AND nome!=','
	ORDER BY nome");
if($db->rows($sql)){
	while($row= $db->expand($sql)){
				
		$pdf->Cell(191, 6, $row['nome'],1, 0, 'L',false);
		$pdf->Ln(6);
		$pdf->Cell(151, 6, $row['endereco'].', '.$row['numero'].' - '.$row['bairro'],1, 0, 'L',false);			
		$pdf->Cell(40, 6, '('.$row['ddd'].') '.$row['telefone'],1, 0, 'R',false);			
		$pdf->Ln(8);
	
	}


} else {
	$pdf->Cell(191, 6, 'NENHUM CLIENTE ENCONTRADO.',1, 0, 'C',0);
}



//SAIDA DO PDF
$pdf->Output("$end_final", "$tipo_pdf");






?>
