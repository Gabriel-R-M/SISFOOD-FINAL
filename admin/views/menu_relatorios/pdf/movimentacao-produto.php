
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
$pdf->SetTitle('RELATORIO ESTOQUE');

//LINHA//
$pdf->Line(10,3,200,3);
//LINHA//


//PESQUISA GERAL//
$sql = $db->select("SELECT produto FROM lanches WHERE id='$id' LIMIT 1");
$ob = $db->expand($sql);	
//PESQUISA GERAL//

////CABEÇALHO RELATORIO////
$pdf->SetY(3);
$pdf->SetFont("MyriadPro-Semibold", "", 13);
$pdf->Ln(4);	
$pdf->Cell(191, 6, 'RELATORIO MOVIMENTAÇÃO ESTOQUE',0, 0, 'C');

$pdf->SetFont("MyriadPro-Semibold", "", 11);
$pdf->Ln(7);	
$pdf->Cell(191, 6, 'PRODUTO: '.$ob['produto'],0, 0, 'C');


$pdf->SetFont("MyriadPro-Semibold", "", 9);
$pdf->SetTextColor(0,0,0);
////CABEÇALHO RELATORIO////
$pdf->Ln(13);
$pdf->SetFillColor(244,244,244);

$pdf->Cell(35, 8, 'TIPO',1, 0, 'L',true);	
$pdf->Cell(40, 8, 'DATA/HORA',1, 0, 'L',true);
$pdf->Cell(20, 8, 'QTD',1, 0, 'C',true);			
$pdf->Cell(69, 8, 'USUÁRIO',1, 0, 'L',true);		
$pdf->Cell(24, 8, 'FINAL',1, 0, 'C',true);		
$pdf->Ln(8);

//DADOS DA VENDA
$total_vendas=0;
$sql = $db->select("SELECT estoque_movimentacao.*, usuarios.nome AS atendente FROM estoque_movimentacao 
	LEFT JOIN usuarios ON estoque_movimentacao.id_usuario=usuarios.id
	WHERE estoque_movimentacao.id_produto='$id' AND data>='$data1' AND data<='$data2'
	ORDER BY estoque_movimentacao.id");

if($db->rows($sql)){

	$primeiro=0;

	$deve=0;
	$recebe=0;
	while($row= $db->expand($sql)){

		if($row['atendente']==''){
		$row['atendente'] = 'ADMINISTRADOR';
	}


		if($row['tipo']==0){			
			$pdf->SetFillColor(165,36,32);
			$pdf->SetTextColor(255,255,255);

			if($row['id_venda']!=0){
				$pdf->Cell(35, 8, 'SAÍDA VENDA: '.$row['id_venda'],1, 0, 'L',true);
			} else {
				$pdf->Cell(35, 8, 'SAÍDA',1, 0, 'L',true);
			}
			
		} else {
			$msg='PAGAMENTO';
			$pdf->SetFillColor(87,133,33);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(35, 8, 'ENTRADA',1, 0, 'L',true);
		}


		$pdf->SetTextColor(0,0,0);

		$pdf->Cell(40, 8, data_mysql_para_user($row['data']).' às '.substr($row['hora'],0,5),1, 0, 'L',false);
		
		$pdf->Cell(20, 8, $row['quantidade'],1, 0, 'C',false);	

		$pdf->Cell(69, 8, $row['atendente'],1, 0, 'L',false);	


		//SOMA
		if($row['tipo']==1){	
			$primeiro = ($primeiro+$row['quantidade']);
		//DIMINUI	
		} else {
			$primeiro = ($primeiro-$row['quantidade']);
		}
		


		$pdf->SetFillColor(238,238,238);
		
	
		$pdf->Cell(24, 8, $primeiro,1, 0, 'C',TRUE);	


		
		$pdf->Ln(8);



		
	}




} else {
	$pdf->Cell(191, 6, 'NENHUMA MOVIMENTAÇÃO ENCONTRADA ENCONTRADA.',1, 0, 'C',0);
}







//SAIDA DO PDF
$pdf->Output("$end_final", "$tipo_pdf");






?>
