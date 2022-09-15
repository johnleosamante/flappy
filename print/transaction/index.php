<?php
# print/transaction/index.php

include_once('../../_functions_/functions.php');
require('../../_fpdf_/fpdf.php');

$department_logo = GetURL() . '/assets/images/Department.png';
$division_logo = GetURL() . '/assets/images/Division.png';
$page_width = 210;
$page_height = 297;
$logo_size = 20;

foreach ($_GET as $key => $data) {
  $code = strtoupper($_GET[$key] = base64_decode(urldecode($data)));
}

if (empty($code)) {
  header('Location:' . GetURL());
}

$pdf = new FPDF('P', 'mm', array($page_width, $page_height));

$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'qrtemp' . DIRECTORY_SEPARATOR;
$PNG_WEB_DIR = 'qrtemp/';

include("../../_phpqrcode_/qrlib.php");

if (!file_exists($PNG_TEMP_DIR)) mkdir($PNG_TEMP_DIR);

$qrname = $PNG_TEMP_DIR . md5($code) . '.png';
$errorCorrectionLevel = 'L';
$matrixPointSize = 5;

QRcode::png($code, $qrname, $errorCorrectionLevel, $matrixPointSize, 2);

$qrimage = $PNG_WEB_DIR . basename($qrname);

$pdf->AliasNbPages('{pages}');
$pdf->AddPage();
$pdf->SetTitle($code, true);

// Header
$pdf->Image($department_logo, ($page_width - $logo_size) / 2, 5, $logo_size);
$pdf->SetY(25);
$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(0, 5, 'Republic of the Philippines', 0, 1, 'C');
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 5, 'Department of Education', 0, 1, 'C');
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 5, 'REGION IX, ZAMBOANGA PENINSULA', 0, 1, 'C');
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(0, 5, strtoupper(GetDivision()), 0, 1, 'C');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(0, 5, GetCity(), 0, 1, 'C');
$pdf->Line(10, 51, $page_width - 10, 51);

// Content
$pdf->SetFont('Helvetica','B',14);
$pdf->SetY(55);
$pdf->Cell(0, 5, 'DOCUMENT TRACKING SYSTEM', 0 , 1, 'C');
$pdf->SetFont('Helvetica', '', 8);
$pdf->Cell(0, 5, '(Attachment)', 0 , 1, 'C');
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(0, 5, 'Control #: ' . $code, 0, 0, 'L');
$pdf->Cell(0, 5, date("F d, Y"), 0, 1, 'R');

$pdf->Image($qrimage, ($page_width - 50)/2, 71, 50);

// Footer
$pdf->Line(10, $page_height/2 - 28, $page_width-10,  $page_height/2 - 28);
$pdf->Image($division_logo, 10, $page_height/2 - 26, 25);
$pdf->SetFont('Helvetica', '', 9);
$pdf->Text(37, $page_height/2 - 21, 'Address: Purok Farmers, Olingan, Dipolog City', );
$pdf->Text(37, $page_height/2 - 17, 'Telephone No.: (065) 908-2583)');
$pdf->Text(37, $page_height/2 - 13, 'Email: dipolog.city@deped.gov.ph');
$pdf->Text(37, $page_height/2 - 9, 'Website: dipologcitydivision.net');
$pdf->Text(37, $page_height/2 - 5, 'FB Page: facebook.com/depeddipologcity');

// Separator
$pdf->Line(0, $page_height/2, $page_width,  $page_height/2);
$pdf->Text(5, $page_height/2 + 5, '(Cut here)', );

// Header
$pdf->Image($department_logo, ($page_width - $logo_size) / 2, $page_height/2 + 5, $logo_size);
$pdf->SetY($page_height/2 + 25);
$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(0, 5, 'Republic of the Philippines', 0, 1, 'C');
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 5, 'Department of Education', 0, 1, 'C');
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 5, 'REGION IX, ZAMBOANGA PENINSULA', 0, 1, 'C');
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(0, 5, strtoupper(GetDivision()), 0, 1, 'C');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(0, 5, GetCity(), 0, 1, 'C');
$pdf->Line(10, $page_height/2 + 51, $page_width - 10, $page_height/2 + 51);

// Content
$pdf->SetFont('Helvetica','B',14);
$pdf->SetY($page_height/2 + 55);
$pdf->Cell(0, 5, 'DOCUMENT TRACKING SYSTEM', 0 , 1, 'C');
$pdf->SetFont('Helvetica', '', 8);
$pdf->Cell(0, 5, '(Client\'s Copy)', 0 , 1, 'C');
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(0, 5, 'Control #: ' . $code, 0, 0, 'L');
$pdf->Cell(0, 5, date("F d, Y"), 0, 1, 'R');

$pdf->Image($qrimage, ($page_width - 50)/2, $page_height/2 + 71, 50);

// Footer
$pdf->Line(10, $page_height - 28, $page_width-10,  $page_height - 28);
$pdf->Image($division_logo, 10, $page_height - 26, 25);
$pdf->SetFont('Helvetica', '', 9);
$pdf->Text(37, $page_height - 21, 'Address: Purok Farmers, Olingan, Dipolog City', );
$pdf->Text(37, $page_height - 17, 'Telephone No.: (065) 908-2583)');
$pdf->Text(37, $page_height - 13, 'Email: dipolog.city@deped.gov.ph');
$pdf->Text(37, $page_height - 9, 'Website: dipologcitydivision.net');
$pdf->Text(37, $page_height - 5, 'FB Page: facebook.com/depeddipologcity');

$pdf->Output();
?>