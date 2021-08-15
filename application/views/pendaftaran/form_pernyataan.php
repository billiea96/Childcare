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
$pdf->SetTitle('Form Pernyataan');
$pdf->SetSubject('Form Pernyataan');
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, 15);
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

/*PAGE 1*/
// add a page
$pdf->AddPage();


$pdf->setCellHeightRatio(1.4);

$kelamin = '';
if($anak['Kelamin']=='L')
  $kelamin='Laki-Laki';
else
  $kelamin='Perempuan';

$tanggalLahir1=$pendaftaran[39]['Jawaban'];
$tanggalLahir2=$pendaftaran[40]['Jawaban'];
$tanggalLahir3=$pendaftaran[41]['Jawaban'];

if($tanggalLahir1!='-'){
  $tanggalLahir1=date('m-d-Y',strtotime($tanggalLahir1));
}
if($tanggalLahir2!='-'){
  $tanggalLahir2=date('m-d-Y',strtotime($tanggalLahir2));
}
if($tanggalLahir3!='-'){
  $tanggalLahir3=date('m-d-Y',strtotime($tanggalLahir3));
}
$html= '
  <table style="border-collapse:collapse;" border="0" align="center" cellpadding="3">
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;">FORM PERNYATAAN</td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="25%" style="">No. Pendaftaran </th>
      <th align="left" width="45%" style="">: &nbsp; '.$pendaftaran[0]["NoForm"].'</th>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="25%" style="">Tanggal mendaftar </th>
      <th align="left" width="45%" style="">: &nbsp; '.date("d-m-Y",strtotime($pendaftaran[0]["Tanggal"])).'</th>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="15%" style="">Nama anak :</th>
      <th align="left" width="30%" style="">'.$anak["Nama"].'</th>
      <th align="center" width="15%" style="">Tanggal lahir</th>
      <th align="left" width="15%" style="">: '.date("d-m-Y",strtotime($anak["TanggalLahir"])).'</th>
      <th align="right" width="10%" style="">Sex : </th>
      <th align="left" width="15%" style="">'.$kelamin.'</th>
    </tr>
    <tr>
      <th align="left" width="35%" style="">Nama panggilan anak dirumah :</th>
      <th align="left" width="65%" style="">'.$anak["Panggilan"].'</th>
    </tr>
    <tr>
      <th align="left" width="33%" style="">Nama dokter anak tersebut : </th>
      <th align="left" width="27%" style="">'.$anak["Dokter"].'</th>
      <th align="right" width="15%" style="">No. telp : </th>
      <th align="left" width="25%" style="">'.$anal["NoTelpDokter"].'</th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="22%" style="">Nama lengkap ayah </th>
      <th align="left" width="78%" style=""> : &nbsp;'.$orangtua["NamaAyah"].'</th>
    </tr>
    <tr>
      <th align="left" width="22%" style="">Alamat ayah </th>
      <th align="left" width="78%" style=""> : &nbsp;'.$orangtua["AlamatRumahAyah"].'</th>
    </tr>
    <tr>
      <th align="left" width="18%" style="">No. telp rumah :</th>
      <th align="left" width="17%" style="">'.$orangtua["NoTelpRumahAyah"].'</th>
      <th align="left" width="15%" style="">Tempat kerja</th>
      <th align="left" width="17%" style="">: '.$orangtua["NoTempatKerjaAyah"].'</th>
      <th align="right" width="10%" style="">No Hp :</th>
      <th align="left" width="20%" style="">'.$orangtua["NoHPAyah"].'</th>
    </tr>
    <tr>
      <th align="left" width="22%" style="">Alamat tempat kerja </th>
      <th align="left" width="78%" style=""> : &nbsp;'.$orangtua["AlamatKerjaAyah"].'</th>
    </tr>
    <tr>
      <th align="left" width="30%" style="">Lama bekerja dalam sehari </th>
      <th align="left" width="70%" style=""> : &nbsp;'.$orangtua["JamKerjaAyah"].' Jam</th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="22%" style="">Nama lengkap ibu </th>
      <th align="left" width="78%" style=""> : &nbsp;'.$orangtua["NamaIbu"].'</th>
    </tr>
    <tr>
      <th align="left" width="22%" style="">Alamat ibu </th>
      <th align="left" width="78%" style=""> : &nbsp;'.$orangtua["AlamatRumahIbu"].'</th>
    </tr>
    <tr>
      <th align="left" width="18%" style="">No. telp rumah :</th>
      <th align="left" width="17%" style="">'.$orangtua["NoTelpRumahIbu"].'</th>
      <th align="left" width="15%" style="">Tempat kerja</th>
      <th align="left" width="17%" style="">: '.$orangtua["NoTempatKerjaIbu"].'</th>
      <th align="right" width="10%" style="">No Hp :</th>
      <th align="left" width="20%" style="">'.$orangtua["NoHPIbu"].'</th>
    </tr>
    <tr>
      <th align="left" width="22%" style="">Alamat tempat kerja </th>
      <th align="left" width="78%" style=""> : &nbsp;'.$orangtua["AlamatKerjaIbu"].'</th>
    </tr>
    <tr>
      <th align="left" width="30%" style="">Lama bekerja dalam sehari </th>
      <th align="left" width="70%" style=""> : &nbsp;'.$orangtua["JamKerjaIbu"].' Jam</th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Orang lain yang dapat dikontak saat darurat dan menjemput anak tersebut</th>
    </tr>
    <tr>
      <th align="left" width="10%" style="">1. Nama </th>
      <th align="left" width="40%" style=""> : &nbsp;'.$pendaftaran[20]["Jawaban"].'</th>
      <th align="left" width="10%" style="">2. Nama </th>
      <th align="left" width="40%" style=""> : &nbsp;'.$pendaftaran[21]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="24%" style=""> &nbsp;&nbsp;&nbsp;Hubungan dg anak :</th>
      <th align="left" width="26%" style=""> '.$pendaftaran[22]["Jawaban"].'</th>
      <th align="left" width="24%" style=""> &nbsp;&nbsp;&nbsp;Hubungan dg anak :</th>
      <th align="left" width="26%" style=""> '.$pendaftaran[23]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style=""> &nbsp;&nbsp;&nbsp;No. telp rumah :</th>
      <th align="left" width="30%" style=""> '.$pendaftaran[24]["Jawaban"].'</th>
      <th align="left" width="20%" style=""> &nbsp;&nbsp;&nbsp;No. telp rumah :</th>
      <th align="left" width="30%" style=""> '.$pendaftaran[25]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="12%" style=""> &nbsp;&nbsp;&nbsp;No. HP :</th>
      <th align="left" width="38%" style=""> '.$pendaftaran[26]["Jawaban"].'</th>
      <th align="left" width="12%" style=""> &nbsp;&nbsp;&nbsp;No. HP :</th>
      <th align="left" width="38%" style=""> '.$pendaftaran[27]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="22%" style=""> &nbsp;&nbsp;&nbsp;No. tempat kerja :</th>
      <th align="left" width="28%" style=""> '.$pendaftaran[28]["Jawaban"].'</th>
      <th align="left" width="22%" style=""> &nbsp;&nbsp;&nbsp;No. tempat kerja :</th>
      <th align="left" width="28%" style=""> '.$pendaftaran[29]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Orang lain yang dapat menjemput anak tersebut :</th>
    </tr>
    <tr>
      <th align="left" width="10%" style="">Nama </th>
      <th align="left" width="40%" style=""> : &nbsp;'.$pendaftaran[30]["Jawaban"].'</th>
      <th align="left" width="18%" style="">No. telp & HP </th>
      <th align="left" width="32%" style=""> : &nbsp;'.$pendaftaran[33]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="10%" style="">Nama </th>
      <th align="left" width="40%" style=""> : &nbsp;'.$pendaftaran[31]["Jawaban"].'</th>
      <th align="left" width="18%" style="">No. telp & HP </th>
      <th align="left" width="32%" style=""> : &nbsp;'.$pendaftaran[34]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="10%" style="">Nama </th>
      <th align="left" width="40%" style=""> : &nbsp;'.$pendaftaran[32]["Jawaban"].'</th>
      <th align="left" width="18%" style="">No. telp & HP </th>
      <th align="left" width="32%" style=""> : &nbsp;'.$pendaftaran[35]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Anak lainnya dalam keluarga anda :</th>
    </tr>
    <tr>
      <th align="left" width="10%" style="">Nama </th>
      <th align="left" width="40%" style=""> : &nbsp;'.$pendaftaran[36]["Jawaban"].'</th>
      <th align="left" width="18%" style="">Tanggal lahir </th>
      <th align="left" width="32%" style=""> : &nbsp;'.$tanggalLahir1.'</th>
    </tr>
    <tr>
      <th align="left" width="10%" style="">Nama </th>
      <th align="left" width="40%" style=""> : &nbsp;'.$pendaftaran[37]["Jawaban"].'</th>
      <th align="left" width="18%" style="">Tanggal lahir </th>
      <th align="left" width="32%" style=""> : &nbsp;'.$tanggalLahir2.'</th>
    </tr>
    <tr>
      <th align="left" width="10%" style="">Nama </th>
      <th align="left" width="40%" style=""> : &nbsp;'.$pendaftaran[38]["Jawaban"].'</th>
      <th align="left" width="18%" style="">Tanggal lahir </th>
      <th align="left" width="32%" style=""> : &nbsp;'.$tanggalLahir3.'</th>
    </tr>
    ';




$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

/*PAGE 2*/
// add a page
$pdf->AddPage();

$pdf->setCellHeightRatio(1.4);


$html= '
  <table style="border-collapse:collapse;" border="0" align="center" cellpadding="3">
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="100%" style="font-weight:bold;">Makanan</th>
    </tr>
    <tr>
      <th align="left" width="47%" style="">Apakah anak anda masih mengkonsumsi ASI?</th>
      <th align="left" width="53%" style="">'.$pendaftaran[42]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Jika ya: </th>
    </tr>
    <tr>
      <th align="left" width="55%" style="">Apakah anda berencana melanjutkan pemberian ASI?</th>
      <th align="left" width="45%" style="">'.$pendaftaran[43]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Jika ya, apa rencana untuk melanjutkan hal tersebut?</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[44]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="100%" style="">Bagaimana jadwal pemberian ASI tersebut?</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[45]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="100%" style="">Apakah anda memberikan suplemen lain?</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[46]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="42%" style="">Apakah anak anda menggunakan botol?</th>
      <th align="left" width="58%" style="">'.$pendaftaran[47]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Jika ya: Bagaimana jadwal pemberiannya?</th>
    </tr>
    <br>
    <tr>
      <th align="center" width="30%" style="font-weight:bold;border:1px solid #000;">Cairan</th>
      <th align="center" width="70%" style="font-weight:bold;border:1px solid #000;">Merek, Jumlah, Waktu</th>
    </tr>
    <tr>
      <th align="left" width="30%" style="border:1px solid #000;"> Susu formula</th>
      <th align="left" width="70%" style="border:1px solid #000;"> &nbsp;'.$pendaftaran[49]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="30%" style="border:1px solid #000;"> Susu murni</th>
      <th align="left" width="70%" style="border:1px solid #000;"> &nbsp;'.$pendaftaran[50]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="30%" style="border:1px solid #000;"> Air</th>
      <th align="left" width="70%" style="border:1px solid #000;"> &nbsp;'.$pendaftaran[51]["Jawaban"].'</th>
    </tr>
    <br>
    <tr>
      <th align="left" width="100%" style="">Bagaimana posisi anak anda biasanya saat diberi makan menggunakan botol?</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[52]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="100%" style="">Bagaimana posisi yang disukai anak anda saat disendawakan?</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[53]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="63%" style="">Apakah anak anda sudah dikenalkan dengan makanan padat?</th>
      <th align="left" width="37%" style="">'.$pendaftaran[54]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="23%" style="">Jika ya, apa jenisnya?</th>
      <th align="left" width="77%" style="">'.$pendaftaran[55]["Jawaban"].'</th>
    </tr>
    ';

$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

/*PAGE 3*/
// add a page
$pdf->AddPage();

$pdf->setCellHeightRatio(1.4);


$html= '
  <table style="border-collapse:collapse;" border="0" align="center" cellpadding="3">
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Bagaimana jadwal pemberian makan anak anda?</th>
    </tr>
    <br>
    <tr>
      <th align="center" width="20%" style="font-weight:bold;border:1px solid #000;">Makanan padat</th>
      <th align="center" width="20%" style="font-weight:bold;border:1px solid #000;">Merek</th>
      <th align="center" width="20%" style="font-weight:bold;border:1px solid #000;">Kepadatan</th>
      <th align="center" width="20%" style="font-weight:bold;border:1px solid #000;">Jumlah</th>
      <th align="center" width="20%" style="font-weight:bold;border:1px solid #000;">Waktu</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Cereal</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[57]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[57]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[57]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[57]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Cereal</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[58]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[58]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[58]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[58]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Cereal</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[59]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[59]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[59]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[59]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Sayuran</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[60]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[60]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[60]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[60]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Sayuran</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[61]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[61]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[61]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[61]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Sayuran</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[62]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[62]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[62]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[62]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Sayuran</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[63]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[63]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[63]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[63]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Buah</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[64]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[64]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[64]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[64]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Buah</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[65]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[65]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[65]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[65]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Buah</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[66]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[66]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[66]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[66]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Buah</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[67]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[67]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[67]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[67]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Daging</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[68]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[68]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[68]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[68]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Daging</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[69]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[69]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[69]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[69]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Snack</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[70]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[70]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[70]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[70]['Jawaban'])[3].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="border:1px solid #000;"> Snack</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[71]['Jawaban'])[0].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[71]['Jawaban'])[1].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[71]['Jawaban'])[2].'</th>
      <th align="left" width="20%" style="border:1px solid #000;">&nbsp;'.explode(',',$pendaftaran[71]['Jawaban'])[3].'</th>
    </tr>
    <br>
    <tr>
      <th align="left" width="55%" style="">Apakah anak anda alergi terhadap makanan tertentu?</th>
      <th align="left" width="45%" style="">'.$pendaftaran[72]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="">Jika ya, sebutkan:</th>
      <th align="left" width="80%" style="">'.$pendaftaran[73]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Makanan apa yang disukai atau tidak disukai anak anda?</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[74]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="100%" style="font-weight:bold;">Tidur</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Jelaskan jadwal tidur anak anda (termasuk tidur siang dan lamanya)?</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[75]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="58%" style="">Apakah biasanya anak anda menangis saat akan tidur?</th>
      <th align="left" width="42%" style="">'.$pendaftaran[76]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="25%" style="">Jika ya, berapa lama?</th>
      <th align="left" width="75%" style="">'.$pendaftaran[77]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="40%" style="">Dimanakah biasanya anak anda tidur?</th>
      <th align="left" width="60%" style="">'.$pendaftaran[78]["Jawaban"].'</th>
    </tr>
    ';

$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


/*PAGE 4*/
// add a page
$pdf->AddPage();

$pdf->setCellHeightRatio(1.4);


$html= '
  <table style="border-collapse:collapse;" border="0" align="center" cellpadding="3">
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="100%" style="font-weight:bold;">Pemakaian Popok</th>
    </tr>
    <br>
    <tr>
      <th align="left" width="52%" style="">Apakah merek popok yang digunakan anak anda?</th>
      <th align="left" width="48%" style="">'.$pendaftaran[79]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Jelaskan cara pemakaian popok ke anak anda (termasuk pemberian krim dan bedak)</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[80]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="70%" style="">Apakah anak anda rentan mengalami luka karena pemakaian popok?</th>
      <th align="left" width="30%" style="">'.$pendaftaran[81]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="15%" style="">Perawatan : </th>
      <th align="left" width="90%" style="">'.$pendaftaran[82]["Jawaban"].'</th>
    </tr>
    <br><br>
    <tr>
      <th align="left" width="100%" style="font-weight:bold;">Perkembangan Sosial/Emosional</th>
    </tr>
    <br>
    <tr>
      <th align="left" width="100%" style="">Jelaskan karakter anak anda: (misal: sering sakit perut, suka memeluk)</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[83]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="100%" style="">Tanda apa yang ditunjukan anak anda saat lapar, lelah, dan terlalu bersemangat? (misal: menarik telinga, mengusap mata)</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[84]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="60%" style="">Apakah anak anda sudah terbiasa terpisah dengan anda? </th>
      <th align="left" width="40%" style="">'.explode(",",$pendaftaran[85]["Jawaban"])[0].'</th>
    </tr>
    <tr>
      <th align="left" width="11%" style="">Jelaskan : </th>
      <th align="left" width="89%" style="">'.explode(",",$pendaftaran[85]["Jawaban"])[1].'</th>
    </tr>
    <tr>
      <th align="left" width="45%" style="">Apakah anak anda takut terhadap sesuatu? </th>
      <th align="left" width="55%" style="">'.explode(",",$pendaftaran[86]["Jawaban"])[0].'</th>
    </tr>
    <tr>
      <th align="left" width="11%" style="">Jelaskan : </th>
      <th align="left" width="89%" style="">'.explode(",",$pendaftaran[86]["Jawaban"])[1].'</th>
    </tr>
    <tr>
      <th align="left" width="65%" style="">Apakah anak anda punya mainan, selimut atau benda lainnya? </th>
      <th align="left" width="35%" style="">'.explode(",",$pendaftaran[87]["Jawaban"])[0].'</th>
    </tr>
    <tr>
      <th align="left" width="12%" style="">Sebutkan : </th>
      <th align="left" width="88%" style="">'.explode(",",$pendaftaran[87]["Jawaban"])[1].'</th>
    </tr>
    <tr>
      <th align="left" width="68%" style="">Apakah anak anda sering menghabiskan waktu dengan anak lain? </th>
      <th align="left" width="32%" style="">'.$pendaftaran[88]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="55%" style="">Jelaskan : (dengan siapa, kapan, berapa sering) </th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[89]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="55%" style="">Aktifitas apa yang anak anda sukai </th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[90]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="55%" style="">Apakah anak tersebut pernah dititipkan sebelumnya? </th>
      <th align="left" width="45%" style="">'.$pendaftaran[91]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="55%" style="">Jika ya, ceritakan: </th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[92]["Jawaban"].'<br></th>
    </tr>
    <br>
    ';

$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


/*PAGE 5*/
// add a page
$pdf->AddPage();

$pdf->setCellHeightRatio(1.4);


$html= '
  <table style="border-collapse:collapse;" border="0" align="center" cellpadding="3">
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="100%" style="font-weight:bold;">Pemakaian Popok</th>
    </tr>
    <br>
    <tr>
      <th align="left" width="38%" style="">Apakah anak anda rutin diimunisasi?</th>
      <th align="left" width="62%" style="">'.$pendaftaran[93]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="38%" style="">Jika tidak,</th>
    </tr>
    <tr>
      <th align="left" width="11%" style="">Jelaskan?</th>
      <th align="left" width="89%" style="">'.$pendaftaran[94]["Jawaban"].'</th>
    </tr>
    <br>
    <tr>
      <th align="left" width="100%" style="">Catatan : sertakan dokumen imunisasi</th>
    </tr>
    <br>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-weight:bold;">Kesehatan Anak</td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="50%" style="">Apakah anak anda memiliki masalah kesehatan?</th>
      <th align="left" width="50%" style="">'.$pendaftaran[95]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">(Jika ya, sertakan surat-surat yang berkaitan)</th>
    </tr>
    <br>
    <tr>
      <th align="left" width="100%" style="">Penyakit yang sedang atau pernah dialami anak : </th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[96]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="100%" style="">Sebutkan kecelakaan atau luka yang pernah dialami anak anda : </th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[97]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="30%" style="">Apakah anak memiliki alergi?</th>
      <th align="left" width="70%" style="">'.$pendaftaran[98]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Jika ya, alergi terhadap apa dan bagaimana gejala yang muncul : </th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[99]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="57%" style="">Apakah anak anda harus menggunakan obat tertentu?</th>
      <th align="left" width="43%" style="">'.$pendaftaran[100]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Jika ya, sebutkan nama obatnya dan dalam kondisi apa obat tersebut diberikan : </th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[101]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="73%" style="">Apakah anda memiliki kekuatiran terhadap pekermbangan anak anda?</th>
      <th align="left" width="27%" style="">'.$pendaftaran[102]["Jawaban"].'</th>
    </tr>
    <tr>
      <th align="left" width="100%" style="">Jika ya, jelaskan : </th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[103]["Jawaban"].'<br></th>
    </tr>
    <br>
    <tr>
      <th align="left" width="100%" style="">Berikan informasi mengenai kondisi kesehatan anak atau kebutuhan khusus lainnya yang harus diperhatikan pengasuh anak anda : </th>
    </tr>
    <tr>
      <th align="left" width="100%" style="border:1px solid #000;line-height:20px;">&nbsp;'.$pendaftaran[104]["Jawaban"].'<br></th>
    </tr>
    ';

$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


/*PAGE 6*/
// add a page
$pdf->AddPage();

$pdf->setCellHeightRatio(1.4);


$html= '
  <table style="border-collapse:collapse;" border="0" align="center" cellpadding="3">
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="left" width="20%" style="">Paket Penitipan</th>
      <th align="left" width="80%" style=""> : '.$paket["Nama"].'</th>
    </tr>
    <tr>
      <th align="left" width="20%" style="">Tanggal dititipkan</th>
      <th align="left" width="80%" style=""> : '.date("m-d-Y",strtotime($paket["Tanggal"])).'</th>
    </tr>
    <br>
    <br>
    <tr>
      <th align="justify" width="100%" style="">&nbsp;&nbsp;&nbsp;&nbsp;Saya yang bertanda tangan dibawah ini menyatakan bahwa telah mengisi form pendaftaran online dengan sebenar-benarnya dan segala jenis kesalahan dalam pengisian dan informasi yang berkaitan dengan anak tersebut diatas, saya sendiri yang bertanggung jawab. Dan form pernyataan ini adalah bukti bahwa saya ingin mendaftarkan anak.</th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="right" width="60%" style=""></th>
      <th align="center" width="40%" style="">Surabaya,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="center" width="15%" style=""></th>
      <td width="70%" colspan="2" style="font-size:14px;font-weight:bold;"></td>
      <th align="center" width="15%" style=""></th>
    </tr>
    <tr>
      <th align="right" width="60%" style=""></th>
      <th align="center" width="40%" style="">(..................................)</th>
    </tr>
    ';

$html.='</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page*/
$pdf->lastPage();



//Close and output PDF document
ob_clean();
$namaFile='Form Pernyataan ';
$pdf->Output($namaFile, 'I');


//============================================================+
// END OF FILE
//============================================================+
