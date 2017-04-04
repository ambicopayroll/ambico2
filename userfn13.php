<?php

// Global user functions
// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

function tgl_indo($tgl) {
	$a_namabln = array(
		1 => "Januari",
		"Februari",
		"Maret",
		"April",
		"Mei",
		"Juni",
		"Juli",
		"Agustus",
		"September",
		"Oktober",
		"November",
		"Desember"
	);
	$a_hari = array(
		"Minggu",
		"Senin",
		"Selasa",
		"Rabu",
		"Kamis",
		"Jumat",
		"Sabtu");
	$tgl_data = strtotime($tgl);

	//$tgl_data = $tgl;
	$tanggal = date("d", $tgl_data);
	$bulan = $a_namabln[date("m", $tgl_data)];
	$tahun = date("Y", $tgl_data);
	$hari - date("w", $tgl);
	return $a_hari.", ".$tanggal." ".$bulan." ".$tahun;
}
?>
