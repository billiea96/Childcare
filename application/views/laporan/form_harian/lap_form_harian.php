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
$pdf->SetTitle('Laporan Form Harian');
$pdf->SetSubject('Laporan Form Harian');
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
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

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
	<table style="border-collapse:collapse;" border="0" align="center" cellpadding="5">
		<tr>
			<td width="40%" rowspan="3"><img src="'.base_url().'public/image/angelsni_logo.png" border="0" height="60" width="220" /></td>
			<td width="60%" colspan="4" style="font-size:18px;font-weight:bold;">Catatan Harian Anak</td>
		</tr>
		<tr>
			<td align="left" width="10%">Tanggal</td>
			<td align="left" width="24%">: '.date("d-m-Y",strtotime($form_harian["Tanggal"])).'</td>
			<td align="left" width="18%"></td>
			<td align="left" width="8%"></td>
		</tr>
		<tr>
			<td align="left">Nama</td>
			<td align="left">: '.$form_harian["NamaAnak"].'</td>
			<td align="left">Suhu badan dtg</td>
			<td align="left">: '.$form_harian["SuhuBadanDatang"].'</td>
		</tr>
		';

		
$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetFont('dejavusans', '', 8);

$pdf->setCellHeightRatio(0.5);

$html = '<br>
	<p style="margin-bottom:0px;"><b>Catatan khusus dari orang tua : </b></p>';
$pdf->writeHTML($html, true, false, true, false, '');	

$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->setCellHeightRatio(1.5);
$pdf->Ln(5);

$pdf->MultiCell(172, 10, $form_harian["CatatanOrangtua"], 1, 'L', 0, 1, '', '', true);

$pdf->Ln(2);

$html=	
'<p style="margin-bottom:0px;"><b>Kondisi kesehatan anak (Catatan dari orangtua) : </b></p>';
$pdf->writeHTML($html, true, false, true, false, '');	

$pdf->Ln(2);

$pdf->MultiCell(172, 10, $form_harian["KondisiKesehatan"], 1, 'L', 0, 1, '', '', true);	

$pdf->setCellHeightRatio(1);
$pdf->Ln(8);
//untuk daftar obat vitamin

if(count($daftar_obat_vit)>0){
$html= '
	<table style="border-collapse:collapse;" border="0" align="center" cellpadding="5">
		<tr>
			<th colspan="6" align="left" style="font-weight:bold;">Daftar Obat / Vitamin</th>
		</tr>
		<tr>
			<th align="center" width="22%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Nama Obat/Vit</th>
			<th align="center" width="12%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Dosis</th>
			<th align="center" width="15%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Jadwal Minum</th>
			<th align="center" width="15%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Waktu Pemberian</th>
			<th align="center" width="18%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Pemberi</th>
			<th align="center" width="18%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000">Penanggung Jawab</th>
		</tr>';
$count=0;
foreach ($daftar_obat_vit as $key => $value) {
	$count++;
	$html.='
		<tr>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.$value["Nama"].'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.$value["Dosis"].'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.$value["JadwalMinum"].'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.$value["WaktuPemberian"].'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.$value["NamaPemberi"].'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">'.$value["NamaPenanggungJawab"].'</td>
		</tr>
	';		
}
if($count==0){
	$html.='<tr><td colspan="4">Tidak Meminum Obat / Vitamin</td></tr>';
}	
$html.='</table>';


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
}

//UNTUK CATATAN MAKAN	
if(count($catatan_makan)>0){
$html= '
	<table style="border-collapse:collapse;" border="0" align="center" cellpadding="5">
		<tr>
			<th colspan="4" style="text-align: left; font-weight:bold;">Makan</th>
		</tr>
		<tr>
			<th align="center" width="20%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Jenis</th>
			<th align="center" width="8%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Waktu</th>
			<th align="center" width="40%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">Keterangan</th>
		</tr>';
$count=0;
foreach ($catatan_makan as $key => $value) {
	$count++;
	$html.='
		<tr>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.$value["Jenis"].'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.date('H:i',strtotime($value["Waktu"])).'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">'.$value["Keterangan"].'</td>
		</tr>
	';		
}
if($count==0){
	$html.='<tr><td colspan="4">Tidak Makan</td></tr>';
}	
$html.='</table>';


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
}
//UNTUK CATATAN SNACK
if(count($catatan_snack)>0){
$html= '
	<table style="border-collapse:collapse;page-break-inside:avoid;" border="0" align="center" cellpadding="5">
		<tr>
			<th colspan="4" align="left" style="font-weight:bold;">Snack</th>
		</tr>
		<tr>
			<th align="center" width="20%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Jenis</th>
			<th align="center" width="8%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Waktu</th>
			<th align="center" width="40%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">Keterangan</th>
		</tr>';
$count=0;
foreach ($catatan_snack as $key => $value) {
	$count++;
	$html.='
		<tr>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.$value["Jenis"].'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.date('H:i',strtotime($value["Waktu"])).'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">'.$value["Keterangan"].'</td>
		</tr>
	';		
}

if($count==0){
	$html.='<tr><td width="68%" style="border:1px solid #000;">Tidak Makan Snack</td></tr>';
}	
$html.='</table>';


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
}

//UNTUK CATATAN MINUM SUSU
$html= '
	<table style="border-collapse:collapse;page-break-inside:avoid;" border="0" align="center" cellpadding="5">
		<tr>
			<th colspan="3" width="52%" align="left" style="font-weight:bold;">Minum Susu</th>
			<th colspan="3" width="4%" align="left" style="font-weight:bold;"></th>
			<th colspan="3" width="44%" align="left" style="font-weight:bold;">BAB</th>
		</tr>
		<tr>
			<th align="center" width="8%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Waktu</th>
			<th align="center" width="8%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">CC</th>
			<th align="center" width="36%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">Keterangan</th>
			<th width="4%"></th>
			<th align="center" width="8%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Waktu</th>
			<th align="center" width="36%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">Keterangan</th>
		</tr>';
$count=0;
if(count($catatan_minum_susu>count($catatan_bab))){
	$count=count($catatan_minum_susu);
}else{
	$count=count($catatan_bab);
}
for($i=0;$i<$count;$i++) {
	$waktuMinumSusu=date('H:i',strtotime($catatan_minum_susu[$i]["Waktu"]));
	$cc =$catatan_minum_susu[$i]["CC"];
	$keteranganSusu=$catatan_minum_susu[$i]["Keterangan"];
	$waktuBab=date('H:i',strtotime($catatan_bab[$i]["Waktu"]));
	$keteranganBab=$catatan_bab[$i]["Keterangan"];

	if(empty($catatan_minum_susu[$i]['Waktu'])){
		$waktuMinumSusu='';
		$cc='';
		$keteranganSusu='';
	}
	if(empty($catatan_bab[$i]['Waktu'])){
		$waktuBab='';
		$keteranganBab='';
	}

	$html.='
		<tr>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.$waktuMinumSusu.'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.$cc.'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">'.$keteranganSusu.'</td>
			<td></td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.$waktuBab.'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">'.$keteranganBab.'</td>
		</tr>
	';		
}
if($count==0){
	$html.='
		<tr>
			<td width="52%" style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">-</td>
			<td width="4%"></td>
			<td width="44%" style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">-</td>
		</tr>
	';	
}
$html.='</table>';


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


//UNTUK CATATAN BAB
/*if(count($catatan_bab)>0){
$html= '
	<table style="border-collapse:collapse;page-break-inside:avoid;" border="0" align="center" cellpadding="5">
		<tr>
			<th colspan="2" align="left" style="font-weight:bold;">BAB</th>
		</tr>
		<tr>
			<th align="center" width="8%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Waktu</th>
			<th align="center" width="30%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">Keterangan</th>
		</tr>';
$count=0;
foreach ($catatan_bab as $key => $value) {
	$count++;
	$html.='
		<tr>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.date('H:i',strtotime($value["Waktu"])).'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">'.$value["Keterangan"].'</td>
		</tr>
	';		
}
if($count==0){
	$html.='<tr><td colspan="4">Tidak BAB</td></tr>';
}	
$html.='</table>';


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
}*/
//UNTUK CATATAN TIDUR
if(count($catatan_tidur)>0){
$html= '
	<table style="border-collapse:collapse;page-break-inside:avoid;" border="0" align="center" cellpadding="5">
		<tr>
			<th colspan="3" align="left" style="font-weight:bold;">Tidur</th>
		</tr>
		<tr>
			<th align="center" width="15%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">#</th>
			<th align="center" width="13%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Jam Tidur</th>
			<th align="center" width="13%" style="font-weight:bold;border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">Jam Bangun</th>
		</tr>';
$count=0;
foreach ($catatan_tidur as $key => $value) {
	$count++;
	$html.='
		<tr>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">Tidur '.$count.'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;">'.date('H:i',strtotime($value["JamMulaiTidur"])).'</td>
			<td style="border-top:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000;">'.date('H:i',strtotime($value["JamBangun"])).'</td>
		</tr>
	';		
}
if($count==0){
	$html.='<tr><td colspan="4">Tidak Tidur</td></tr>';
}	
$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
}

//UNTUK POTONG KUKU
$html= '<p><b>Potong kuku : </b>'.$form_harian["PotongKuku"].'</p>';	
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


//UNTUK CATATAN MAM
$html=	
'<p style="margin-bottom:0px;"><b>Catatan Khusus Dari Mam-ku : </b></p>';
$pdf->writeHTML($html, true, false, true, false, '');	

$pdf->Ln(2);
$pdf->setCellHeightRatio(1.7);
$pdf->MultiCell(172, 10, $form_harian["CatatanMom"], 1, 'L', 0, 1, '', '', true);	
$pdf->Ln(4);
$pdf->setCellHeightRatio(0.5);

//UNTUK BARANG YANG HARUS DIBAWA
$html= '<b>Mam-ku mengingatkan mama untuk membawa barang-barang dibawah ini : </b>';	


$pdf->writeHTML($html, true, false, true, false, '');

$pdf->setCellHeightRatio(1.5);


$html= '
	<table style="border-collapse:collapse;" border="0" align="left" cellpadding="5">
		';
$count=0;
foreach ($barang as $key => $value) {
	$count++;
	$html.='
		<tr>
			<td width="30%">- '.$value["Nama"].'</td>
			<td width="70%">: '.$value["Keterangan"].'</td>
		</tr>
	';		
}
if($count==0){
	$html.='<tr><td colspan="2">Tidak Ada Barang</td></tr>';
}	
$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//untuk tanda tangan
$html= '
	<table style="border-collapse:collapse;page-break-inside:avoid;" border="0" align="center" cellpadding="5">
		';
$html.='
		<tr>
			<td>Pengasuh</td>
			<td>Penanggung Jawab</td>
			<td>Mengetahui (orang tua)</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>(................................)</td>
			<td>(................................)</td>
			<td>(................................)</td>
		</tr>
	';		
	
$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();



//Close and output PDF document
ob_clean();
$namaFile='Form Harian-'.$form_harian["NamaAnak"];
$pdf->Output($namaFile, 'I');


//============================================================+
// END OF FILE
//============================================================+
