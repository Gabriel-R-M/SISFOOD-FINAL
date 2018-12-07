<?php
$end_fpdf = "fpdf"; 

define("FPDF_FONTPATH", "$end_fpdf/font/");
require_once("$end_fpdf/fpdf.php");

require_once("$end_fpdf/makefont/makefont.php");
MakeFont('c:\\Windows\\Fonts\\MyriadPro-Semibold.ttf','cp1252');


?>
