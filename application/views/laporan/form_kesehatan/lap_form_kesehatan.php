<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */



// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Teknik Informatika - UBAYA');
$pdf->SetTitle('Laporan Form Kesehatan');
$pdf->SetSubject('Laporan Form Kesehatan');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
/*$pdf->SetHeaderData("angelsni_logo.png", "60", "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tCATATAN HARIAN ANAK", "\nTanggal\t\t: \t\t".$form_harian['Tanggal']."\t\n\nNama \t\t\t\t: \t\t".$form_harian['NamaAnak']."\t\t\t\t Suhu Badan dtg : \t\t".$form_harian['SuhuBadanDatang'],array(0,0,0),array(255,255,255));*/

// remove default header/footer
$pdf->setPrintHeader(false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT+8, 10, 15);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(10);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();

// create some HTML content
//untuk Header
$html.= '
	<table nobr="true" style="border-collapse:collapse;" border="0" align="center" cellpadding="5">
		<tr>
			<td width="100%" colspan="3" style="font-size:14px;font-weight:bold;">LAPORAN KESEHATAN</td>
		</tr>
		<tr>
			<td align="left" width="10%"></td>
			<td align="left" width="60%"></td>
			<td align="right" width="30%">'.$tanggal.'</td>
		</tr>
		<tr>
			<td align="left">Nama</td>
			<td align="left">: '.$anak["Nama"].'</td>
			<td align="left"></td>
		</tr>
		<tr>
			<td align="left">Perawat</td>
			<td align="left">: '.$pertumbuhan2["NamaKaryawan"].'</td>
			<td align="left"></td>
		</tr>
		<tr>
			<td align="left">Usia</td>
			<td align="left">: '.$pertumbuhan2["Usia"].' Tahun</td>
			<td align="left"></td>
		</tr>
		';

		
$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

/*$pdf->setCellHeightRatio(0.5);

$html = '<br>
	<p style="margin-bottom:0px;"><b>Catatan khusus dari orang tua : </b></p>';
$pdf->writeHTML($html, true, false, true, false, '');	

$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->setCellHeightRatio(1.7);
$pdf->Ln(5);

$pdf->MultiCell(172, 5, $form_harian["CatatanOrangtua"], 1, 'L', 0, 1, '', '', true);

$pdf->Ln(2);

$html=	
'<p style="margin-bottom:0px;"><b>Kondisi kesehatan anak (Catatan dari orangtua) : </b></p>';
$pdf->writeHTML($html, true, false, true, false, '');	

$pdf->Ln(2);

$pdf->MultiCell(172, 5, $form_harian["KondisiKesehatan"], 1, 'L', 0, 1, '', '', true);	*/

$pdf->setCellHeightRatio(1.2);

$html= '
	<table style="border-collapse:collapse;" border="0" align="center" cellpadding="2">
		<tr>
			<th align="center" colspan="2" width="50%" style="font-weight:bold;border:1px solid #000;">Tanggal '.date('d-m-Y',strtotime($pertumbuhan["Tanggal"])).'</th>
			<th align="center" colspan="2" width="50%" style="font-weight:bold;border:1px solid #000;">Tanggal '.date('d-m-Y',strtotime($pertumbuhan2["Tanggal"])).'</th>
		</tr>
		<tr>
			<td align="left" width="20%" style="border-left:1px solid #000;border-bottom:1px solid #000;"> Berat badan</td>
			<td align="left" width="30%" style="border-right:1px solid #000;border-bottom:1px solid #000;">: '.$pertumbuhan["BeratBadan"].' kg</td>
			<td align="left" width="20%" style="border-left:1px solid #000;border-bottom:1px solid #000;"> Berat badan</td>
			<td align="left" width="30%" style="border-right:1px solid #000;border-bottom:1px solid #000;">: '.$pertumbuhan2["BeratBadan"].' kg</td>
		</tr>
		<tr>
			<td align="left" width="20%" style="border-left:1px solid #000;border-bottom:1px solid #000;"> Tinggi Badan</td>
			<td align="left" width="30%" style="border-right:1px solid #000;border-bottom:1px solid #000;">: '.$pertumbuhan["TinggiBadan"].' cm</td>
			<td align="left" width="20%" style="border-left:1px solid #000;border-bottom:1px solid #000;"> Tinggi Badan</td>
			<td align="left" width="30%" style="border-right:1px solid #000;border-bottom:1px solid #000;">: '.$pertumbuhan2["TinggiBadan"].' cm</td>
		</tr>
		<tr>
			<td align="left" width="20%" style="border-left:1px solid #000;border-bottom:1px solid #000;"> Lingkar kepala</td>
			<td align="left" width="30%" style="border-right:1px solid #000;border-bottom:1px solid #000;">: '.$pertumbuhan["LingkarKepala"].' cm</td>
			<td align="left" width="20%" style="border-left:1px solid #000;border-bottom:1px solid #000;"> Lingkar kepala</td>
			<td align="left" width="30%" style="border-right:1px solid #000;border-bottom:1px solid #000;">: '.$pertumbuhan2["LingkarKepala"].' cm</td>
		</tr>
		';
$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//UNTUK RiWAYAT IMUNISASI
$html= '
	<table style="border-collapse:collapse;page-break-inside:avoid;" border="1" align="left" cellpadding="3">
		<tr>
			<th colspan="2" align="left" style="font-weight:bold;">RIWAYAT IMUNISASI</th>
		</tr>
		<tr>
			<th align="center" width="50%" style="font-weight:bold;border:1px solid #000;">Nama</th>
			<th align="center" width="50%" style="font-weight:bold;border:1px solid #000;">Tanggal</th>
		</tr>';
$count=0;
foreach ($riwayat_imunisasi as $key => $value) {
	$count++;
	$html.='
		<tr>
			<td style="border:1px solid #000;">'.$value["Nama"].'</td>
			<td style="border:1px solid #000;">'.date('d-m-Y',strtotime($value["Tanggal"])).'</td>
		</tr>
	';		
}
if($count==0){
	$html.='<tr><td colspan="2">Tidak ada riwayat imunisasi/td></tr>';
}	
$html.='</table>';
if($count==0){
	$html='';
}

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


//UNTUK RiWAYAT KESEHATAN
$html= '
	<table style="border-collapse:collapse;page-break-inside:avoid;" border="1" align="left" cellpadding="3">
		<tr>
			<th colspan="5" align="left" style="font-weight:bold;">Riwayat kesehatan selama '.$tanggal.'</th>
		</tr>
		<tr>
			<th align="center" width="5%" style="font-weight:bold;border:1px solid #000;">No</th>
			<th align="center" width="20%" style="font-weight:bold;border:1px solid #000;">Tanggal</th>
			<th align="center" width="25%" style="font-weight:bold;border:1px solid #000;">Diagnosa</th>
			<th align="center" width="20%" style="font-weight:bold;border:1px solid #000;">Terapi</th>
			<th align="center" width="30%" style="font-weight:bold;border:1px solid #000;">Catatan</th>
		</tr>';
$count=0;
foreach ($riwayat_kesehatan as $key => $value) {
	$count++;
	$html.='
		<tr>
			<td style="border:1px solid #000;">'.$count.'</td>
			<td style="border:1px solid #000;">'.date('d-m-Y',strtotime($value["Tanggal"])).'</td>
			<td style="border:1px solid #000;">'.$value["Diagnosa"].'</td>
			<td style="border:1px solid #000;">'.$value["Nama"].'</td>
			<td style="border:1px solid #000;">'.$value["Catatan"].'</td>
		</tr>
	';		
}
if($count==0){
	$html.='<tr><td colspan="5">Tidak ada riwayat kesehatan/td></tr>';
}	
$html.='</table>';
if($count==0){
	$html='';
}	

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//UNTUK KESIMPULAN SARAN
$html= '
	<table style="border-collapse:collapse;page-break-inside:avoid;" border="0" align="left" cellpadding="3">
		<tr>
			<td width="15%">Kesimpulan</td>
			<td width="85%">: '.$pertumbuhan["Kesimpulan"].'</td>
		</tr>
		<tr>
			<td width="15%">Saran</td>
			<td width="85%">: '.$pertumbuhan["Saran"].'</td>			
		</tr>
		<tr>
			<td width="15%"></td>
			<td width="85%"></td>			
		</tr>
		<tr>
			<td width="60%"></td>
			<td align="center" width="40%">Dokter TPA,</td>			
		</tr>
		<tr>
			<td width="60%"></td>
			<td align="center" width="40%"></td>			
		</tr>
		<tr>
			<td width="60%"></td>
			<td align="center" width="40%"></td>			
		</tr>
		<tr>
			<td width="60%"></td>
			<td align="center" width="40%">Dr.Adi Pramono Hendrata,Sp PK</td>			
		</tr>
		';

$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page*/
$pdf->lastPage();



//Close and output PDF document
ob_clean();
$namaFile='Form Kesehatan-'.$anak["Nama"];
$pdf->Output($namaFile, 'I');


//============================================================+
// END OF FILE
//============================================================+
