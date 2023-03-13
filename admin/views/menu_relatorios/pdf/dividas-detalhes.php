
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
$pdf->SetTitle('RELATORIO CLIENTE DEVEDOR');

//LINHA//
$pdf->Line(10,3,200,3);
//LINHA//


//PESQUISA GERAL//
$sql = $db->select("SELECT nome FROM clientes
	
	WHERE id='$id' 
	LIMIT 1");
$ob = $db->expand($sql);	
//PESQUISA GERAL//

////CABEÇALHO RELATORIO////
$pdf->SetY(3);
$pdf->SetFont("MyriadPro-Semibold", "", 13);
$pdf->Ln(4);	
$pdf->Cell(191, 6, 'RELATÓRIO CLIENTE DEVEDOR',0, 0, 'C');

$pdf->SetFont("MyriadPro-Semibold", "", 11);
$pdf->Ln(7);	
$pdf->Cell(191, 6, 'CLIENTE: '.$ob['nome'],0, 0, 'C');


$pdf->SetFont("MyriadPro-Semibold", "", 9);
$pdf->SetTextColor(0,0,0);
////CABEÇALHO RELATORIO////
$pdf->Ln(11);
$pdf->SetFillColor(244,244,244);

$pdf->Cell(32, 8, 'DATA/HORA',1, 0, 'L',true);	
$pdf->Cell(30, 8, 'R$ TOTAL',1, 0, 'L',true);
$pdf->Cell(80, 8, 'ATENDENTE',1, 0, 'L',true);			
$pdf->Cell(49, 8, 'TIPO',1, 0, 'L',true);		
$pdf->Ln(8);

//DADOS DA VENDA
$total_vendas=0;
$sql = $db->select("SELECT contas_clientes.*, usuarios.nome AS atendente FROM contas_clientes 
	LEFT JOIN usuarios ON contas_clientes.id_usuario=usuarios.id
	
	WHERE contas_clientes.id_cliente='$id'
	ORDER BY contas_clientes.id");

//echo $db->rows($sql).'<br><br>'; 
if($db->rows($sql)){

	$deve=0;
	$recebe=0;
	while($row= $db->expand($sql)){


		if($row['tipo']==0){
			$msg='DÉBITO - VENDA: '.$row['id_venda'];
			$pdf->SetFillColor(165,36,32);
			$pdf->SetTextColor(255,255,255);
			$deve = ($deve+$row['valor']);
		} else {
			$msg='PAGAMENTO';
			$pdf->SetFillColor(87,133,33);
			$pdf->SetTextColor(255,255,255);
			$recebe = ($recebe+$row['valor_recebe']);
		}


		if($row['tipo']==0){
			$pdf->Cell(32, 8, data_mysql_para_user(substr($row['data_debito'],0,10)).' ás '.substr($row['data_debito'],10,6),1, 0, 'L',true);
			$pdf->Cell(30, 8, 'R$ '.number_format($row['valor'],2,".",","),1, 0, 'L',true);		
		} else {
			$pdf->Cell(32, 8, data_mysql_para_user(substr($row['data_pgto'],0,10)).' ás '.substr($row['data_pgto'],10,6),1, 0, 'L',true);
			$pdf->Cell(30, 8, 'R$ '.number_format($row['valor_recebe'],2,".",","),1, 0, 'L',true);		
		}
		

		$pdf->Cell(80, 8, $row['atendente'],1, 0, 'L',true);	

		$pdf->Cell(49, 8, $msg,1, 0, 'L',true);
	


		


		
		$pdf->Ln(8);



		
	}

	$total_vendas = ($deve-$recebe);
	if($total_vendas<0){$total_vendas=0;}

	$pdf->SetTextColor(0,0,0);
	$pdf->Ln(4);
	$pdf->SetFont("MyriadPro-Semibold", "", 11);
	
	$pdf->Cell(139, 6, '',0, 0, 'L',false);	
	$pdf->Cell(24, 6, 'SALDO DEVEDOR:',0, 0, 'R',false);	
	$pdf->Cell(28, 6, 'R$ '.number_format($total_vendas,2,".",","),0, 0, 'R',false);	


} else {
	$pdf->Cell(191, 6, 'NENHUMA VENDA ENCONTRADA.',1, 0, 'C',0);
}







//SAIDA DO PDF
$pdf->Output("$end_final", "$tipo_pdf");






?>
