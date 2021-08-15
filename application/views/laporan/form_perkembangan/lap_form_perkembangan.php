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
$pdf->SetTitle('Laporan Form Perkembangan');
$pdf->SetSubject('Laporan Form Perkembangan');
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
	<table nobr="true" style="border-collapse:collapse;" border="0" align="center" cellpadding="5">
		<tr>
			<td width="40%" rowspan="3"><img src="'.base_url().'public/image/angelsni_logo.png" border="0" height="60" width="220" /></td>
			<td width="60%" colspan="4" style="font-size:18px;font-weight:bold;">Laporan Perkembangan Anak</td>
		</tr>
		<tr>
			<td align="left" width="10%">Tanggal</td>
			<td align="left" width="24%">: '.date('d-m-Y',strtotime($laporan[0]["Tanggal"])).'</td>
			<td align="left" width="18%"></td>
			<td align="left" width="8%"></td>
		</tr>
		<tr>
			<td align="left">Nama</td>
			<td align="left">: '.$anak["Nama"].'</td>
			<td align="left">Usia</td>
			<td align="left">: '.$usia.'</td>
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

$pdf->setCellHeightRatio(1.5);

$html= '
	<table style="border-collapse:collapse;" border="1" align="center" cellpadding="5">
		<tr>
			<th align="center" width="20%" style="font-weight:bold;">Aspek</th>
			<th align="center" width="50%" style="font-weight:bold;">Uraian</th>
			<th align="center" width="10%" style="font-weight:bold;">K</th>
			<th align="center" width="10%" style="font-weight:bold;">C</th>
			<th align="center" width="10%" style="font-weight:bold;">M</th>
		</tr>';
$count=0;
$id ='';
foreach ($laporan as $key => $value) {
	$count++;
	if($id!=$value["Id"]){
		$id=$value["Id"];
		$html.='
			<tr>
				<td rowspan="'.$value["jumlah"].'" style="verticel-align:middle;"><span style="font-size: 10px;">'.str_repeat('&nbsp;<br/>', $value["jumlah"]-1).'</span>'.$value["Nama"].'</td>
				<td align="left">'.$value["Indikator"].'</td>
				<td>';

				if($value["Nilai"]=="K")
				$html.='<img src="'.base_url().'public/image/centang.png" border="0" height="18" width="18" />';
				
		$html.='</td>
				<td>';

				if($value["Nilai"]=="C")
				$html.='<img src="'.base_url().'public/image/centang.png" border="0" height="18" width="18" />';

		$html.='</td>
				<td>';
				
				if($value["Nilai"]=="M")
				$html.='<img src="'.base_url().'public/image/centang.png" border="0" height="18" width="18" />';	

		$html.=	'</td>
			</tr>
		';		
	}else{
		$html.='
			<tr>
				<td align="left">'.$value["Indikator"].'</td>
				<td>';

				if($value["Nilai"]=="K")
				$html.='<img src="'.base_url().'public/image/centang.png" border="0" height="18" width="18" />';
				
		$html.='</td>
				<td>';

				if($value["Nilai"]=="C")
				$html.='<img src="'.base_url().'public/image/centang.png" border="0" height="18" width="18" />';

		$html.='</td>
				<td>';
				
				if($value["Nilai"]=="M")
				$html.='<img src="'.base_url().'public/image/centang.png" border="0" height="18" width="18" />';	

		$html.=	'</td>
			</tr>
		';	
	}
}

$html.='<tr><td align="left" colspan="5" style="font-weight:bold;">K : Kurang, C : Cukup, M : Mampu</td></tr>';
if($count==0){
	$html.='<tr><td colspan="5">Belum Ada Laporan untuk bulan ini</td></tr>';
}

$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$html= '
	<table style="border-collapse:collapse;page-break-inside:avoid;" border="1"  align="left" cellpadding="5">
		<tr>
			<th width="100%" style="font-weight:bold;">Simpulan dan Saran</th>
		</tr>
		<tr>
			<td>'.$laporan[0]["KesimpulanSaran"].'</td>
		</tr>
		<tr>
			<td width="70%">Nanny,<br><br><br><br></td>
			<td width="30%">Surabaya,<br>Penanggung Jawab<br><br></td>
		</tr>
		';

$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// reset pointer to the last page*/
$pdf->lastPage();



//Close and output PDF document
ob_clean();
$namaFile='Form Perkembangan-'.$anak["Nama"];
$pdf->Output($namaFile, 'I');


//============================================================+
// END OF FILE
//============================================================+
