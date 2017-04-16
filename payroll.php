<?php
//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
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
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ambico');
$pdf->SetTitle('Upah');
$pdf->SetSubject('Upah');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

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
//$pdf->SetFont('times', 'BI', 20);

// add a page
//$pdf->AddPage("L", "A4");
$pdf->AddPage();

include "adodb5/adodb.inc.php";

$conn = ADONewConnection('mysql');
//$conn->Connect('localhost','root','admin','fin_pro');

if ($_SERVER["HTTP_HOST"] == "localhost" ) { // testing on local PC
	$conn->Connect('localhost','root','admin','fin_pro');
} elseif ($_SERVER["HTTP_HOST"] == "ambico.nma-indonesia.com") { // setting koneksi database untuk komputer server
	$conn->Connect('mysql.idhostinger.com','u945388674_ambic','M457r1P 81','u945388674_ambic');
}

$html  = '<table border="0" width="300">';
$html .= '<tr><td>DAFTAR UPAH HARIAN LEPAS</td></tr>';
$html .= '<tr><td>PT AMBICO - CARAT</td></tr>';
$html .= '<tr><td>Periode '.$_POST["start"].' s.d. '.$_POST["end"].'</td></tr>';
$html .= '</table>';

$html .= '<table border="1" width="100%">';
$html .= '<tr><th rowspan="2" align="center">No.</th><th rowspan="2" align="center">Nama / Bagian</th><th rowspan="2" align="center">NP</th><th rowspan="2" align="center">Total Upah</th><th colspan="2" align="center">Premi</th><th rowspan="2" align="center">Absen</th><th rowspan="2" align="center">Jumlah Terima</th></tr>';
$html .= '<tr><th align="center">Malam</th><th align="center">Hadir</th></tr>';

$mno = 1;

$msql = "
	select * from
		v_rekon a
		left join t_rumus_peg b on a.pegawai_id = b.pegawai_id
		left join t_rumus c on b.rumus_id = c.rumus_id
	where
		tgl between '".$_POST['start']."' and '".$_POST['end']."'
		and c.hk_gol = a.gol_hk
	order by
		a.pegawai_id
		, tgl
	"; //echo $msql; exit;
$rs = $conn->Execute($msql);
while (!$rs->EOF) {
	$mpegawai_id = $rs->fields["pegawai_id"];
	$mupah = 0;
	$mpremi_malam = 0;
	$mpremi_hadir = 0;
	$mtidak_masuk = 0;
	$mpot_absen = 0;
	while ($mpegawai_id == $rs->fields["pegawai_id"]) {
		$mupah += $rs->fields["upah"];
		if (substr($rs->fields["jk_kd"], 0, 2) == "S3") {
			$mpremi_malam += $rs->fields["premi_malam"];
		}
		$mpremi_hadir = $rs->fields["premi_hadir"];
		if (is_null($rs->fields["gol_hk"])) {
			$mtidak_masuk = 1;
			$mpot_absen += $rs->fields["pot_absen"];
		}
		$rs->MoveNext();
	}
	$mtotal = $mupah + $mpremi_malam + $mpremi_hadir - $mpot_absen;
	// echo $mupah." ".$mpremi_malam." ".($mtidak_masuk ? "0" : $mpremi_hadir)." ".$mtotal;
	$html .= '<tr><td>'.$mno.'</td><td>'.$rs->fields["pegawai_nama"].'</td><td>'.$rs->fields["pegawai_nip"].'</td>'.'<td align="right">'.number_format($mupah).'</td>'.'<td>'.$mpremi_malam.'</td>'.'<td>'.($mtidak_masuk ? "0" : $mpremi_hadir).'</td>'.'<td>'.$mpot_absen.'</td>'.'<td>'.$mtotal.'</td></tr>';
	$mno++;
}

$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Upah.pdf', 'I');
//echo $html;

$rs->Close();
$conn->Close();

// header("location: ./payroll_.php?ok=1");

?>